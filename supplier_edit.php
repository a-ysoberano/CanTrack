<?php require 'config/database.php';
$page_title = 'Edit Supplier';
$stmt = $pdo->prepare('SELECT * FROM suppliers WHERE id=?');
$stmt->execute([$_GET['id']]);
$s = $stmt->fetch();
if (!$s) redirect('suppliers.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo->prepare('UPDATE suppliers SET supplier_name=?,contact_person=?,contact_number=?,address=?,products_supplied=? WHERE id=?')->execute([$_POST['supplier_name'], $_POST['contact_person'], $_POST['contact_number'], $_POST['address'], $_POST['products_supplied'], $s['id']]);
    redirect('suppliers.php');
}
require 'includes/header.php'; ?>
<div class="panel">
    <h2>Edit Supplier</h2>
    <form method="post">
        <div class="form-grid">
            <div><label>Supplier Name *</label><input required name="supplier_name" value="<?= e($s['supplier_name']) ?>"></div>
            <div><label>Contact Person</label><input name="contact_person" value="<?= e($s['contact_person']) ?>"></div>
            <div><label>Contact Number</label><input name="contact_number" value="<?= e($s['contact_number']) ?>"></div>
            <div><label>Products Supplied</label><input name="products_supplied" value="<?= e($s['products_supplied']) ?>"></div>
            <div class="full"><label>Address</label><textarea name="address"><?= e($s['address']) ?></textarea></div>
        </div>
        <div class="form-actions"><button class="btn">Update Supplier</button><a class="btn secondary" href="suppliers.php">Cancel</a></div>
    </form>
</div><?php require 'includes/footer.php'; ?>