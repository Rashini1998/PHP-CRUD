<?php

include 'db_connection.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['usersId']; 
    $name = $_POST['usersName'];
    $email = $_POST['usersEmail'];
    $phone = $_POST['usersPhone'];
    $address = $_POST['usersAddress'];

   
    $sql = "UPDATE users SET usersName=?, usersEmail=?, usersPhone=?, usersAddress=? WHERE usersId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    
    header("Location: index.php");
    exit();
} else {
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        
        $sql = "SELECT * FROM users WHERE usersId=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            echo "No record found with this ID.";
            exit();
        }
    } else {
        echo "No ID parameter provided.";
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
</head>
<body>
<div class="container my-5">
    <h1>Update User</h1>
    <form method="POST" action="update.php">
    <input type="hidden" name="usersId" value="<?php echo htmlspecialchars($row['usersId']); ?>" />
    <div class="mb-3">
    <label for="usersName" class="form-label">Name</label>
    <input type="text" class="form-control" id="usersName" name="usersName" placeholder="Name" value="<?php echo htmlspecialchars($row['usersName']); ?>" required>
  </div>
  <div class="mb-3">
    <label for="usersEmail" class="form-label">Email address</label>
    <input type="email" class="form-control" id="usersEmail" name="usersEmail" placeholder="Email" value="<?php echo htmlspecialchars($row['usersEmail']); ?>" required>
  </div>
  <div class="mb-3">
    <label for="usersPhone" class="form-label">Phone Number</label>
    <input type="text" class="form-control" id="usersPhone" name="usersPhone" placeholder="Phone Number" value="<?php echo htmlspecialchars($row['usersPhone']); ?>" required>
  </div>
  <div class="mb-3">
    <label for="usersAddress" class="form-label">Address</label>
    <input type="text" class="form-control" id="usersAddress" name="usersAddress" placeholder="Address"  value="<?php echo htmlspecialchars($row['usersAddress']); ?>" required>
  </div>
  <button type="submit" class="btn btn-success">Update</button>
  <button type="submit" class="btn btn-warning" onclick="window.location.href='index.php';">Cancel</button>
</form>
</div>



</body>
</html>
