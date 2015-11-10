<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

/*Breadcrumbs*/
function the_breadcrumb() {
	echo 'You are here: ';
	if (!is_home()) {
		echo '<a href="';
		echo get_option('home');
		echo '">';
		echo 'Home';
		echo "</a> &raquo; ";
		if (is_category() || is_single()) {
			if (is_single()) {
				echo the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
		elseif (is_tag()) {
			single_tag_title();
		}
		elseif (is_day()) {
			echo "Archive for "; the_time('F jS, Y');
		}
		elseif (is_month()) {
			echo "Archive for "; the_time('F, Y');
		}
		elseif (is_year()) {
			echo "Archive for "; the_time('Y');
		}
		elseif (is_author()) {
			echo "Author Archive";
		}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
			echo "Blog Archives";
		}
		elseif (is_search()) {
			echo "Search Results";
		}
		elseif (is_404()) {
			echo "404 Error";
		}
	}else{
		echo '<a href="';
		echo get_option('home');
		echo '">';
		echo 'Home';
		echo "</a>";
	}
}


?>
