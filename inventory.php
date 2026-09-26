<?php require 'config/database.php';
$page_title = 'Inventory';
$items = $pdo->query("SELECT i.*,s.supplier_name,CASE WHEN i.quantity<=0 THEN 'Out of Stock' WHEN i.quantity<=10 THEN 'Low' ELSE 'Good' END stock_status FROM inventory i LEFT JOIN suppliers s ON s.id=i.supplier_id ORDER BY i.product_name")->fetchAll();
require 'includes/header.php'; ?>
<div class="panel">
    <div class="panel-head">
        <h2>Current Inventory</h2><span class="muted">Updated only when deliveries are recorded</span>
    </div>
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>Supplier</th>
            <th>Last Received</th>
            <th>Stock Status</th>
        </tr><?php foreach ($items as $i): ?><tr>
                <td><?= e($i['product_name']) ?></td>
                <td><?= $i['quantity'] ?></td>
                <td><?= e($i['unit']) ?></td>
                <td><?= e($i['supplier_name'] ?: '—') ?></td>
                <td><?= $i['last_received'] ?: '—' ?></td>
                <td><?= badge($i['stock_status']) ?></td>
            </tr><?php endforeach; ?>
    </table>
</div><?php require 'includes/footer.php'; ?>