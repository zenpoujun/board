<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>削除完了!</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php

  if($_SERVER['SERVER_NAME'] == "localhost"){
    // データベースに接続
    $dsn = 'mysql:host=localhost;dbname=board;charset=utf8';// 設定したホスト名
    $user = 'root';//設定したユーザー名
    $password = ''; //設定したパスワード

  }else {
    // データベースに接続
    $dsn = 'mysql:host=localhost;dbname=zjun;charset=utf8';// 設定したホスト名
    $user = 'zjun';//設定したユーザー名
    $password = 'eUbiCYGU'; //設定したパスワード

  }

   $pdo = new PDO($dsn, $user, $password);

    $sql = $pdo->prepare('delete from datas where id=?');

    if($sql->execute([$_REQUEST['id']])){
      echo '削除しました。';
    } else {
      echo '削除できませんでした。';
    }

   ?>

  <ul>
    <li><a href="notice_board.php">投稿ページへ戻る</a></li>
  </ul>
</body>
</html>
