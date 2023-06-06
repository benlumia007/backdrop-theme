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

function is_classicpress() {
    if ( function_exists( 'classicpress_version' ) ) {
        return true;
    } else {
        return false;
    }
}