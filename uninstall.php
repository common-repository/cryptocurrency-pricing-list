<?php

if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) 
exit();
// Delete table and option when plugin delete
global $wpdb;
$table_name = $wpdb->prefix . 'ccpw';
$sql = "DROP TABLE IF EXISTS $table_name";
$wpdb->query($sql);
$table_posts= $wpdb->prefix.'posts';
$table_postmeta = $wpdb->prefix.'postmeta';
$wpdb->query("delete p,pm from $table_posts p join $table_postmeta pm on pm.post_id = p.id where p.post_type = 'ccpw_ticker_post' OR p.post_type = 'price_chart_post' OR p.post_type = 'ccpw_newsticker_post'");
delete_option("ccpw_crypto_currency_compare");
delete_option("ccpw_physical_currency_compare");
delete_option("ccpw_crypto_currency_calculator_img");
delete_option("ccpw_option_number");
delete_option("ccpw_data_delete_coin");
delete_option("ccpw_data_delete_img");
delete_option("ccpw_display_phy_cfn");
delete_option("ccpw_crypto_api_key");