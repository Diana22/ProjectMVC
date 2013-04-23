<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <form action="<?php echo APP_URL; ?>order/edit/<?php echo $order->id; ?>" method="post">

        <label>Pickup Date
            <input type="text" name="form[pickup_date]" value=<?php echo $order->pickup_date; ?>>
        </label><br/>
        <?php if ($cakes = $order->get_cakes()): ?>
            <ol>
                <b>Cakes: </b>
                <?php foreach ($cakes as $key => $cake): ?>
                    <li>
                        <?php echo $cake->name ?>
                        <a href="<?=APP_URL?>order/remove/<?=$order->id . "/" . $cake->id?>">Remove ingredient</a>
                        <br />
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
        <input type="hidden" name="form[id]" value=<?php echo $order->id; ?>>
        <input type="submit" name="form[action]" value="Update">
    </form>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>