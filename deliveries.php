<?php require 'config/database.php';
$page_title = 'Deliveries';
$rows = $pdo->query("SELECT o.*,s.supplier_name,d.actual_delivery_date,d.status delivery_status FROM orders o JOIN suppliers s ON s.id=o.supplier_id LEFT JOIN deliveries d ON d.order_id=o.id WHERE o.status NOT IN ('Cancelled') ORDER BY o.expected_delivery_date DESC")->fetchAll();
require 'includes/header.php'; ?>
<div class="panel">
    <div class="panel-head">
        <h2>Delivery Tracking</h2>
    </div>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Supplier</th>
            <th>Expected Delivery</th>
            <th>Actual Delivery</th>
            <th>Status</th>
            <th>Action</th>
        </tr><?php foreach ($rows as $r): ?><tr>
                <td>#<?= $r['id'] ?></td>
                <td><?= e($r['supplier_name']) ?></td>
                <td><?= $r['expected_delivery_date'] ?></td>
                <td><?= $r['actual_delivery_date'] ?: '—' ?></td>
                <td><?= badge($r['delivery_status'] ?: $r['status']) ?></td>
                <td><?php if (!$r['actual_delivery_date']): ?><a class="btn" href="delivery_record.php?order_id=<?= $r['id'] ?>">Record Delivery</a><?php else: ?><a class="btn light" href="order_view.php?id=<?= $r['id'] ?>">View Order</a><?php endif; ?></td>
            </tr><?php endforeach; ?>
    </table>
</div><?php require 'includes/footer.php'; ?>