<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<?php if (isset($_SESSION['form']['error']))
    if ($_SESSION['form']['error'] == 1): ?>
        <p>Ceva e gresit. Reincercati.</p>
<?php endif ?>

    <form action=<?php echo APP_URL; ?>order/edit/<?php echo $order->id; ?> method="post">

        <label>Client ID
            <input type="text" name="form[id_client]" value=<?php echo $order->id_client; ?>>
        </label><br/>

        <label>Pickup Date
            <input type="text" name="form[pickup_date]" value=<?php echo $order->pickup_date; ?>>
        </label><br/>

        <input type="hidden" name="form[id]" value=<?php echo $order->id; ?>>
        <input type="submit" name="form[action]" value="Update">
    </form>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>