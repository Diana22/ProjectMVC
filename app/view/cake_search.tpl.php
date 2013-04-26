<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<h2>Search cake</h2>
<?php if ($form_error) : ?>
    <p>Ceva e gresit. Reincercati.</p>
<?php endif ?>



<form action="<?php echo APP_URL . "cake/search/"?>" method="post">

    <?php $ingredients = model_ingredient::get_all(); ?>
    <?php foreach ($ingredients as $ingredient): ?>
        <label>
            <input type="checkbox" name="form[ingredient_id][]" value="<?= $ingredient->id ?>"><?=$ingredient->name?><br/>
        </label>
    <?php endforeach ?>
    <br />
    <input type="submit" name="form[action]" value="Search"/>
</form>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>
