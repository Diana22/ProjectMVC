<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<h2>Add ingredient</h2>
<?php if ($form_error) : ?>
    <p>Ceva e gresit. Reincercati.</p>
<?php endif ?>

<form action="<?php echo APP_URL . "ingredient/add/" . $ingredient->id; ?>" method="post">
    <label>
        <input type="hidden" name="form[id]" value="<?php $ingredient->id ?>"/>
    </label>
    <label>Nume
        <input type="text" name="form[name]" value="<?php $ingredient->name ?>"/>
    </label>
    <br/>
    <input type="submit" name="form[action]" value="Add"/>
</form>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>