<?php
// XSS対策のためのHTMLエスケープ
function es($data){
  // $dataが配列の時
  if(is_array($data)){
    // 再帰呼び出し
    return array_map(__METHOD__,$data);
  } else {
    // htmlエスケープを行う
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
  }
}
