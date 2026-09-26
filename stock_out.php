// stock_out.php — bagong file
<?php require 'config/database.php';
$page_title = 'Record Stock Usage';
$items = $pdo->query('SELECT * FROM inventory ORDER BY product_name')->fetchAll();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qty = (float)$_POST['quantity'];
    if ($qty > 0) {
        $pdo->prepare('UPDATE inventory SET quantity = GREATEST(0, quantity - ?) WHERE id=?')
            ->execute([$qty, $_POST['inventory_id']]);
    }
    redirect('inventory.php');
}
require 'includes/header.php'; ?>
<div class="panel">
    <h2>Record Stock Usage</h2>
    <form method="post">
        <div class="form-grid">
            <div><label>Product</label>
                <select required name="inventory_id">
                    <?php foreach ($items as $i): ?>
                        <option value="<?= $i['id'] ?>"><?= e($i['product_name']) ?> (<?= $i['quantity'] ?> <?= e($i['unit']) ?> left)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div><label>Quantity Used/Sold/Spoiled *</label>
                <input required type="number" step="0.01" min="0.01" name="quantity">
            </div>
        </div>
        <div class="form-actions">
            <button class="btn">Save</button>
            <a class="btn secondary" href="inventory.php">Cancel</a>
        </div>
    </form>
</div>
<?php require 'includes/footer.php'; ?>