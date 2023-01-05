<?php
/**
 * Menu interface
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
namespace Backdrop\Theme\Contracts\Menu;
use Backdrop\Contracts\Bootable;

/**
 * Menu Interface
 *
 * @since  1.0.0
 * @access public
 *
 * @link   ( https://developer.wordpress.org/themes/customize-api )
 */
interface Menu extends Bootable {
	/**
	 * Register Menus
	 * 
	 * @since  1.0.0
	 * @access public
	 */
	public function register();
	
	/**
	 * Create Menus
	 * 
	 * @since  1.0.0
	 * @access public
	 */
	public function create( string $name, string $id );
}