<?php 

//admin menu page

add_action('admin_menu', 'ccpw_menu_page');
function ccpw_menu_page(){
    add_menu_page( 'CCPW Menu Page', 'CCPW', 'manage_options', 'cryptocurrency-pricing-list-and-ticker', 'ccpw_list_all_currencies', plugins_url( 'cryptocurrency-pricing-list/images/ccpw_menu_icon.png' ) );
    add_submenu_page( 'cryptocurrency-pricing-list-and-ticker', 'CCPW Menu Page', 'List Crypto Currencies', 'manage_options', 'cryptocurrency-pricing-list-and-ticker', 'ccpw_list_all_currencies');
    add_submenu_page( 'cryptocurrency-pricing-list-and-ticker', 'CCPW Calculator Sub Menu Page', 'Currency Calculator', 'manage_options', 'ccpw_calculator', 'ccpw_calculator');
	add_submenu_page( 'cryptocurrency-pricing-list-and-ticker', __( 'All ccpw Tickers', 'ccpw_ticker' ), __( 'Ticker / List Widget', 'ccpw_ticker' ), 'manage_options', '/edit.php?post_type=ccpw_ticker_post', '');
	add_submenu_page( 'cryptocurrency-pricing-list-and-ticker', __( 'All Price Chart', 'ccpw_price_chart' ), __( 'Pricing Chart', 'ccpw_price_chart' ), 'manage_options', '/edit.php?post_type=price_chart_post', '');
	add_submenu_page( 'cryptocurrency-pricing-list-and-ticker', __( 'All News Tickers', 'ccpw_newsticker' ), __( 'News Ticker', 'ccpw_newsticker' ), 'manage_options', '/edit.php?post_type=ccpw_newsticker_post', '');
	
	add_submenu_page( 'cryptocurrency-pricing-list-and-ticker', 'CCPW Changelly Widget Sub Menu Page', 'Changelly Exchange Widget', 'manage_options', 'ccpw_changelly_exchange_widget', 'ccpw_changelly_exchange_widget');
	add_submenu_page( 'cryptocurrency-pricing-list-and-ticker', 'CCPW Setting Sub Menu Page', 'API Key', 'manage_options', 'ccpw_setting', 'ccpw_setting');
	add_submenu_page("cryptocurrency-pricing-list-and-ticker", "Buy PRO", "<strong id=\"ccpwMenuCallout\" style=\"color: #FCB214;\">Buy PRO</strong>", "manage_options", ccpw_request_url."/cryptocurrency-pricing-list-and-ticker-pro/", '');
    add_submenu_page( 'cryptocurrency-pricing-list-and-ticker', 'CCPW Help Sub Menu Page', 'Help', 'manage_options', 'ccpw_help', 'ccpw_help');
}

// sort order function
function ccpw_sortByOrder($a, $b) {
  return $a['SortOrder'] - $b['SortOrder'];
}

//Init function for plugin
function ccpw_help(){
    echo '<div class="wrap" style="width:75%; float:left"><h1>Help</h1>';
    //set the active tab
    $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'ccpw_cryptocurrencies_shortcodes';
    echo '<h2 class="nav-tab-wrapper"> 
	<a '.(($active_tab =='ccpw_cryptocurrencies_shortcodes')?'style="background: #fff;"':'').' href="?page=ccpw_help&tab=ccpw_cryptocurrencies_shortcodes" class="nav-tab">Coin List</a>
	<a '.(($active_tab =='ccpw_cryptocurrencies_calculator_shortcodes')?'style="background: #fff;"':'').' href="?page=ccpw_help&tab=ccpw_cryptocurrencies_calculator_shortcodes" class="nav-tab">Calculator</a>
	<a '.(($active_tab =='ccpw_cryptocurrencies_price_shortcodes')?'style="background: #fff;"':'').' href="?page=ccpw_help&tab=ccpw_cryptocurrencies_price_shortcodes" class="nav-tab">Price List</a>
	<a '.(($active_tab =='ccpw_cryptocurrencies_ticker_listwidget_shortcodes')?'style="background: #fff;"':'').' href="?page=ccpw_help&tab=ccpw_cryptocurrencies_ticker_listwidget_shortcodes" class="nav-tab">Ticker/List Widget</a>
	<a '.(($active_tab =='ccpw_cryptocurrencies_price_chart_shortcodes')?'style="background: #fff;"':'').' href="?page=ccpw_help&tab=ccpw_cryptocurrencies_price_chart_shortcodes" class="nav-tab">Price Chart</a>
	<a '.(($active_tab =='ccpw_cryptocurrencies_chabgelly_widget_shortcodes')?'style="background: #fff;"':'').' href="?page=ccpw_help&tab=ccpw_cryptocurrencies_chabgelly_widget_shortcodes" class="nav-tab">Changelly Widget</a>
	
	</h2>';
    if ($active_tab == 'ccpw_cryptocurrencies_shortcodes'){
    echo '<h3>Lists for Cryptocurrencies shortcodes</h3>
    <div class="ccpw_help_lists_cryptocurrencies">
    <span>You can use the following shortcodes and PHP codes to render the results.</span><br><br>
    <span>If you would like to show the currency coins you selected choose coinlist="checked" in shortcode Or if you want to show all currency coin then choose coinlist="all" in shortcode.</span><br><br>
    <span>To show cryptocurrency all coins list.</span><br><br>
1. In content Example :- [ccpw_allcurrencies coinlist="all"]<br>
2. In template Example :- &lt;?php echo do_shortcode("[ccpw_allcurrencies coinlist="all"]"); ?&gt;<br><br>
<span>To show cryptocurrency all coin list with pagiantion.</span><br><br>
1. In content Example :- [ccpw_allcurrencies pagination="true" coinlist="all"]<br>
2. In template Example :- &lt;?php echo do_shortcode("[ccpw_allcurrencies pagination="true" coinlist="all"]"); ?&gt;<br><br>
<span>To show selected cryptocurrency coin list.</span><br><br>
1. In content Example :- [ccpw_allcurrencies coinlist="checked"]<br>
2. In template Example :- &lt;?php echo do_shortcode("[ccpw_allcurrencies  coinlist="checked"]"); ?&gt;<br><br>
<span>To show cryptocurrency selected coin list with pagiantion.</span><br><br>
1. In content Example :- [ccpw_allcurrencies pagination="true" coinlist="checked"]<br>
2. In template Example :- &lt;?php echo do_shortcode("[ccpw_allcurrencies pagination="true" coinlist="checked"]"); ?&gt;<br><br>
 </div>';
}
	if ($active_tab == 'ccpw_cryptocurrencies_calculator_shortcodes'){
	echo '<h3>Lists for Cryptocurrencies Calculator shortcodes</h3>
	<div class="ccpw_help_lists_cryptocurrencies">
	<span>You can use the following shortcodes and PHP codes to render the results.</span><br><br>
    1. In content Example :- [ccpw_currency_calculator]<br>
	2. In template Example :- &lt;?php echo do_shortcode("[ccpw_currency_calculator]"); ?&gt;
    </div>';	
	}
	if ($active_tab == 'ccpw_cryptocurrencies_price_shortcodes'){
	echo '<h3>Lists for Cryptocurrencies Price shortcodes</h3>
	<div class="ccpw_help_lists_cryptocurrencies">
	<span>You can use the following shortcode and PHP code to render the results.</span><br><br>
    1. In content Example :- [ccpw_currencies_with_price]<br>
	2. In template Example :- &lt;?php echo do_shortcode("[ccpw_currencies_with_price]"); ?&gt;
    </div>';	
	}
	
	if ($active_tab == 'ccpw_cryptocurrencies_ticker_listwidget_shortcodes'){
	echo '<h3>Lists for Cryptocurrencies Ticker & List Widget shortcodes</h3>
	<div class="ccpw_help_lists_cryptocurrencies">
	<span>You can use the following shortcode and PHP code to render the results.</span><br><br>
	1. In content Example :- [ccpw_ticker id="ID"]<br>
	2. In template Example :- &lt;?php echo do_shortcode("[ccpw_ticker id="ID"]"); ?&gt;
    </div>';	
	}
	if ($active_tab == 'ccpw_cryptocurrencies_price_chart_shortcodes'){
	echo '<h3>Lists for Cryptocurrencies Pricing Chart shortcodes</h3>
	<div class="ccpw_help_lists_cryptocurrencies">
	<span>You can use the following shortcode and PHP code to render the results.</span><br><br>
    1. In content Example :- [ccpw_price_chart id="ID"]<br>
	2. In template Example :- &lt;?php echo do_shortcode("[cccpw_price_chart id="ID"]"); ?&gt;
    </div>';	
	}
	
	if ($active_tab == 'ccpw_cryptocurrencies_chabgelly_widget_shortcodes'){
	echo '<h3>Lists for Cryptocurrencies Changelly Exchange Widget shortcodes</h3>
	<div class="ccpw_help_lists_cryptocurrencies">
	<span>You can use the following shortcode and PHP code to render the results.</span><br><br>
    1. In content Example :- [ccpw_changelly_widget]<br>
	2. In template Example :- &lt;?php echo do_shortcode("[ccpw_changelly_widget]"); ?&gt;
    </div>';	
	}
	echo '</div><a href="'.ccpw_request_url.'/cryptocurrency-pricing-list-and-ticker-pro/" target="_blank"><img class="probanner" src="'.ccpw_url.'images/probanner.png" style="float: right;margin-top: 20px; width:20%;"></a>';
}

