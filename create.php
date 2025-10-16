<?php
header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");


$servername = "localhost";
$username = "root";
$password = "";
$db_name = "student_api";

$conn = new mysqli($servername, $username, $password, $db_name);

if ($conn->connect_error) {
    die(json_encode(["error" => "connection failed " . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);


$name = $data["name"];
$email = $data["email"];
$course = $data["course"];

$sql = "INSERT INTO students (name, email, course) VALUES ('$name', '$email', '$course')";

if ($conn->query($sql)) {
    echo json_encode(["message" => "Student added successfully!"]);
} else {
    echo json_encode(["error" => "Failed to insert data."]);
}

$conn->close();
