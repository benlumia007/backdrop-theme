<?php
/**
 * Backdrop Core ( src/Menu/Menu.php )
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @author    Benjamin Lu ( https://getbenonit.com )
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Define namespace
 */
namespace Benlumia007\Backdrop\Theme\Menu;
use Benlumia007\Backdrop\Theme\Contracts\Menu\Menu as MenuContracts;

/**
 * Regiser Menu Class
 * 
 * @since  3.0.0
 * @access public
 */
class Menu implements MenuContracts {
    /**
     * $menu_id
     * 
     * @since  3.0.0
     * @access public
     * @return string $menu_id
     */
    public $menu_id;

    /**
     * Register Menus
     * 
     * @since  3.0.0
     * @access public
     * @return void
     */
    public function register() {
        foreach ( $this->menu_id as $key => $value ) {
            $this->create( $value, $key );
        }
    }

	/**
	 * Create Menus
	 *
	 * @param string $name outputs name.
	 * @param string $id output id.
	 */
	public function create( string $name, string $id ) {
		$args = [
			$id => $name,
		];

		register_nav_menus( $args );
	}

	public function boot() {
		add_action( 'after_setup_theme', [ $this, 'register' ] );
	}
}