<?php @include APP_PATH . '/view/snippets/header.tpl.php'; ?>

<?php if ($order->id): ?>
    <p>Order ID: <?php echo $order->id; ?> </p>
<?php endif; ?>

<?php if ($order->pickup_date): ?>
    <p>Pickup date: <?php echo $order->pickup_date; ?> </p>
<?php endif; ?>
<?php if ($cakes = $order->get_cakes()) : ?>
    <?php foreach ($cakes as $cake): ?>
        <b>Quantity:</b> <?php echo $cake->ordered_quantity ?> <b>Cake:</b> <?php echo $cake->name ?> <br />
    <?php endforeach; ?>
<?php endif; ?>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php';