<?php require 'config/database.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([trim($_POST['username'] ?? '')]);
    $account = $stmt->fetch();
    if ($account && password_verify($_POST['password'] ?? '', $account['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $account['id'];
        $_SESSION['username'] = $account['username'];
        redirect('dashboard.php');
    } else {
        $error = "That username or password isn't right.";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Log in | CanTrack</title>
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <main class="login-wrap">
        <form class="login-card" method="post" novalidate>
            <img class="login-logo" src="assets/img/logo.png" alt="CanTrack">
            <h1>Log in to CanTrack</h1>
            <p class="login-sub">Enter your staff account to open the order and delivery tracker.</p>

            <?php if ($error): ?>
                <p class="login-error" role="alert"><?= e($error) ?></p>
            <?php endif; ?>

            <label for="username">Username</label>
            <input id="username" name="username" type="text" autocomplete="username" required autofocus>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>

            <button class="login-submit" type="submit">Log in</button>

            <a class="login-back" href="index.php">&larr; Back to homepage</a>
        </form>
    </main>
</body>

</html>