<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>投稿完了!</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
  require_once("escape.php");

  // データの受け取り
  $name = $_POST['name'];
  $title = $_POST['title'];
  $massage = $_POST['massage'];

  date_default_timezone_set('Japan'); //タイムゾーンの設定
  $created = date('Y-m-d H:i:s');


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
  $sql = $pdo->prepare('insert into datas values(null,?,?,?,?)');
  $sql->execute(
    [es($name),es($title),nl2br(es($massage)),$created]);


   ?>
  <div>
    <p>メッセージを投稿しました。</p>
    <ul>
      <li><a href="notice_board.php">投稿ページへ戻る</a></li>
    </ul>
</div>
</body>
</html>
