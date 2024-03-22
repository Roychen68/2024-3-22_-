<?php
$pdo = new PDO("mysql:host=localhost;charset=utf8;dbname=web01","admin","1234");

$id = $_POST['id'];

$sql = "SELECT * FROM `tickets` WHERE `id` = '$id'";

$result = $pdo->query($sql)->fetch();

echo json_encode($result);
?>