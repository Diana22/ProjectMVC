<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <form action=<?php echo APP_URL; ?>account/edit/<?php echo $account->id; ?> method="post">

        <label>Username.
            <input type="text" name="form[username]" value=<?php echo $account->username; ?>>
        </label><br/>

        <label>Password.
            <input type="text" name="form[pass]" value=<?php echo $account->pass; ?>>
        </label><br/>

        <label>Type.
            <input type="text" name="form[type]" value=<?php echo $account->type; ?>>
        </label><br/>

        <input type="hidden" name="form[id]" value=<?php echo $account->id; ?>>
        <input type="submit" name="form[action]" value="Update">
    </form>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>