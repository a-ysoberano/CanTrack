<?php if (!isset($page_title)) $page_title = 'School Canteen'; ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page_title) ?> | School Canteen</title><link rel="stylesheet" href="assets/css/style.css"></head><body>
<aside class="sidebar no-print"><div class="brand">🍽️ <span>School Canteen<small>Order & Delivery Tracker</small></span></div>
<nav><a href="dashboard.php">Dashboard</a><a href="suppliers.php">Suppliers</a><a href="orders.php">Orders</a><a href="deliveries.php">Deliveries</a><a href="inventory.php">Inventory</a><a href="reports.php">Reports</a></nav></aside>
<main class="content"><header class="topbar"><div><h1><?= e($page_title) ?></h1><p>School Canteen Supplier Order & Delivery Tracking System</p></div></header>
