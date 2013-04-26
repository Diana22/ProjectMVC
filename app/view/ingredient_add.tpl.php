<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<h2>Add ingredient</h2>
<?php if (isset($_SESSION['form']['error'])):
    if ($_SESSION['form']['error'] == 1): ?>
        <p>Ceva e gresit. Reincercati.</p>
    <?php endif ?>
<?php endif ?>

<form action="<?php echo APP_URL ?>ingredient/add/<?php echo $ingredient->id; ?>" method="post">
    <label>Nume
        <input type="text" name="form[name]" value=""/>
    </label>
    <br/>
    <input type="submit" name="form[action]" value="Add"/>
</form>


<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>