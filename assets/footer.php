<footer>
<p>&copy;<?php echo date('Y').'&nbsp;'.$author.'&nbsp;-&nbsp;'.$copyright; ?></p>
<a href="https://github.com/syndicatefx/Pencil" title="Powered by Pencil">Powered by Pencil</a>
</footer>

<?php
if(basename($_SERVER['PHP_SELF']) == 'index.php'){
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="assets/js/jPages.min.js"></script>
<script>
$(document).ready(function(){
	$(".holder").jPages({
        containerID: "archives",
        perPage :5,
        links:false
    });
});
</script>
<?php
};
if(basename($_SERVER['PHP_SELF']) == 'admin.php'){
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="assets/js/trumbowyg.min.js"></script>
<script src="assets/js/jPages.min.js"></script>
<script src="assets/js/upload.js"></script>
<script>
$(document).ready(function(){
	$('#simple-editor').trumbowyg({
		btns: ['viewHTML', 'formatting', 'link', 'btnGrp-semantic', 'btnGrp-lists', 'insertImage']
	});
	$(".holder").jPages({
        containerID: "archives",
        perPage :5,
        links:false
    });
});
</script>
<?php
};
?>
</body>
</html>