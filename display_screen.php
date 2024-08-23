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

// Retrieve data
$sql = "SELECT usersName, usersEmail, usersPhone,usersAddress FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>User Information</h2>";
    echo "<table border='1'><tr><th>Name</th><th>Email</th><th>Phone</th><th>Address</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["usersName"]."</td><td>".$row["usersEmail"]."</td><td>".$row["usersPhone"]."</td><td>".$row["usersAddress"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