//List all currences
function ccpw_list_all_currencies(){
	global $wpdb;
	$table_name = $wpdb->prefix . 'ccpw';
	echo '<div class="wrap" style="width:75%; float:left;"><h1>List all Cryptocurrencies</h1>
	<p>Please select the currencies which you would like to show on the web page.</p>';
	// Coin List
	$ccpw_coinlist_url = 'all/coinlist';
	$ccpw_request_response_array_set = ccpw_requests_get($ccpw_coinlist_url);
	$ccpw_coinlist_all_currencies_raw = json_decode($ccpw_request_response_array_set['response_body'], true);
	$ccpw_coinlist_all_currencies = $ccpw_coinlist_all_currencies_raw['Data'];
	$ccpw_imagebaseurl = $ccpw_coinlist_all_currencies_raw['BaseImageUrl'];
	
	//sort currencies by order
    usort($ccpw_coinlist_all_currencies, 'ccpw_sortByOrder');
	if(isset($_REQUEST['ccpw-list-currencies'])){
	echo '<div class="ccpw_save_setting notice notice-success is-dismissible">
	<p><strong>Settings saved.</strong></p>
	</div>';
	function ccpw_blankFilter($var){return ($var !== '');}
	if(!empty($_POST['ccpw_cryptocompare_list'])){
	$ccpw_crypto_coinlist = array_values(array_filter($_POST['ccpw_cryptocompare_list']));
	$ccpw_crypto_imgurl = array_values(array_filter($_POST['ccpw_data-img-url']));
	$ccpw_crypto_algo = array_values(array_filter($_POST['ccpw_data-algo'],'ccpw_blankFilter'));
	$ccpw_crypto_proof = array_values(array_filter($_POST['ccpw_data-proof'],'ccpw_blankFilter'));
	$ccpw_crypto_supply = array_values(array_filter($_POST['ccpw_data-supply'],'ccpw_blankFilter'));
	$ccpw_crypto_fullname = array_values(array_filter($_POST['ccpw_data-fullname'],'ccpw_blankFilter'));
		foreach( $ccpw_crypto_coinlist as $index => $ccpw_crypto_coinname ) {
			$ccpw_check_coins = $wpdb->get_results("SELECT * FROM $table_name WHERE coin_name = '$ccpw_crypto_coinname'",ARRAY_A);
			$ccpw_totalcoin = count($ccpw_check_coins);
			$ccpw_crypto_coinname = sanitize_text_field($ccpw_crypto_coinname);
			$ccpw_crypto_imgurl[$index] = esc_url($ccpw_crypto_imgurl[$index]);
			$ccpw_crypto_algo[$index] = sanitize_text_field($ccpw_crypto_algo[$index]);
			$ccpw_crypto_proof[$index] = sanitize_text_field($ccpw_crypto_proof[$index]);
			$ccpw_crypto_supply[$index] = (int)$ccpw_crypto_supply[$index];
			$ccpw_crypto_fullname[$index] = sanitize_text_field($ccpw_crypto_fullname[$index]);
			if($ccpw_totalcoin == 0){
			 $wpdb->insert( $table_name, array( 'coin_name' => $ccpw_crypto_coinname,'coin_img' => $ccpw_crypto_imgurl[$index],'coin_algo'=>$ccpw_crypto_algo[$index],'coin_proof'=>$ccpw_crypto_proof[$index],'coin_supply'=>$ccpw_crypto_supply[$index],'coin_fullname'=>$ccpw_crypto_fullname[$index]));
			}else{
			 $wpdb->update( $table_name, array('coin_img' => $ccpw_crypto_imgurl[$index],'coin_algo'=>$ccpw_crypto_algo[$index],'coin_proof'=>$ccpw_crypto_proof[$index],'coin_supply'=>$ccpw_crypto_supply[$index],'coin_fullname'=>$ccpw_crypto_fullname[$index]),array( 'coin_name' => $ccpw_crypto_coinname) );
			}
		}
	}
	if(!empty($_POST['ccpw_data-delete_coin'])){
	$ccpw_crypto_deletecoin=array_values(array_filter($_POST['ccpw_data-delete_coin']));
	foreach( $ccpw_crypto_deletecoin as $index => $delete_coin_name ){
	$delete_coin_name = sanitize_text_field($delete_coin_name);
    $ccpw_check_coins = $wpdb->get_results("SELECT * FROM $table_name WHERE coin_name ='$delete_coin_name'",ARRAY_A);
	$ccpw_get_coin = count($ccpw_check_coins);
	 if($ccpw_get_coin == 1){
     $wpdb->delete( $table_name, array( 'coin_name' => $delete_coin_name));
     }
 	}
	}
	}
	echo '<form action="" method="post" class="ccpw_list_currency_form">';
	$ccpw_crypto_savedlist = $wpdb->get_results("SELECT coin_name,coin_img FROM $table_name", ARRAY_A);
	$ccpw_crypto_savedcoinlist=array();
	foreach ($ccpw_crypto_savedlist as $ccpw_crypto_savelist) { 
	$ccpw_crypto_savedcoinlist[]= $ccpw_crypto_savelist['coin_name'];
	}
	if (isset($_GET['ccpw_setpage'])) {
	$ccpw_setpage = $_GET['ccpw_setpage'];
	}
	if(!empty($_GET['ccpw_setpage']) && $_GET['ccpw_setpage']==2){$ccpw_setpage = ($_GET['ccpw_setpage']-1)+99;$maxlimit=$_GET['ccpw_setpage']*99;}
	elseif(!empty($_GET['ccpw_setpage'])&& $_GET['ccpw_setpage']>=3){
		$ccpw_setpage = ($_GET['ccpw_setpage']-1)*99+1;$maxlimit=$_GET['ccpw_setpage']*99;
	} else{$ccpw_setpage = 0;$maxlimit=99;}
	for ($i=$ccpw_setpage;  $i <= $maxlimit; $i++ ){ 
	if(!empty($ccpw_coinlist_all_currencies[$i]["Name"])){
	echo '<div class="ccpw_currencies_list">';
	if(!empty($ccpw_coinlist_all_currencies[$i]["ImageUrl"])){ 
	echo '<img width="22" height="22" class="ccpw_img_none" src="'.$ccpw_imagebaseurl.$ccpw_coinlist_all_currencies[$i]["ImageUrl"].'"/>';
	echo '<label class="ccpw_img_none">
	<input class="ccpw_coin_click" ccpw_crypto_img_url="'.$ccpw_imagebaseurl.$ccpw_coinlist_all_currencies[$i]["ImageUrl"].'" class="ccpw_coin_checkbox checkbox" type="checkbox" name="ccpw_cryptocompare_list[]" value="'.$ccpw_coinlist_all_currencies[$i]["Name"].'" '.(( is_array( $ccpw_crypto_savedcoinlist ) && in_array($ccpw_coinlist_all_currencies[$i]["Name"], $ccpw_crypto_savedcoinlist))? 'checked':'').' ccpw_algo="'.$ccpw_coinlist_all_currencies[$i]["Algorithm"].'" ccpw_proof="'.$ccpw_coinlist_all_currencies[$i]["ProofType"].'" ccpw_supply="'.$ccpw_coinlist_all_currencies[$i]["TotalCoinSupply"].'" ccpw_fullname="'.$ccpw_coinlist_all_currencies[$i]["FullName"].'">
	<input class="ccpw_img_url" type="hidden" name="ccpw_data-img-url[]" value="'.(( is_array( $ccpw_crypto_savedcoinlist ) && in_array($ccpw_coinlist_all_currencies[$i]["Name"], $ccpw_crypto_savedcoinlist))? $ccpw_imagebaseurl.$ccpw_coinlist_all_currencies[$i]["ImageUrl"]:'').'">
	<input class="ccpw_algo" type="hidden" name="ccpw_data-algo[]" value="'.(( is_array( $ccpw_crypto_savedcoinlist ) && in_array($ccpw_coinlist_all_currencies[$i]["Name"], $ccpw_crypto_savedcoinlist))? $ccpw_coinlist_all_currencies[$i]["Algorithm"]:'').'">
	<input class="ccpw_proof" type="hidden" name="ccpw_data-proof[]" value="'.(( is_array( $ccpw_crypto_savedcoinlist ) && in_array($ccpw_coinlist_all_currencies[$i]["Name"], $ccpw_crypto_savedcoinlist))? $ccpw_coinlist_all_currencies[$i]["ProofType"]:'').'">
	<input class="ccpw_supply" type="hidden" name="ccpw_data-supply[]" value="'.(( is_array( $ccpw_crypto_savedcoinlist ) && in_array($ccpw_coinlist_all_currencies[$i]["Name"], $ccpw_crypto_savedcoinlist))? $ccpw_coinlist_all_currencies[$i]["TotalCoinSupply"]:'').'">
	<input class="ccpw_fullname" type="hidden" name="ccpw_data-fullname[]" value="'.(( is_array( $ccpw_crypto_savedcoinlist ) && in_array($ccpw_coinlist_all_currencies[$i]["Name"], $ccpw_crypto_savedcoinlist))? $ccpw_coinlist_all_currencies[$i]["FullName"]:'').'">
	<input class="ccpw_delete_coin" type="hidden" name="ccpw_data-delete_coin[]" value="">
	'.$ccpw_coinlist_all_currencies[$i]["Name"].'
	</label>';
	}
	echo '</div>';
	 } } 
	echo '<label class="ccpw_select_all"><input type="checkbox" id="select_all">Select All</label>';
	if(empty($_GET['ccpw_setpage']) || $_GET['ccpw_setpage'] == 1){ 
	echo '<div class="ccpw_custom-pagination"> 
	 <span>Total Count:- '.count($ccpw_coinlist_all_currencies).'</span>&nbsp;&nbsp;&nbsp;
	<span>Pages:- '.$ccpw_setpage.' To  '.$maxlimit.'</span><br><br>
	<a class="button button-primary ccpw_next-btn" href="'.site_url().'/wp-admin/admin.php?page=cryptocurrency-pricing-list-and-ticker&ccpw_setpage=2">Next Page </a>
	</div>';
	} else {
	$prev_page = $_GET['ccpw_setpage']-1;
	$next_page = $_GET['ccpw_setpage']+1; 
	  echo '<div class="ccpw_custom-pagination"> 
	  <span>Total Count:- '.count($ccpw_coinlist_all_currencies).'</span>&nbsp;&nbsp;&nbsp;
	  <span>Pages:- '.$ccpw_setpage.' To  '.(((empty($ccpw_coinlist_all_currencies[$i]["Name"])))?count($ccpw_coinlist_all_currencies):$maxlimit).'</span> <br><br>
	 <a class="button button-primary ccpw_prev-btn" href="'.site_url().'/wp-admin/admin.php?page=cryptocurrency-pricing-list-and-ticker&ccpw_setpage='.$prev_page.'">Prev Page </a>';
	 if(empty($ccpw_coinlist_all_currencies[$i]["Name"])){ } else {
	 echo '<a class="button button-primary ccpw_next-btn" href="'.site_url().'/wp-admin/admin.php?page=cryptocurrency-pricing-list-and-ticker&ccpw_setpage='.$next_page.'">Next Page </a>';
	}
	echo '</div>';
	}
    echo '<input name="ccpw-list-currencies" id="submit" class="ccpw_list_currencies_submit button button-primary" value="Save Changes" type="submit">
    </form></div><a href="'.ccpw_request_url.'/cryptocurrency-pricing-list-and-ticker-pro/" target="_blank"><img class="probanner" src="'.ccpw_url.'images/probanner.png" style="float: right;margin-top: 20px; width:20%;"></a>';
}

