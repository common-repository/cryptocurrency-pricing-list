<?php
function ccpw_currency_calculator_shortcode($atts,$content = null ){
// begin output buffering
    ob_start();	
global $wpdb;
$table_name = $wpdb->prefix . 'ccpw';
$ccpw_data_delete_coin = get_option('ccpw_data_delete_coin');	
$unserialize_ccpw_crypto_currency_compare =  unserialize(get_option('ccpw_crypto_currency_compare'));
$unserialize_ccpw_physical_currency_compare =  unserialize(get_option('ccpw_physical_currency_compare'));
if(empty($unserialize_ccpw_crypto_currency_compare) || empty($unserialize_ccpw_physical_currency_compare)){
echo '<div class="ccpw_cryptocurrency_not_select">Please choose atleast one Cryptocurrency & One Physical Currency.</div>';	
} else {
$combined_array = array_merge($unserialize_ccpw_crypto_currency_compare , $unserialize_ccpw_physical_currency_compare);
$ccpw_switcher = "";
if(!empty($_POST["ccpw_coin_switcher"])){
$ccpw_switcher = $_POST["ccpw_coin_switcher"];
}

foreach ($unserialize_ccpw_crypto_currency_compare as $unserialize_coin) {
$ccpw_check_coins = $wpdb->get_results("SELECT * FROM $table_name WHERE coin_name = '$unserialize_coin'",ARRAY_A);
$ccpw_totalcoin = count($ccpw_check_coins);
}
if(!empty($ccpw_totalcoin)){
echo '<form id="ccpw_btc_calc" class="cp-form" action="" method="post">
<input name="coin_number" class="ccpw_crypto_currency_comparevalue" value="'.(((empty($_POST['coin_number'])))?"1" :$_POST['coin_number']).'" type="text">
<br>
<select name="ccpw_coin_switcher" class="ccpw_coin_switcher">';
foreach ($unserialize_ccpw_crypto_currency_compare as $unserialize_coin) {
echo '<option '.((($ccpw_switcher == $unserialize_coin)?"selected":'')).' value="'.$unserialize_coin.'">'.$unserialize_coin.'</option>';
}
echo '</select><input type="hidden" name="ccpw_option_number" class="ccpw_option_number" value="0"><br><br><input type="submit" value="Calculate" name="submit_calculator"> 
</form>';
} else {
echo '<div class="ccpw_cryptocurrency_not_select">Please choose atleast one Cryptocurrency.</div>';	
}
}
if(isset($_REQUEST['submit_calculator'])){
if(abs($_POST['coin_number'])){
$coin_number = abs($_POST['coin_number']);
$data_url_currency_1 =  trim(mb_strtoupper($_POST['ccpw_coin_switcher']));
$data_url_currency_2 = '';
foreach ($combined_array as $data_ccpw_physical_currency_compare) {
if ($data_url_currency_2 != ''){
$data_url_currency_2 .= ',';
}
$data_url_currency_2 .= trim(mb_strtoupper($data_ccpw_physical_currency_compare));
}
$ccpw_coinlist_url = 'price?fsym='.$data_url_currency_1.'&tsyms='.$data_url_currency_2;
$ccpw_request_response_array_set = ccpw_requests_get($ccpw_coinlist_url);
$data_all_currencies_raw = json_decode($ccpw_request_response_array_set['response_body'], true);
if(!empty($data_all_currencies_raw)){
echo '<br><table class="cp-table cp-prices-table"><tbody>';
$check_coins_default = $wpdb->get_results("SELECT coin_img FROM $table_name WHERE coin_name = '".$_POST['ccpw_coin_switcher']."'");
$ccpw_color_img = $check_coins_default[0]->coin_img;
$ccpw_color_img_new = "";
foreach ($data_all_currencies_raw as $key => $data_all_currencies_raw2) {
$check_coins = $wpdb->get_results("SELECT coin_img FROM $table_name WHERE coin_name = '$key'");
@$ccpw_color_img_new =  $check_coins[0]->coin_img;
echo '<tr>
<td>
<img align="absmiddle" width="22" height="22" src="'.$ccpw_color_img.'"> &nbsp;
'.$coin_number.' '.$data_url_currency_1.'   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= 
</td>
<td>';
$var_img_exist = ccpw_url."/images/physical-currencies-icons/".$key.".png";
$headers = get_headers($var_img_exist);
if($headers[0] == "HTTP/1.1 200 OK"){
echo '<img align="absmiddle" width="22" height="22" src="'.ccpw_url.'images/physical-currencies-icons/'.$key.'.png"> &nbsp;';
} else {
echo '<img class="img_none" src="'.$ccpw_color_img_new.'" width="22" height="22" align="absmiddle"> &nbsp;';	
}
echo $coin_number*$data_all_currencies_raw2; echo " "; echo $key;
echo '</td></tr>';
}
echo "</tbody></table>";
} else {
//	echo $unserialize_ccpw_crypto_currency_compare;
$no_data_array = array($data_url_currency_1);
$combined_array = array_merge($no_data_array , $unserialize_ccpw_physical_currency_compare);
$check_coins_default = $wpdb->get_results("SELECT coin_img FROM $table_name WHERE coin_name = '".$_POST['ccpw_coin_switcher']."'");
$ccpw_color_img = $check_coins_default[0]->coin_img;
echo '<br><table class="cp-table cp-prices-table"><tbody>';
$ccpw_color_img_new = "";
foreach ($combined_array as $key => $data_all_currencies_raw2) {
$check_coins = $wpdb->get_results("SELECT coin_img FROM $table_name WHERE coin_name = '$key'");
@$ccpw_color_img_new =  $check_coins[0]->coin_img;
echo '<tr>
<td>
<img align="absmiddle" width="22" height="22" src="'.$ccpw_color_img.'"> &nbsp;
'.$coin_number.' '.$data_url_currency_1.'   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;= 
</td>
<td>';
$var_img_exist = ccpw_url."/images/physical-currencies-icons/".$data_all_currencies_raw2.".png";
$headers = get_headers($var_img_exist);
if($headers[0] == "HTTP/1.1 200 OK"){
echo '<img align="absmiddle" width="22" height="22" src="'.ccpw_url.'images/physical-currencies-icons/'.$data_all_currencies_raw2.'.png"> &nbsp;';
echo '<span class="ccpw_nocal_data">Data not avaliable</span>';
} else {
echo '<img class="img_none" src="'.$ccpw_color_img.'" width="22" height="22" align="absmiddle"> &nbsp;';	
echo $coin_number; echo " "; echo $data_all_currencies_raw2;
}
//echo $coin_number; echo " "; echo $data_all_currencies_raw2;
echo '</td></tr>';
}
echo "</tbody></table>";
//echo '<div class="ccpw_error_msg_show">Data not avaliable</div>';
}
} else {
echo '<div class="ccpw_error_msg_show">Please enter integer value.</div>';
}
}
// end output buffering, grab the buffer contents, and empty the buffer
    return ob_get_clean(); 

}