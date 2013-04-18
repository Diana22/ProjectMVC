<?php
// Action list.
if ($action == 'list' )
{
@include APP_PATH . '/view/snippets/header.tpl.php'; ?>

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
}
// Action view.
elseif ($action = 'view')
{
    @include APP_PATH . '/view/snippets/header.tpl.php';
?>
<h2> <?php echo $cakes->name;?></h2>
<p>
    <?php
    if ($cakes->price)
        echo "Price: " . $cakes->price . "<br/>";
    if ($cakes->weight)
        echo "Weight: " . $cakes->weight . "<br/>";
    if ($cakes->calories)
        echo "Calories: " . $cakes->calories . "<br/>";
    if ($cakes->quantity)
        echo "Available quantity: " . $cakes->quantity;
    ?>
</p>
<p>
    <?php
    if ($cakes->get_ingredients())
    {
        echo "Ingredients: <br />";
        $i = 1;
        foreach($cakes->get_ingredients() as $ingredient)
        {
            echo "$i: $ingredient[ingredient_name] <br />";
            $i++;
        }
    }
    ?>
</p>
<?php
    @include APP_PATH . '/view/snippets/footer.tpl.php';
}