<?php require 'vendor/autoload.php';

// Create a new Container with Guzzle injected
$container = new \Slim\Container([
    'http' => function () {
        return new GuzzleHttp\Client();
    }
]);

// Instantiate the App object
$app = new \Slim\App($container);

// Get weather by id (890869 for Gothenburg - http://woeid.rosselliot.co.nz)
$app->get('/locations/{id}', function ($request, $response, $args) {
    // Get the weather from MetaWeather
    $result =
        $this->http->get("https://www.metaweather.com/api/location/{$args['id']}")
            ->getBody()
            ->getContents();
    // Return the result as JSON
    return $response->withStatus(200)->withJson(json_decode($result));
});

// Delete weather by id
$app->delete('/locations/{id}', function ($request, $response, $args) {
    return $response->withStatus(200)->write("Location {$args['id']} deleted.");
});

/**
 * Try to run the application else echo an Exception.
 */
try {
    $app->run();
} catch (Exception $e){
    echo "Error: " .  $e;
}

