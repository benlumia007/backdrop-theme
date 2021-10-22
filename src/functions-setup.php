<?php
/**
 * Backdrop Core
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @license   GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author    Benjamin Lu ( https://getbenonit.com )
 */

/**
 * Define namespace
 */
namespace Benlumia007\Backdrop\Theme;
use function Benlumia007\Backdrop\Template\path;

/**
 * Add Post Type Support
 */
function post_type_support() {
    add_post_type_support( 'page', 'excerpt' );
}

/**
 * Add Comment Templates
 */
function comments_template( $template ) {
	$templates = [];
    $path = path();

	// Allow for custom templates entered into comments_template( $file ).
	$template = str_replace( trailingslashit( get_stylesheet_directory() ), '', $template );

	$template = $path . $template;

	if ( 'comments.php' !== $template ) {
		$templates[] = $template;
	}

	// Add a comments template based on the post type.
	$templates[] = sprintf( 'comments/%s.php', get_post_type() );

	// Add the default comments template.
	$templates[] = "{$path}/comments/default.php";
	$templates[] = 'comments.php';

	// Return the found template.
	return locate_template( $templates );
}

/**
 * Add excerpt more
 */
function excerpt_more() {
	global $post;
	$more = ' ...';

	return esc_html( $more );
}

/**
 * Get the Archive Title
 */
function archive_title() {
	if ( is_category() ) {
		$title = esc_html__( 'Category', 'ecclesiastical' ) . '<span class="archive-description">' . single_cat_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = esc_html__( 'Tag', 'ecclesiastical' ) . '<span class="archive-description">' . single_tag_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = esc_html__( 'Author', 'ecclesiastical' ) . '<span class="archive-description">' . get_the_author() . '</span>';
	} elseif ( is_year() ) {
		$title = esc_html__( 'Year', 'ecclesiastical' ) . '<span class="archive-description">' . get_the_date( _x( 'Y', 'yearly archives date format', 'ecclesiastical' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = esc_html__( 'Month', 'ecclesiastical' ) . '<span class="archive-description">' . get_the_date( _x( 'F', 'monthly archives date format', 'ecclesiastical' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = esc_html__( 'Day', 'ecclesiastical' ) . '<span class="archive-description">' . get_the_date( _x( 'F j Y', 'daily archives date format', 'ecclesiastical' ) ) . '</span>';
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'ecclesiastical' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'ecclesiastical' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'ecclesiastical' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'ecclesiastical' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'ecclesiastical' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'ecclesiastical' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'ecclesiastical' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'ecclesiastical' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'ecclesiastical' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = esc_html__( 'Archives', 'ecclesiastical' ) . '<span class="archive-description">' . post_type_archive_title( '', false ) . '</span>';
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		// Translators: 1 = singular name, 2 = single term title.
		$title = sprintf( __( '%1$s: %2$s', 'ecclesiastical' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = esc_html__( 'Archives', 'ecclesiastical' );
	}
	return $title;
}

if ( ! function_exists( 'wp_body_open' ) ) {
    /**
     * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
     */
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}