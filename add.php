<?php
$user = 'mysql';
$pass = 'mysql';
$receipe_name = htmlspecialchars($_POST['receipe_name']);
$howto = htmlspecialchars($_POST['howto']);
$category = (int)htmlspecialchars($_POST['category']);
$difficulty = (int)htmlspecialchars($_POST['difficulty']);
$budget = (int)htmlspecialchars($_POST['budget']);
try{

}catch(PDOException $e){

}

?>
