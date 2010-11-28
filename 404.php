<?php get_header(); ?>
	
<div class="post post-page post-404">
	<div class="post-head"></div>
	<div class="post-content">
		<h2 class="pagetitle"><?php _e('Page Not Found','comicpress'); ?></h2>
		<p><a href="<?php echo home_url(); ?>"><?php _e('Click here to return to the home page','comicpress'); ?></a> <?php _e('or try a search:','comicpress'); ?></p>
		<p><?php get_search_form(); ?></p>
	</div>
	<div class="post-foot"></div>
</div>

<?php get_footer() ?>