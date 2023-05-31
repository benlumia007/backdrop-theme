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

 namespace Backdrop\Theme;

# Filters the WordPress element classes.
add_filter( 'body_class',    __NAMESPACE__ . '\body_class_filter',    ~PHP_INT_MAX, 2 );

# Filters the archive title and description.
add_filter( 'get_the_archive_title',       __NAMESPACE__ . '\archive_title_filter', 5 );
add_filter( 'get_the_archive_description', __NAMESPACE__ . '\archive_description_filter', 0           );
add_filter( 'get_the_archive_description', __NAMESPACE__ . '\archive_description_format', PHP_INT_MAX );

# Add extra support for post types.
add_action( 'init', __NAMESPACE__ . '\post_type_support', 15 );

# Default excerpt more.
add_filter( 'excerpt_more', __NAMESPACE__ . '\excerpt_more', 5 );

# Filters the title for untitled posts.
add_filter( 'the_title', __NAMESPACE__ . '\untitled_post' );

# Adds common theme items to <head>.
add_action( 'wp_head', __NAMESPACE__ . '\meta_generator', 0 );
add_action( 'wp_head', __NAMESPACE__ . '\link_pingback',  0 );

# Filter the comments template.
add_filter( 'comments_template', __NAMESPACE__ . '\comments_template', 5 );

add_action( 'init', __NAMESPACE__ . '\is_plugin_active');