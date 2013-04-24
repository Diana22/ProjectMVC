<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<h2>Search cake</h2>
<?php if ($form_error) : ?>
    <p>Ceva e gresit. Reincercati.</p>
<?php endif ?>

<form action="<?php echo APP_URL . "cake/search/"?>" method="post">
    <label>Name:
        <input type="text" name="form[name]" value=""/>
    </label>
    <br/>
    <input type="submit" name="form[action]" value="Search"/>
</form>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>
