<?php
include 'assets/config.php';
include 'assets/functions.php';
include 'assets/header.php';
?>

<header>
<img src="assets/logo.svg">
<h1><?php echo $sitename ?></h1>
</header>

<article>
<p><?php echo $description ?></p>

<ul id="archives">
<?php
	ListPosts();
?>
</ul>
</article>
<div class="holder"></div>

<?php
include 'assets/footer.php';
?>