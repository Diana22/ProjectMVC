<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <form action=<?php echo APP_URL; ?>cake/add method="post">
        <label>Cake name:
            <input type="text" name="form[name]" value="">
        </label><br/>

        <label>Cake price:
            <input type="text" name="form[price]" value="">
        </label><br/>

        <label>Cake weight:
            <input type="text" name="form[weight]" value="">
        </label><br/>

        <label>Cake calories:
            <input type="text" name="form[calories]" value="">
        </label><br/>

        <label>Cake quantity:
            <input type="text" name="form[quantity]" value="">
        </label>
        <br/>
        <input type="submit" name="form[action]" value="Add">
    </form>



<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>