<?php
/**
 * Backdrop
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
function display_site_title( array $args = [] ): void {

	echo render_site_title( $args );
}

/**
 * Returns the site title HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function render_site_title( array $args = [] ): string {

	$args = wp_parse_args( $args, [
		'tag'       => 'h1',
		'class'      => 'site-title',
		'link_class' => 'site-title-link'
	] );

	$html = '';

	$title = get_bloginfo( 'name', 'display' );

	if ( $title ) {
		$link = render_home_link( [
			'text' => $title,
			'class' => $args['link_class']
		] );

		$html = sprintf(
			'<%1$s class="%2$s">%3$s</%1$s>',
			tag_escape( $args['tag'] ),
			esc_attr( $args['class'] ),
			$link
		);
	}

	return apply_filters( 'backdrop/render/site/title', $html );
}

/**
 * Outputs the site description HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function display_site_description( array $args = [] ): void {

	echo render_site_description( $args );
}

/**
 * Returns the site description HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return string
 */
function render_site_description( array $args = [] ):string {

	$args = wp_parse_args( $args, [
		'tag'       => 'span',
		'class'      => 'site-description',
	] );

	$html = '';
	$title = get_bloginfo( 'description', 'display' );

	if ( $title ) {
		$html = sprintf(
			'<%1$s class="%2$s">%3$s</%1$s>',
			tag_escape( $args['tag'] ),
			esc_attr( $args['class'] ),
			$title
		);
	}

	return apply_filters( 'backdrop/render/site/description', $html );
}


/**
 * Outputs the site link HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function display_site_link( array $args = [] ): void {

	echo render_site_link( $args );
}

/**
 * Return the site link HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return string
 */
function render_site_link( array $args = [] ): string {

	$args = wp_parse_args(
		$args,
		[
			'text'   => '%s',
			'class'  => 'site-link',
			'before' => '',
			'after'  => '',
		]
	);
	$html = sprintf(
		'<a class="%1$s" href="%2$s">%3$s</a>',
		esc_attr( $args['class'] ),
		esc_url( home_url( '/' ) ),
		sprintf( $args['text'], get_bloginfo( 'name' ) )
	);
	return apply_filters( 'backdrop/render/site/link', $html );
}

function display_theme_link( array $args = [] ): void {

	echo render_theme_link( $args );
}

/**
 * Returns the Theme Link.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function render_theme_link( array $args = [] ): string {
    
	$args = wp_parse_args( $args, [
		'class'  => 'theme-link',
		'before' => '',
		'after'  => ''
	] );

	$theme = wp_get_theme( get_template() );

	$allowed = [
		'abbr'    => [ 'title' => true ],
		'acronym' => [ 'title' => true ],
		'code'    => true,
		'em'      => true,
		'strong'  => true
	];

	$html = sprintf(
		'<a class="%s" href="%s">%s</a>',
		esc_attr( $args['class'] ),
		esc_url( $theme->display( 'ThemeURI' ) ),
		wp_kses( $theme->display( 'Name' ), $allowed )
	);

	return apply_filters( 'backdrop/render/theme/link', $args['before'] . $html . $args['after'] );
}

/**
 * Outputs the site link HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function display_home_link( array $args = [] ): void {

	echo render_home_link( $args );
}

/**
 * Returns the site link HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return string
 */
function render_home_link( array $args = [] ): string {

	$args = wp_parse_args( $args, [
		'text'   => '%s',
		'class'  => 'home-link',
		'before' => '',
		'after'  => ''
	] );

	$html = sprintf(
		'<a class="%s" href="%s" rel="home">%s</a>',
		esc_attr( $args['class'] ),
		esc_url( home_url() ),
		sprintf( $args['text'], get_bloginfo( 'name', 'display' ) )
	);
	return apply_filters( 'backdrop/render/home/link', $args['before'] . $html . $args['after'] );
}

/**
 * Output the WordPress Link HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function display_wp_link( array $args = [] ): void {

	echo render_wp_link( $args );
}

/**
 * Returns the WordPress Link HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return string
 */
function render_wp_link( array $args = [] ): string {
	$args = wp_parse_args( $args, [
		'text'   => '%s',
		'class'  => 'wp-link',
		'before' => '',
		'after'  => '',
	] );

	$html = sprintf(
		'<a class="%1$s" href="%2$s">%3$s</a>',
		esc_attr( $args['class'] ),
		esc_url( __( 'https://wordpress.org', 'backdrop' ) ),
		sprintf( $args['text'], esc_html__( 'WordPress', 'backdrop' ) )
	);
	return apply_filters( 'backdrop/render/wp/link', $html );
}

/**
 * Output the ClassicPress Link HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function display_cp_link( array $args = [] ): void {

	echo render_cp_link( $args );
}

/**
 * Returns the WordPress Link HTML.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $args
 * @return void
 */
function render_cp_link( array $args = [] ): string {

	$args = wp_parse_args( $args, [
		'text'   => '%s',
		'class'  => 'cp-link',
		'before' => '',
		'after'  => '',
	] );

	$html = sprintf(
		'<a class="%1$s" href="%2$s">%3$s</a>',
		esc_attr( $args['class'] ),
		esc_url( __( 'https://www.classicpress.net', 'backdrop' ) ),
		sprintf( $args['text'], esc_html__( 'ClassicPress', 'backdrop' ) )
	);
	return apply_filters( 'backdrop/render/cp/link', $html );
}