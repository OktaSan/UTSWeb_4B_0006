<?php
session_start();
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'utsweb';

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (!$conn) {
    die('DB error: ' . mysqli_connect_error());
}

function isAdmin()
{
    return isset($_SESSION['admin']);
}

function requireAdmin()
{
    if (!isAdmin()) {
        header('Location: login.php');
        exit;
    }
}
