<?php require 'config/database.php';
$orderId = (int)$_GET['order_id'];
$st = $pdo->prepare('SELECT o.*,s.supplier_name FROM orders o JOIN suppliers s ON s.id=o.supplier_id WHERE o.id=?');
$st->execute([$orderId]);
$o = $st->fetch();
if (!$o) redirect('deliveries.php');
$st = $pdo->prepare('SELECT * FROM order_items WHERE order_id=?');
$st->execute([$orderId]);
$items = $st->fetchAll();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();
        $complete = true;
        foreach ($items as $i) {
            if ((float)$_POST['delivered'][$i['id']] < (float)$i['quantity']) $complete = false;
        }
        $status = $complete ? 'Delivered' : 'Incomplete';
        $pdo->prepare('INSERT INTO deliveries(order_id,reference_number,actual_delivery_date,notes,status) VALUES(?,?,?,?,?)')->execute([$orderId, trim($_POST['reference_number']), $_POST['actual_delivery_date'], $_POST['notes'], $status]);
        $deliveryId = $pdo->lastInsertId();
        $di = $pdo->prepare('INSERT INTO delivery_items(delivery_id,order_item_id,delivered_quantity) VALUES(?,?,?)');
        $inv = $pdo->prepare('INSERT INTO inventory(product_id,product_name,quantity,unit,supplier_id,last_received) VALUES(?,?,?,?,?,?) ON DUPLICATE KEY UPDATE quantity=quantity+VALUES(quantity),unit=VALUES(unit),supplier_id=VALUES(supplier_id),last_received=VALUES(last_received)');
        foreach ($items as $i) {
            $qty = max(0, (float)$_POST['delivered'][$i['id']]);
            $di->execute([$deliveryId, $i['id'], $qty]);
            if ($qty > 0) $inv->execute([$i['product_id'], $i['product_name'], $qty, $i['unit'], $o['supplier_id'], $_POST['actual_delivery_date']]);
        }
        $pdo->prepare('UPDATE orders SET status=? WHERE id=?')->execute([$status, $orderId]);
        $pdo->commit();
        redirect('deliveries.php');
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = 'Could not record delivery. This order may already have a delivery.';
    }
}
$page_title = 'Record Delivery';
require 'includes/header.php'; ?>
<div class="panel">
    <h2>Order #<?= $o['id'] ?> — <?= e($o['supplier_name']) ?></h2><?php if (isset($error)): ?><p class="notice"><?= e($error) ?></p><?php endif; ?><form method="post">
        <div class="form-grid">
            <div><label>Delivery Reference Number</label><input name="reference_number" placeholder="Receipt or delivery note number"></div>
            <div><label>Actual Delivery Date *</label><input required type="date" name="actual_delivery_date" value="<?= date('Y-m-d') ?>"></div>
            <div><label>Expected Delivery</label><input readonly value="<?= $o['expected_delivery_date'] ?>"></div>
            <div class="full"><label>Delivery Notes</label><textarea name="notes" placeholder="Note any missing or damaged items."></textarea></div>
        </div>
        <h3>Delivered Quantities</h3>
        <table>
            <tr>
                <th>Product</th>
                <th>Ordered</th>
                <th>Delivered</th>
                <th>Result</th>
            </tr><?php foreach ($items as $i): ?><tr>
                    <td><?= e($i['product_name']) ?></td>
                    <td><?= $i['quantity'] ?> <?= e($i['unit']) ?></td>
                    <td><input required min="0" max="<?= $i['quantity'] ?>" step="0.01" type="number" name="delivered[<?= $i['id'] ?>]" value="<?= $i['quantity'] ?>"></td>
                    <td class="muted">Less than ordered = Incomplete</td>
                </tr><?php endforeach; ?>
        </table>
        <div class="form-actions"><button class="btn">Save Delivery</button><a class="btn secondary" href="deliveries.php">Cancel</a></div>
    </form>
</div><?php require 'includes/footer.php'; ?>