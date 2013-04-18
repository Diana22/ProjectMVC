<?php @include APP_PATH . '/view/snippets/header.tpl.php'; ?>

<h2> <?php echo $cake->name;?></h2>

<?php if ($cake->price): ?>
    <p>Price: <?php echo $cake->price; ?> </p>
<?php endif; ?>

<?php if ($cake->weight): ?>
    <p>Weight: <?php echo $cake->weight; ?> </p>
<?php endif; ?>

<?php if ($cake->calories): ?>
    <p>Calories: <?php echo $cake->calories; ?> </p>
<?php endif; ?>

<?php if ($cake->quantity): ?>
    <p>Available quantity: <?php echo $cake->quantity; ?> </p>
<?php endif; ?>

<?php
if ($ingredients = $cake->get_ingredients()): ?>
    <h3>Ingredients</h3>
    <ol>
        <?php foreach ($ingredients as $key => $ingredient) : ?>
            <li><?php echo $ingredient['ingredient_name']; ?></li>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>
<?php @include APP_PATH . '/view/snippets/footer.tpl.php';