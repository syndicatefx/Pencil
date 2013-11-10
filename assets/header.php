<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" user-scalable="no" />
<?php if(basename($_SERVER['PHP_SELF']) == 'index.php'){?>
<title><?php echo $sitename ?></title>
<meta name="title" content="<?php echo $sitename ?>">
<?php }else{ ?>    
<title><?php echo PageTitle(). ' | ' .$sitename ?></title>
<meta name="title" content="<?php echo PageTitle(). ' | ' .$sitename ?>">
<?php } ?>
<?php if(basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == 'admin.php'){ ?>
<meta name='description' content='<?php echo $description ?>'>
<?php  }else{ ?>
<meta name='description' content='<?php echo PageDesc() ?>'>
<?php  };?>
<meta name="author" content="<?php echo $author ?>">
<meta name="Copyright" content="<?php echo $copyright ?>">

<!-- Open Graph -->
<meta property="og:title" content="<?php echo PageTitle() ?>"/>
<?php if(basename($_SERVER['PHP_SELF']) == 'index.php'){ ?>
<meta property="og:description" content="<?php echo $description ?>"/>
<?php  }else{ ?>
<meta property="og:description" content="<?php echo PageDesc() ?>"/>
<?php  };?>    
<meta property="og:url" content="<?php echo $_SERVER['REQUEST_URI'] ?>"/>
<meta property="og:image" content="assets/logo.png"/>
<?php if(basename($_SERVER['PHP_SELF']) == 'index.php'){ ?>
<meta property="og:type" content="website"/>
<?php  }else{ ?>
<meta property="og:type" content="article"/>
<?php  };?>    
<meta property="og:site_name" content="<?php echo $sitename ?>"/>

<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link rel="stylesheet" href="assets/css/style.css">
<?php if(basename($_SERVER['PHP_SELF']) == 'admin.php'){ ?>
<link rel='stylesheet' href='assets/css/admin.css'>
<meta name='robots' content='noindex,nofollow' />
<?php } ?>
</head>
<body>