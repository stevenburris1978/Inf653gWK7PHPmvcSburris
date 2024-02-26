<?php include('view/header.php'); ?>

<section>
    <header>
        <h1>Todo Items</h1>
    </header>

    <!-- Form for adding a new item -->
    <form action="." method="post">
        <input type="hidden" name="action" value="add_item">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="description" placeholder="Description" required>
        <input type="submit" value="Add Item">
    </form>

    <!-- List of items -->
    <?php if (!empty($items)) : ?>
        <ul>
            <?php foreach ($items as $item) : ?>
                <li>
                    <p>Item Title:</p>
                    <?= htmlspecialchars($item['Title']) ?>: <br><p>Description:</p><?= htmlspecialchars($item['Description']) ?>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="edit_item_form">
                        <input type="hidden" name="item_number" value="<?= $item['ItemNum'] ?>">
                        <input type="submit" value="Edit">
                    </form>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_item">
                        <input type="hidden" name="item_number" value="<?= $item['ItemNum'] ?>">
                        <input type="submit" value="Remove">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No to do list items exist yet.</p>
    <?php endif; ?>
</section>

<?php include('view/footer.php'); ?>


