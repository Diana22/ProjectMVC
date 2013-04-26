<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<h2>Edit ingredient</h2>
<?php if (isset($_SESSION['form']['error'])):
    if ($_SESSION['form']['error'] == 1): ?>
    <p>Ceva e gresit. Reincercati.</p>
<?php endif ?>
<?php endif ?>

<form action="<?php echo APP_URL ?>ingredient/edit/<?php echo $ingredient->id; ?>" method="post">
    <label>
        <input type="hidden" name="form[id]" value="<?php echo $ingredient->id ?>"/>
    </label>
    <label>Nume
        <input type="text" name="form[name]" value="<?php echo $ingredient->name ?>"/>
    </label>
    <br/>
    <input type="submit" name="form[action]" value="Update"/>
</form>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>




