<?php
/**
 * Created by PhpStorm.
 * User: IPN Gabii
 * Date: 2018. 02. 27.
 * Time: 10:04
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

use Medoo\Medoo;

// Initialize
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'bitophpbe',
    'server' => 'localhost',
    'username' => 'homestead',
    'password' => 'secret'
]);

// Test
//$database->insert('user', [
//    'username' => 'bito23',
//    'email' => 'faszbito2@pina.kukac',
//    'password' => hash('SHA512', 'bitorina')
//]);

$app = new \Slim\App;

$app->post('/user/add-new', function (Request $request, Response $response, array $args) use ($database) {
    $data = $request->getParsedBody();
    $database->insert('user', [
        'username' => $data["username"],
        'email' => $data["email"],
        'password' => hash('SHA512', $data["password"])
    ]);
});

$app->get('/user/read/{id}', function (Request $request, Response $response, array $args) use ($database) {
    // az $args array-ben tárolja az url-ben lévő változókat
    // jelen esetben ez úgy néz ki hogy $args["id"]
    // var_dump($args["id"]);

    // json formátumban adom vissza az adatokat a c#-nak ezt kell majd feldolgoznod
    $data = $database->select("user", [
            "username",
            "email"
        ], [
            "id" => $args["id"]
        ]
    );
    return json_encode($data);
});
$app->run();