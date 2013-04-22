<?php @include APP_PATH . '/view/snippets/header.tpl.php'; ?>

    <h2> <?php echo $account->username;?></h2>

<?php if ($client->name): ?>
    <p>Name: <?php echo $client->name; ?> </p>
<?php endif; ?>

<?php if ($client->address): ?>
    <p>Address: <?php echo $client->address; ?> </p>
<?php endif; ?>

<?php if ($client->phone): ?>
    <p>Phone: <?php echo $client->phone; ?> </p>
<?php endif; ?>

<?php if ($account->type == "1"): ?>
    <p>Account type: <?php echo "admin"; ?> </p>
    <?php endif; ?>
<?php if ($account->type == "0"): ?>
    <p>Account type: <?php echo "client"; ?> </p>
<?php endif; ?>
    <a href=<?php echo APP_URL?>account/edit/<?php echo $account->id?>>Edit Account</a>

<?php @include APP_PATH . '/view/snippets/footer.tpl.php';