<?php
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更
//1. POSTデータ取得
$photo_name = $_POST["photo_name"];
$photo_comment = $_POST["photo_comment"];
$id     = $_POST["id"];


//2. DB接続します
include("funcs.php");
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "UPDATE Photos SET photo_name=:photo_name, photo_comment=:photo_comment WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':photo_name', $photo_name, PDO::PARAM_STR);
$stmt->bindParam(':photo_comment', $photo_comment, PDO::PARAM_STR);
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}