<?php
function ccpw_currency_ticker_shortcode($atts,$content = null ){
// begin output buffering
    ob_start();	
global $wpdb;
$table_name = $wpdb->prefix . 'ccpw';
$atts = shortcode_atts(
		array(
			'id' => '',
		), $atts
	);
parse_str( str_replace('quot;', " ", $atts['id']), $array);
foreach ($array as $key => $value) {
$post_id = $key;
}
if ( 'publish' == get_post_status ( $post_id ) ) {
$ticker_hide_mobile = get_post_meta( $post_id, 'ccpw_ticker_hide_on_mobile',true );
if(!empty(get_post_meta( $post_id, 'ccpw_ticker-type' ))){
$ticker_types = get_post_meta( $post_id, 'ccpw_ticker-type' );
$ticker_type = "";
foreach ($ticker_types as $ticker_type_meta) {
	$ticker_type .= $ticker_type_meta;
}
}
if(!empty(get_post_meta( $post_id, 'ccpw_ticker_position' ))){
$positions = get_post_meta( $post_id, 'ccpw_ticker_position' );
$position = "";
foreach ($positions as $position_meta) {
	$position .= $position_meta;
}
}
if(!empty(get_post_meta( $post_id, 'ccpw_ticker_speed' ))){
$speeds = get_post_meta( $post_id, 'ccpw_ticker_speed' );
$ticker_speed = "";
foreach ($speeds as $speeds_meta) {
	$ticker_speed .= $speeds_meta;
}
}
if(!empty(get_post_meta( $post_id, 'ccpw_background_color' ))){
$background_colors = get_post_meta( $post_id, 'ccpw_background_color' );
$bg_color = "";
foreach ($background_colors as $background_color) {
	if(empty($background_color)){
	$bg_color .= "#eee;";	
	} else {
	$bg_color .= $background_color;
	}
}
}
if(!empty(get_post_meta( $post_id, 'ccpw_font_color' ))){
$ccpw_font_colors = get_post_meta( $post_id, 'ccpw_font_color' );
$fc_color = "";
foreach ($ccpw_font_colors as $ccpw_font_color) {
	if(empty($ccpw_font_color)){
	$fc_color .= "#000;";	
	} else {
	$fc_color .= $ccpw_font_color;
	}
}
}

if(!empty(get_post_meta( $post_id, 'ccpw_border_color' ))){
$ccpw_border_colors = get_post_meta( $post_id, 'ccpw_border_color' );
$bd_color = "";
foreach ($ccpw_border_colors as $ccpw_border_color) {
	if(empty($ccpw_border_color)){
	$bd_color .= "#000;";	
	} else {
	$bd_color .= $ccpw_border_color;
	}
}
}

if(!empty(get_post_meta( $post_id, 'ccpw_padding_from_top' ))){
$ccpw_padding_from_tops = get_post_meta( $post_id, 'ccpw_padding_from_top' );
$pd_top = "";
foreach ($ccpw_padding_from_tops as $ccpw_padding_top) {
	if(empty($ccpw_padding_top)){
	$pd_top .= '0px';	
	} else {
	$pd_top .= $ccpw_padding_top.'px';
	}
}
}

if(!empty(get_post_meta( $post_id, 'ccpw_padding_from_bottom' ))){
$ccpw_padding_from_bottoms = get_post_meta( $post_id, 'ccpw_padding_from_bottom' );
$pd_bottom = "";
foreach ($ccpw_padding_from_bottoms as $ccpw_padding_bottom) {
	if(empty($ccpw_padding_bottom)){
	$pd_bottom .= '0px';	
	} else {
	$pd_bottom .= $ccpw_padding_bottom.'px';
	}
}
}
if(!empty(get_post_meta( $post_id, 'ccpw_display_cry_logos' ))){
$ccpw_display_cry_logos = get_post_meta( $post_id, 'ccpw_display_cry_logos' );
$display_cry_logo = "";
foreach ($ccpw_display_cry_logos as $ccpw_display_cry_logo) {
	$display_cry_logo .= $ccpw_display_cry_logo;
}
}

if(!empty(get_post_meta( $post_id, 'ccpw_display_phy_logos' ))){
$ccpw_display_phy_logos = get_post_meta( $post_id, 'ccpw_display_phy_logos' );
$display_phy_logo = "";
foreach ($ccpw_display_phy_logos as $ccpw_display_phy_logo) {
	$display_phy_logo .= $ccpw_display_phy_logo;
}
}

if(!empty(get_post_meta( $post_id, 'ccpw_display_up_down' ))){
$ccpw_display_up_down = get_post_meta( $post_id, 'ccpw_display_up_down' );
$ccpw_display_ud = "";
foreach ($ccpw_display_up_down as $ccpw_display_up_downs) {
	$ccpw_display_ud .= $ccpw_display_up_downs;
}
}
$unserialize_currency = get_post_meta( $post_id, 'ccpw_display_phy_currencies',true );
$unserialize_currency1='';
if(empty($unserialize_currency)){
$unserialize_currency1 = "USD";
} else {
$unserialize_currency1 = $unserialize_currency;	
}

$ccpw_display_currencies = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true));
$unserialize_currency2 = '';
foreach ($ccpw_display_currencies as $ccpw_display_currencies_get) {
if ($unserialize_currency2 != ''){
$unserialize_currency2 .= ',';
}
$unserialize_currency2 .= $ccpw_display_currencies_get;
}
$ccpw_coinlist_url = 'pricemultifull?fsyms='.$unserialize_currency2.'&tsyms='.$unserialize_currency1.'';
$ccpw_request_response_array_set = ccpw_requests_get($ccpw_coinlist_url);
$data_all_currencies_raws_1 = json_decode($ccpw_request_response_array_set['response_body'], true);
if($position == "Header"){
echo "<style>#tickercontainer_".$post_id."{position:fixed;top:$pd_top;width:100%;background:$bg_color;left:0;z-index:99999; color:$fc_color;} #webTicker_".$post_id." li {border-right: 1px solid $bd_color;} </style>";
} elseif($position == "Footer"){
echo "<style>#tickercontainer_".$post_id."{position:fixed;bottom:$pd_bottom;width:100%;background:$bg_color;left:0;z-index:99999; color:$fc_color;} #webTicker_".$post_id." li {border-right: 1px solid $bd_color;}</style>";
} elseif($position == "Anywhere"){
echo "<style>#tickercontainer_".$post_id."{background:$bg_color; color:$fc_color; margin-bottom: 10px;} #webTicker_".$post_id." li {border-right: 1px solid $bd_color; }</style>";
}
if($ticker_type == "Ticker"){
$ticker_hide_mobile = get_post_meta( $post_id, 'ccpw_ticker_hide_on_mobile',true );	
if(!wp_is_mobile()){
	echo "<script>jQuery(document).ready(function(){
jQuery('#webTicker_".$post_id."').webTicker({
	speed:$ticker_speed,
	moving:true,
	height:'30px',
	 duplicate:true,
	 hoverpause:true,
	  startEmpty:false,
	});
});</script>";	
echo '<div id="tickercontainer_'.$post_id.'" class="tickercontainer">
    <div class="mask">';
