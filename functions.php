<?php
/**
 * Theme functions and definitions
 *
 * @package HelloBiz
 */

use HelloBiz\Theme;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_BIZ_ELEMENTOR_VERSION', '1.1.1' );
define( 'EHP_THEME_SLUG', 'hello-biz' );

define( 'HELLO_BIZ_PATH', get_template_directory() );
define( 'HELLO_BIZ_URL', get_template_directory_uri() );
define( 'HELLO_BIZ_ASSETS_PATH', HELLO_BIZ_PATH . '/assets/' );
define( 'HELLO_BIZ_ASSETS_URL', HELLO_BIZ_URL . '/assets/' );
define( 'HELLO_BIZ_SCRIPTS_PATH', HELLO_BIZ_ASSETS_PATH . 'js/' );
define( 'HELLO_BIZ_SCRIPTS_URL', HELLO_BIZ_ASSETS_URL . 'js/' );
define( 'HELLO_BIZ_STYLE_PATH', HELLO_BIZ_ASSETS_PATH . 'css/' );
define( 'HELLO_BIZ_STYLE_URL', HELLO_BIZ_ASSETS_URL . 'css/' );
define( 'HELLO_BIZ_IMAGES_PATH', HELLO_BIZ_ASSETS_PATH . 'images/' );
define( 'HELLO_BIZ_IMAGES_URL', HELLO_BIZ_ASSETS_URL . 'images/' );
define( 'HELLO_BIZ_STARTER_IMAGES_PATH', HELLO_BIZ_IMAGES_PATH . 'starter-content/' );
define( 'HELLO_BIZ_STARTER_IMAGES_URL', HELLO_BIZ_IMAGES_URL . 'starter-content/' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

// Init the Theme class
require HELLO_BIZ_PATH . '/theme.php';

Theme::instance();

// Register the [mallory_donate] shortcode
function mallory_donate_accordion_shortcode() {
    // Define your fixed amounts
    $amounts = array( 5, 10, 25, 100, 250 );
    // Base ActBlue URL
    $base_url = 'https://secure.actblue.com/donate/mp-clawson'
              . '?source=WEB_NBI_MM_ORG_WebMain_20250402';

    ob_start();
    ?>
    <div class="mallory-donate-accordion">
      <a class="donate-bar-text mallory-donate-link" href="<?php echo esc_url( $base_url ); ?>" target="_blank" rel="noopener">
        Donate Now to Elect Meredith for Clawson City Council
        <i class="fa fa-arrow-right donate-arrow" aria-hidden="true"></i>
      </a>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'mallory_donate', 'mallory_donate_accordion_shortcode' );

// Enqueue minimal CSS (and Font Awesome if you want the arrows)
function mallory_donate_assets() {
    wp_enqueue_style(
        'mallory-donate-css',
        get_stylesheet_directory_uri() . '/css/mallory-donate.css'
    );
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css',
        array(),
        '6.4.0'
    );
}
add_action( 'wp_enqueue_scripts', 'mallory_donate_assets' );


// 1) Enqueue our footer‐specific CSS
function meredith_footer_assets() {
  wp_enqueue_style(
    'meredith-footer-css',
    get_stylesheet_directory_uri() . '/css/meredith-footer.css',
    [],
    '1.0'
  );
}
add_action( 'wp_enqueue_scripts', 'meredith_footer_assets' );
