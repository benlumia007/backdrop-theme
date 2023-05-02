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
use function Backdrop\Template\Helpers\path;




/**
 * This function is for adding extra support for features not default to the core post types.
 * Excerpts are added to the 'page' post type.  Comments and trackbacks are added for the
 * 'attachment' post type.  Technically, these are already used for attachments in core, but
 * they're not registered.
 *
 * @since  1.0.0
 * @access public
 * @return void
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
 * Filters the excerpt more output with internationalized text and a link to the post.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $text
 * @return string
 */
function excerpt_more( string $text ): string {

    if ( 0 !== strpos( $text, '<a' ) ) {

        $text = sprintf(
            ' <a href="%s" class="entry__more-link">%s</a>',
            esc_url( get_permalink() ),
            trim( $text )
        );
    }

    return $text;
}

/**
 * Filters the WordPress body class with a better set of classes that are more
 * consistently handled and are backwards compatible with the original body
 * class functionality that existed prior to WordPress core adopting this feature.
 *
 * @since  1.0.0
 * @access public
 * @param  array  $classes
 * @param  array  $class
 * @return array
 */
function body_class_filter( $classes, $class ) {

	$classes = [];

	// Multisite check adds the 'multisite' class and the blog ID.
	if ( is_multisite() ) {
		$classes[] = 'multisite';
		$classes[] = 'blog-' . get_current_blog_id();
	}

	// Front page of the site.
	if ( is_front_page() ) {
		$classes[] = 'home';
	}

	// Blog page.
	if ( is_home() ) {
		$classes[] = 'blog';

	// Singular views.
	} elseif ( is_singular() ) {

		// Get the queried post object.
		$post      = get_queried_object();
		$post_id   = get_queried_object_id();
		$post_type = $post->post_type;

		$classes[] = "single-{$post_type}";

		// Checks for custom template.
		$template = str_replace(
			[ "{$post_type}-template-", "{$post_type}-", 'template-', 'tmpl-' ],
			'',
			basename( get_page_template_slug( $post_id ), '.php' )
		);

		$classes[] = $template ? "{$post_type}-template-{$template}" : "{$post_type}-template-default";

		// Post format.
		if ( current_theme_supports( 'post-formats' ) && post_type_supports( $post_type, 'post-formats' ) ) {
			$post_format = \get_post_format( $post_id );

			$classes[] = $post_format && ! is_wp_error( $post_format ) ? "{$post_type}-format-{$post_format}" : "{$post_type}-format-standard";
		}

		// Attachment mime types.
		if ( is_attachment() ) {

			foreach ( explode( '/', get_post_mime_type() ) as $type ) {
				$classes[] = "attachment-{$type}";
			}
		}

	// Archive views.
	} elseif ( is_archive() ) {
		$classes[] = 'archive';

		// Post type archives.
		if ( is_post_type_archive() ) {
			$post_type = get_query_var( 'post_type' );

			$classes[] = sprintf(
				'archive-%s',
				is_array( $post_type ) ? reset( $post_type ) : $post_type
			);
		}

		// Taxonomy archives.
		if ( is_tax() || is_category() || is_tag() ) {

			// Get the queried term object.
			$term     = get_queried_object();
			$term_id  = get_queried_object_id();
			$taxonomy = $term->taxonomy;

			$slug = 'post_format' === $taxonomy ? str_replace( 'post-format-', '', $term->slug ) : $term->slug;

			$classes[] = 'taxonomy';
			$classes[] = "taxonomy-{$taxonomy}";
			$classes[] = "taxonomy-{$taxonomy}-" . sanitize_html_class( $slug, $term_id );
		}

		// User/author archives.
		if ( is_author() ) {
			$user_id = get_query_var( 'author' );

			$classes[] = 'author';
			$classes[] = 'author-' . sanitize_html_class( get_the_author_meta( 'user_nicename', $user_id ), $user_id );
		}

		// Date archives.
		if ( is_date() ) {
			$classes[] = 'date';

			if ( is_year() ) {
				$classes[] = 'year';
			}

			if ( is_month() ) {
				$classes[] = 'month';
			}

			if ( get_query_var( 'w' ) ) {
				$classes[] = 'week';
			}

			if ( is_day() ) {
				$classes[] = 'day';
			}
		}

		// Time archives.
		if ( is_time() ) {
			$classes[] = 'time';

			if ( get_query_var( 'hour' ) ) {
				$classes[] = 'hour';
			}

			if ( get_query_var( 'minute' ) ) {
				$classes[] = 'minute';
			}
		}
	}

	// Search results.
	elseif ( is_search() ) {
		$classes[] = 'search';
	}

	// Error 404 pages.
	elseif ( is_404() ) {
		$classes[] = 'error-404';
	}

	// Paged views.
	if ( is_paged() ) {
		$classes[] = 'paged';
		$classes[] = 'paged-' . intval( get_query_var( 'paged' ) );

	// Singular post paged views using <!-- nextpage -->.
	} elseif ( is_singular() && 1 < get_query_var( 'page' ) ) {
		$classes[] = 'paged';
		$classes[] = 'paged-' . intval( get_query_var( 'page' ) );
	}

	// Is the current user logged in.
	$classes[] = is_user_logged_in() ? 'logged-in' : 'logged-out';

	// WP admin bar.
	if ( is_admin_bar_showing() ) {
		$classes[] = 'admin-bar';
	}

	// Use the '.custom-background' class to integrate with the WP background feature.
	if ( get_background_image() || get_background_color() ) {
		$classes[] = 'custom-background';
	}

	// Add the '.custom-header' class if the user is using a custom header.
	if ( get_header_image() || ( display_header_text() && get_header_textcolor() ) ) {
		$classes[] = 'custom-header';
	}

	// Add the `.custom-logo` class if user is using a custom logo.
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		$classes[] = 'wp-custom-logo';
	}

	// Add the `.wp-embed-responsive` class if the theme supports it.
	if ( current_theme_supports( 'responsive-embeds' ) ) {
		$classes[] = 'wp-embed-responsive';
	}

	// Add the '.display-header-text' class if the user chose to display it.
	if ( display_header_text() ) {
		$classes[] = 'display-header-text';
	}

	return array_map( 'esc_attr', array_unique( array_merge( $classes, (array) $class ) ) );
}