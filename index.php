<?php require 'vendor/autoload.php';

// Instantiate the App object
$app = new \Slim\App();

// Declare routes
$app->get('/locations/{id}', function ($request, $response, $args) {
    return $response->withStatus(200)->write("Location {$args['id']} retrieved.");
});
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

