<?php
/**
 * Admin interface
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
namespace Backdrop\Theme\Contracts\Admin;
use Backdrop\Contracts\Bootable;

/**
 * Admin
 */
interface Admin extends Bootable {
	/**
	 * menu()
	 * 
	 * @since  1.0.0
	 * @access public
	 */
	public function menu();

	/**
	 * callback()
	 * 
	 * @since  1.0.0
	 * @access public
	 */
	public function callback();

	/**
	 * tabs()
	 * 
	 * @since  1.0.0
	 * @access public
	 */
	public function tabs();

	/**
	 * pages()
	 * 
	 * @since  1.0.0
	 * @access public
	 */
	public function pages();
}