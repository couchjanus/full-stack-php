<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title.' - '.APPNAME; //APPNAME defined in index.php?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<!-- Iconos -->
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">

    <link href="/css/admin.css" rel="stylesheet">
</head>
<body>
	<span class='bckg'></span>
	<header>
	  <h1>
		Admin
	  </h1>
	  <nav>
		<ul>
		  <li>
			<a data-title='Projects' href="/admin">Dashboard</a>
		  </li>
		  <li>
			<a data-title='Управление товарами' href="/admin/products">Products</a>
		  </li>
		  <li>
			<a data-title='Управление категориями' href="/admin/categories">Categories</a>
		  </li>
		  <li>
			<a data-title='Управление posts' href="/admin/posts">Posts</a>
		  </li>

		</ul>
	  </nav>
	</header>
	<main>
	  <div class='title'>
		<h2><?= $title;?></h2>
		<a href='#' title='Profil'>
		  Hello Admin !
		</a>
	  </div>
