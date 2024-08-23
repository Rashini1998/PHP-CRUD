<?php

include 'db_connection.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $sql = "DELETE FROM users WHERE usersId=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

   
    header("Location: index.php");
    exit();
} else {
    echo "No ID parameter provided.";
}
?>
