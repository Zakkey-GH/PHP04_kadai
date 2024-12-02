<?php

// save_photo.php

//1. POSTデータ取得
$photo_name = $_POST["photo_name"];
$photo_comment = $_POST["photo_comment"];


//2. DB接続します
include("funcs.php");
$pdo = db_conn();



try {

    
    // ファイル処理
    if (isset($_FILES['photo_file']) && $_FILES['photo_file']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['photo_file']['tmp_name'];
        $file_data = file_get_contents($file_tmp); // ファイルを読み込み
        $file_size = $_FILES['photo_file']['size'];
        if ($file_size > 5 * 1024 * 1024) { // 5MB以下制限
            echo "ファイルサイズが大きすぎます。";
            exit;
        }
        // データベースに保存
        $sql = "INSERT INTO Photos (photo_name, photo_comment, photo_data) VALUES (:photo_name, :photo_comment, :photo_data)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':photo_name', $photo_name, PDO::PARAM_STR);
        $stmt->bindParam(':photo_comment', $photo_comment, PDO::PARAM_STR);
        $stmt->bindParam(':photo_data', $file_data, PDO::PARAM_LOB);
        $status = $stmt->execute();
        echo "写真がアップロードされました！";
    } else {
        echo "ファイルのアップロードに失敗しました。";
    }

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    sql_error($stmt);
}else{
    //５．index.phpへリダイレクト
    header("Location: index.php");
exit();

}
?>
