<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <form action=<?php echo APP_URL; ?>cake/edit/<?php echo $cake->id; ?> method="post">
        <label>Cake name.
            <input type="text" name="form[name]" value=<?php echo $cake->name; ?>>
        </label><br/>

        <label>Cake price.
            <input type="text" name="form[price]" value=<?php echo $cake->price; ?>>
        </label><br/>

        <label>Cake weight.
            <input type="text" name="form[weight]" value=<?php echo $cake->weight; ?>>
        </label><br/>

        <label>Cake calories.
            <input type="text" name="form[calories]" value=<?php echo $cake->calories; ?>>
        </label><br/>

        <label>Cake quantity.
            <input type="text" name="form[quantity]" value=<?php echo $cake->quantity; ?>>
        </label>
<br/>
<?php $ingredients1 = model_ingredient::get_all() ?>
<?php  foreach ($ingredients1 as $ingred): ?>
    <?php $bool = false; ?>
    <?php foreach ($ingredients2 as $ingredient): ?>
        <?php if ($ingred->id == $ingredient->id) {
            $bool = true;
        } ?>
    <?php endforeach ?>
    <?php if ($bool) { ?>
        <label>
            <input type="checkbox" checked='checked' name="form[ingredient_id][]"
                   value="<?= $ingred->id ?>"><?=$ingred->name?><br/>
        </label>
    <?php } ?>
    <?php if (!$bool) { ?>
        <label>
            <input type="checkbox" name="form[ingredient_id][]" value="<?= $ingred->id ?>"><?=$ingred->name?><br/>
        </label>
    <?php } ?>
    <?php endforeach; ?>
    <br/>

        <input type="hidden" name="form[id]" value=<?php echo $cake->id; ?>>
        <input type="submit" name="form[action]" value="Update">
    </form>



<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>