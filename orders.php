<?php require 'config/database.php';
$page_title = 'Orders';
if (isset($_GET['cancel'])) {
    $pdo->prepare("UPDATE orders SET status='Cancelled' WHERE id=?")->execute([$_GET['cancel']]);
    redirect('orders.php');
}
$orders = $pdo->query('SELECT o.*,s.supplier_name,(SELECT SUM(quantity*unit_price) FROM order_items WHERE order_id=o.id) total FROM orders o JOIN suppliers s ON s.id=o.supplier_id ORDER BY o.id DESC')->fetchAll();
require 'includes/header.php'; ?>
<div class="panel">
    <div class="panel-head">
        <h2>Supplier Orders</h2><a class="btn" href="order_create.php">+ Create Order</a>
    </div>
    <div class="table-wrap">
        <table>
            <tr>
                <th>Order ID</th>
                <th>Supplier</th>
                <th>Order Date</th>
                <th>Expected Delivery</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr><?php foreach ($orders as $o): ?><tr>
                    <td>#<?= $o['id'] ?></td>
                    <td><?= e($o['supplier_name']) ?></td>
                    <td><?= $o['order_date'] ?></td>
                    <td><?= $o['expected_delivery_date'] ?></td>
                    <td>₱<?= number_format($o['total'] ?? 0, 2) ?></td>
                    <td><?= badge($o['status']) ?></td>
                    <td class="actions"><a class="btn light" href="order_view.php?id=<?= $o['id'] ?>">View</a><?php if (!in_array($o['status'], ['Delivered', 'Incomplete', 'Cancelled'])): ?><a class="btn secondary" href="order_edit.php?id=<?= $o['id'] ?>">Edit</a><a class="btn danger" onclick="return confirm('Cancel this order?')" href="orders.php?cancel=<?= $o['id'] ?>">Cancel</a><?php endif; ?></td>
                </tr><?php endforeach; ?>
        </table>
    </div>
</div><?php require 'includes/footer.php'; ?>