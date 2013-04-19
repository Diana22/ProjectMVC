<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<<<<<<< HEAD
<h2>Administrare</h2>
=======

    <a href="<?php echo APP_URL; ?>admin/ingredients/">List of ingredients</a>
    <br />
    <a href="<?php echo APP_URL; ?>cakestore/admin/list/">List of cakes</a>
    <br />
    <a href="<?php echo APP_URL; ?>cakestore/admin/orders/">List of orders</a>
>>>>>>> 1c016585f2512610d378e8703b516ce9487c3e92

<p>Bine ai venit, <?php echo $admin->name; ?>!</p>

<p>Aici vin optiunile de administrare produse / stoc / comenzi etc</p>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>