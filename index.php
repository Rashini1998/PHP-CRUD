<?php

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usersName = $_POST['name'];
    $usersEmail = $_POST['email'];
    $usersPhone = $_POST['phone'];
    $usersAddress = $_POST['address'];

    $sql = "INSERT INTO users (usersName, usersEmail, usersPhone, usersAddress) VALUES ('$usersName', '$usersEmail', '$usersPhone', '$usersAddress')";

    if ($conn->query($sql) === TRUE) {
     
        header("Location: " . $_SERVER['PHP_SELF']);
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$sql = "SELECT usersId, usersName, usersEmail, usersPhone, usersAddress FROM users";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["usersName"] . "</td><td>" . $row["usersEmail"] . "</td><td>" . $row["usersPhone"] . "</td><td>" . $row["usersAddress"] . "</td>";
                        echo "<td>";        
                        echo "<a href='update.php?id=" . htmlspecialchars($row["usersId"]) . "' class='btn btn-success'>Update</a> ";               
                        echo "<a href='delete.php?id=" . htmlspecialchars($row["usersId"]) . "' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>";
                        echo "</td>";
                        echo "</tr>";

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
