<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<h2>Edit client</h2>
<?php if ($form_error) : ?>
    <p>Ceva e gresit. Reincercati.</p>
<?php endif ?>

<form action="<?php echo APP_URL . "client/edit/" . $client->account_id; ?>" method="post">
    <label>
        <input type="hidden" name="form[username]" value="<?php $account->username ?>"/>
    </label>
    <br />
    <label>
        <input type="hidden" name="form[type]" value=""/>
    </label>
    <br />
    <label>Parola
        <input type="text" name="form[pass]" value=""/>
    </label>
    <br/>
    <label>Nume
        <input type="text" name="form[name]" value="<?php echo $client->name?>"/>
    </label>
    <br/>
    <label>Adresa
        <input type="text" name="form[address]" value="<?php echo $client->address?>"/>
    </label>
    <br/>
    <label>Telefon
        <input type="text" name="form[phone]" value="<?php echo $client->phone?>"/>
    </label>
    <br/>
    <input type="submit" name="form[action]" value="Update"/>
</form>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>