echo "<ul id='webTicker_".$post_id."' class='ccpwwebticker'>";
foreach (reset($data_all_currencies_raws_1) as $data_all_currencies_raw) {
$name = $data_all_currencies_raw[$unserialize_currency1]["FROMSYMBOL"];

$price = number_format($data_all_currencies_raw[$unserialize_currency1]['PRICE'], 2);
$symbol = $data_all_currencies_raw[$unserialize_currency1]["FROMSYMBOL"];
$percent_change_24h_price = number_format($data_all_currencies_raw[$unserialize_currency1]["CHANGE24HOUR"], 5) - 0 . '%';
$percent_change_24h = number_format($data_all_currencies_raw[$unserialize_currency1]["CHANGE24HOUR"], 5) - 0;
$change_sign_minus = "-";
if ( strpos( $percent_change_24h, $change_sign_minus ) !==false) {
$change_sign = '<img align="absmiddle" width="22" height="22" class="ccpw_down_img ccpw_img_none" src="'.ccpw_url.'images/arrow-down.png"/>';
$change_class = "down";
} else {
$change_sign = '<img align="absmiddle" width="22" height="22" class="ccpw_up_img ccpw_img_none" src="'.ccpw_url.'images/arrow-up.png"/>';
$change_class = "up";
}
if($display_phy_logo=="on" && $display_cry_logo=="on"){
$check_coins = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true ));
if(in_array($symbol, $check_coins)){
echo '<li class="'.$change_class.'"><p><img align="absmiddle" width="22" height="22" class="ccpw_img_none" src="'.ccpw_url.'images/crypto-currencies-icons/'.$symbol.'.png"/>'.$symbol.'</p><p><img align="absmiddle" width="22" height="22" class="ccpw_img_none" src="'.ccpw_url.'images/physical-currencies-icons/'.$unserialize_currency1.'.png"/> '.$price.'</p>';
if($ccpw_display_ud=="on"){
echo ''.$change_sign.'<span class="ccpw_price_pertge">'.$percent_change_24h_price.'</span>';
} 
echo '</li>';
}

} elseif($display_cry_logo=="on" && $display_phy_logo==""){
$check_coins = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true ));
if(in_array($symbol, $check_coins)){
echo '<li class="'.$change_class.'"><p><img align="absmiddle" width="22" height="22" class="ccpw_img_none" src="'.ccpw_url.'images/crypto-currencies-icons/'.$symbol.'.png"/>'.$symbol.'</p><p>('.$unserialize_currency1.' '.$price.')</p>';
if($ccpw_display_ud=="on"){
echo ''.$change_sign.'<span class="ccpw_price_pertge">'.$percent_change_24h_price.'</span>';
}
echo '</li>';
}

} elseif($display_cry_logo=="" && $display_phy_logo=="on"){
$check_coins = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true ));
if(in_array($symbol, $check_coins)){
echo '<li class="'.$change_class.'"><p>'.$symbol.'</p><p><img align="absmiddle" width="22" height="22" class="ccpw_img_none" src="'.ccpw_url.'images/physical-currencies-icons/'.$unserialize_currency1.'.png"/> '.$price.'</p>';
if($ccpw_display_ud=="on"){
echo ''.$change_sign.'<span class="ccpw_price_pertge">'.$percent_change_24h_price.'</span>';
} 
echo '</li>';
}

} else {
$check_coins = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true ));
if(in_array($symbol, $check_coins)){
echo '<li class="'.$change_class.'"><p><span>'.$symbol.'</span><span>('.$unserialize_currency1.' '.$price.')</span>   </p>';
if($ccpw_display_ud=="on"){
echo ''.$change_sign.'<span class="ccpw_price_pertge">'.$percent_change_24h_price.'</span>';
} 
echo '</li>';
}

} 
}


