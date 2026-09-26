<?php require 'config/database.php';
$page_title = 'Add Supplier';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare('INSERT INTO suppliers(supplier_name,contact_person,contact_number,address,products_supplied) VALUES(?,?,?,?,?)')->execute([$_POST['supplier_name'], $_POST['contact_person'], $_POST['contact_number'], $_POST['address'], $_POST['products_supplied']]);
    redirect('suppliers.php');
}
$view = isset($_GET['id']) ? $pdo->prepare('SELECT * FROM suppliers WHERE id=?') : null;
if ($view) {
    $view->execute([$_GET['id']]);
    $s = $view->fetch();
    if ($s) {
        $history = $pdo->prepare('SELECT id,reference_number,order_date,expected_delivery_date,status FROM orders WHERE supplier_id=? ORDER BY order_date DESC');
        $history->execute([$s['id']]);
        $history = $history->fetchAll();
    }
}
require 'includes/header.php'; ?>
<div class="panel">
    <div class="panel-head">
        <h2><?= isset($s) ? 'Supplier Details' : 'New Supplier' ?></h2>
    </div><?php if (isset($s)): ?><div class="form-grid">
            <div><label>Supplier Name</label><?= e($s['supplier_name']) ?></div>
            <div><label>Contact Person</label><?= e($s['contact_person']) ?></div>
            <div><label>Contact Number</label><?= e($s['contact_number']) ?></div>
            <div><label>Products Supplied</label><?= e($s['products_supplied']) ?></div>
            <div class="full"><label>Address</label><?= nl2br(e($s['address'])) ?></div>
        </div>
        <h3>Previous orders</h3>
        <div class="table-wrap">
            <table>
                <tr>
                    <th>Order</th>
                    <th>Reference no.</th>
                    <th>Order date</th>
                    <th>Expected delivery</th>
                    <th>Status</th>
                </tr><?php foreach ($history as $order): ?><tr>
                        <td><a href="order_view.php?id=<?= $order['id'] ?>">#<?= $order['id'] ?></a></td>
                        <td><?= e($order['reference_number'] ?: '—') ?></td>
                        <td><?= $order['order_date'] ?></td>
                        <td><?= $order['expected_delivery_date'] ?></td>
                        <td><?= badge($order['status']) ?></td>
                    </tr><?php endforeach; ?>
            </table>
        </div>
        <p><a class="btn" href="supplier_edit.php?id=<?= $s['id'] ?>">Edit Supplier</a> <a class="btn secondary" href="suppliers.php">Back</a></p><?php else: ?><form method="post">
            <div class="form-grid">
                <div><label>Supplier Name *</label><input required name="supplier_name"></div>
                <div><label>Contact Person</label><input name="contact_person"></div>
                <div><label>Contact Number</label><input name="contact_number"></div>
                <div><label>Products Supplied</label><input name="products_supplied" placeholder="e.g. Snacks, drinks"></div>
                <div class="full"><label>Address</label><textarea name="address"></textarea></div>
            </div>
            <div class="form-actions"><button class="btn">Save Supplier</button><a class="btn secondary" href="suppliers.php">Cancel</a></div>
        </form><?php endif; ?>
</div><?php require 'includes/footer.php'; ?>