<?php
include 'assets/config.php';
include 'assets/functions.php';
include 'assets/header.php';
?>


<header>
<img src="assets/logo.svg">
<h1><a href="./"><?php echo $sitename ?></a></h1>
</header>

<article>
<?php ShowPost(); ?>
</article>

<?php
include 'assets/footer.php';
?>