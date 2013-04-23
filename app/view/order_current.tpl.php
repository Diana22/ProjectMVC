<h2> <?php echo "Order Number:" . $order->id;?></h2>

<?php if ($order->pickup_date): ?>
    <p>Pickup date: <?php echo $order->pickup_date; ?> </p>
<?php endif; ?>

<?php if ($cakes = $order->get_cakes()): ?>
    <h3>Cakes: </h3>
    <ol>
        <?php foreach ($cakes as $key => $cake): ?>
            <li>
                <?php echo $cake->name ?><br />
            </li>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>