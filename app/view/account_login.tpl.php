<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

<h2>Autentificare</h2>

<?php if (isset($_SESSION['form']['error'])):
    if ($_SESSION['form']['error'] == 1): ?>
        <p><em>Utilizator sau parola gresita. Reincercati.</em></p>
    <?php endif ?>
<?php endif ?>

<form action="<?php echo APP_URL; ?>account/login" method="post">
	<label>Utilizator
		<input type="text" name="form[user]" value="" />
	</label>
	<br />
	<label>Parola
		<input type="password" name="form[password]" value="" />
	</label>
	<br />
	<input type="submit" name="form[action]" value="Trimite" />
</form>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>