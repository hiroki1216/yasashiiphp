<?php
require_once __DIR__ . '/../../db_config.php';
$receipe_name = htmlspecialchars($_POST['receipe_name']);
$howto = htmlspecialchars($_POST['howto']);
$category = (int)htmlspecialchars($_POST['category']);
$difficulty = (int)htmlspecialchars($_POST['difficulty']);
$budget = (int)htmlspecialchars($_POST['budget']);
try {
    $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO recipes (recipe_name, category, difficulty, budget, howto) values (?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $receipe_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $category, PDO::PARAM_INT);
    $stmt->bindValue(3, $difficulty, PDO::PARAM_INT);
    $stmt->bindValue(4, $budget, PDO::PARAM_INT);
    $stmt->bindValue(5, $howto, PDO::PARAM_STR);
    $stmt->execute();
    $dbh = null;
    echo 'レシピの登録を完了しました。' . '<br>' . PHP_EOL;
    echo '<a href="index.php">' . 'トップページへ戻る</a>';
} catch (PDOException $e) {
    echo 'エラー発生 :' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
