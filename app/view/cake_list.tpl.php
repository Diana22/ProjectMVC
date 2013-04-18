<?php @include APP_PATH . '/view/snippets/header.tpl.php'; ?>

<h2>Our cakes.</h2>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>
<?php// include_once  "../controller/cake.php" ?>
<?php// $cls_a = new controller_cake(); ?>
<?php// $cakes = $cls_a::action_list(); ?>
<?php if ($cakes) : ?>

    <?php foreach ($cakes as $cake) : ?>

        <p><b><?php echo $cake->name;
                    echo ' ';
                    echo $cake->quantity; ?></b></p>
        <p><<a href="<?php echo APP_URL ?>cake/view/<?php echo $cake->id
            ?>">view cake details</a></p>
            echo $cake->quantity?>
    <?php endforeach; ?>

<?php else : ?>

    <p>Sorry, no sugar for you, babyyy!!</p>

<?php endif; ?>
<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>
