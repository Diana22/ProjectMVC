<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<h2>Ingredients</h2>

<?php  if ($ingredients) : ?>
    <a href="ingredient/add/">Add Ingredient</a></p>
    <?php foreach ($ingredients as $ingredient) : ?>

        <p><b><?php echo $ingredient->name; ?></b>
        <a href="<?php echo APP_URL ?>ingredient/edit/<?php echo $ingredient->id
            ?>">Edit ingredient</a></p>

    <?php endforeach; ?>

<?php else : ?>

    <p>No ingredients</p>

<?php endif; ?>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>



