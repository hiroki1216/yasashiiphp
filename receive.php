<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>出力結果</title>
</head>
<body>
    <?php
        // print_r($_POST);
        echo htmlspecialchars($_POST['receipe_name'],ENT_QUOTES);
        echo '<br>';
        //if文
        // if($_POST['category'] == '1') echo '和食';
        // if($_POST['category'] == '2') echo '中華';
        // if($_POST['category'] == '3') echo '洋食';

        //match式
        echo match ($_POST['category']){
            '1' => '和食',
            '2' => '中華',
            '3' => '洋食',
        } . '<br>';
        // if($_POST['difficulty']=='2'){
        //     echo '普通';
        // }elseif($_POST['difficulty']=='1'){
        //     echo '簡単';
        // }else{
        //     echo '難しい';
        // }
        // echo '<br>';
        echo match ($_POST['difficulty']){
            '1' => '簡単',
            '2' => '普通',
            '3' => '難しい',
        } . '<br>';

        if(is_numeric($_POST['budget'])){
            echo number_format($_POST['budget']);
        }
        echo '<br>';
        echo nl2br(htmlspecialchars($_POST['howto'],ENT_QUOTES));
        echo '<br>';
    ?>
</body>
</html>
