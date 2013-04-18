<?php @include APP_PATH . '/view/snippets/header.tpl.php'; ?>

<h2>Our cakes.</h2>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>
<?php if ($cakes) : ?>

    <?php foreach ($cakes as $cake) : ?>

        <p><b><?php echo $cake->name;
                echo ' ';
                echo $cake->quantity; ?></b></p>
        <p><<a href="<?php echo APP_URL ?>cake/view/<?php echo $cake->id
            ?>">view cake details</a></p>
    <?php endforeach; ?>

<?php else : ?>

    <p>Sorry, no sugar for you, babyyy!!</p>

<?php endif; ?>
<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>