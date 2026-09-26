<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$host = 'localhost';
$db   = 'school_canteen';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    exit('Database connection failed. Import database/school_canteen.sql and check config/database.php.');
}

function e($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function badge($status) { return '<span class="badge badge-'.strtolower(str_replace(' ', '-', $status)).'">'.e($status).'</span>'; }
function redirect($url) { header('Location: '.$url); exit; }

// Every page that requires this file needs a signed-in session, except the
// login/logout pages themselves.
$publicPages = ['login.php', 'logout.php'];
if (!in_array(basename($_SERVER['PHP_SELF']), $publicPages) && empty($_SESSION['user_id'])) {
    redirect('login.php');
}
