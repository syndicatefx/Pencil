<?php
//PAGE TITLE//////////////////////////////////////////////
function PageTitle(){
	if(basename($_SERVER['PHP_SELF']) == 'admin.php'){
		echo 'Admin';
	}else{
		$pageTitle = basename($_SERVER['REQUEST_URI']);
		$pageTitle = basename($pageTitle);
		$pageTitle = preg_replace('/\.' . preg_quote(pathinfo($pageTitle, PATHINFO_EXTENSION), '/') . '$/', '', $pageTitle);
		$pageTitle = utf8_encode($pageTitle);
		$pageTitle = str_replace ("-", " ", substr($pageTitle, 11),$pageTitle);
		$pageTitle = ucwords($pageTitle);
		echo $pageTitle;
	}
}
//PAGE DESCRIPTION////////////////////////////////////////
function PageDesc(){
		$post = basename($_GET['name']);
		$text = file_get_contents("posts/$post.txt");
		$start = strpos($text, '<p>');
		$end = strpos($text, '.', $start);
		$paragraph = substr($text, $start, $end-$start+1);
		$paragraph = html_entity_decode(strip_tags($paragraph));
		echo $paragraph;
}
//HOMEPAGE - INDEX////////////////////////////////////////
function ListPosts(){
	$directory = "posts/";
	$files = glob($directory . "*.txt");
	rsort($files);
	if(count($files) > 0){
		foreach($files as $file) {
			$file = basename($file);
			$file = preg_replace('/\.' . preg_quote(pathinfo($file, PATHINFO_EXTENSION), '/') . '$/', '', $file);
			$fulltitle = str_replace ("-", " ", $file);
			$title = substr($fulltitle, 11);
			$title = ucwords($title);
            $date = date_create(substr($file, 0, 10));

			echo '<li><h2><a href="'.$file.'">';
			echo $title;
			echo '</a>';
			echo '</h2>';
            echo '<small>Posted on '.date_format($date, 'jS M Y').'</small>';
            echo '</li>';
		}
	}else{
		echo "<p class='warning'>No Posts Added Yet!</p>";
	}
}
//VIEW POST//////////////////////////////////////////////
function ShowPost(){
	$post = basename($_GET['name']); 
 	$date = date_create(substr($post, 0, 10));

  	if (isset($post)) {
	    if (file_exists("posts/".$post.".txt")) {
	        echo '<h2 class="post-title">';
			PageTitle();
			echo '</h2>';
			echo '<span class="date">Posted on '.date_format($date, 'jS M Y').'</span>';
			include("posts/".$post.".txt");
		}
	    elseif(!file_exists("posts/".$post.".txt")){
	      echo "<h2 class='post-title'>Post Not Found!</h2>";
	  	}
	}
}
/******************************************************
	ADMIN PAGE
*******************************************************/
function admin(){
	//SAVE NEW FILES//////////////////////////////
	if(isset($_POST['SubmitContent'])) {

		$postname = $_POST['postname'];
		$page = $_POST['page'];
		
		if (!is_writable("posts/")){

			echo "<p class='error'>Cannot Write file ".$title.", check your permissions!</p>";
			echo "<button onclick='javascript:window.location.reload(history.go(-1));'>Back</button>";

		}
		else{
			$title = "$postname";
			$data = "$page";
			$fh = fopen("posts/{$title}.txt", "w");
			fwrite($fh, $data);
			fclose($fh);
			echo "<p class='success'>The file ".$title." has been successfully created!</p>";
		};
	};
	//CREATE NEW FILE/////////////////////////////
	if(isset($_POST["newfile"])){

		echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
			echo "<input type='text' name='postname' placeholder='Title example: 2013-08-23-my-first-post (no need for extension)'>";
			echo "<textarea class='editor' id='simple-editor' name='page'></textarea>";
			echo "<button name='SubmitContent' type='submit'>Save</button>";
			echo "<button type='cancel'>Cancel</button>";
		echo "</form>";

	};
	//DELETE FILES////////////////////////////////
	if (isset($_POST["delete"])){
		$delete = $_POST["delete"];
		unlink($delete);

		echo "<p class='success'>The file ".$delete." has been deleted!!</p>";

	};
	if (isset($_POST["filedelete"])){
		$filedelete = $_POST["filedelete"];

		echo "<div>";
		echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
		echo "<p class='warning'>Are you sure you want to delete ".$filedelete."</p>";
		echo "<button class='delete' type='submit' name='delete' value='".$filedelete."'>Confirm</button>";
		echo "<button type='cancel'>Cancel</button>";
		echo "</form>";
		echo "</div>";
	};
	//SAVE EDITED FILES///////////////////////////
	if (isset($_POST["fileselect"]) and isset($_POST["content"])) {

		$content = $_POST["content"];
		$fileselect = $_POST["fileselect"];

		if (!is_writable($_POST["fileselect"])){

			echo "<p class='error'>Cannot Write to file ".$fileselect.", check your permissions!</p>";
			echo "<button onclick='javascript:window.location.reload(history.go(-1));'>Back</button>";
		}
		else{
			$data = fopen($fileselect, "w");
			fwrite ($data, $content);
			fclose ($data);

			echo "<div>";
			echo "<p class='success'>The file ".$fileselect." has been successfully updated!</p>";
			echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
			echo "<button type='submit'>edit another file</button>";
			echo "</form>";
			echo "</div>";


		};
	};
	//EDIT FILES//////////////////////////////////
	if (isset($_POST["fileselect"])) {
		$fileselect = $_POST["fileselect"];

		echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
		echo "<h3>".basename($fileselect)."</h3>";
		
		echo "<textarea class='editor' id='simple-editor' name='content'>";
		readfile($fileselect);
		echo "</textarea>";
		echo "<button type='submit' name='fileselect' value='".$fileselect."'>Save</button>";
		echo "<button type='cancel'>Cancel</button>";
		echo "</form>";
	};
    //UPLOAD IMAGES///////////////////////////////
    if(isset($_POST["uploadImage"])){
        echo '<h4>Upload images</h4>';
        echo '<span id="response"></span>';
        echo '<form method="post" class="uploadForm" enctype="multipart/form-data"  action="upload.php">';
        echo '<input type="file" name="images" id="images" multiple />';
        echo '<button type="submit" id="btn">Upload Files!</button>';
        echo '</form>';
    };
	//CHOOSE FILES TO EDIT////////////////////////		
	echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
		echo "<ul id='archives'>";
			$filenames = glob("posts/*.txt");
			rsort($filenames);
			foreach ($filenames as $filename) {
				$file = preg_replace('/\.' . preg_quote(pathinfo($filename, PATHINFO_EXTENSION), '/') . '$/', '', $filename);
				$fulltitle = str_replace ("-", " ", $file);
				$title = substr($fulltitle, 16);
				$title = ucwords($title);
			    echo "<li>".basename($title)."<button class='delete' type='submit' name='filedelete' value='$filename'>Delete</button><button class='edit' type='submit' name='fileselect' value='$filename'>Edit</button></li>";
			}
		echo "</ul>";
		echo "<button type='submit' name='newfile'>Create New</button>";
        echo "<button type='submit' name='uploadImage'>Upload Image</button>";
	echo "</form>";
}
?>