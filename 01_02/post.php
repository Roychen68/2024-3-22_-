<?php
$pdo = new PDO("mysql:host=localhost;charset=utf8;dbname=web01","admin","1234");

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];
$password = $_POST['password'];

$sql = "INSERT INTO `tickets`(`firstname`, `lastname`, `phone`, `password`) VALUES ('$firstname','$lastname','$phone','$password')";

$pdo->exec($sql);
?>