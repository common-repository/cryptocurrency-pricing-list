<?php
/**
Plugin Name: Cryptocurrency Pricing list and Ticker
Plugin URI: https://wordpress.org/plugins/cryptocurrency-pricing-list/
Description: Cryptocurrency Plugin for Wordpress you can use to list all the cryptocurrencies such as bitcoin, litecoin, ethereum, ripple, dash etc. It has more than 2000+ coins that you can choose to show on your website. We are using Crypto Compare API which is having 99.9% uptime for API calls.
Author: premiumthemes
Version: 1.5
Author URI: https://www.premium-themes.co/
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
define ('ccpw_version', '1.5');
//define plugin url global
define('ccpw_url', plugin_dir_url( __FILE__ ));
define('ccpw_request_url', "https://www.premium-themes.co");
define('ccpw_api_url', "https://min-api.cryptocompare.com/data/");
//include source files
foreach ( glob( plugin_dir_path( __FILE__ ) . "inc/*.php" ) as $ccpw_file ){
include_once $ccpw_file;
}

//define shortcodes
add_shortcode( 'ccpw_allcurrencies', 'ccpw_all_currencies_shortcode');
add_shortcode( 'ccpw_currency_calculator', 'ccpw_currency_calculator_shortcode');
add_shortcode( 'ccpw_currencies_with_price', 'ccpw_currencies_with_price_shortcode');
add_shortcode( 'ccpw_ticker', 'ccpw_currency_ticker_shortcode');
add_shortcode( 'ccpw_price_chart', 'ccpw_currency_price_chart_shortcode');
add_shortcode( 'ccpw_changelly_widget', 'ccpw_changelly_widget_shortcode');
add_shortcode( 'ccpw_news_ticker', 'ccpw_news_ticker_shortcode');
add_filter( 'plugin_row_meta', 'ccpw_plugin_row_meta', 10, 2 );


function ccpw_plugin_row_meta( $links, $file ) {
		if ( strpos( $file, 'cryptocurrency-pricing-list-and-ticker.php' ) !== false ) {
			$row_meta = array(
				'support' => '<a href="' . esc_url(ccpw_request_url.'/cryptocurrency-pricing-list-and-ticker-pro/') . '" aria-label="' . esc_attr__( 'Visit premium plugin', 'ccpw' ) . '">' . esc_html__( 'PRO Plugin', 'ccpw' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}

		return (array) $links;
	}

//Create table when plugin install
function ccpw_install(){
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'ccpw';
	$sql = "CREATE TABLE $table_name (
		id int(50) NOT NULL AUTO_INCREMENT,
		coin_name varchar(250) NOT NULL,
		coin_fullname varchar(250) DEFAULT NULL,
		coin_img varchar(250) NOT NULL,
		coin_algo varchar(250) DEFAULT NULL,
		coin_proof varchar(250) DEFAULT NULL,
		coin_supply varchar(250) DEFAULT NULL,
		activity_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY id (id)
	) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	update_option('ccpw_plugin_version', ccpw_version);
}
register_activation_hook(__FILE__,'ccpw_install');


//enqueue_scripts for admin
function ccpw_admin_enqueue_script()
{  
   wp_enqueue_style( 'wp-color-picker' );
   wp_enqueue_script( 'cpw_color_picker', ccpw_url . 'js/ccpw_color_picker.js', array( 'wp-color-picker' ), false, true );
   wp_enqueue_script( 'ccpw_admin_enqueue_scripts', ccpw_url . 'js/ccpw_backend.js', __FILE__, '', true);
   wp_enqueue_style( 'ccpw_admin_enqueue_style', ccpw_url . 'css/ccpw_backend.css', __FILE__);
  }
add_action('admin_enqueue_scripts', 'ccpw_admin_enqueue_script');

//enqueu script function for frontend
function ccpw_front_enqueue_script()
{  
	wp_enqueue_script("jquery");
	wp_enqueue_script( 'ccpw_front_enqueue_scripts', ccpw_url . 'js/ccpw_frontend.js', __FILE__, '', true);
    wp_enqueue_style( 'ccpw_front_enqueue_style', ccpw_url . 'css/ccpw_frontend.css', __FILE__);
	wp_enqueue_script( 'ccpw_Chart_bundle', ccpw_url . 'js/Chart.bundle.js', __FILE__, '', false);
	wp_enqueue_script( 'ccpw_amcharts', ccpw_url . 'js/amchart/amcharts.js', __FILE__);
	wp_enqueue_script( 'ccpw_serial', ccpw_url . 'js/amchart/serial.js', __FILE__);
	wp_enqueue_script( 'ccpw_amstock', ccpw_url . 'js/amchart/amstock.js', __FILE__);
	wp_enqueue_script( 'ccpw_exportjs', ccpw_url . 'js/amchart/plugins/export/export.min.js', __FILE__);
	wp_enqueue_style( 'ccpw_exportcss', ccpw_url . 'js/amchart/plugins/export/export.css', __FILE__);
	wp_enqueue_script( 'ccpw_light', ccpw_url . 'js/amchart/light.js', __FILE__);
    wp_register_script( 'front_enqueue_webticker_scripts', ccpw_url . 'js/jquery.webticker.min.js', __FILE__, '', true);
	wp_enqueue_script('front_enqueue_webticker_scripts');
} 
add_action('wp_enqueue_scripts', 'ccpw_front_enqueue_script');

// Run a process update plugin data
function ccpw_update_db_check() {
	global $wpdb;
    if ( get_option( 'ccpw_plugin_version' ) != ccpw_version) {
	update_option('ccpw_plugin_version', ccpw_version);
		$table_name = $wpdb->prefix . 'ccpw';
		$column_name ='coin_fullname';
		$columnexists = $wpdb->get_results( $wpdb->prepare(
		"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",
		DB_NAME, $table_name, $column_name) );
		if (empty( $columnexists ) ) {
		$wpdb->query( "ALTER TABLE $table_name ADD coin_algo VARCHAR(250) NULL AFTER coin_img, ADD coin_proof VARCHAR(250) NULL AFTER coin_algo, ADD coin_supply VARCHAR(250) NULL AFTER coin_proof, ADD coin_fullname VARCHAR(250) NULL AFTER coin_name;");
		/*check if table not empty*/
		$ccpw_check_table = $wpdb->get_results("SELECT * FROM $table_name",ARRAY_A);
		if(count($ccpw_check_table)>0){
			$ccpw_coinlist_url = 'all/coinlist';
			$ccpw_request_response_array_set = ccpw_requests_get($ccpw_coinlist_url);
			$ccpw_coinlist_all_currencies_raw = json_decode($ccpw_request_response_array_set['response_body'], true);
			$ccpw_coinlist_all_currencies = $ccpw_coinlist_all_currencies_raw['Data'];
			$ccpw_imagebaseurl = $ccpw_coinlist_all_currencies_raw['BaseImageUrl'];
			foreach($ccpw_coinlist_all_currencies as $ccpw_coinlist_all_currency){
				$ccpw_crypto_coinname= $ccpw_coinlist_all_currency["Name"];
				$ccpw_check_coins = $wpdb->get_results("SELECT * FROM $table_name WHERE coin_name = '$ccpw_crypto_coinname'",ARRAY_A);
				$ccpw_totalcoin = count($ccpw_check_coins);
					if($ccpw_totalcoin != 0){
						$wpdb->update( $table_name, array('coin_img' => $ccpw_imagebaseurl.$ccpw_coinlist_all_currency["ImageUrl"],'coin_algo'=>$ccpw_coinlist_all_currency["Algorithm"],'coin_proof'=>$ccpw_coinlist_all_currency["ProofType"],'coin_supply'=>$ccpw_coinlist_all_currency["TotalCoinSupply"],'coin_fullname'=>$ccpw_coinlist_all_currency["FullName"]),array( 'coin_name' => $ccpw_crypto_coinname));
					}
			
			}
		}
		}
    }
}
add_action('wp_loaded', 'ccpw_update_db_check');

/*WP remote GET REQUEST */ 
function ccpw_requests_get($ccpw_coinlist_url){
$ccpw_header = esc_attr(get_option('ccpw_crypto_api_key'));
$url = ccpw_api_url.$ccpw_coinlist_url;	
$get_remote = wp_remote_get($url,
 array(
  'timeout' => 200,
  'httpversion' => '1.0',
  'redirection' => 5,
  'blocking'    => true,
  'headers'     => array('Content-Type'=> 'application/json',
  						 'authorization'=> $ccpw_header
   ),
  'sslverify'   => true,
  )
  );
  if ( is_wp_error( $get_remote ) ) {
  $result['error_msg'] =$get_remote->get_error_message();
  }else{
  $result['response_body'] = wp_remote_retrieve_body($get_remote);
  $result['response_code'] = wp_remote_retrieve_response_code($get_remote);
  }
return $result;
}