<?php 
include 'assets/config.php';
include 'assets/functions.php';
include 'assets/header.php';
?>

<header>
<img src="assets/logo.svg">
<h1><?php echo $sitename ?></h1>
<p>Administration Panel</p>
</header>

<?php admin(); ?>

<div class="holder"></div>

<?php
include 'assets/footer.php';
?>