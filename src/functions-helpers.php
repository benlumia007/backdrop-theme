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

namespace Backdrop\Theme;

/**
 * This is a wrapper function for core WP's `get_theme_mod()` function.  Core
 * doesn't provide a filter hook for the default value (useful for child themes).
 * The purpose of this function is to provide that additional filter hook.  To
 * filter the final theme mod, use the core `theme_mod_{$name}` filter hook.
 *
 * @param  string $name
 * @param  mixed  $default
 * @return mixed
 */
function mod( $name, $default = false ) {
    return get_theme_mod(
        $name,
        apply_filters( "backdrop/theme/mod/{$name}/default", $default )
    );
}


function is_classicpress() {
    if ( function_exists( 'classicpress_version' ) ) {
        return true;
    } else {
        return false;
    }
}