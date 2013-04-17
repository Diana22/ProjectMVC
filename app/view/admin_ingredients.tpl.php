<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>
<html>
<h2>Ingredients</h2>
<?php include_once "../model/ingredient.php";?>
<?php include_once "../controller/adminn.php";?>
<?php $cls = new Controller(); ?>
<?php $ingredients = $cls::action_ingredients();?>

<?php if ($ingredients) : ?>
    <a href="ingredient/add/">Add Ingredient</a></p>
    <?php foreach ($ingredients as $ingredient) : ?>

        <p> <?php echo $ingredient->name; ?>
        <a href="ingredient/edit/<?php echo $ingredient->id ?>">Edit Ingredient</a></p>

    <?php endforeach; ?>

<?php else : ?>

    <p>No ingredients</p>

<?php endif; ?>



</html>

