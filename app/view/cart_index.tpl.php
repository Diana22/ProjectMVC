<?php @include APP_PATH . '/view/snippets/header.tpl.php'; ?>

<h2>Cart</h2>

<?php if ($cakes = $cart->get_cakes()) : ?>
	<form method="post" action="<?php echo APP_URL ?>cart/update">
		<ol>
		<?php foreach ($cakes as $cake) : ?>
			<li>
				<h3><?php echo $cake->name ?></h3>
				<label>
					Quantity 
					<input type="text" name="form[cake][<?php echo $cake->id ?>]" value="<?php echo $cake->order_quantity ?>" />
				</label>
			</li>
		<?php endforeach ?>
		</ol>

		<input type="submit" name="form[action]" value="Update quantities" />
	</form>

	<ul>
		<li><a href="<?php echo APP_URL ?>cart/empty">Empty cart</a></li>
		<li><a href="<?php echo APP_URL ?>cart/send">Checkout</a></li>
	</ul>
<?php else : ?>
	<p>The cart is empty</p>
<?php endif ?>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php'; ?>