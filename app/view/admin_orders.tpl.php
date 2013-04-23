<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<h2>Orders</h2>

<?php  if ($orders) : ?>
    <?php foreach ($orders as $order) : ?>

        <p><b><?php echo $order->id; ?></b>
            <a href="<?php echo APP_URL ?>order/edit/<?php echo $order->id ?>">  Edit order</a>
            <a href=<?php echo APP_URL ?>"order/delete/"<?php echo $order->id ?> Delete order</a>
        </p>

    <?php endforeach; ?>

<?php else : ?>

    <p>No orders</p>

<?php endif; ?>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>