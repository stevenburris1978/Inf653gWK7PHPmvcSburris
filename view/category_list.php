<?php 

include("view/header.php"); 
?>

<!-- Display Categories -->
<?php if (!empty($categories)) : ?> 
    <section id="list" class="list">
        <header>
            <h1>Categories List</h1>
        </header>
        <!-- Loop through the categories and display each one -->
        <?php foreach ($categories as $category) : ?>
            <div class="bordered">
                <div class="list__row">
                    <div class="list__item">
                        <!-- Display the category name -->
                        <p class="bold"><?= htmlspecialchars($category['categoryName']) ?></p>
                    </div>
                    <div class="list__removed">
                        <!-- Form to delete the category -->
                        <form action="." method="post">
                            <input type="hidden" name="action" value="delete_category">
                            <input type="hidden" name="category_id" value="<?= $category['categoryID'] ?>">
                            <button class="remove-button">Remove</button>
                        </form>
                    </div>
                </div>
        </div>
        <?php endforeach; ?>
    </section>
<?php else : ?>
    <p>No Categories exist!</p>
<?php endif; ?>

<!-- Add Category Form -->
<section>
    <h2>Add Category</h2>
    <div class="bordered">
        <form action="." method="post" id="add__form" class="add__form">
            <input type="hidden" name="action" value="add_category">
            <div class="add__inputs">
                <label>Name:</label>
                <!-- Input for the new category name -->
                <input type="text" name="category_name" maxlength="100" placeholder="Name" autofocus required>
            </div>
            <div class="add__addItem">
                <!-- Button to submit the form and add a new category -->
                <button class="add-button bold">Add</button>
            </div>
        </form>
    </div>
</section>

<!-- Link to View/Edit Items -->
<p><a href=".?action=list_todoitems">View/Edit Items</a></p>

<?php 

include("view/footer.php"); 
?>