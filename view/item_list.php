<?php 
include('view/header.php'); 
?>

<!-- Section to Display Itemss -->
<section>
    <h1>Categories With Items</h1>
    <!-- Form for Filtering Items by Category -->
    <form action="." method="get">
        <select name="category_id">
            <option value="0">View All</option>
            <?php foreach ($categories as $category) : ?>
                <!-- Dynamically generate options for categories, mark selected based on current filter -->
                <option value="<?= $category['categoryID'] ?>" <?= $category_id == $category['categoryID'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['categoryName']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Go</button>
    </form>

    <!-- Check if there are categories to display -->
    <?php if (!empty($todoitems)) : ?>
        <!-- Loop through each item and display it -->
        <?php foreach ($todoitems as $item) : ?>
            <div>
                <p><strong><?= htmlspecialchars($item['categoryName']) ?></strong></p> <!-- Display the category name -->
                <p><?= htmlspecialchars($item['Title']) ?></p> <!-- Display the item title -->
                <p><?= htmlspecialchars($item['Description']) ?></p> <!-- Display the item description -->
                <!-- Form to delete the item-->
                <form action="." method="post">
                    <input type="hidden" name="action" value="delete_item">
                    <input type="hidden" name="item_id" value="<?= $item['ItemNum'] ?>">
                    <button type="submit">Remove</button> <!-- Button to delete the item -->
                </form>
                <!-- Form to edit the item -->
                <form action="." method="post" style="display: inline;">
                    <input type="hidden" name="action" value="edit_item_form">
                    <input type="hidden" name="item_id" value="<?= $item['ItemNum'] ?>">
                    <button type="submit">Edit</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <!-- Message displayed if no itemss exist -->
        <p>No items exist<?= $category_id ? ' for this category' : '' ?> !</p>
    <?php endif; ?>
</section>

<!-- Section to Add a New Item -->
<section>
    <h2>Add Item To Category</h2>
    <form action="." method="post">
        <select name="category_id" required>
            <option value="">Please select</option>
            <?php foreach ($categories as $category) : ?>
                <!-- Options for selecting category, populated dynamically -->
                <option value="<?= $category['categoryID'] ?>">
                    <?= htmlspecialchars($category['categoryName']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <!-- Input field for the item title -->
        <input type="text" name="title" maxlength="120" placeholder="Title" required>
        <!-- Input field for the item description -->
        <input type="text" name="description" maxlength="120" placeholder="Description" required>
        <button type="submit" name="action" value="add_item">Add</button> <!-- Submit button for adding the item -->
    </form>
</section>

<!-- Link to View/Edit categories page -->
<p><a href=".?action=list_categories">View/Add Categories</a></p>

<?php 
include('view/footer.php'); 
?>