echo "</ul></div></div>";
}
else{
if($ticker_hide_mobile!='on'){
	echo "<script>jQuery(document).ready(function(){
jQuery('#webTicker_".$post_id."').webTicker({
	speed:$ticker_speed,
	moving:true,
	height:'30px',
	 duplicate:true,
	 hoverpause:true,
	  startEmpty:false,
	});
});</script>";	
echo '<div id="tickercontainer_'.$post_id.'" class="tickercontainer">
    <div class="mask">';
echo "<ul id='webTicker_".$post_id."' class='ccpwwebticker'>";
foreach (reset($data_all_currencies_raws_1) as $data_all_currencies_raw) {
$name = $data_all_currencies_raw[$unserialize_currency1]["FROMSYMBOL"];

$price = number_format($data_all_currencies_raw[$unserialize_currency1]['PRICE'], 2);
$symbol = $data_all_currencies_raw[$unserialize_currency1]["FROMSYMBOL"];
$percent_change_24h_price = number_format($data_all_currencies_raw[$unserialize_currency1]["CHANGE24HOUR"], 5) - 0 . '%';
$percent_change_24h = number_format($data_all_currencies_raw[$unserialize_currency1]["CHANGE24HOUR"], 5) - 0;
$change_sign_minus = "-";
if ( strpos( $percent_change_24h, $change_sign_minus ) !==false) {
$change_sign = '<img align="absmiddle" width="22" height="22" class="ccpw_down_img ccpw_img_none" src="'.ccpw_url.'images/arrow-down.png"/>';
$change_class = "down";
} else {
$change_sign = '<img align="absmiddle" width="22" height="22" class="ccpw_up_img ccpw_img_none" src="'.ccpw_url.'images/arrow-up.png"/>';
$change_class = "up";
}
if($display_phy_logo=="on" && $display_cry_logo=="on"){
$check_coins = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true ));
if(in_array($symbol, $check_coins)){
echo '<li class="'.$change_class.'"><p><img align="absmiddle" width="22" height="22" class="ccpw_img_none" src="'.ccpw_url.'images/crypto-currencies-icons/'.$symbol.'.png"/>'.$symbol.'</p><p><img align="absmiddle" width="22" height="22" class="ccpw_img_none" src="'.ccpw_url.'images/physical-currencies-icons/'.$unserialize_currency1.'.png"/> '.$price.'</p>';
if($ccpw_display_ud=="on"){
echo ''.$change_sign.'<span class="ccpw_price_pertge">'.$percent_change_24h_price.'</span>';
} 
echo '</li>';
}

} elseif($display_cry_logo=="on" && $display_phy_logo==""){
$check_coins = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true ));
if(in_array($symbol, $check_coins)){
echo '<li class="'.$change_class.'"><p><img align="absmiddle" width="22" height="22" class="ccpw_img_none" src="'.ccpw_url.'images/crypto-currencies-icons/'.$symbol.'.png"/>'.$symbol.'</p><p>('.$unserialize_currency1.' '.$price.')</p>';
if($ccpw_display_ud=="on"){
echo ''.$change_sign.'<span class="ccpw_price_pertge">'.$percent_change_24h_price.'</span>';
}
echo '</li>';
}

} elseif($display_cry_logo=="" && $display_phy_logo=="on"){
$check_coins = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true ));
if(in_array($symbol, $check_coins)){
echo '<li class="'.$change_class.'"><p>'.$symbol.'</p><p><img align="absmiddle" width="22" height="22" class="ccpw_img_none" src="'.ccpw_url.'images/physical-currencies-icons/'.$unserialize_currency1.'.png"/> '.$price.'</p>';
if($ccpw_display_ud=="on"){
echo ''.$change_sign.'<span class="ccpw_price_pertge">'.$percent_change_24h_price.'</span>';
} 
echo '</li>';
}
} else {
$check_coins = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true ));
if(in_array($symbol, $check_coins)){
echo '<li class="'.$change_class.'"><p><span>'.$symbol.'</span><span>('.$unserialize_currency1.' '.$price.')</span>   </p>';
if($ccpw_display_ud=="on"){
echo ''.$change_sign.'<span class="ccpw_price_pertge">'.$percent_change_24h_price.'</span>';
} 
echo '</li>';
}
} 
}
echo "</ul></div></div>";
}
}
} elseif($ticker_type == "list-widget"){
echo "<style> body .ccpw-widget_".$post_id." {border: 1px solid $bd_color; background-color: $bg_color;color: $fc_color;} body .ccpw-widget_".$post_id." table{color: $fc_color;} body .ccpw-widget_".$post_id." table td, body .ccpw-widget_".$post_id." table th{border: 1px solid $bd_color;}  </style>";
echo '<div id="ccpw-list-widget" class="ccpw-widget ccpw-widget_'.$post_id.'">
<table class="ccpw_table" style="border:none!important;">
<thead>
<tr>';
echo '<th>Crypto Currency</th>';
$ccpw_cfn = get_option('ccpw_display_phy_cfn');
$ccpw_cfn_exp = explode("~", $ccpw_cfn);
if(in_array($unserialize_currency1, $ccpw_cfn_exp)){
echo '<th>Price ('.$ccpw_cfn_exp[1].')</th>';	
} else {
echo '<th>Price</th>';		
}
if($ccpw_display_ud=="on"){
echo '<th>24H % Change</th>';
}
echo '</tr>
</thead>
<tbody>';
foreach (reset($data_all_currencies_raws_1) as $data_all_currencies_raw) {
$name = $data_all_currencies_raw[$unserialize_currency1]["FROMSYMBOL"];

$price = number_format($data_all_currencies_raw[$unserialize_currency1]['PRICE'], 2);
$symbol = $data_all_currencies_raw[$unserialize_currency1]["FROMSYMBOL"];
$percent_change_24h_price = number_format($data_all_currencies_raw[$unserialize_currency1]["CHANGE24HOUR"], 5) - 0 . '%';
$percent_change_24h = number_format($data_all_currencies_raw[$unserialize_currency1]["CHANGE24HOUR"], 5) - 0;
$change_sign_minus = "-";
if ( strpos( $percent_change_24h, $change_sign_minus ) !==false) {
$change_sign = '<img align="absmiddle" width="22" height="22" class="ccpw_down_img ccpw_img_none" src="'.ccpw_url.'images/arrow-down.png"/>';
$change_class = "down";
} else {
$change_sign = '<img align="absmiddle" width="22" height="22" class="ccpw_up_img ccpw_img_none" src="'.ccpw_url.'images/arrow-up.png"/>';
$change_class = "up";
}
if($display_phy_logo=="on" && $display_cry_logo=="on"){
$check_coins = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true ));
if(in_array($symbol, $check_coins)){
echo '<tr class="'.$change_class.'">
<td>
<div class="ccpw_coin_info">
<span class="name"><img align="absmiddle" width="22" height="22" class="ccpw_img_none" src="'.ccpw_url.'images/crypto-currencies-icons/'.$symbol.'.png"/>  '.$symbol.'</span>
</div>
</td>
<td>
<img align="absmiddle" width="22" height="22" class="ccpw_img_none" src="'.ccpw_url.'images/physical-currencies-icons/'.$unserialize_currency1.'.png"/> '.$price;
echo '</td>';
if($ccpw_display_ud=="on"){
echo '<td>'.$change_sign.'<span class="ccpw_price_pertge">'.$percent_change_24h_price.'</span></td>';
}
echo '</tr>';
}
} elseif($display_cry_logo=="on" && $display_phy_logo==""){
$check_coins = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true ));
if(in_array($symbol, $check_coins)){
echo '<tr class="'.$change_class.'">
<td>
<div class="ccpw_coin_info">
<span class="name"><img align="absmiddle" width="22" height="22" class="ccpw_img_none" src="'.ccpw_url.'images/crypto-currencies-icons/'.$symbol.'.png"/>  '.$symbol.'</span>
</div>
</td>
<td>'.$unserialize_currency1.' '.$price;
echo '</td>';
if($ccpw_display_ud=="on"){
echo '<td>'.$change_sign.'<span class="ccpw_price_pertge">'.$percent_change_24h_price.'</span></td>';
} 
echo '</tr>';
}
	
} elseif($display_cry_logo=="" && $display_phy_logo=="on"){
$check_coins = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true ));
if(in_array($symbol, $check_coins)){
echo '<tr class="'.$change_class.'">
<td>
<div class="ccpw_coin_info">
<span class="name">'.$symbol.'</span>
</div>
</td>
<td>
<img align="absmiddle" width="22" height="22" class="ccpw_img_none" src="'.ccpw_url.'images/physical-currencies-icons/'.$unserialize_currency1.'.png"/>'.$price;
echo '</td>';
if($ccpw_display_ud=="on"){
echo '<td>'.$change_sign.'<span class="ccpw_price_pertge">'.$percent_change_24h_price.'</span></td>';
} 
echo '</tr>';
}

} else {
$check_coins = unserialize(get_post_meta( $post_id, 'ccpw_display_currencies', true ));
$ccpw_cfn = get_option('ccpw_display_phy_cfn');
$ccpw_cfn_exp = explode("~", $ccpw_cfn);
if(in_array($symbol, $check_coins)){
echo '<tr class="'.$change_class.'">
<td>
<div class="ccpw_coin_info">
<span class="name">'.$symbol.'</span>
</div>
</td>
<td>';
if(in_array($unserialize_currency1, $ccpw_cfn_exp)){
echo $unserialize_currency1.' '.$price;
}
echo '</td>';
if($ccpw_display_ud=="on"){
echo '<td>'.$change_sign.'<span class="ccpw_price_pertge">'.$percent_change_24h_price.'</span></td>';
} else {

} 
echo '</tr>';
}

} 
}
echo '</tbody>
</table>
</div>';
}
// end output buffering, grab the buffer contents, and empty the buffer
    return ob_get_clean(); 
}
}

