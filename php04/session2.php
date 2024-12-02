<?php
session_start(); //KEY発行：ユニーク

echo $_SESSION["name"];
echo "<br>";
echo session_id(); //KEY確認用
