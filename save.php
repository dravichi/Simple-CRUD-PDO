<?php
$id = $_POST['id'];
$conn = require_once 'Connection.php';
$title = trim($_POST['title']);
$description = trim($_POST['description']);
if (empty($title) || empty($description)) {
    echo "<script>
            alert('Error : Make sure you fill out the form!')
            location.replace('index.php')
          </script>";
    die;
}
if (!empty($id)) {
    $conn->update($id, $title, $description);
} else {
    $notes = $conn->read();
    foreach ($notes as $note) {
        if (strtolower($title) == strtolower($note['title'])) {
            echo "<script>
                    alert('Error : The title has been used!')
                    location.replace('index.php')
                  </script>";
            die;
        }
    }
    $conn->create($title, $description);
}
header('Location: index.php');
