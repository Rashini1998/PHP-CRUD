<?php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phptest";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

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

    $sql = "INSERT INTO users (usersName, usersEmail, usersPhone, usersAddress) VALUES ('$usersName', '$usersEmail', '$usersPhone', '$usersAddress')";

    // if ($conn->query($sql) === FALSE) {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
    if ($conn->query($sql) === TRUE) {
        // Redirect after successful insert
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve data
$sql = "SELECT usersName, usersEmail, usersPhone, usersAddress FROM users";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
</head>
<body>
    <div class="container my-5">
        <h1>Form </h1>
        <form method="post" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="John" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="0778452369" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Colombo, Sri Lanka" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <h2 class="my-5">Inserted Data</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["usersName"] . "</td><td>" . $row["usersEmail"] . "</td><td>" . $row["usersPhone"] . "</td><td>" . $row["usersAddress"] . "</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
