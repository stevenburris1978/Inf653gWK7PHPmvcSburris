<?php include('view/header.php'); ?>

<section>
    <header>
        <h1>Edit Item</h1>
    </header>

    <form action="." method="post">
        <input type="hidden" name="action" value="edit_item">
        <input type="hidden" name="item_number" value="<?= $item['ItemNum'] ?>">

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($item['Title']) ?>" required>

        <label for="description">Description:</label>
        <input type="text" name="description" id="description" value="<?= htmlspecialchars($item['Description']) ?>" required>

        <input type="submit" value="Save Changes">
    </form>
</section>

<?php include('view/footer.php'); ?>
