<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>
<h2>Create a new account:</h2>

    <form action="<?php echo APP_URL; ?>account/create" method="post">
        <label>Username
            <input type="text" name="form[user]" value="" />
        </label>
        <br />
        <label>Parola
            <input type="password" name="form[password]" value="" />
        </label>
        <br />
        <label>Nume Utilizator
            <input type="text" name="form[name]" value="" />
        </label>
        <br />
        <label>Adresa
            <input type="text" name="form[address]" value="" />
        </label>
        <br />
        <label>Numar de telefon
            <input type="text" name="form[phone]" value="" />
        </label>
        <br />
        <input type="submit" name="form[action]" value="Create" />
    </form>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php';