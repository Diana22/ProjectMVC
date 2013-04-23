<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <h2>The cake was removed from order!</h2>

    <a href="<?php echo APP_URL ?>order/edit/<?=$order->id ?>">List of orders</a>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>