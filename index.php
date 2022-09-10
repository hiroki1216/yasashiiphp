<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>レシピの一覧</h1>
    <a href="/yasashiiphp/form.html">レシピの新規登録</a>
    <?php
    require_once __DIR__ . '/../../db_config.php';
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT * FROM recipes';
        $stmt = $dbh->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_NAMED);
        echo '<table>' . PHP_EOL;
        echo '<tr>' . PHP_EOL;
        echo '<th>料理名</th><th>予算</th><th>難易度</th>';
        echo '</tr>' . PHP_EOL;
        foreach ($result as $row) {
            echo '<tr>' . PHP_EOL;
            echo '<td>' . htmlspecialchars($row['recipe_name'], ENT_QUOTES) . '</td>' . PHP_EOL;
            echo '<td>' . htmlspecialchars($row['budget'], ENT_QUOTES) . '</td>' . PHP_EOL;
            echo '<td>' .
                match ($row['difficulty']) {
                    '1' => '簡単',
                    '2' => '普通',
                    '3' => '難しい',
                }
                . '</td>' . PHP_EOL;
            echo '<td><a href = "detail.php?id='. htmlspecialchars($row['id'],ENT_QUOTES) . '">詳細</a></td>' . PHP_EOL;
            echo '<td> | <a href = "edit.php?id='. htmlspecialchars($row['id'],ENT_QUOTES) . '">変更</a></td>' . PHP_EOL;
            echo '<td> | <a href = "delete.php?id='. htmlspecialchars($row['id'],ENT_QUOTES) . '">削除</a></td>' . PHP_EOL;
            echo '</tr>' . PHP_EOL;
        }
        echo '</table>' . PHP_EOL;
        $dbh = null;
    } catch (PDOException $e) {
        echo 'Error発生:' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
        exit;
    }
    ?>
</body>
</html>

