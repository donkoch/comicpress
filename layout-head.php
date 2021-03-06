<div id="content-wrapper">

	<?php
	do_action( 'comicpress-content-area' );
	if ( ! get_theme_mod( 'comicpress-customize-comic-in-column', false ) ) do_action( 'comic-area' );
	?>

	<div id="subcontent-wrapper">

		<?php
		if ( ! comicpress_is_signup() && ! comicpress_sidebars_disabled() ) {
			if ( comicpress_is_layout( '2cl,3c,3cl,3clgn' ) ) comicpress_get_sidebar( 'left' );
			if ( comicpress_is_layout( '3cl' ) ) comicpress_get_sidebar( 'right' );
		}
		if ( is_front_page() && ! comicpress_sidebars_disabled() ) {
			comicpress_get_sidebar( 'home-splash' );
		}
		?>

		<div id="content-column">

			<?php
			if ( get_theme_mod( 'comicpress-customize-comic-in-column', false ) ) do_action( 'comic-area' );
			if ( ! comicpress_is_signup() && ! comicpress_sidebars_disabled() ) {
				if ( comicpress_is_layout( '3crgn' ) ) comicpress_get_sidebar( 'left' );
			}
			?>

			<div id="content" class="narrowcolumn">

				<?php
				do_action( 'comicpress-narrowcolumn-area' );
				if ( ! comicpress_sidebars_disabled() ) {
					if ( ! is_front_page() && ! comicpress_themeinfo( 'over-blog-sidebar-all-posts' ) ) return;
					comicpress_get_sidebar( 'over-blog' );
				}
				do_action( 'comic-blog-area' );
				?>