//Currency Calculator
function ccpw_calculator(){
	global $wpdb;
	$table_name = $wpdb->prefix . 'ccpw';
	if(isset($_REQUEST['ccpw-calculate-currencies'])){
	if(empty($_POST['ccpw_crypto_currency_compare'])){
	echo '<div class="ccpw_error_top_msg notice notice-error is-dismissible"><p><strong>Please choose atleast one Crypto Currency.</strong></p></div>';
	} elseif(empty($_POST['ccpw_physical_currency_compare'])){
	echo '<div class="ccpw_error_top_msg notice notice-error is-dismissible"><p><strong>Please choose atleast one Physical Currency.</strong></p></div>';
	} else {
	echo '<div class="ccpw_error_top_msg notice notice-success is-dismissible"><p><strong>Settings saved.</strong></p></div>';
	$ccpw_crypto_currency=$ccpw_physical_currency=array();
	if(!empty($_POST['ccpw_crypto_currency_compare'])){
	$ccpw_posted_crypto_currencies=$_POST['ccpw_crypto_currency_compare'];	
		foreach($ccpw_posted_crypto_currencies as $ccpw_posted_crypto_currency){
			$ccpw_crypto_currency[] = sanitize_text_field($ccpw_posted_crypto_currency);
		}
	}
	if(!empty($_POST['ccpw_physical_currency_compare'])){
	$ccpw_posted_phy_currencies=$_POST['ccpw_physical_currency_compare'];
		foreach($ccpw_posted_phy_currencies as $ccpw_posted_phy_currency){
			$ccpw_physical_currency[] = sanitize_text_field($ccpw_posted_phy_currency);
		}
	}

    update_option('ccpw_crypto_currency_compare', serialize($ccpw_crypto_currency));
    update_option('ccpw_physical_currency_compare', serialize($ccpw_physical_currency));
	}
	}
	echo '<div class="wrap" style="width:75%;float:left;"><h1>Currency Calculator</h1>
	<form action="" method="post">
	<h4>Crypto Currencies</h4>';
	$unserialize_ccpw_crypto_currency_compare =  unserialize(get_option('ccpw_crypto_currency_compare'));
	$unserialize_ccpw_physical_currency_compare =  unserialize(get_option('ccpw_physical_currency_compare'));
	$unserialize_ccpw_cryptocompare_list_1 = $wpdb->get_results("SELECT coin_name,coin_img FROM $table_name");
	$unserialize_ccpw_cryptocompare_list_ex=$unserialize_ccpw_cryptocompare_list_img = "";
	$img = 0;
	foreach ($unserialize_ccpw_cryptocompare_list_1 as $unserialize_ccpw_cryptocompare_list_2) { 
	$unserialize_ccpw_cryptocompare_list_ex .= $unserialize_ccpw_cryptocompare_list_2->coin_name.',';
	if(empty($unserialize_ccpw_cryptocompare_list_2->coin_img)){
	$unserialize_ccpw_cryptocompare_list_img .= 'images/none.png,';	
	} else {
	$unserialize_ccpw_cryptocompare_list_img .= $unserialize_ccpw_cryptocompare_list_2->coin_img.',';
	}
	}
	$unserialize_ccpw_cryptocompare_list = array_filter(explode(",", $unserialize_ccpw_cryptocompare_list_ex));
	$ccpw_crypto_img_url = array_filter(explode(",", $unserialize_ccpw_cryptocompare_list_img));
	if(empty($unserialize_ccpw_cryptocompare_list)){
	echo '<div class="ccpw_cryptocurrency_not_select">Please choose atleast one Cryptocurrency. <a href="'.site_url().'/wp-admin/admin.php?page=cryptocurrency-pricing-list-and-ticker">Click Here</a></div>';
	} else {
	$ccpw_crypto_currency_calculator_img =  unserialize(get_option('ccpw_crypto_currency_calculator_img'));
	foreach ($unserialize_ccpw_cryptocompare_list as $unserialize_ccpw_cryptocompare_list_get) {
	echo '<div class="ccpw_currencies_list">';
	if($ccpw_crypto_img_url[$img] == "images/none.png"){
	echo '<img class="ccpw_img_none" src="'.ccpw_url.'images/none.png" width="22" height="22">';
	} else {
	echo '<img class="ccpw_img_none" src="'.$ccpw_crypto_img_url[$img].'" width="22" height="22">';	
	}
	echo '<label class="ccpw_img_none">
	<input class="ccpw_coin_checkbox checkbox ccpw_crypto_cr_click" type="checkbox" ccpw_crypto_cr_img_url="'.$ccpw_crypto_img_url[$img].'"name="ccpw_crypto_currency_compare[]" value="'.$unserialize_ccpw_cryptocompare_list_get.'" '.((is_array( $unserialize_ccpw_crypto_currency_compare ) && in_array($unserialize_ccpw_cryptocompare_list_get, $unserialize_ccpw_crypto_currency_compare))? 'checked':'').'>'.$unserialize_ccpw_cryptocompare_list_get.'
	</label>
	</div>';
	$img++; } }
	echo '<div class="clear"></div> <h4>Physical Currencies</h4>'; 
	$phy_cu_list = array("AUD", "BRL", "CAD", "CHF", "CLP", "CNY", "CZK", "DKK", "EUR", "GBP","HKD","HUF", "IDR", "ILS", "INR", "JPY", "KRW", "MXN", "MYR", "NOK", "NZD", "PHP", "PKR", "PLN", "RUB", "SEK", "SGD", "THB", "TRY", "TWD", "USD", "ZAR");
	foreach ($phy_cu_list as $value) {
	echo '<div class="ccpw_currencies_list">
	<img class="ccpw_img_none" src="'.ccpw_url.'images/physical-currencies-icons/'.$value.'.png" width="22" height="22">
	<label class="ccpw_img_none">
	<input class="ccpw_coin_checkbox checkbox" type="checkbox" name="ccpw_physical_currency_compare[]" value="'.$value.'" '.((( is_array($unserialize_ccpw_physical_currency_compare) && in_array($value, $unserialize_ccpw_physical_currency_compare))? 'checked':'')).'> 
	'.$value.'
	</label>
	</div>';
	} 
	echo '<input name="ccpw-calculate-currencies" id="submit" class="ccpw_calculator_currencies_submit button button-primary" value="Save Changes" type="submit">
    </form></div><a href="'.ccpw_request_url.'/cryptocurrency-pricing-list-and-ticker-pro/" target="_blank"><img class="probanner" src="'.ccpw_url.'images/probanner.png" style="float: right;margin-top: 20px;width:20%"></a>';
}

// Ticker
add_action( 'init', 'ccpw_create_ticker_post_type' );
function ccpw_create_ticker_post_type() {
	$labels = array(
		'name'               => _x( 'CCPW Tickers', 'Plural Name' ),
		'singular_name'      => _x( 'CCPW Tickers', 'Singular Name' ),
		'add_new'            => _x( 'Add New', 'CCPW Ticker' ),
		'add_new_item'       => __( 'Add New CCPW Ticker' ),
		'edit_item'          => __( 'Edit CCPW Ticker' ),
		'new_item'           => __( 'New CCPW Ticker' ),
		'all_items'          => __( 'All CCPW Tickers' ),
		'view_item'          => __( 'View CCPW Ticker' ),
		'search_items'       => __( 'Search CCPW Tickers' ),
		'not_found'          => __( 'No CCPW Tickers found' ),
		'not_found_in_trash' => __( 'No CCPW Tickers found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'CCPW Tickers',
	);
	$args = array(
		'labels'      => $labels,
		'supports'    => array( 'title' ),
		'hierarchical'=> false,
		'public' => false,
		'show_ui'=> true,
		'show_in_nav_menus' => false,
		'can_export'=> true,
		'has_archive' => false,
		'rewrite' => false,
		'exclude_from_search'=> true,
		'publicly_queryable' => true,
	);
	register_post_type( 'ccpw_ticker_post', $args );
}

// Remove ticker custom post type
add_action( 'admin_menu', 'remove_ccpw_ticker_post' );
function remove_ccpw_ticker_post() {
	remove_menu_page( 'edit.php?post_type=ccpw_ticker_post' );
}

// Remove Slug Meta Boxes custom post type
add_action( 'add_meta_boxes', 'remove_ccpw_slug_meta_boxes' );
function remove_ccpw_slug_meta_boxes() {
    remove_meta_box( 'slugdiv', 'ccpw_ticker_post', 'normal' );
}


// Add PRO plugin button on custom post type
add_action('admin_head-edit.php', 'ccpw_custom_btn');	
function ccpw_custom_btn()
	{
		global $current_screen;
		
      // Not our post type, exit earlier
 		if ('price_chart_post' != $current_screen->post_type && 'ccpw_ticker_post' != $current_screen->post_type && 'ccpw_newsticker_post' != $current_screen->post_type) {
			return;
		}

		?>
        <script type="text/javascript">
            jQuery(document).ready( function($)
            {
				$(".wrap").find('a.page-title-action').after("<a id='ccpw_add_proplugin' href='https://goo.gl/z88oWU' target='_blank' class='add-new-h2'>Add a PRO ticker</a>");
                
            });
        </script>
    <?php

	}

// Set selected submenu
function ccpw_ticker_correct_current_menu(){
	$screen = get_current_screen();
	if ( $screen->id == 'ccpw_ticker_post' || $screen->id == 'edit-ccpw_ticker_post' ) {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#toplevel_page_cryptocurrency-pricing-list-and-ticker').addClass('wp-has-current-submenu wp-menu-open menu-top menu-top-first').removeClass('wp-not-current-submenu');
		$('#toplevel_page_cryptocurrency-pricing-list-and-ticker > a').addClass('wp-has-current-submenu').removeClass('wp-not-current-submenu');
	});
	</script>
	<?php
	}
	if ( $screen->id == 'ccpw_ticker_post' ) {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('a[href$="cryptocurrency-pricing-list-and-ticker_add_post"]').parent().addClass('current');
		$('a[href$="cryptocurrency-pricing-list-and-ticker_add_post"]').addClass('current');
	});
	</script>
	<?php
	}
	if ( $screen->id == 'edit-ccpw_ticker_post' ) {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('a[href$="cryptocurrency-pricing-list-and-ticker_show_posts"]').parent().addClass('current');
		$('a[href$="cryptocurrency-pricing-list-and-ticker_show_posts"]').addClass('current');
	});
	</script>
	<?php
	}
}
add_action('admin_head', 'ccpw_ticker_correct_current_menu', 50);

function set_custom_edit_ccpw_columns($columns) {
	    $columns['tickertype'] = __( 'Ticker Type', 'ccpw' );
		$columns['shortcode'] = __( 'Shortcode', 'ccpw' );
	   return $columns;
}

add_filter('manage_ccpw_ticker_post_posts_columns', 'set_custom_edit_ccpw_columns');

function custom_ccpw_column( $column, $post_id ) {
	    switch ( $column ) {
		   case 'shortcode' :
	            echo '<code>[ccpw_ticker id="'.$post_id.'"]</code>'; 
	            break;
				 case 'tickertype' :
	            $tickertype = get_post_meta( $post_id, 'ccpw_ticker-type' ); 
				echo ucwords($tickertype[0]);
	            break;
	    }
	}
add_action( 'manage_ccpw_ticker_post_posts_custom_column' ,'custom_ccpw_column', 10, 2 );


function custom_ccpw_reorder_columns($columns) {
  $custom_ccpw_columns = array();
  $date = 'date'; 
  foreach($columns as $key => $value) {
    if ($key==$date){
      $custom_ccpw_columns['tickertype'] ='';
	  $custom_ccpw_columns['shortcode'] = '';
    }
	
      $custom_ccpw_columns[$key] = $value;
  }
  return $custom_ccpw_columns;
}
add_filter('manage_ccpw_ticker_post_posts_columns', 'custom_ccpw_reorder_columns');

// Add sidebar
add_action( 'add_meta_boxes','register_ccpw_ticker_post_meta_box');
function register_ccpw_ticker_post_meta_box()
{
    add_meta_box( 'ccpw_ticker-shortcode', 'Cryptocurrency Plugin for Wordpress','ccpw_ticker_shortcode_meta', 'ccpw_ticker_post', 'side', 'high' );
    add_meta_box( 'ccpw_ticker-display-ph-currencies', 'Display Physical Currencies','ccpw_ticker_type_display_ph_currencies', 'ccpw_ticker_post');
    add_meta_box( 'ccpw_ticker-display-currencies', 'Display Crypto Currencies','ccpw_ticker_type_display_currencies', 'ccpw_ticker_post');
    add_meta_box( 'ccpw_ticker-type', 'Ticker Type','ccpw_ticker_type_meta', 'ccpw_ticker_post');
	add_meta_box( 'ccpw_ticker_hide_on_mobile', 'Remove Ticker from Mobile?','ccpw_ticker_mobile_hide', 'ccpw_ticker_post');
    add_meta_box( 'ccpw_display_cry_logos', 'Display Crypto Currencies Logos? ','ccpw_display_cry_logos', 'ccpw_ticker_post');
    add_meta_box( 'ccpw_display_phy_logos', 'Display Physical Currencies Logos? ','ccpw_display_phy_logos', 'ccpw_ticker_post');
    add_meta_box( 'ccpw_display_up_down', 'Display Up/Down?','ccpw_ticker_display_up_down', 'ccpw_ticker_post');
    add_meta_box( 'ccpw_ticker_position', 'Ticker Position','ccpw_ticker_position', 'ccpw_ticker_post');
    add_meta_box( 'ccpw_ticker_speed', 'Ticker Speed','ccpw_ticker_speed', 'ccpw_ticker_post');
    add_meta_box( 'ccpw_padding_from_top', 'Padding From Top','ccpw_padding_from_top', 'ccpw_ticker_post');
    add_meta_box( 'ccpw_padding_from_bottom', 'Padding From Bottom','ccpw_padding_from_bottom', 'ccpw_ticker_post');
    add_meta_box( 'ccpw_background_color', 'Background Color','ccpw_background_color', 'ccpw_ticker_post');
    add_meta_box( 'ccpw_font_color', 'Font Color','ccpw_font_color', 'ccpw_ticker_post');
    add_meta_box( 'ccpw_border_color', 'Border Color','ccpw_border_color', 'ccpw_ticker_post');
}

