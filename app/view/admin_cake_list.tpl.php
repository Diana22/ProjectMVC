<?php @include APP_PATH . '/view/snippets/header.tpl.php'; ?>

    <h2>Our cakes</h2>

<?php if ($cakes) : ?>

    <ol>

        <?php foreach ($cakes as $cake) : ?>

            <li>

                <h3><?php echo $cake->name; ?></h3>
                <ul>
                    <li><b>Quantity:</b> <?php echo $cake->quantity ?></li>
                    <li><a href="<?php echo APP_URL ?>admin/cake/<?php echo $cake->id ?>">View</a></li>
                </ul>

            </li>

        <?php endforeach; ?>

    </ol>

<?php else : ?>

    <p>Sorry, no sugar for you, babyyy!!</p>

<?php endif; ?>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>