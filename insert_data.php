<?php

include 'db_connection.php';

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
