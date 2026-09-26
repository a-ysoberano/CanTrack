<?php require 'config/database.php';
$page_title = 'Suppliers';
if (isset($_GET['delete'])) {
    $pdo->prepare('DELETE FROM suppliers WHERE id=?')->execute([$_GET['delete']]);
    redirect('suppliers.php');
}
$suppliers = $pdo->query('SELECT * FROM suppliers ORDER BY supplier_name')->fetchAll();
require 'includes/header.php'; ?>
<div class="panel">
    <div class="panel-head">
        <h2>Supplier List</h2><a class="btn" href="supplier_add.php">+ Add Supplier</a>
    </div>
    <div class="table-wrap">
        <table>
            <tr>
                <th>Name</th>
                <th>Contact Person</th>
                <th>Contact Number</th>
                <th>Products Supplied</th>
                <th>Action</th>
            </tr><?php foreach ($suppliers as $s): ?><tr>
                    <td><?= e($s['supplier_name']) ?></td>
                    <td><?= e($s['contact_person']) ?></td>
                    <td><?= e($s['contact_number']) ?></td>
                    <td><?= e($s['products_supplied']) ?></td>
                    <td class="actions"><a class="btn light" href="supplier_add.php?id=<?= $s['id'] ?>">View</a><a class="btn secondary" href="supplier_edit.php?id=<?= $s['id'] ?>">Edit</a><a class="btn danger" onclick="return confirm('Delete this supplier?')" href="suppliers.php?delete=<?= $s['id'] ?>">Delete</a></td>
                </tr><?php endforeach; ?>
        </table>
    </div>
</div><?php require 'includes/footer.php'; ?>