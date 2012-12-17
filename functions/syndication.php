<?php
/**
 * Syndication - Feed Count Capturing & adding comic to feed.
 * Author: Philip M. Hofer (Frumph)
 * In Testing
 */

function comicpress_the_title_rss($title = '') {
	global $post;
	if (!empty($post)) {
		switch ($count = get_comments_number()) {
			case 0:
				$title_pattern = __('%s (No Comments)', 'comicpress');
				break;
			case 1:
				$title_pattern = __('%s (1 Comment)', 'comicpress');
				break;
			default:
				$title_pattern = sprintf(__('%%s (%d Comments)', 'comicpress'), $count);
				break;
		}
		return sprintf($title_pattern, $title);
	}
}

/**
 * Handle making changes to ComicPress before the export process starts.
 */
function comicpress_export_wp() {
	remove_filter('the_title_rss', 'comicpress_the_title_rss');
}

if (comicpress_themeinfo('enable_comment_count_in_rss')) {
	add_filter('the_title_rss', 'comicpress_the_title_rss');
	// Remove the title count from being in the export.
	add_action('export_wp', 'comicpress_export_wp');
}

//Insert the comic image into the RSS feed
if (!function_exists('comicpress_comic_feed')) {
	function comicpress_comic_feed($content = '') { 
		global $wp_query, $post, $comiccat;
		if ($wp_query->query_vars['cat'] == $comiccat ) {
			$content .= '<p><a href="'.get_permalink().'" title="'.comicpress_the_hovertext($post).'">'.comicpress_display_comic_thumbnail('comic',$post,true).'</a></p>';
		} else {
			$content .= '<p><a href="'.get_permalink().'" title="'.comicpress_the_hovertext($post).'">'.comicpress_display_comic_thumbnail('rss',$post,true).'</a></p>';
		}
		return apply_filters('comicpress_comic_feed', $content);
	}
}

// removed the comicpress_in_comic_category so that if it has a post-image it will add it to the rss feed (else rss comic thumb)
if (!function_exists('comicpress_insert_comic_feed')) {
	function comicpress_insert_comic_feed($content = '') {
		global $post;
		$category = get_the_category($post->ID);
		if (comicpress_in_comic_category($category[0]->cat_ID)) {
			$content = comicpress_comic_feed().$content;
		}
		return apply_filters('comicpress_insert_comic_feed', $content);
	}
}

add_filter('the_content_feed','comicpress_insert_comic_feed');
add_filter('the_excerpt_rss','comicpress_insert_comic_feed');
