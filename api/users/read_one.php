<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if (isset($_GET['id']) && $_GET['id'] > 0) {

    $user->id = $_GET['id'];

    if ($user->readOneUser()) {

        $product_arr = array(
            "id" => $user->id,
            "email" => $user->email,
            "firstName" => $user->firstName,
            "lastName" => $user->lastName,
            "createdAt" => $user->createdAt
        );

        http_response_code(200);

        echo json_encode($product_arr);
    } else {

        http_response_code(404);

        echo json_encode(array("message" => "User does not exist."));
    }
} else {

    http_response_code(400);

    echo json_encode(array("message" => "Unable to update user. No valid ID."));
}