function ccpw_ticker_shortcode_meta(){ 
    $id = get_the_ID();
    $dynamic_attr='';
    _e(' <p>Paste this shortcode in anywhere (page/post)</p>','ccpw'); 
    $element_type = get_post_meta( $id, 'pp_type', true );
    $dynamic_attr.="[ccpw_ticker id=\"{$id}\"";
    $dynamic_attr.=']';
    ?>
    <input type="text" class="regular-small" name="ccpw_tiker_meta_box_text" id="ccpw_tiker_meta_box_text" value="<?php echo htmlentities($dynamic_attr) ;?>" readonly/>
    <input type="text" class="regular-small" name="ccpw_tiker_meta_box_text_php" id="ccpw_tiker_meta_box_text_php" value="&lt;?php echo do_shortcode('<?php echo htmlentities($dynamic_attr) ;?>'); ?&gt;" readonly/>
    <div>
    </div>
    <?php 
}

function ccpw_ticker_type_display_ph_currencies(){ 
$post_id = get_the_ID();
$ccpw_cfn = esc_attr(get_option('ccpw_display_phy_cfn'));
$ccpw_display_phy_currencies = get_post_meta( $post_id, 'ccpw_display_phy_currencies',true );
$phy_cu_list = array(array("AUD","Australian Dollar"), array("BRL","Brazilian real"), array("CAD","Canadian dollar"), array("CHF","Swiss franc"), array("CLP","Chilean peso"), array("CNY","Chinese Yuan Renminbi"), array("CZK","Czech koruna"), array("DKK","Danish krone"), array("EUR","Euro"), array("GBP","Great Britain Pound"), array("HKD","Hong Kong Dollars"), array("HUF","Hungarian forint"), array("IDR","Indonesian rupiah"), array("ILS","Sheqel"), array("INR","Indian rupee"), array("JPY","Japanese yen"), array("KRW","Korean won"), array("MXN","Mexican Peso"), array("MYR","Malaysian ringgit"), array("NOK","Norwegian krone"), array("NZD","New Zealand Dollar"), array("PHP","Philippine Peso"), array("PKR","Pakistani rupee"), array("PLN","Polish zloty"), array("RUB","Russian ruble"), array("SEK","Swedish Krona"), array("SGD","Singapore dollar"), array("THB","Thai baht"), array("TRY","Turkish lira"), array("TWD","New Taiwan Dollar"), array("USD","United States dollar"), array("ZAR","South African rand"));
foreach ($phy_cu_list as $value) {
$currence_sym = $value[0];
$currence_name = $value[1];
	echo '<p class="ccpw_full_currency">
	<img class="ccpw_img_none" src="'.ccpw_url.'images/physical-currencies-icons/'.$currence_sym.'.png" width="22" height="22">
	<label class="ccpw_img_none">';
if(empty($ccpw_display_phy_currencies) && $currence_sym == "USD"){
echo '<input class="ccpw_full_currency_input" type="radio" data-val="'.$currence_sym.'~'.$currence_name.'" name="ccpw_display_phy_currencies" name="ccpw_display_phy_currencies" value="'.$currence_sym.'" checked> 
	'.$currence_sym.'
	</label>';
echo '<input value="USD~United States dollar" class="input_curr_name" type="hidden" name="ccpw_display_phy_cfn">';
} else {
echo '<input class="ccpw_full_currency_input" type="radio" data-val="'.$currence_sym.'~'.$currence_name.'" name="ccpw_display_phy_currencies" value="'.$currence_sym.'" '.($currence_sym==$ccpw_display_phy_currencies ? 'checked':'').'> 
	'.$currence_sym.'
	</label>';
if(empty($ccpw_cfn)){
echo '<input value="USD~United States dollar" class="input_curr_name" type="hidden" name="ccpw_display_phy_cfn">';
} else {
echo '<input value="'.$ccpw_cfn.'" class="input_curr_name" type="hidden" name="ccpw_display_phy_cfn">';
}
}
echo '</p>';

} 
}

function ccpw_ticker_type_display_currencies(){
$post_id = get_the_ID();
$cry_cu_list = array("BTC", "ETH", "XRP", "BCH", "EOS", "LTC", "ADA", "XLM", "MIOTA", "NEO","XMR", "DASH", "TRX", "XEM", "USDT", "VEN", "ETC", "QTUM", "BNB", "OMG", "ICX", "LSK", "BTG", "XVG", "ZEC", "PPT", "NANO", "BTM", "BCN", "BTCP", "STEEM", "BTS", "WAN", "SC", "DOGE", "BCD", "DGD", "ZIL", "MKR", "STRAT", "RHOC", "SNT", "WAVES", "DCR", "ONT", "ZRX", "AE", "REP", "AION", "LRC");
$ccpw_display_currencies = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true));
foreach ($cry_cu_list as $value) {
//foreach ($ccpw_display_currencies as $ccpw_display_currencies_array) {
	echo '<p>
	<img class="ccpw_img_none" src="'.ccpw_url.'images/crypto-currencies-icons/'.$value.'.png" width="22" height="22">
	<label class="ccpw_img_none">
	<input type="checkbox" name="ccpw_display_currencies[]" value="'.$value.'" '.((is_array( $ccpw_display_currencies ) && in_array($value, $ccpw_display_currencies))? 'checked':'').'> 
	'.$value.'
	</label>
	</p>';
//}
} 
}

function ccpw_ticker_type_meta(){ 
$post_id = get_the_ID();
$ccpw_ticker_type = get_post_meta( $post_id, 'ccpw_ticker-type');
foreach ($ccpw_ticker_type as $ccpw_ticker_type_array) {
echo '<label><input type="radio" name="ccpw_ticker-type" id="ccpw_ticker-type" value="Ticker" '.((($ccpw_ticker_type_array == "Ticker")?"checked":'')).'/> Ticker &nbsp;&nbsp;&nbsp;&nbsp;</label> <label><input type="radio" name="ccpw_ticker-type" id="ccpw_ticker-type" value="list-widget" '.((($ccpw_ticker_type_array == "list-widget")?"checked":'')).'/> List Widget</label>';
}
}

function ccpw_ticker_mobile_hide(){ 
$post_id = get_the_ID();
$ccpw_ticker_hide_on_mobile = get_post_meta( $post_id, 'ccpw_ticker_hide_on_mobile',true);
echo '<label><input type="checkbox" name="ccpw_ticker_hide_on_mobile" id="ccpw_ticker_hide_on_mobile" value="on" '.((($ccpw_ticker_hide_on_mobile == "on")?"checked":'')).'/> Remove this ticker on mobile</label>';

}

function ccpw_display_cry_logos(){ 
$post_id = get_the_ID();
$ccpw_display_cry_logos = get_post_meta( $post_id, 'ccpw_display_cry_logos');
foreach ($ccpw_display_cry_logos as $ccpw_display_cry_logos_array) {
echo '<label><input type="checkbox" name="ccpw_display_cry_logos" id="ccpw_display_cry_logos" value="on" '.((($ccpw_display_cry_logos_array == "on")?"checked":'')).'/> Select if you want to display Currency logos</label>';
}
}

function ccpw_display_phy_logos(){ 
$post_id = get_the_ID();
$ccpw_display_phy_logos = get_post_meta( $post_id, 'ccpw_display_phy_logos');
foreach ($ccpw_display_phy_logos as $ccpw_display_phy_logos_array) {
echo '<label><input type="checkbox" name="ccpw_display_phy_logos" id="ccpw_display_phy_logos" value="on" '.((($ccpw_display_phy_logos_array == "on")?"checked":'')).'/> Select if you want to display Currency logos</label>';
}
}

function ccpw_ticker_display_up_down(){ 
$post_id = get_the_ID();
$ccpw_display_up_down = get_post_meta( $post_id, 'ccpw_display_up_down');
foreach ($ccpw_display_up_down as $ccpw_display_up_down_array) {
echo '<label><input type="checkbox" name="ccpw_display_up_down" id="ccpw_display_up_down" value="on" '.((($ccpw_display_up_down_array == "on")?"checked":'')).'/> Select if you want to display Currency changes in price</label>';
}
}

function ccpw_ticker_position(){ 
$post_id = get_the_ID();
$ccpw_ticker_position = get_post_meta( $post_id, 'ccpw_ticker_position');
foreach ($ccpw_ticker_position as $ccpw_ticker_position_array) {
echo '<label><input type="radio" name="ccpw_ticker_position" id="ccpw_ticker_position" value="Header" '.((($ccpw_ticker_position_array == "Header")?"checked":'')).'/> Header &nbsp;&nbsp;&nbsp;&nbsp;</label> <label><input type="radio" name="ccpw_ticker_position" id="ccpw_ticker_position" value="Footer" '.((($ccpw_ticker_position_array == "Footer")?"checked":'')).'/>Footer &nbsp;&nbsp;&nbsp;&nbsp;</label> <label><input type="radio" name="ccpw_ticker_position" id="ccpw_ticker_position" value="Anywhere" '.((($ccpw_ticker_position_array == "Anywhere")?"checked":'')).'/>Anywhere</label>';
}
}

function ccpw_ticker_speed(){ 
$post_id = get_the_ID();
$ccpw_ticker_speed = get_post_meta( $post_id, 'ccpw_ticker_speed');
foreach ($ccpw_ticker_speed as $ccpw_ticker_speed_array) {
echo '<select name="ccpw_ticker_speed">';
for ($i=10;  $i <= 200; $i++ ){ 
if ($i % 10 == 0){
echo '<option value="'.$i.'" '.((($ccpw_ticker_speed_array == $i)?"selected='selected'":'')).'>'.$i.'</option>';
}
}
echo '</select>';
}
}

function ccpw_padding_from_top(){ 
$post_id = get_the_ID();
$ccpw_padding_from_top = get_post_meta( $post_id, 'ccpw_padding_from_top');
foreach ($ccpw_padding_from_top as $ccpw_padding_from_top_array) {
echo '<input type="text" name="ccpw_padding_from_top" id="ccpw_padding_from_top" value="'.$ccpw_padding_from_top_array.'"/>';
}
}

function ccpw_padding_from_bottom(){ 
$post_id = get_the_ID();
$ccpw_padding_from_bottom = get_post_meta( $post_id, 'ccpw_padding_from_bottom');
foreach ($ccpw_padding_from_bottom as $ccpw_padding_from_bottom_array) {
echo '<input type="text" name="ccpw_padding_from_bottom" id="ccpw_padding_from_bottom" value="'.$ccpw_padding_from_bottom_array.'"/>';
}
}

function ccpw_background_color(){ 
$post_id = get_the_ID();
$ccpw_background_color = get_post_meta( $post_id, 'ccpw_background_color');
foreach ($ccpw_background_color as $ccpw_background_color_array) {
echo '<input type="text" class="ccpw_background_color" name="ccpw_background_color" id="ccpw_background_color" value="'.$ccpw_background_color_array.'"/>';
}
}

