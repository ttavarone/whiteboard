<?php
	
/* -----------------------------------------------------------------------
	 These are the global variables
----------------------------------------------------------------------- */
$website_name = 'Whiteboard';
$author = 'Tucker Tavarone';
$date = 'January 2, 2020';
$weather = 'Overcast, 33&deg;';
$pages = array('index.php' => 'Viewer',
				'editor.php' => 'Editor');
								

/* -----------------------------------------------------------------------
	 Connect to database.  Return mysqli object
----------------------------------------------------------------------- */
function db_connect() {
	
	// Connect and select project3 database
	// mysqli(host, user, password, database_name)
	
	// $mysqli = new mysqli("localhost", "sienasel_proj3", "Proj32019", "sienasel_project3");
	// $mysqli = new mysqli("localhost", "breimern_proj3", "Proj32019", "breimern_project3");
	 
	// Output error info if there is a connection problem
	if ($mysqli->connect_errno) {
	   die("Failed to connect to MySQL: ($mysqli->connect_errno) $mysqli->connect_error");
	}

	// echo "Connection successful"; //For testing

	return $mysqli;	
}


/* ------------------------------------------------------------------------------------------------------
	 Echos a basic web page with a navbar in the header, a Bootstrap main container and a custom footer
------------------------------------------------------------------------------------------------------ */
function make_basic_page($page_name, $content, $style=null) {
	global $website_name;
	global $author;
	global $pages;
		
	echo 	make_top($website_name, $page_name, $style).'
				<header>
				</header>	
				<main class="container">
					'.$content.'
				</main>
				<footer>
					'.make_footer($pages, $author).'
				</footer>'.
				make_bottom();
}

								
/* -----------------------------------------------------------------------
	 This creates the top of every web page and slices in the
	 website name, page name and optional style, i.e., embedded CSS	 
----------------------------------------------------------------------- */								
function make_top($website_name, $page_name, $style=null) {
	global $date;
	global $weather;

	if ($style != null) 
		$style = '<style>'.$style.'</style>';
	
	return '
		<!DOCTYPE html>
		<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>'.$website_name.' - '.$page_name.'</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="style.css">
		'.$style.'
		</head>
		<body>
		<div class="jumbotron jumbotron-fluid">
		  <div class="container">
		    <h1 class="display-4">Whiteboard Viewer</h1>
		    <p class="lead">'.$date.'                  '.$weather.'</p>
		  </div>
		</div>
		';	
}

/* -----------------------------------------------------------------------
	 Creates the bottom of every web page to include the bootstrap javascript
----------------------------------------------------------------------- */								
function make_bottom() {
	return '
			<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		</body>
		</html>
	';
}


/* -----------------------------------------------------------------------
	 This creates the nav menu from the pages array and active page name
	 Also, slices the website name into the navbar brand area
----------------------------------------------------------------------- */

/* -----------------------------------------------------------------------
	 This creates the page footer with links at bottom
----------------------------------------------------------------------- */
function make_footer($pages, $author) {
  $menu = ''; 
	foreach ( $pages as $link => $name ) {
		$menu .= '<li class="nav-item"><a class="nav-link active" href="'.$link.'">'.$name.'</a></li>';
	}    
	
	return '  
		<footer>
	    <ul>'.$menu.'</ul>
		</footer>
	';
}

/* --------------------------------------------------------------------------------
	Creates a Bootstrap row with columns that can have four different configuration 
	depending on whether or not side_menu or aside_content are present
-------------------------------------------------------------------------------- */								
function make_main_content($main_article, $side_menu=null, $aside_content=null) {
	// If both side_menu and aside are present
	if ($side_menu && $aside_content) {
		$main_content = '
			<div class="row justify-content-end"> 
				<nav class="col-sm-4 col-lg-3">
					'.$side_menu.'
				</nav>
				<article class="col-sm-8 col-lg-6">
					'.$main_article.'
				</article>
				<aside class="col-sm-4 col-lg-3">
					'.$aside_content.'
				</aside>
			</div>					
		';
	}
	else if ($side_menu) {	  // Side menu only	
		$main_content = '
			<div class="row justify-content-end"> 
				<nav class="col-sm-4 col-lg-3">
					'.$side_menu.'
				</nav>
				<article class="col-sm-8 col-lg-9">
					'.$main_article.'
				</article>
			</div>			
		';
	}
	else if ($aside_content) {		// Aside only
		$main_content = '
			<div class="row justify-content-end"> 
				<article class="col-sm-8 col-lg-9">
					'.$main_article.'
				</article>
				<aside class="col-sm-4 col-lg-3">
					'.$aside_content.'
				</aside>
			</div>			
		';
	}
	else {		// No side menu and no aside
		$main_content = '
				'.$main_article.'			
		';
	}
	return $main_content;
}



/* -----------------------------------------------------------------------
	 This creates a bootstrap card with the given title, content and
	 background style (primary, success, danger, etc.)
----------------------------------------------------------------------- */
function make_card($title, $content, $style='primary') {
	return '
		<div class="card bg-'.$style.'">
		  <div class="card-header">
		    '.$title.'
		  </div>
		  <div class="card-body bg-light">
		    '.$content.'
		  </div>
		</div>';
}


/* ----------------------------------------------------------------------------
	 This creates a bootstrap list group from the given title, list and style
---------------------------------------------------------------------------- */
function make_listgroup($title, $list, $style='primary') {
	
	$content  = '<ul class="list-group list-group-flush">';
	foreach ($list as $url => $name) {
		$content .= '<a class="list-group-item" href="'.$url.'">'.$name.'</a>';
	}
	$content .= '</ul>';
	
	return '
		<div class="card bg-'.$style.'">
			<h5 class="card-header text-light">'.$title.'</h5>
				'.$content.'
		</div>';
}
	
?>