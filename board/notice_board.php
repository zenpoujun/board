<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>掲示板</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div>
    <h1>投稿ページ</h1>
  <form action="board-output.php" method="POST">
    <ul>
      <li><label>name:<input type="text" name="name" size="30" placeholder="名前を入力してください"></label></li>
      <li><label>title:<input type="text" name="title" size="30" placeholder="タイトルを入力してください"></label></li>
      <li><label>massage:<textarea name="massage" cols="30" rows="4" maxlength="100" placeholder="コメントを入力してください"></textarea></label></li>
      <li><input type="submit" value="投稿する"></li>
    </ul>
  </form>
</div>


<?php

require_once("check_encode.php");

// 文字エンコードのチェック機能
if(!cken($_POST)){
  $encoding = mb_internal_encoding();
  $error = "Encoding Error! The expected encoding is ". $encoding;

  exit($error);
}


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


// 自動リンク機能
function url2link($massage, $link_title = null)
{
    $pattern = '/(href=")?https?:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+/';
    $massage = preg_replace_callback($pattern, function($matches) use ($link_title) {

        // 既にリンクになっている時やMarkdown style link の場合はそのまま
        if (isset($matches[1])) return $matches[0];
        $link_title = $link_title ?: $matches[0];
        return "<a href=\"{$matches[0]}\">$link_title</a>";

    }, $massage);
    return $massage;
}

// 書き込んだメッセージなどの表示
foreach ($pdo->query('select * from datas order by created desc') as $row) {


  echo '<hr>';
  echo '<p>';
  echo 'No.',$row['id'],"\t";
  echo 'name :',"\t", $row['name'];
  echo '</p>';
  echo '<ul>';
  echo '<li>';
  echo 'title :',"\t",$row['title'];
  echo '</li>';
  echo '<li>';
  echo 'massage :',"\t",url2link($row['massage']);
  echo '</li>';
  echo '<li>';
  echo 'date :',"\t",$row['created'];
  echo '</li>';
  echo '<li>';
  echo '<a href="board-output_delete.php?id=',$row['id'],'">削除</a>';
  echo '</li>';
  echo '</ul>';

}

 ?>
</body>
</html>
