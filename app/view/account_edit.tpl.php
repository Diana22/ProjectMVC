<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <form action=<?php echo APP_URL; ?>"account/edit/"<?php echo $account->id; ?> method="post">

        <label>Username.
            <input type="text" name="form[username]" value=<?php echo $account->username; ?> >
        </label><br />

        <label>Password.
            <input type="text" name="form[pass]" value="">
        </label><br />

        <?php if (isset($_SESSION) && $_SESSION['myshop']['account_type'] == "admin"): ?>
        <label>Account type:
            <select name="form[type]">
                <option value='1'>Admin</option>
                <option value='0'>Client</option>
            </select>
        </label><br />
        <?php else: ?>
            <input type="hidden" name="form[type]" value=0>
        <?php endif; ?>
        <input type="hidden" name="form[id]" value=<?php echo $account->id; ?> >
        <input type="submit" name="form[action]" value="Update">
    </form>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>