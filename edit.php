<?php
require_once __DIR__ . '/../../db_config.php';
if (empty($_GET['id'])) {
    echo 'IDを正しく入力してください。';
    exit;
}
$id = (int)$_GET['id'];
try {
    $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'SELECT * FROM recipes where id =?';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $ddh = null;
} catch (PDOException $e) {
    echo 'Error発生:' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>入力フォーム</title>
</head>

<body>
    <form action="update.php?id=<?= htmlspecialchars($result['id'], ENT_QUOTES) ?>" method="post">
        料理名：<input type="text" name="receipe_name" value="<?= htmlspecialchars($result['recipe_name'], ENT_QUOTES); ?>">
        <br>
        カテゴリ:
        <select name="category">
            <option hidden>選択してください</option>
            <option value="1" <?php if ($result['category'] == 1) echo 'selected' ?>>和食</option>
            <option value="2" <?php if ($result['category'] == 2) echo 'selected' ?>>中華</option>
            <option value="3" <?php if ($result['category'] == 3) echo 'selected' ?>>洋食</option>
        </select>
        <br>
        難易度:
        <input type="radio" name="difficulty" value="1" <?php if ($result['difficulty'] == 1) echo 'checked' ?>>簡単
        <input type="radio" name="difficulty" value="2" <?php if ($result['difficulty'] == 2) echo 'checked' ?>>普通
        <input type="radio" name="difficulty" value="3" <?php if ($result['difficulty'] == 3) echo 'checked' ?>>難しい
        <br>
        予算:
        <input type="number" min="1" max="9999" name="budget" value="<?= htmlspecialchars($result['budget'], ENT_QUOTES) ?>">円
        <br>
        作り方:
        <textarea name="howto" cols="40" rows="4" maxlength="320"><?= htmlspecialchars($result['howto'], ENT_QUOTES) ?></textarea>
        <br>
        <button>送信</button>
    </form>
</body>

</html>