function ccpw_font_color(){ 
$post_id = get_the_ID();
$ccpw_font_color = get_post_meta( $post_id, 'ccpw_font_color');
foreach ($ccpw_font_color as $ccpw_font_color_array) {
echo '<input type="text" class="ccpw_font_color" name="ccpw_font_color" id="ccpw_font_color" value="'.$ccpw_font_color_array.'"/>';
}
}

function ccpw_border_color(){ 
$post_id = get_the_ID();
$ccpw_border_color = get_post_meta( $post_id, 'ccpw_border_color');
foreach ($ccpw_border_color as $ccpw_border_color_array) {
echo '<input type="text" class="ccpw_border_color" name="ccpw_border_color" id="ccpw_border_color" value="'.$ccpw_border_color_array.'"/>';
}
}

add_action( 'save_post_ccpw_ticker_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{
   $ccpw_tiker_meta_box_text="";
   if (isset($_POST['ccpw_tiker_meta_box_text'])){$ccpw_tiker_meta_box_text = esc_html($_POST['ccpw_tiker_meta_box_text']);}
   update_post_meta( $post_id, 'ccpw_tiker_meta_box_text', $ccpw_tiker_meta_box_text);

   $ccpw_ticker_type="";
   if (isset($_POST['ccpw_ticker-type'])){$ccpw_ticker_type = sanitize_text_field($_POST['ccpw_ticker-type']);}
   update_post_meta( $post_id, 'ccpw_ticker-type', $ccpw_ticker_type);
   
   $ccpw_ticker_hideon_mobile="";
   if (isset($_POST['ccpw_ticker_hide_on_mobile'])){$ccpw_ticker_hideon_mobile = sanitize_text_field($_POST['ccpw_ticker_hide_on_mobile']);}
   update_post_meta( $post_id, 'ccpw_ticker_hide_on_mobile', $ccpw_ticker_hideon_mobile);

   $ccpw_save_crypto_currencies=array();
   if(isset($_POST['ccpw_display_currencies']) && !empty($_POST['ccpw_display_currencies'])){
   	   $ccpw_save_crypto_currencies=$_POST['ccpw_display_currencies'];	
		foreach($ccpw_save_crypto_currencies as $ccpw_save_crypto_currency){
			$ccpw_save_crypto_currencies[] = sanitize_text_field($ccpw_save_crypto_currency);
		}
	
   update_post_meta( $post_id, 'ccpw_display_currencies', serialize($_POST['ccpw_display_currencies']));
}
   $ccpw_display_phy_currencies="";
   if (isset($_POST['ccpw_display_phy_currencies'])){$ccpw_display_phy_currencies = sanitize_text_field($_POST['ccpw_display_phy_currencies']);}
   update_post_meta( $post_id, 'ccpw_display_phy_currencies', $ccpw_display_phy_currencies);

   $ccpw_display_cry_logos="";
   if (isset($_POST['ccpw_display_cry_logos'])){$ccpw_display_cry_logos = sanitize_text_field($_POST['ccpw_display_cry_logos']);}
   update_post_meta( $post_id, 'ccpw_display_cry_logos', $ccpw_display_cry_logos);

   $ccpw_display_phy_logos="";
   if (isset($_POST['ccpw_display_phy_logos'])){$ccpw_display_phy_logos = sanitize_text_field($_POST['ccpw_display_phy_logos']);}
   update_post_meta( $post_id, 'ccpw_display_phy_logos', $ccpw_display_phy_logos);

   $ccpw_display_up_down="";
   if (isset($_POST['ccpw_display_up_down'])){$ccpw_display_up_down = sanitize_text_field($_POST['ccpw_display_up_down']);}
   update_post_meta( $post_id, 'ccpw_display_up_down', $ccpw_display_up_down);

   $ccpw_ticker_position="";
   if (isset($_POST['ccpw_ticker_position'])){$ccpw_ticker_position = sanitize_text_field($_POST['ccpw_ticker_position']);}
   update_post_meta( $post_id, 'ccpw_ticker_position', $ccpw_ticker_position);

   $ccpw_ticker_speed="";
   if (isset($_POST['ccpw_ticker_speed'])){$ccpw_ticker_speed = (int)$_POST['ccpw_ticker_speed'];}
   update_post_meta( $post_id, 'ccpw_ticker_speed', $ccpw_ticker_speed);

   $ccpw_padding_from_top="";
   if (isset($_POST['ccpw_padding_from_top'])){$ccpw_padding_from_top = (int)$_POST['ccpw_padding_from_top'];}
   update_post_meta( $post_id, 'ccpw_padding_from_top', $ccpw_padding_from_top);

   $ccpw_padding_from_bottom="";
   if (isset($_POST['ccpw_padding_from_bottom'])){$ccpw_padding_from_bottom = (int)$_POST['ccpw_padding_from_bottom'];}
   update_post_meta( $post_id, 'ccpw_padding_from_bottom', $ccpw_padding_from_bottom);

   $ccpw_background_color="";
   if (isset($_POST['ccpw_background_color'])){$ccpw_background_color = sanitize_text_field($_POST['ccpw_background_color']);}
   update_post_meta( $post_id, 'ccpw_background_color', $ccpw_background_color);

   $ccpw_font_color="";
   if (isset($_POST['ccpw_font_color'])){$ccpw_font_color = sanitize_text_field($_POST['ccpw_font_color']);}
   update_post_meta( $post_id, 'ccpw_font_color', $ccpw_font_color);

   $ccpw_border_color="";
   if (isset($_POST['ccpw_border_color'])){$ccpw_border_color = sanitize_text_field($_POST['ccpw_border_color']);}
   update_post_meta( $post_id, 'ccpw_border_color', $ccpw_border_color);

   $ccpw_display_phy_cfn="";
   if (isset($_POST['ccpw_display_phy_cfn'])){$ccpw_display_phy_cfn = sanitize_text_field($_POST['ccpw_display_phy_cfn']);}
   update_option('ccpw_display_phy_cfn', $ccpw_display_phy_cfn);
}

/* Price chart */

add_action( 'init', 'ccpw_create_price_chart_post_type' );
function ccpw_create_price_chart_post_type() {
	$ccpw_price_chart_labels = array(
		'name'               => _x( 'Price Chart', 'Plural Name' ),
		'singular_name'      => _x( 'Price Chart', 'Singular Name' ),
		'add_new'            => _x( 'Add New', 'Price Chart' ),
		'add_new_item'       => __( 'Add New Price Chart' ),
		'edit_item'          => __( 'Edit Price Chart' ),
		'new_item'           => __( 'New Price Chart' ),
		'all_items'          => __( 'All Price Chart' ),
		'view_item'          => __( 'View Price Chart' ),
		'search_items'       => __( 'Search Price Chart' ),
		'not_found'          => __( 'No Price Chart found' ),
		'not_found_in_trash' => __( 'No Price Chart found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Price Chart',
	);
	$ccpw_price_chart_args = array(
		'labels'      => $ccpw_price_chart_labels,
		'supports'    => array( 'title' ),
		'hierarchical'=> false,
		'public' => false,
		'show_ui'=> true,
		'show_in_nav_menus' => false,
		'can_export'=> true,
		'has_archive' => false,
		'rewrite' => false,
		'exclude_from_search'=> true,
		'publicly_queryable' => true,
	);
	register_post_type( 'price_chart_post', $ccpw_price_chart_args );
}


// Remove Price Chart custom post type
add_action( 'admin_menu', 'remove_price_chart_post' );
function remove_price_chart_post() {
	remove_menu_page( 'edit.php?post_type=price_chart_post' );
}

// Remove Slug Meta Boxes custom post type
add_action( 'add_meta_boxes', 'remove_ccpw_slug_meta_price_chart' );
function remove_ccpw_slug_meta_price_chart() {
    remove_meta_box( 'slugdiv', 'price_chart_post', 'normal' );
}

// Set selected submenu
function ccpw_price_chart_correct_current_menu(){
	$ccpw_price_chart_screen = get_current_screen();
	if ( $ccpw_price_chart_screen->id == 'price_chart_post' || $ccpw_price_chart_screen->id == 'edit-price_chart_post' ) {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#toplevel_page_cryptocurrency-pricing-list-and-ticker').addClass('wp-has-current-submenu wp-menu-open menu-top menu-top-first').removeClass('wp-not-current-submenu');
		$('#toplevel_page_cryptocurrency-pricing-list-and-ticker > a').addClass('wp-has-current-submenu').removeClass('wp-not-current-submenu');
	});
	</script>
	<?php
	}
	if ( $ccpw_price_chart_screen->id == 'price_chart_post' ) {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('a[href$="cryptocurrency-pricing-list-and-ticker_add_post"]').parent().addClass('current');
		$('a[href$="cryptocurrency-pricing-list-and-ticker_add_post"]').addClass('current');
	});
	</script>
	<?php
	}
	if ( $ccpw_price_chart_screen->id == 'edit-price_chart_post' ) {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('a[href$="cryptocurrency-pricing-list-and-ticker_show_posts"]').parent().addClass('current');
		$('a[href$="cryptocurrency-pricing-list-and-ticker_show_posts"]').addClass('current');
	});
	</script>
	<?php
	}
	
}
add_action('admin_head', 'ccpw_price_chart_correct_current_menu', 50);

function set_custom_edit_ccpw_columns_price_chart($columns) {
		$columns['shortcode'] = __( 'Shortcode', 'ccpw' );
	   return $columns;
}
add_filter('manage_price_chart_post_posts_columns', 'set_custom_edit_ccpw_columns_price_chart');

function custom_ccpw_column_price_chart( $column, $post_id ) {
	    switch ( $column ) {
		   case 'shortcode' :
	            echo '<code>[ccpw_price_chart id="'.$post_id.'"]</code>'; 
	            break;
	    }
	}
add_action( 'manage_price_chart_post_posts_custom_column' ,'custom_ccpw_column_price_chart', 10, 2 );


function custom_ccpw_reorder_columns_price_chart($columns) {
  $custom_ccpw_columns = array();
  $date = 'date'; 
  foreach($columns as $key => $ccpw_value) {
    if ($key==$date){
	  $custom_ccpw_columns['shortcode'] = '';
    }
	
      $custom_ccpw_columns[$key] = $ccpw_value;
  }
  return $custom_ccpw_columns;
}
add_filter('manage_price_chart_post_posts_columns', 'custom_ccpw_reorder_columns_price_chart');

// Add sidebar
add_action( 'add_meta_boxes','register_price_chart_post_meta_box');
function register_price_chart_post_meta_box()
{
    add_meta_box( 'ccpw_price_chart-shortcode', 'Cryptocurrency Plugin for Wordpress','ccpw_price_chart_shortcode_meta', 'price_chart_post', 'side', 'high' );
    add_meta_box( 'ccpw_price_chart-display-ph-currencies', 'Display Physical Currencies','ccpw_price_chart_type_display_ph_currencies', 'price_chart_post');
    add_meta_box( 'ccpw_price_chart-display-currencies', 'Display Crypto Currencies','ccpw_price_chart_type_display_currencies', 'price_chart_post');
	add_meta_box( 'ccpw_pc_border_color', 'Border Color','ccpw_pc_border_color', 'price_chart_post');
    add_meta_box( 'ccpw_pc_font_color', 'Font Color','ccpw_pc_font_color', 'price_chart_post');
    add_meta_box( 'ccpw_pc_line_color', 'Chart Color','ccpw_pc_line_color', 'price_chart_post');
    
}

