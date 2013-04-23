<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <h2>Delete ingredient</h2>

<?php if ($form_error) : ?>
    <p><em>Error</em></p>
<?php endif ?>

    <form action="<?php echo APP_URL; ?>ingredient/deleted" method="post">
        <label>Ingredient
            <input type="text" name="form[ingredient]" value="" />
        </label>
        <br />
        <label>
            <input type="hidden" name="form[ingredient][id]" value="<?php echo $ingredient['id'] ?>" />
        </label>
        <br />
        <input type="submit" name="form[action]" value="Delete Ingredient" />
    </form>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>