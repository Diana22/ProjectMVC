<?php @include APP_PATH . '/view/snippets/header.tpl.php'; ?>

<h2>Our cakes.</h2>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>
<?php include_once  "../controller/cake.php" ?>
<?php $cls_a = new controller_cake(); ?>
<?php $cakes = $cls_a::action_list(); ?>
<?php if ($cakes) : ?>

    <?php foreach ($cakes as $cake) : ?>

        <p> <?php echo $cake->name;
            echo " ";
            echo $cake->quantity?>
            <a href="cake/view/<?php echo $cake->id ?>">Cake page</a>
        </p>

    <?php endforeach; ?>

<?php else : ?>

    <p>No cakes</p>

<?php endif; ?>
