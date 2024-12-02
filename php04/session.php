<?php
session_start();

$_SESSION["name"]="yamazaki";
$_SESSION["age"] = 20;

echo session_id();