add_action( 'wp_footer', 'ticker_in_footer');
function ticker_in_footer(){
$my_query = query_posts(array('post_type'=> 'ccpw_ticker_post', 'post_status' => 'publish','meta_query' => array(
		array('key' => 'ccpw_ticker_position','value' => array('Header','Footer'),'compare' => 'IN')
)));	
while (have_posts()): the_post();
$post_id = get_the_ID();
$ticker_types = get_post_meta( $post_id, 'ccpw_ticker-type' );
if(!empty($ticker_types)){
$ticker_type = "";
foreach ($ticker_types as $ticker_type_meta) {
	$ticker_type .= $ticker_type_meta;
}
$ccpw_tiker_meta_box_text = get_post_meta( $post_id, 'ccpw_tiker_meta_box_text' );
$ccpw_tiker_code = "";
foreach ($ccpw_tiker_meta_box_text as $ccpw_tiker_meta_box_text_meta) {
	$ccpw_tiker_code .= $ccpw_tiker_meta_box_text_meta;
}
$positions = get_post_meta( $post_id, 'ccpw_ticker_position' );
$ticker_hide_mobile = get_post_meta( $post_id, 'ccpw_ticker_hide_on_mobile',true );

$position = "";
foreach ($positions as $position_meta) {
	$position .= $position_meta;
}
if($post_id){
if($ticker_type=="Ticker"){
if($position=="Header"||$position=="Footer"){
	if(!wp_is_mobile() ){
	echo do_shortcode($ccpw_tiker_code);
	}else{
		if($ticker_hide_mobile!='no'){
			echo do_shortcode($ccpw_tiker_code);
		}
	}
}
}
}	
}
endwhile;
}
