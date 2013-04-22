<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <form action=<?php echo APP_URL; ?>cake/add/<?php echo $cake->id; ?> method="post">
        <label>Cake name
            <input type="text" name="form[name]" value=<?php $cake->name; ?>>
        </label><br/>

        <label>Cake price
            <input type="text" name="form[price]" value=<?php $cake->price; ?>>
        </label><br/>

        <label>Cake weight
            <input type="text" name="form[weight]" value=<?php $cake->weight; ?>>
        </label><br/>

        <label>Cake calories
            <input type="text" name="form[calories]" value=<?php  $cake->calories; ?>>
        </label><br/>

        <label>Cake quantity
            <input type="text" name="form[quantity]" value=<?php  $cake->quantity; ?>>
        </label>
        <br/>
        <input type="hidden" name="form[id]" value=<?php  $cake->id; ?>>
        <input type="submit" name="form[action]" value="Create">
    </form>



<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>