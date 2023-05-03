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

