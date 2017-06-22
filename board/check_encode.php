<?php
// 配列の文字エンコードのチェック
function cken(array $data){
  $result = true;
  foreach ($data as $key => $value) {
    if(is_array($value)){
      // 含まれている値が配列の時
      $value = implode("",$value);
    }
    if(!mb_check_encoding($value)){
      // 文字のエンコードが一致しない時
      $result = false;

      break;
    }
  }
  return $result;
}
