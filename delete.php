<?php
$conn = require_once 'Connection.php';
$conn->delete($_POST['id']);
header('Location: index.php');
