<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>写真アップロードアプリ</title>
    <link rel="stylesheet" href="css/style.css" >

</head>

<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
        </div>
    </nav>
</header>






<body>
    <h1>Buukar -- Booker</h1>
    <form id="photoForm" enctype="multipart/form-data" method="post" action="save_photo.php">
        <input type="text" name="photo_name" id="photo_name" placeholder="写真名" required>
        <textarea name="photo_comment" id="photo_comment" placeholder="写真コメント"></textarea>
        <input type="file" name="photo_file" id="photo_file" accept="image/jpeg, image/png" required>
        <button type="submit">アップロード</button>
        <div id="message" class="message"></div>
    </form>

        <!-- 検索フォーム -->
        <form id="searchForm" method="post" action="search_photo.php">
        <input type="text" name="query" id="query" placeholder="検索キーワード" required>
        <button type="submit">検索</button>
    </form>

    <!-- 検索結果表示領域 -->
    <div id="results" class="results">
        <!-- 検索結果はここに表示されます -->
    </div>

    <div id="bukabuka_img"><img src="img/IMG_0657.jpeg" alt=""></div>
</body>
</html>
