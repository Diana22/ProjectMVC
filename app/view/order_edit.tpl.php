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
		
		<label> <?php if($order->get_status() == $order::STATUS_NEW) : ?>
            <input type="radio" checked name="form[status]" value="-1">New order
                <?php else :?>
                <input type="radio" name="form[status]" value="-1">New order
            <?php endif ?>
        </label><br/>
        
		<label> <?php if($order->get_status() == $order::STATUS_PROCESSED) : ?>
                <input type="radio" checked name="form[status]" value="0">Processed
            <?php else :?>
                <input type="radio" name="form[status]" value="0">Processed
            <?php endif ?>
        </label><br/>
        
		<label> <?php if($order->get_status() == $order::STATUS_CANCELLED) : ?>
                <input type="radio" checked name="form[status]" value="1">Cancelled
            <?php else :?>
                <input type="radio" name="form[status]" value="1">Cancelled
            <?php endif ?>
        </label><br/>
       
	   <input type="hidden" name="form[id]" value=<?php echo $order->id; ?>>
        <input type="submit" name="form[action]" value="Update">
    </form>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>