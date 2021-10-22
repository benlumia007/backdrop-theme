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