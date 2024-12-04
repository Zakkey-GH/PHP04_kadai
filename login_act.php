<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

// 初期化
if (!isset($_SESSION['login_attempts'])) {
  $_SESSION['login_attempts'] = 0;
}

if ($_SESSION['login_attempts'] >= 5) {
  // ログイン失敗回数が5回以上なら空のページにリダイレクト
  header("Location: empty.php");
  exit();
}




//POST値
$lid = $_POST["lid"]; //lid
$lpw = $_POST["lpw"]; //lpw

//1.  DB接続します
include("funcs.php");
$pdo = db_conn();

//2. データ登録SQL作成
//* PasswordがHash化→条件はlidのみ！！
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid=:lid AND life_flg=0"); 
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR); //lid
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5.該当１レコードがあればSESSIONに値を代入
//入力したPasswordと暗号化されたPasswordを比較！[戻り値：true,false]
$pw = password_verify($lpw, $val["lpw"]); //$lpw = password_hash($lpw, PASSWORD_DEFAULT);   //パスワードハッシュ化
if($pw){ 
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id(); //SESSIONにあづけておく
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  
  //Login成功時（select.phpへ）
  $_SESSION['login_attempts'] = 0; // 成功時にリセット
  redirect("select.php");
  // echo $val["name"];

}else{
  //Login失敗時(login.phpへ)
  $_SESSION['login_attempts']++;
  $remaining_attempts = 5 - $_SESSION['login_attempts'];
  echo "ログイン失敗！残り試行回数: " . ($remaining_attempts > 0 ? $remaining_attempts : 0);
  redirect("login.php");

}

exit();

