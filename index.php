<?php
session_start(); // Mulai sesi

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php'); // Arahkan ke halaman login jika belum login
    exit;
}

require_once('Controllers/Page.php');

// Periksa apakah URL ditentukan
if (isset($_GET['url'])) {
    $file = $_GET['url'];
} else {
    header("Location: ?url=armada");
    exit();
}

$title = strtoupper($file);
$home = new Page("$title", "$file");
$home->call();
