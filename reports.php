<?php require 'config/database.php';
$page_title = 'Reports';
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$where = '';
$params = [];
if ($from && $to) {
    $where = ' WHERE o.order_date BETWEEN ? AND ?';
    $params = [$from, $to];
}
$st = $pdo->prepare("SELECT o.*,s.supplier_name,d.actual_delivery_date,d.status delivery_status FROM orders o JOIN suppliers s ON s.id=o.supplier_id LEFT JOIN deliveries d ON d.order_id=o.id $where ORDER BY o.order_date DESC");
$st->execute($params);
$orders = $st->fetchAll();
$inventory = $pdo->query('SELECT i.*,s.supplier_name FROM inventory i LEFT JOIN suppliers s ON s.id=i.supplier_id ORDER BY i.product_name')->fetchAll();
require 'includes/header.php'; ?>
<div class="panel no-print">
    <div class="panel-head">
        <h2>Report Filters</h2><button class="btn secondary" onclick="window.print()">Print Report</button>
    </div>
    <form class="filter">
        <div><label>From</label><input type="date" name="from" value="<?= $from ?>"></div>
        <div><label>To</label><input type="date" name="to" value="<?= $to ?>"></div><button class="btn">Apply</button><a class="btn light" href="reports.php">Clear</a>
    </form>
</div>
<div class="panel">
    <h2>Order and Delivery History</h2>
    <table>
        <tr>
            <th>Order</th>
            <th>Supplier</th>
            <th>Order Date</th>
            <th>Expected</th>
            <th>Actual</th>
            <th>Order Status</th>
            <th>Delivery Status</th>
        </tr><?php foreach ($orders as $o): ?><tr>
                <td>#<?= $o['id'] ?></td>
                <td><?= e($o['supplier_name']) ?></td>
                <td><?= $o['order_date'] ?></td>
                <td><?= $o['expected_delivery_date'] ?></td>
                <td><?= $o['actual_delivery_date'] ?: '—' ?></td>
                <td><?= badge($o['status']) ?></td>
                <td><?= $o['delivery_status'] ? badge($o['delivery_status']) : '—' ?></td>
            </tr><?php endforeach; ?>
    </table>
</div>
<div class="panel">
    <h2>Inventory List</h2>
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>Supplier</th>
            <th>Last Received</th>
        </tr><?php foreach ($inventory as $i): ?><tr>
                <td><?= e($i['product_name']) ?></td>
                <td><?= $i['quantity'] ?></td>
                <td><?= e($i['unit']) ?></td>
                <td><?= e($i['supplier_name'] ?: '—') ?></td>
                <td><?= $i['last_received'] ?: '—' ?></td>
            </tr><?php endforeach; ?>
    </table>
</div><?php require 'includes/footer.php'; ?>