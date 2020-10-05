<?php
session_start();

$_SESSION["device"] = 'unifi';
$_SESSION["mac"] = $_GET["id"];
$_SESSION["ap"] = $_GET["ap"];

header("Location: https://zigsawifi.net");

?>