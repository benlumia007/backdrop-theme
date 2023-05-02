<?php
/**
 * Backdrop Core
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-theme
 */

/**
 * Define namespace
 */
namespace Backdrop\Theme;

/**
 * Adds the meta charset to the header.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function meta_charset() {
	echo apply_filters(
		'backdrop/theme/head/meta/charset',
		sprintf( '<meta charset="%s" />', esc_attr( get_bloginfo( 'charset' ) ) )
	);
}

/**
 * Adds the meta viewport to the header.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function meta_viewport() {
	echo apply_filters(
		'backdrop/theme/head/meta/viewport',
		'<meta name="viewport" content="width=device-width, initial-scale=1" />' . "\n"
	);
}

/**
 * Adds the theme generator meta tag.  This is particularly useful for checking
 * theme users' version when handling support requests.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function meta_generator() {
	$theme = wp_get_theme( \get_template() );

	$generator = sprintf(
		'<meta name="generator" content="%s %s" />' . "\n",
		esc_attr( $theme->get( 'Name' ) ),
		esc_attr( $theme->get( 'Version' ) )
	);

	echo apply_filters( 'backdrop/theme/head/meta/generator', $generator );
}

/**
 * Adds the pingback link to the header.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function link_pingback() {

	$link = '';

	if ( 'open' === get_option( 'default_ping_status' ) ) {
		$link = sprintf(
			'<link rel="pingback" href="%s" />' . "\n",
			esc_url( get_bloginfo( 'pingback_url' ) )
		);
	}

	echo apply_filters( 'backdrop/theme/head/link/pingback', $link );
}


# Filters the WordPress element classes.
// add_filter( 'body_class',    __NAMESPACE__ . '\body_class_filter',    ~PHP_INT_MAX, 2 );

# Add extra support for post types.
// add_action( 'init', __NAMESPACE__ . '\post_type_support', 15 );

# Default excerpt more.
// add_filter( 'excerpt_more', __NAMESPACE__ . '\excerpt_more', 5 );

# Filter the comments template
// add_filter( 'comments_template', __NAMESPACE__ . '\comments_template' );