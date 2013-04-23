<?php @include APP_PATH . '/view/snippets/header.tpl.php'; ?>

    <h2> <?php echo $order->id;?></h2>

<?php if ($order->client_id): ?>
    <p>Client ID: <?php echo $order->client_id; ?> </p>
<?php endif; ?>

<?php if ($order->pickup_date): ?>
    <p>Pickup date: <?php echo $order->pickup_date; ?> </p>
<?php endif; ?>

<?php if ($cake = $cake->get_all()) : ?>
    <?php foreach ($cake as $key => $cake): ?>

        <b>Cake</b> <?php echo $cake->name ?>

    <?php endforeach; ?>
<?php endif; ?>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php';