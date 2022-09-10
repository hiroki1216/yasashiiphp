<?php
require_once __DIR__ . '/../../db_config.php';
if (empty($_GET['id'])) {
    echo 'IDを正しく入力してください。';
    exit;
}
try {
    $id = $_GET['id'];
    $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'DELETE FROM recipes where id = ?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $ddh = null;
    echo '対象データを削除しました。';
} catch (PDOException $e) {
    echo 'Error発生:' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