function ccpw_price_chart_shortcode_meta(){ 
    $ccpw_id = get_the_ID();
    $ccpw_dynamic_attr='';
    _e(' <p>Paste this shortcode in anywhere (page/post)</p>','ccpw'); 
    $element_type = get_post_meta( $ccpw_id, 'pp_type', true );
    $ccpw_dynamic_attr.="[ccpw_price_chart id=\"{$ccpw_id}\"";
    $ccpw_dynamic_attr.=']';
    ?>
    <input type="text" class="regular-small" name="ccpw_price_chart_meta_box_text" id="ccpw_price_chart_meta_box_text" value="<?php echo htmlentities($ccpw_dynamic_attr) ;?>" readonly/>
    <input type="text" class="regular-small" name="ccpw_price_chart_meta_box_text_php" id="ccpw_price_chart_meta_box_text_php" value="&lt;?php echo do_shortcode('<?php echo htmlentities($ccpw_dynamic_attr) ;?>'); ?&gt;" readonly/>
    <div>
    </div>
    <?php 
}

function ccpw_price_chart_type_display_ph_currencies(){ 
$post_id = get_the_ID();
$ccpw_pc_display_phy_currencies = get_post_meta( $post_id, 'ccpw_pc_display_phy_currencies',true);
$ccpw_phy_cu_list = array(array("AUD","Australian Dollar"), array("BRL","Brazilian real"), array("CAD","Canadian dollar"), array("CHF","Swiss franc"), array("CLP","Chilean peso"), array("CNY","Chinese Yuan Renminbi"), array("CZK","Czech koruna"), array("DKK","Danish krone"), array("EUR","Euro"), array("GBP","Great Britain Pound"), array("HKD","Hong Kong Dollars"), array("HUF","Hungarian forint"), array("IDR","Indonesian rupiah"), array("ILS","Sheqel"), array("INR","Indian rupee"), array("JPY","Japanese yen"), array("KRW","Korean won"), array("MXN","Mexican Peso"), array("MYR","Malaysian ringgit"), array("NOK","Norwegian krone"), array("NZD","New Zealand Dollar"), array("PHP","Philippine Peso"), array("PKR","Pakistani rupee"), array("PLN","Polish zloty"), array("RUB","Russian ruble"), array("SEK","Swedish Krona"), array("SGD","Singapore dollar"), array("THB","Thai baht"), array("TRY","Turkish lira"), array("TWD","New Taiwan Dollar"), array("USD","United States dollar"), array("ZAR","South African rand"));
foreach ($ccpw_phy_cu_list as $ccpw_value) {
$currence_sym = $ccpw_value[0];
$currence_name = $ccpw_value[1];
if(!empty($ccpw_pc_display_phy_currencies)){
	echo '<p class="ccpw_full_currency">
	<img class="ccpw_img_none" src="'.ccpw_url.'images/physical-currencies-icons/'.$currence_sym.'.png" width="22" height="22">
	<label class="ccpw_img_none">';
if($ccpw_pc_display_phy_currencies==$currence_sym){
echo '<input class="ccpw_full_currency_input" type="radio" data-val="'.$currence_sym.'~'.$currence_name.'" name="ccpw_pc_display_phy_currencies" name="ccpw_pc_display_phy_currencies" value="'.$currence_sym.'" checked>';
}
else{
echo '<input class="ccpw_full_currency_input" type="radio" data-val="'.$currence_sym.'~'.$currence_name.'" name="ccpw_pc_display_phy_currencies" name="ccpw_pc_display_phy_currencies" value="'.$currence_sym.'">';
}
echo $currence_sym;
echo '</p>';

} else {
	echo '<p class="ccpw_full_currency">
	<img class="ccpw_img_none" src="'.ccpw_url.'images/physical-currencies-icons/'.$currence_sym.'.png" width="22" height="22">
	<label class="ccpw_img_none">';
if($currence_sym == "USD"){
echo '<input class="ccpw_full_currency_input" type="radio" data-val="'.$currence_sym.'~'.$currence_name.'" name="ccpw_pc_display_phy_currencies" name="ccpw_pc_display_phy_currencies" value="'.$currence_sym.'" checked> 
	'.$currence_sym.'
	</label>';
} else {
echo '<input class="ccpw_full_currency_input" type="radio" data-val="'.$currence_sym.'~'.$currence_name.'" name="ccpw_pc_display_phy_currencies" value="'.$currence_sym.'"> 
	'.$currence_sym.'
	</label>';
}
echo '</p>';
}

} 
}

function ccpw_price_chart_type_display_currencies(){
$post_id = get_the_ID();
$ccpw_cry_cu_list = array("BTC", "ETH", "XRP", "BCH", "EOS", "LTC", "ADA", "XLM", "MIOTA", "NEO","XMR", "DASH", "TRX", "XEM", "USDT", "VEN", "ETC", "QTUM", "BNB", "OMG", "ICX", "LSK", "BTG", "XVG", "ZEC", "PPT", "NANO", "BTM", "BCN", "BTCP", "STEEM", "BTS", "WAN", "SC", "DOGE", "BCD", "DGD", "ZIL", "MKR", "STRAT", "RHOC", "SNT", "WAVES", "DCR", "ONT", "ZRX", "AE", "REP", "AION", "LRC");
$ccpw_pc_display_currencies = get_post_meta( $post_id, 'ccpw_pc_display_currencies',true );
foreach ($ccpw_cry_cu_list as $ccpw_value) {
if(!empty($ccpw_pc_display_currencies)){
	echo '<p>
	<img class="ccpw_img_none" src="'.ccpw_url.'images/crypto-currencies-icons/'.$ccpw_value.'.png" width="22" height="22">
	<label class="ccpw_img_none">';
	if($ccpw_pc_display_currencies==$ccpw_value){
	echo '<input type="radio" name="ccpw_pc_display_currencies" value="'.$ccpw_value.'" checked>'; 
	}else{
	echo '<input type="radio" name="ccpw_pc_display_currencies" value="'.$ccpw_value.'">';
	}
	echo $ccpw_value.'
	</label>
	</p>';

} else {
	echo '<p>
	<img class="ccpw_img_none" src="'.ccpw_url.'images/crypto-currencies-icons/'.$ccpw_value.'.png" width="22" height="22">
	<label class="ccpw_img_none">
	<input type="radio" name="ccpw_pc_display_currencies" value="'.$ccpw_value.'"> 
	'.$ccpw_value.'
	</label>
	</p>';
}
} 
}


function ccpw_pc_border_color(){ 
$post_id = get_the_ID();
$ccpw_pc_border_color = get_post_meta( $post_id, 'ccpw_pc_border_color',true);
if(!empty($ccpw_pc_border_color)){
echo '<input type="text" class="ccpw_pc_border_color" name="ccpw_pc_border_color" id="ccpw_pc_border_color" value="'.$ccpw_pc_border_color.'"/><div class="clear"></div>';
}else {
echo '<input type="text" class="ccpw_pc_border_color" name="ccpw_pc_border_color" id="ccpw_pc_border_color" value="#000"/><div class="clear"></div>';	
}	
}

function ccpw_pc_font_color(){ 
$post_id = get_the_ID();
$ccpw_pc_font_color = get_post_meta( $post_id, 'ccpw_pc_font_color',true);
if(!empty($ccpw_pc_font_color)){
echo '<input type="text" class="ccpw_pc_font_color" name="ccpw_pc_font_color" id="ccpw_ccpw_pc_font_colorfont_color_price_chart" value="'.$ccpw_pc_font_color.'"/>';
} else {
echo '<input type="text" class="ccpw_pc_font_color" name="ccpw_pc_font_color" id="ccpw_pc_font_color" value="#000"/>';	
}
}

function ccpw_pc_line_color(){ 
$post_id = get_the_ID();
$ccpw_pc_line_color = get_post_meta( $post_id, 'ccpw_pc_line_color', true);
if(!empty($ccpw_pc_line_color)){
echo '<input type="text" class="ccpw_pc_line_color" name="ccpw_pc_line_color" id="ccpw_pc_line_color" value="'.$ccpw_pc_line_color.'"/>';

} else {
echo '<input type="text" class="ccpw_pc_line_color" name="ccpw_pc_line_color" id="ccpw_pc_line_color" value="#1e73be"/>';	
}
}
add_action( 'save_post_price_chart_post', 'ccpw_meta_box_save_price_chart' , 10, 2 );
function ccpw_meta_box_save_price_chart( $post_id )
{
   $ccpw_pc_line_color=$ccpw_font_color_price_chart=$ccpw_pc_display_phy_cfn=$ccpw_pc_display_phy_currencies=$ccpw_pc_display_currencies=$ccpw_price_chart_meta_box_text=$ccpw_pc_border_color="";
   
   if (isset($_POST['ccpw_price_chart_meta_box_text']) && $_POST['ccpw_price_chart_meta_box_text'] != ''){$ccpw_price_chart_meta_box_text = sanitize_text_field($_POST['ccpw_price_chart_meta_box_text']);}
   update_post_meta( $post_id, 'ccpw_price_chart_meta_box_text', $ccpw_price_chart_meta_box_text);


   if (isset($_POST['ccpw_pc_display_currencies']) && $_POST['ccpw_pc_display_currencies'] != ''){$ccpw_pc_display_currencies = sanitize_text_field($_POST['ccpw_pc_display_currencies']);}
   update_post_meta( $post_id, 'ccpw_pc_display_currencies', $ccpw_pc_display_currencies);


   if (isset($_POST['ccpw_pc_display_phy_currencies']) && $_POST['ccpw_pc_display_phy_currencies'] != ''){$ccpw_pc_display_phy_currencies = sanitize_text_field($_POST['ccpw_pc_display_phy_currencies']);}
   update_post_meta( $post_id, 'ccpw_pc_display_phy_currencies', $ccpw_pc_display_phy_currencies);
   
   
   if (isset($_POST['ccpw_pc_display_phy_cfn']) && $_POST['ccpw_pc_display_phy_cfn'] != ''){$ccpw_pc_display_phy_cfn = sanitize_text_field($_POST['ccpw_pc_display_phy_cfn']);}
   update_option('ccpw_pc_display_phy_cfn_'.$post_id.'', $ccpw_pc_display_phy_cfn);

  $ccpw_pc_font_color ="";
  if (isset($_POST['ccpw_pc_font_color']) && $_POST['ccpw_pc_font_color'] != ''){$ccpw_pc_font_color = sanitize_text_field($_POST['ccpw_pc_font_color']); }
   update_post_meta( $post_id, 'ccpw_pc_font_color', $ccpw_pc_font_color);

 if (isset($_POST['ccpw_pc_line_color']) && $_POST['ccpw_pc_line_color'] != ''){$ccpw_pc_line_color = sanitize_text_field($_POST['ccpw_pc_line_color']);}
   update_post_meta( $post_id, 'ccpw_pc_line_color', $ccpw_pc_line_color);

   if (isset($_POST['ccpw_pc_border_color'])){$ccpw_pc_border_color = sanitize_text_field($_POST['ccpw_pc_border_color']);}
   update_post_meta( $post_id, 'ccpw_pc_border_color', $ccpw_pc_border_color);
   
}

