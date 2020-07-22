<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/Database.php';
include_once '../../models/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$stmt = $user->read();
$num = $stmt->rowCount();
echo json_encode($stmt);;

if ($num > 0) {

    $users_arr = array();
    $users_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $user_item = array(
            "id" => $row['id'],
            "email" => $row['email'],
            "firstName" => $row['firstName'],
            "lastName" => $row['lastName'],
            "createdAt" => $row['createdAt'],
        );

        array_push($users_arr["records"], $user_item);
    }

    http_response_code(200);

    echo json_encode($users_arr);
} else {

    http_response_code(404);

    echo json_encode(
        array("message" => "No users found.")
    );
}