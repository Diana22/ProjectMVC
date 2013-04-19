<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<h2>Ingredients</h2>

<p><a href="<?php echo APP_URL ?>ingredient/add/">Add ingredient</a></p>

<?php  if ($ingredients) : ?>

	<ol>

    <?php foreach ($ingredients as $ingredient) : ?>

        <li>
        	<h3><?php echo $ingredient->name; ?></h3>
        	<ul>
		        <li><a href="<?php echo APP_URL ?>ingredient/edit/<?php echo $ingredient->id ?>">Edit</a></li>
		        <li><a href="<?php echo APP_URL ?>ingredient/delete/<?php echo $ingredient->id ?>">Delete</a></li>
		    </ul>
	    </li>

    <?php endforeach; ?>

	</ol>

<?php else : ?>

    <p>No ingredients</p>

<?php endif; ?>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>