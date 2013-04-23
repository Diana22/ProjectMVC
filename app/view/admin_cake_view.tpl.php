<?php @include APP_PATH . '/view/snippets/header.tpl.php'; ?>

    <h2> <?php echo $cake->name;?></h2>

<?php if ($cake->price): ?>
    <p>Price: <?php echo $cake->price; ?> </p>
<?php endif; ?>

<?php if ($cake->weight): ?>
    <p>Weight: <?php echo $cake->weight; ?> </p>
<?php endif; ?>

<?php if ($cake->calories): ?>
    <p>Calories: <?php echo $cake->calories; ?> </p>
<?php endif; ?>

<?php if ($cake->quantity): ?>
    <h3>Add to cart</h3>
    <form action="<?php echo APP_URL; ?>cart/add" method="post">
        <input type="hidden" name="form[cake_id]" value="<?php echo $cake->id ?>" />
        <label>Quantity
            <select name="form[quantity]">
                <?php for ($i = 1; $i <= $cake->quantity; $i ++) : ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php endfor ?>
            </select>
        </label>
        <br />
        <input type="submit" name="form[action]" value="Add" />
    </form>

<?php endif; ?>

<?php if ($ingredients = $cake->get_ingredients()) : ?>
    <h3>Ingredients</h3>
    <ol>
        <?php foreach ($ingredients as $key => $ingredient) : ?>
            <li>
                <?php echo $ingredient->name; ?>
            </li>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>

<?php if ($_SESSION['myshop']['account_type'] == "admin"): ?>
    <a href=<?php echo APP_URL . "cake/edit/$cake->id" ?> >Edit</a>
    <a href=<?php echo APP_URL . "cake/delete/$cake->id" ?> >Delete</a>
<?php endif; ?>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php';