//Changelly Exchange Widget
function ccpw_changelly_exchange_widget(){
	global $wpdb;
	$table_name = $wpdb->prefix . 'ccpw';
	if(isset($_REQUEST['ccpw-changelly-widget'])){
	if(empty($_POST['ccpw_cew_affilate_id'])){
	echo '<div class="ccpw_error_top_msg notice notice-error is-dismissible"><p><strong>Please Enter Changelly Affiliate ID.</strong></p></div>';	
		}  else {
	echo '<div class="ccpw_error_top_msg notice notice-success is-dismissible"><p><strong>Settings saved.</strong></p></div>';
	$ccpw_cew_customize_color=sanitize_text_field($_POST['ccpw_cew_customize_color']);
	$ccpw_cew_affilate_id=sanitize_text_field($_POST['ccpw_cew_affilate_id']);
	$ccpw_cew_customize_width=(int)$_POST['ccpw_cew_customize_width'];
	$ccpw_cew_customize_height=(int)$_POST['ccpw_cew_customize_height'];
	
	update_option('ccpw_cew_customize_color', $ccpw_cew_customize_color);
    update_option('ccpw_cew_affilate_id', $ccpw_cew_affilate_id);
	update_option('ccpw_cew_customize_width', $ccpw_cew_customize_width);
    update_option('ccpw_cew_customize_height', $ccpw_cew_customize_height);
	}
	}
	$ccpw_cew_affilate_id=$ccpw_cew_customize_color='';
	echo '<div class="wrap" style="width:80%;float:left;"><h1>Changelly Exchange Widget</h1>
	<form action="" method="post">
	<h4>Changelly Widget Color</h4>';
	$ccpw_cew_customize_color = esc_attr(get_option('ccpw_cew_customize_color'));
	if(empty($ccpw_cew_customize_color)){
	echo '<input type="text" class="ccpw_cew_customize_color" name="ccpw_cew_customize_color" id="ccpw_cew_customize_color" value="#0eda7c"/>';}else{
		echo '<input type="text" class="ccpw_cew_customize_color" name="ccpw_cew_customize_color" id="ccpw_cew_customize_color" value="'.$ccpw_cew_customize_color.'"/>';}
	
	echo '<h4>Changelly Affiliate ID </h4>';
	$ccpw_cew_affilate_id = esc_attr(get_option('ccpw_cew_affilate_id'));
	echo '<input type="text" class="ccpw_cew_affilate_id" name="ccpw_cew_affilate_id" id="ccpw_cew_affilate_id" value="'.$ccpw_cew_affilate_id.'" placeholder="17ccc4b3e943"><br/>';
	
	echo '<h4>Changelly Widget Width (in px)</h4>';
	$ccpw_cew_customize_width = esc_attr(get_option('ccpw_cew_customize_width'));
	echo '<input type="text" class="ccpw_cew_customize_width" name="ccpw_cew_customize_width" id="ccpw_cew_customize_width" value="'.$ccpw_cew_customize_width.'" placeholder="600"><br/>';
	
	echo '<h4>Changelly Widget Height (in px)</h4>';
	$ccpw_cew_customize_height = esc_attr(get_option('ccpw_cew_customize_height'));
	echo '<input type="text" class="ccpw_cew_customize_height" name="ccpw_cew_customize_height" id="ccpw_cew_customize_height" value="'.$ccpw_cew_customize_height.'" placeholder="500"><br/><br/><br/>';
	
	echo '<input name="ccpw-changelly-widget" id="submit" class="ccpw_changelly_submit button button-primary" value="Save Changes" type="submit">
    </form></div><a href="'.ccpw_request_url.'/cryptocurrency-pricing-list-and-ticker-pro/" target="_blank"><img class="probanner" src="'.ccpw_url.'images/probanner.png" style="float: right;margin-top: 20px;"></a>';
}

//News ticker

add_action( 'init', 'ccpw_create_news_ticker_post_type' );
function ccpw_create_news_ticker_post_type() {
	$ccpw_news_ticker_labels = array(
		'name'               => _x( 'News Ticker', 'Plural Name' ),
		'singular_name'      => _x( 'News Ticker', 'Singular Name' ),
		'add_new'            => _x( 'Add New', 'News Ticker' ),
		'add_new_item'       => __( 'Add New News Ticker' ),
		'edit_item'          => __( 'Edit News Ticker' ),
		'new_item'           => __( 'New News Ticker' ),
		'all_items'          => __( 'All News Ticker' ),
		'view_item'          => __( 'View News Ticker' ),
		'search_items'       => __( 'Search News Ticker' ),
		'not_found'          => __( 'No News Ticker' ),
		'not_found_in_trash' => __( 'No News Ticker found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'News Ticker',
	);
	$ccpw_news_ticker_args = array(
		'labels'      => $ccpw_news_ticker_labels,
		'supports'    => array( 'title' ),
		'hierarchical'=> false,
		'public' => false,
		'show_ui'=> true,
		'show_in_nav_menus' => false,
		'can_export'=> true,
		'has_archive' => false,
		'rewrite' => false,
		'exclude_from_search'=> true,
		'publicly_queryable' => true,
	);
	register_post_type( 'ccpw_newsticker_post', $ccpw_news_ticker_args );
}

// Remove ticker custom post type
add_action( 'admin_menu', 'remove_ccpw_news_ticker_post' );
function remove_ccpw_news_ticker_post() {
	remove_menu_page( 'edit.php?post_type=ccpw_newsticker_post' );
}

// Remove Slug Meta Boxes custom post type
add_action( 'add_meta_boxes', 'remove_ccpw_news_slug_meta_boxes' );
function remove_ccpw_news_slug_meta_boxes() {
    remove_meta_box( 'slugdiv', 'ccpw_newsticker_post', 'normal' );
}

// Set selected submenu
function ccpw_news_ticker_correct_current_menu(){
	$ccpw_news_ticker_screen = get_current_screen();
	if ( $ccpw_news_ticker_screen->id == 'ccpw_newsticker_post' || $ccpw_news_ticker_screen->id == 'edit-ccpw_newsticker_post' ) {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#toplevel_page_cryptocurrency-pricing-list-and-ticker').addClass('wp-has-current-submenu wp-menu-open menu-top menu-top-first').removeClass('wp-not-current-submenu');
		$('#toplevel_page_cryptocurrency-pricing-list-and-ticker > a').addClass('wp-has-current-submenu').removeClass('wp-not-current-submenu');
	});
	</script>
	<?php
	}
	if ( $ccpw_news_ticker_screen->id == 'ccpw_newsticker_post' ) {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#adminmenu .wp-submenu li:nth-child(6)').parent().addClass('current');
		$('#adminmenu .wp-submenu li:nth-child(6)').addClass('current');
		$('a[href$="cryptocurrency-pricing-list-and-ticker-add_post"]').parent().addClass('current');
		$('a[href$="cryptocurrency-pricing-list-and-ticker-add_post"]').addClass('current');
	});
	</script>
	<?php
	}
	if ( $ccpw_news_ticker_screen->id == 'edit-ccpw_newsticker_post' ) {
	?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('a[href$="cryptocurrency-pricing-list-and-ticker-show_posts"]').parent().addClass('current');
		$('a[href$="cryptocurrency-pricing-list-and-ticker-show_posts"]').addClass('current');
	});
	</script>
	<?php
	}
}
add_action('admin_head', 'ccpw_news_ticker_correct_current_menu', 50);

function set_custom_edit_ccpw_news_columns($columns) {
	    $columns['newstickertype'] = __( 'Type', 'ccpw_pro' );
		$columns['shortcode'] = __( 'Shortcode', 'ccpw_pro' );
	   return $columns;
}

add_filter('manage_ccpw_newsticker_post_posts_columns', 'set_custom_edit_ccpw_news_columns');

function custom_ccpw_news_column( $column, $post_id ) {
	    switch ( $column ) {
		   case 'shortcode' :
	            echo '<code>[ccpw_news_ticker id="'.$post_id.'"]</code>'; 
	            break;
				 case 'newstickertype' :
	            $newstickertype = get_post_meta( $post_id, 'ccpw_news_ticker_type',true ); 
				echo ucwords($newstickertype);
	            break;
	    }
	}
add_action( 'manage_ccpw_newsticker_post_posts_custom_column' ,'custom_ccpw_news_column', 10, 2 );


function custom_ccpw_news_reorder_columns($columns) {
  $custom_ccpw_columns = array();
  $date = 'date'; 
  foreach($columns as $key => $value) {
    if ($key==$date){
      $custom_ccpw_columns['newstickertype'] ='';
	  $custom_ccpw_columns['shortcode'] = '';
    }
	
      $custom_ccpw_columns[$key] = $value;
  }
  return $custom_ccpw_columns;
}
add_filter('manage_posts_columns', 'custom_ccpw_news_reorder_columns');

// Add sidebar
add_action( 'add_meta_boxes','register_ccpw_news_ticker_post_meta_box');
function register_ccpw_news_ticker_post_meta_box()
{
	add_meta_box( 'ccpw_news_ticker-shortcode', 'Cryptocurrency Plugin for Wordpress','ccpw_news_ticker_shortcode_meta', 'ccpw_newsticker_post', 'side', 'high' );
	add_meta_box( 'ccpw_news_ticker_type', 'Choose Your Type','ccpw_news_ticker_type_meta', 'ccpw_newsticker_post');
	add_meta_box( 'ccpw_news_ticker_hide_on_mobile', 'Remove News Ticker from Mobile?','ccpw_news_ticker_mobile_hide', 'ccpw_newsticker_post');
	add_meta_box( 'ccpw_newsticker_position', 'Position','ccpw_newsticker_position', 'ccpw_newsticker_post');
    add_meta_box( 'ccpw_newsticker_speed', 'Speed','ccpw_newsticker_speed', 'ccpw_newsticker_post');
    add_meta_box( 'ccpw_newspadding_from_top', 'Padding From Top','ccpw_newspadding_from_top', 'ccpw_newsticker_post');
    add_meta_box( 'ccpw_newspadding_from_bottom', 'Padding From Bottom','ccpw_newspadding_from_bottom', 'ccpw_newsticker_post');
    add_meta_box( 'ccpw_newsbackground_color', 'Background Color','ccpw_newsbackground_color', 'ccpw_newsticker_post');
    add_meta_box( 'ccpw_newsfont_color', 'Font Color','ccpw_newsfont_color', 'ccpw_newsticker_post');
	add_meta_box( 'ccpw_news_border_style', 'Border Color','ccpw_news_border_style', 'ccpw_newsticker_post');
   
}

function ccpw_news_ticker_shortcode_meta(){ 
    $ccpw_news_ticker_id = get_the_ID();
    $ccpw_news_ticker_dynamic_attr='';
    _e(' <p>Paste this shortcode in anywhere (page/post)</p>','ccpw_pro'); 
    $ccpw_news_ticker_dynamic_attr.="[ccpw_news_ticker id=\"{$ccpw_news_ticker_id}\"]";
    ?>
    <input type="text" class="regular-small" name="ccpw_news_tiker_meta_box_text" id="ccpw_tiker_meta_box_text" value="<?php echo htmlentities($ccpw_news_ticker_dynamic_attr) ;?>" readonly/>
    <input type="text" class="regular-small" name="ccpw_news_tiker_meta_box_text_php" id="ccpw_tiker_meta_box_text_php" value="&lt;?php echo do_shortcode('<?php echo htmlentities($ccpw_news_ticker_dynamic_attr) ;?>'); ?&gt;" readonly/>
   <?php 
}

function ccpw_news_ticker_type_meta(){ 
$post_id = get_the_ID();
$ccpw_news_ticker_type = get_post_meta( $post_id, 'ccpw_news_ticker_type', true);
if (empty($ccpw_news_ticker_type)) {
echo '<label><input type="radio" class="ccpw_horizontalticker_click" name="ccpw_news_ticker_type" id="ccpw_news_ticker_type" value="Horizontal" checked="checked"/> Horizontal </label>';
} else {
echo '<label><input type="radio" class="ccpw_list_widget_click" name="ccpw_news_ticker_type" id="ccpw_news_ticker_type" value="Horizontal" '.((($ccpw_news_ticker_type == "Horizontal")?"checked":'')).'/> Horizontal</label>';
}
}

