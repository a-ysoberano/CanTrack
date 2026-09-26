<?php require 'config/database.php';
$stmt = $pdo->prepare('SELECT o.*,s.supplier_name,s.contact_person,s.contact_number FROM orders o JOIN suppliers s ON s.id=o.supplier_id WHERE o.id=?');
$stmt->execute([$_GET['id']]);
$o = $stmt->fetch();
if (!$o) redirect('orders.php');
$items = $pdo->prepare('SELECT * FROM order_items WHERE order_id=?');
$items->execute([$o['id']]);
$items = $items->fetchAll();
$total = 0;
foreach ($items as $i) $total += $i['quantity'] * $i['unit_price'];
$page_title = 'Order #' . $o['id'];
require 'includes/header.php'; ?>
<div class="panel">
    <div class="panel-head no-print">
        <h2>Order Details <?= badge($o['status']) ?></h2>
        <div class="actions"><button class="btn secondary" onclick="window.print()">Print / Save PDF</button><?php if (!in_array($o['status'], ['Delivered', 'Incomplete', 'Cancelled'])): ?><a class="btn" href="delivery_record.php?order_id=<?= $o['id'] ?>">Record Delivery</a><?php endif; ?></div>
    </div>
    <h2 class="print-title" style="display:none">School Canteen Purchase Order</h2>
    <div class="form-grid">
        <div><label>Supplier</label><?= e($o['supplier_name']) ?><br><span class="muted"><?= e($o['contact_person']) ?> <?= e($o['contact_number']) ?></span></div>
        <div><label>Order ID</label>#<?= $o['id'] ?><?= $o['reference_number'] ? ' · ' . e($o['reference_number']) : '' ?></div>
        <div><label>Order Date</label><?= $o['order_date'] ?></div>
        <div><label>Expected Delivery</label><?= $o['expected_delivery_date'] ?></div>
    </div>
    <div class="table-wrap">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Unit Price</th>
                <th>Subtotal</th>
            </tr><?php foreach ($items as $i): $sub = $i['quantity'] * $i['unit_price']; ?><tr>
                    <td><?= e($i['product_name']) ?></td>
                    <td><?= $i['quantity'] ?></td>
                    <td><?= e($i['unit']) ?></td>
                    <td>₱<?= number_format($i['unit_price'], 2) ?></td>
                    <td>₱<?= number_format($sub, 2) ?></td>
                </tr><?php endforeach; ?>
        </table>
    </div>
    <div class="total">Total: ₱<?= number_format($total, 2) ?></div>
    <p><label>Notes</label><?= nl2br(e($o['notes'] ?: 'None')) ?></p>
    <div class="no-print">
        <h3>Order Message</h3>
        <div class="message" id="order-message">Good day! We would like to place an order for the following items:

            <?php foreach ($items as $i): ?>* <?= e($i['product_name']) ?> — <?= $i['quantity'] ?> <?= e($i['unit']) ?>
        <?php endforeach; ?>
        Expected delivery: <?= date('F j, Y', strtotime($o['expected_delivery_date'])) ?>

        Thank you.</div>
        <p><button class="btn" onclick="copyMessage()">Copy Message</button> <a class="btn secondary" href="orders.php">Back to Orders</a></p>
    </div>
</div><?php require 'includes/footer.php'; ?>