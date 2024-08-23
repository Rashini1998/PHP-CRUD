<?php

//database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phptest";

//create connection
$conn = new mysqli($servername,$username,$password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usersName = $_POST['name'];
    $usersEmail = $_POST['email'];
    $usersPhone = $_POST['phone'];
    $usersAddress = $_POST['address'];

    $sql = "INSERT INTO users (usersName, usersEmail, usersPhone, usersAddress) VALUES ('$usersName','$usersEmail','$usersPhone','$usersAddress')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>
