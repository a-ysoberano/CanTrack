<?php require 'config/database.php';
$page_title = 'Dashboard';
$count = function ($sql) use ($pdo) {
    return $pdo->query($sql)->fetchColumn();
};
$stats = ['Total Suppliers' => $count('SELECT COUNT(*) FROM suppliers'), 'Pending Orders' => $count("SELECT COUNT(*) FROM orders WHERE status IN ('Pending','Scheduled')"), 'Upcoming Deliveries' => $count("SELECT COUNT(*) FROM orders WHERE expected_delivery_date>=CURDATE() AND status IN ('Pending','Scheduled')"), 'Incomplete Deliveries' => $count("SELECT COUNT(*) FROM orders WHERE status='Incomplete'"), 'Low Stock Items' => $count('SELECT COUNT(*) FROM inventory WHERE quantity BETWEEN 1 AND 10')];
$orders = $pdo->query('SELECT o.*,s.supplier_name FROM orders o JOIN suppliers s ON s.id=o.supplier_id ORDER BY o.id DESC LIMIT 8')->fetchAll();
require 'includes/header.php'; ?>
<div class="cards"><?php foreach ($stats as $label => $value): ?><div class="card"><label><?= e($label) ?></label><strong><?= $value ?></strong></div><?php endforeach; ?></div>
<div class="panel">
    <div class="panel-head">
        <h2>Recent Orders</h2><a class="btn" href="order_create.php">+ Create Order</a>
    </div>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Supplier</th>
            <th>Order Date</th>
            <th>Expected Delivery</th>
            <th>Status</th>
            <th>Action</th>
        </tr><?php foreach ($orders as $o): ?><tr>
                <td>#<?= $o['id'] ?></td>
                <td><?= e($o['supplier_name']) ?></td>
                <td><?= $o['order_date'] ?></td>
                <td><?= $o['expected_delivery_date'] ?></td>
                <td><?= badge($o['status']) ?></td>
                <td><a class="btn light" href="order_view.php?id=<?= $o['id'] ?>">View</a></td>
            </tr><?php endforeach; ?>
    </table>
</div><?php require 'includes/footer.php'; ?>