function ccpw_news_ticker_mobile_hide(){ 
$post_id = get_the_ID();
$ccpw_news_ticker_mobile_hide = get_post_meta( $post_id, 'ccpw_news_ticker_mobile_hide',true);
echo '<label><input type="checkbox" name="ccpw_news_ticker_mobile_hide" id="ccpw_news_ticker_mobile_hide" value="on" '.((($ccpw_news_ticker_mobile_hide == "on")?"checked":'')).'/> Remove this news ticker on mobile</label>';
}

function ccpw_newsticker_position(){ 
$post_id = get_the_ID();
$ccpw_newsticker_position = get_post_meta( $post_id, 'ccpw_newsticker_position',true);
if (empty($ccpw_newsticker_position)) {
echo '<label><input type="radio" name="ccpw_newsticker_position" id="ccpw_newsticker_position" value="Header"/> Header</label> &nbsp;&nbsp;&nbsp;&nbsp; <label><input type="radio" name="ccpw_newsticker_position" id="ccpw_newsticker_position" value="Footer"/>Footer</label> &nbsp;&nbsp;&nbsp;&nbsp; <label><input type="radio" name="ccpw_newsticker_position" id="ccpw_newsticker_position" value="Anywhere"/>Anywhere</label>';
} else {
echo '<label><input type="radio" name="ccpw_newsticker_position" id="ccpw_newsticker_position" value="Header" '.((($ccpw_newsticker_position == "Header")?"checked":'')).'/> Header</label> &nbsp;&nbsp;&nbsp;&nbsp; <label><input type="radio" name="ccpw_newsticker_position" id="ccpw_newsticker_position" value="Footer" '.((($ccpw_newsticker_position == "Footer")?"checked":'')).'/>Footer</label> &nbsp;&nbsp;&nbsp;&nbsp; <label><input type="radio" name="ccpw_newsticker_position" id="ccpw_newsticker_position" value="Anywhere" '.((($ccpw_newsticker_position == "Anywhere")?"checked":'')).'/>Anywhere</label>';
}
}

function ccpw_newsticker_speed(){ 
$post_id = get_the_ID();
$ccpw_newsticker_speed = get_post_meta( $post_id, 'ccpw_newsticker_speed',true);
if (empty($ccpw_newsticker_speed)) {
echo '<select name="ccpw_newsticker_speed">';
for ($ccpw_i=10;  $ccpw_i <= 200; $ccpw_i++ ){ 
if ($ccpw_i % 10 == 0){
echo '<option value="'.$ccpw_i.'">'.$ccpw_i.'</option>';
}
}
echo '</select>';
} else {
echo '<select name="ccpw_newsticker_speed">';
for ($ccpw_i=10;  $ccpw_i <= 200; $ccpw_i++ ){ 
if ($ccpw_i % 10 == 0){
echo '<option value="'.$ccpw_i.'" '.((($ccpw_newsticker_speed == $ccpw_i)?"selected='selected'":'')).'>'.$ccpw_i.'</option>';
}
}
echo '</select>';
}

}

function ccpw_newspadding_from_top(){ 
$post_id = get_the_ID();
$ccpw_newspadding_from_top = get_post_meta( $post_id, 'ccpw_newspadding_from_top',true);
if (empty($ccpw_newspadding_from_top)) {
echo '<input type="text" name="ccpw_newspadding_from_top" id="ccpw_newspadding_from_top" value=""/>';	
} else {
echo '<input type="text" name="ccpw_newspadding_from_top" id="ccpw_newspadding_from_top" value="'.$ccpw_newspadding_from_top.'"/>';
}
}

function ccpw_newspadding_from_bottom(){ 
$post_id = get_the_ID();
$ccpw_newspadding_from_bottom = get_post_meta( $post_id, 'ccpw_newspadding_from_bottom',true);
if (empty($ccpw_newspadding_from_bottom)) {
echo '<input type="text" name="ccpw_newspadding_from_bottom" id="ccpw_newspadding_from_bottom" value=""/>';
} else {
echo '<input type="text" name="ccpw_newspadding_from_bottom" id="ccpw_newspadding_from_bottom" value="'.$ccpw_newspadding_from_bottom.'"/>';
}
}

function ccpw_newsbackground_color(){ 
$post_id = get_the_ID();
$ccpw_newsbackground_color = get_post_meta( $post_id, 'ccpw_newsbackground_color',true);
if (empty($ccpw_newsbackground_color)) {
echo '<input type="text" class="ccpw_newsbackground_color" name="ccpw_newsbackground_color" id="ccpw_newsbackground_color" value="#eee"/>';
} else {
echo '<input type="text" class="ccpw_newsbackground_color" name="ccpw_newsbackground_color" id="ccpw_newsbackground_color" value="'.$ccpw_newsbackground_color.'"/>';
}
}

function ccpw_newsfont_color(){ 
$post_id = get_the_ID();
$ccpw_newsfont_color = get_post_meta( $post_id, 'ccpw_newsfont_color',true);
if (empty($ccpw_newsfont_color)) {
echo '<input type="text" class="ccpw_newsfont_color" name="ccpw_newsfont_color" id="ccpw_newsfont_color" value="#000"/>';
} else {
echo '<input type="text" class="ccpw_newsfont_color" name="ccpw_newsfont_color" id="ccpw_newsfont_color" value="'.$ccpw_newsfont_color.'"/>';
}
}

function ccpw_news_border_style(){ 
$post_id = get_the_ID();
$ccpw_news_border_style = get_post_meta( $post_id, 'ccpw_news_border_style',true);
if(!empty($ccpw_news_border_style)){
echo '<input type="text" class="ccpw_news_border_style" name="ccpw_news_border_style" id="ccpw_news_border_style" value="'.$ccpw_news_border_style.'"/><div class="clear"></div>';	
}
else {
echo '<input type="text" class="ccpw_news_border_style" name="ccpw_news_border_style" id="ccpw_news_border_style" value="#000"/><div class="clear"></div>';	
}	
}



add_action( 'save_post_ccpw_newsticker_post', 'ccpw_news_meta_box_save', 10, 2 );
function ccpw_news_meta_box_save( $post_id )
{
	$ccpw_news_tiker_meta_box_text=$ccpw_news_ticker_type=$ccpw_newsticker_position=$ccpw_newsticker_speed=$ccpw_newspadding_from_top=$ccpw_newspadding_from_bottom=$ccpw_newsbackground_color=$ccpw_newsfont_color=$ccpw_news_custom_css=$ccpw_news_box_shadow=$ccpw_news_border_style=$ccpw_news_ticker_mobile_hide='';
	
	if (isset($_POST['ccpw_news_tiker_meta_box_text']) && $_POST['ccpw_news_tiker_meta_box_text'] != ''){$ccpw_tiker_meta_box_text = sanitize_text_field($_POST['ccpw_news_tiker_meta_box_text']);}
   update_post_meta( $post_id, 'ccpw_news_tiker_meta_box_text', $ccpw_news_tiker_meta_box_text);
	

   if (isset($_POST['ccpw_news_ticker_type']) && $_POST['ccpw_news_ticker_type'] != ''){
$ccpw_news_ticker_type = sanitize_text_field($_POST['ccpw_news_ticker_type']);}
   update_post_meta( $post_id, 'ccpw_news_ticker_type', $ccpw_news_ticker_type);
   
   if(isset($_POST['ccpw_news_ticker_mobile_hide']) && $_POST['ccpw_news_ticker_mobile_hide']){
   $ccpw_news_ticker_mobile_hide = sanitize_text_field($_POST['ccpw_news_ticker_mobile_hide']); }
   update_post_meta( $post_id, 'ccpw_news_ticker_mobile_hide', $ccpw_news_ticker_mobile_hide);
   
   if (isset($_POST['ccpw_newsticker_position']) && $_POST['ccpw_newsticker_position'] != ''){$ccpw_newsticker_position = sanitize_text_field($_POST['ccpw_newsticker_position']);}
   update_post_meta( $post_id, 'ccpw_newsticker_position', $ccpw_newsticker_position);


   if (isset($_POST['ccpw_newsticker_speed']) && $_POST['ccpw_newsticker_speed'] != ''){$ccpw_newsticker_speed = (int)$_POST['ccpw_newsticker_speed'];}
   update_post_meta( $post_id, 'ccpw_newsticker_speed', $ccpw_newsticker_speed);


   if (isset($_POST['ccpw_newspadding_from_top']) && $_POST['ccpw_newspadding_from_top'] != ''){$ccpw_newspadding_from_top = (int)$_POST['ccpw_newspadding_from_top']; }
   update_post_meta( $post_id, 'ccpw_newspadding_from_top', $ccpw_newspadding_from_top); 


   if (isset($_POST['ccpw_newspadding_from_bottom']) && $_POST['ccpw_newspadding_from_bottom'] != ''){$ccpw_newspadding_from_bottom = (int)$_POST['ccpw_newspadding_from_bottom']; }
   update_post_meta( $post_id, 'ccpw_newspadding_from_bottom', $ccpw_newspadding_from_bottom);


   if (isset($_POST['ccpw_newsbackground_color']) && $_POST['ccpw_newsbackground_color'] != ''){$ccpw_newsbackground_color = sanitize_text_field($_POST['ccpw_newsbackground_color']); }
   update_post_meta( $post_id, 'ccpw_newsbackground_color', $ccpw_newsbackground_color);


   if (isset($_POST['ccpw_newsfont_color']) && $_POST['ccpw_newsfont_color'] != ''){$ccpw_newsfont_color = sanitize_text_field($_POST['ccpw_newsfont_color']); }
   update_post_meta( $post_id, 'ccpw_newsfont_color', $ccpw_newsfont_color);
   
   if (isset($_POST['ccpw_news_border_style']) && $_POST['ccpw_news_border_style'] != ''){sanitize_text_field($ccpw_news_border_style = $_POST['ccpw_news_border_style']);}
   update_post_meta( $post_id, 'ccpw_news_border_style', $ccpw_news_border_style);
  
}


//Setting function for plugin
function ccpw_setting(){
	if(isset($_REQUEST['ccpw-setting-save'])){
	if(!empty($_POST['ccpw_crypto_api_key'])){
	echo '<div class="ccpw_error_top_msg notice notice-success is-dismissible"><p><strong>Settings saved.</strong></p></div>';
	update_option('ccpw_crypto_api_key', $_POST['ccpw_crypto_api_key']);
	} else {
	echo '<div class="ccpw_error_top_msg notice notice-error is-dismissible"><p><strong>Please enter the API Key.</strong></p></div>';
	}
	}
	$api_value ="";
	if(!empty(get_option('ccpw_crypto_api_key'))){
	$api_value = get_option('ccpw_crypto_api_key');
	$button_value = "Save Changes";
	} else {
	$button_value = "Save API Key";
	}
    echo '<div class="wrap" style="width:75%; float:left"><h1>API Key</h1>
    <p><a href="https://min-api.cryptocompare.com/documentation" target="_blank">Click here</a> to get the cryptocompare API key.</p>

    <form action="" method="post" class="ccpw_setting_form">
    <input type="password" name="ccpw_crypto_api_key" value="'.$api_value.'" class="ccpw_crypto_api_key">
	<input name="ccpw-setting-save" id="submit" class="ccpw_setting_submit button button-primary" value="'.$button_value.'" type="submit">
    </form>
    ';

}