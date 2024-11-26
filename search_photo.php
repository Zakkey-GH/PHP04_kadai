<?php

try {
    // DB接続
    $pdo = new PDO('mysql:dbname=PhotoApp;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}

// 検索キーワードを取得（POSTリクエストか確認）
$query = isset($_POST['query']) ? $_POST['query'] : '';

try {
    // 検索クエリを準備
    $sql = "SELECT photo_name, photo_comment, photo_data FROM Photos WHERE photo_name LIKE :query OR photo_comment LIKE :query";
    $stmt = $pdo->prepare($sql);
    $searchKeyword = "%" . $query . "%";
    $stmt->bindParam(':query', $searchKeyword, PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 戻るボタンを表示
    echo "<button id='backButton' style='margin-bottom: 20px; padding: 10px 20px; background-color: #007BFF; color: #fff; border: none; border-radius: 4px; cursor: pointer;'>戻る</button>";

    // 検索結果を表示
    echo "<div id='results'>";
    if ($results) {
        foreach ($results as $row) {
            echo "<div style='border: 1px solid #ddd; padding: 10px; margin-bottom: 10px;'>";
            echo "<h3>" . htmlspecialchars($row['photo_name']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['photo_comment']) . "</p>";
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['photo_data']) . '" alt="写真" style="max-width: 100%; height: auto;"/>';
            echo "</div>";
        }
    } else {
        echo "<p>検索結果が見つかりません。</p>";
    }
    echo "</div>";
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}
?>

<!-- jQuery を読み込む -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // 戻るボタンのクリックイベント
        $('#backButton').on('click', function () {
            // 検索結果を完全にクリア
            $('#results').empty();

            // index.php に遷移
            window.location.href = 'index_1.php';
        });

        // ページリロード時にキャッシュを無効化
        if (performance.navigation.type === 1 || performance.getEntriesByType("navigation")[0].type === "reload") {
            $('#results').empty();
        }
    });
</script>
