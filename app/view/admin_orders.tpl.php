<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<h2>Orders</h2>

<?php  if ($orders) : ?>
    <?php foreach ($orders as $order) : ?>
        <b><?php echo $order->id; ?></b>
        <?php if ($cakes = $order->get_cakes()): ?>
            <h3>Ingredients</h3>
            <ol>
                <?php foreach ($cakes as $key => $ingredient) : ?>
                    <li>
                        <?php echo $ingredient->name; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
        <p>
            <a href="<?php echo APP_URL ?>order/edit/<?php echo $order->id ?>">  Edit order</a>
            <a href="<?php echo APP_URL ?>order/delete/<?php echo $order->id ?>"> Delete order</a>
        </p>

    <?php endforeach; ?>



<?php else : ?>

    <p>No orders</p>

<?php endif; ?>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>