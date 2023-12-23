<?php
/**
 * Plugin Name: KAGG Disable Aggressive Updates
 * Description: WordPress плагин для ускорения админки WordPress путём отключения агрессивных проверок обновлений
 * Version: 1.1
 * Plugin URI: https://www.kobzarev.com
 * Author: Mikhail Kobzarev
 * Author URI: https://www.kobzarev.com
 * License: GNU General Public License v2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: kagg-disable-aggressive-updates
 * GitHub Plugin URI: https://github.com/kagg-design/kagg-disable-aggressive-updates
 * Requires WP:       4.9
 * Requires PHP:      7.0
 *
 * @package kagg-disable-aggressive-updates
 * @wordpress-plugin
 * @license   GPL-2.0+
 * @link https://wp-kama.ru/id_8514/uskoryaem-adminku-wordpress-otklyuchaem-proverki-obnovlenij.html
 * @see https://wp-kama.ru/filecode/wp-includes/update.php
 * @author Kama (https://wp-kama.ru)
 * @version 1.1
 */

if ( is_admin() ) {
	// Отключим проверку обновлений при любом заходе в админку...
	remove_action( 'admin_init', '_maybe_update_core' );
	remove_action( 'admin_init', '_maybe_update_plugins' );
	remove_action( 'admin_init', '_maybe_update_themes' );

	// Отключим проверку обновлений при заходе на специальную страницу в админке...
	remove_action( 'load-plugins.php', 'wp_update_plugins' );
	remove_action( 'load-themes.php', 'wp_update_themes' );

	/**
	 * Отключим проверку необходимости обновить браузер в консоли - мы всегда юзаем топовые браузеры!
	 * Эта проверка происходит раз в неделю...
	 *
	 * @see https://wp-kama.ru/function/wp_check_browser_version
	 */
	$user_agent = isset( $_SERVER['HTTP_USER_AGENT'] )
		? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) )
		: '';

	add_filter( 'pre_site_transient_browser_' . md5( $user_agent ), '__return_empty_array' );
}
