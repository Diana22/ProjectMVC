<html>
<head>
	<title>
		<?php if (isset($html_head_title)) : ?>
			<?php echo $html_head_title; ?> |
		<?php endif ?>
		Shop
	</title>
</head>

<body>

<h1>Shop</h1>
    <a href=<?php echo APP_URL?>home/index>Home</a>
    <a href=<?php echo APP_URL?>cart/index>My Cart</a>
<?php if ($_SESSION): ?>
    <a href=<?php echo APP_URL?>account/logout>Log Out</a>
    <a href=<?php echo APP_URL?>account/view>My Account</a>
<?php else: ?>
    <a href=<?php echo APP_URL?>account/login>Log In</a>
    <a href=<?php echo APP_URL ?>account/create/>Create account</a>
<?php endif; ?>
<?php if ($_SESSION['myshop']['account_type'] = "admin"): ?>
    <a href=<?php echo APP_URL ?>admin>Administration</a>
<?php endif; ?>


<hr />