<?php if (!isset($page_title)) $page_title = 'CanTrack';
$current = basename($_SERVER['PHP_SELF']);
function navlink($href, $label, $icon)
{
    global $current;
    $active = in_array($current, is_array($href) ? $href : [$href]) ? ' class="active"' : '';
    $url = is_array($href) ? $href[0] : $href;
    echo '<a href="' . $url . '"' . $active . '>' . $icon . $label . '</a>';
} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($page_title) ?> | CanTrack</title>
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <aside class="sidebar no-print">
        <div class="brand"><img src="assets/img/logo.png" width="32" height="32" alt="CanTrack"> <span>CanTrack<small>Order & Delivery Tracker</small></span></div>
        <nav>
            <?php navlink('dashboard.php', 'Dashboard', '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2.5" y="2.5" width="6.5" height="6.5" rx="1"/><rect x="11" y="2.5" width="6.5" height="6.5" rx="1"/><rect x="2.5" y="11" width="6.5" height="6.5" rx="1"/><rect x="11" y="11" width="6.5" height="6.5" rx="1"/></svg>'); ?>
            <?php navlink(['suppliers.php', 'supplier_add.php', 'supplier_edit.php'], 'Suppliers', '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="7" cy="6.5" r="2.5"/><path d="M2.5 16c0-2.8 2-4.5 4.5-4.5s4.5 1.7 4.5 4.5"/><circle cx="14.5" cy="7" r="2"/><path d="M12.5 11.7c1.8.2 3 1.6 3 4.3"/></svg>'); ?>
            <?php navlink(['orders.php', 'order_create.php', 'order_edit.php', 'order_view.php'], 'Orders', '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="4" y="2.5" width="12" height="15" rx="1.2"/><path d="M7.5 2.5v2h5v-2M7 9h6M7 12h6M7 15h3.5"/></svg>'); ?>
            <?php navlink(['deliveries.php', 'delivery_record.php'], 'Deliveries', '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="6" width="9" height="7" rx="1"/><path d="M11 8.3h3l2.5 2.5v2.2h-5.5z"/><circle cx="5.2" cy="15" r="1.4"/><circle cx="13.8" cy="15" r="1.4"/></svg>'); ?>
            <?php navlink('inventory.php', 'Inventory', '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2.5 6 10 3l7.5 3-7.5 3-7.5-3Z"/><path d="M2.5 6v7l7.5 3.3 7.5-3.3V6"/><path d="M10 9v7.3"/></svg>'); ?>
            <?php navlink('reports.php', 'Reports', '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3v13a1 1 0 0 0 1 1h13"/><path d="M6 14V9M10 14V6M14 14v-4"/></svg>'); ?>
        </nav>
    </aside>
    <main class="content">
        <header class="topbar">
            <div>
                <h1><?= e($page_title) ?></h1>
                <p>Supplier Order & Delivery Tracking System</p>
            </div>
            <div class="user-chip no-print"><span><?= e($_SESSION['username'] ?? '') ?></span><a href="logout.php">Log out</a></div>
        </header>