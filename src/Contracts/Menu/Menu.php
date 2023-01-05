<?php
/**
 * Backdrop Core ( src/Contracts/Menu/Menu.php )
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @author    Benjamin Lu ( https://getbenonit.com )
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Define namespace
 */
namespace Backdrop\Theme\Contracts\Menu;
use Backdrop\Contracts\Bootable;

/**
 * Menu Interface
 *
 * @since  3.0.0
 * @access public
 *
 * @link   ( https://developer.wordpress.org/themes/customize-api )
 */
interface Menu extends Bootable {
	/**
	 * Register Menus
	 * 
	 * @since  3.0.0
	 * @access public
	 */
	public function register();
	
	/**
	 * Create Menus
	 * 
	 * @since  3.0.0
	 * @access public
	 */
	public function create( string $name, string $id );
}