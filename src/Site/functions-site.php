<?php
/**
 * Backdrop Core ( src/Sidebar/Sidebar.php )
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
namespace Backdrop\Theme\Site;

/**
 * Outputs the site title HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function display_site_title( array $args = [] ) {
	echo render_site_title( $args ); // phpcs:ignore
}

/**
 * Returns the site title HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function render_site_title( array $args = [] ) {
	$args = wp_parse_args( $args, [
		'tag'       => 'h1',
		'class'      => 'site-title',
	] );

	$html = '';
	$title = get_bloginfo( 'name', 'display' );

	if ( $title ) {
		$link = render_home_link( [
			'text' => $title,
		] );

		$html = sprintf(
			'<%1$s class="%2$s">%3$s</%1$s>',
			tag_escape( $args['tag'] ),
			esc_attr( $args['class'] ),
			$link // phpcs:ignore
		);
	}
	return apply_filters( 'succotash/render/site/title', $html );
}