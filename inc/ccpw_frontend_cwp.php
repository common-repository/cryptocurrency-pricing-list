<?php
function ccpw_currencies_with_price_shortcode($atts){
global $wpdb;
$table_name = $wpdb->prefix . 'ccpw';
$get_total_count = $wpdb->get_results("SELECT coin_name FROM $table_name");
$html = '';
if(isset($_GET['ccpw_setpage'])) {
$ccpw_setpage = $_GET['ccpw_setpage'];
}
if(!empty($_GET['ccpw_setpage']) && $_GET['ccpw_setpage']==2){$ccpw_setpage = ($_GET['ccpw_setpage']-1)+30;$maxlimit=$_GET['ccpw_setpage']*30;}
elseif(!empty($_GET['ccpw_setpage'])&& $_GET['ccpw_setpage']>=3){
	$ccpw_setpage = ($_GET['ccpw_setpage']-1)*30+1;$maxlimit=$_GET['ccpw_setpage']*30;
} else{$ccpw_setpage = 0;$maxlimit=30;}
for ($i=$ccpw_setpage;  $i <= $maxlimit; $i++ ){
$unserialize_ccpw_cryptocompare_list_1 = $wpdb->get_results("SELECT coin_name FROM $table_name LIMIT 30 OFFSET $ccpw_setpage");
$unserialize_ccpw_cryptocompare_list_ex = array();
foreach ($unserialize_ccpw_cryptocompare_list_1 as $unserialize_ccpw_cryptocompare_list_2) { 
$unserialize_ccpw_cryptocompare_list_ex[] = $unserialize_ccpw_cryptocompare_list_2->coin_name.',';
}
if(empty($_GET['select_option'])){
$data_url_currency_1 =  'USD';
} else {
$data_url_currency_1 =  $_GET['select_option'];	
}
$data_url_currency_2 = '';
foreach ($unserialize_ccpw_cryptocompare_list_ex as $data_ccpw_cryptocompare_list) {
$data_url_currency_2 .= $data_ccpw_cryptocompare_list;
}
$ccpw_coinlist_url = 'pricemulti?fsyms='.$data_url_currency_2.'&tsyms='.$data_url_currency_1;
$ccpw_request_response_array_set = ccpw_requests_get($ccpw_coinlist_url);
$data_all_currencies_raw = json_decode($ccpw_request_response_array_set['response_body'], true);
$html .= '<div class="ccpw_all_currency_list_table">';	
$html .= '<table class="ccpw_cp-table cp-cryptocurrencies-table">';	
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>'.__('Coin', 'CCPW').'</th>';
$html .= '<th>'.__('Amount', 'CCPW').'</th>';
$html .= '<th>'.__('=', 'CCPW').'</th>';
$html .= '<th><form action="" method="GET">';
if(isset($_GET['ccpw_setpage'])){
$html .= '<input type="hidden" name="ccpw_setpage" value="'.$_GET['ccpw_setpage'].'">';
}
$html .= '<select name="select_option" id="myselect" onchange="this.form.submit()">
<option '.((($data_url_currency_1 == "USD")?"selected":'')).' value="USD">USD</option>
<option '.((($data_url_currency_1 == "AUD")?"selected":'')).' value="AUD">AUD</option>
<option '.((($data_url_currency_1 == "CAD")?"selected":'')).' value="CAD">CAD</option>
<option '.((($data_url_currency_1 == "EUR")?"selected":'')).' value="EUR">EUR</option>
<option '.((($data_url_currency_1 == "GBP")?"selected":'')).' value="GBP">GBP</option>
</select></form></th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
$ccpw_color_img_new = "";
foreach ($data_all_currencies_raw as $key => $ccpw_coinlist_currency){
$check_coins = $wpdb->get_results("SELECT coin_img FROM $table_name WHERE coin_name = '$key'");
$ccpw_color_img_new =  $check_coins[0]->coin_img;
foreach ($ccpw_coinlist_currency as $ccpw_coinlist_currencys) {
$html .=  '<tr>';
if($ccpw_color_img_new == "images/none.png"){
$html .=  '<td><img align="absmiddle" width="20" height="20" src="'.ccpw_url.'images/none.png" /> &nbsp;'.htmlspecialchars($key).'</td>';
} else {
$html .=  '<td><img align="absmiddle" width="20" height="20" src="'.$ccpw_color_img_new.'" alt="'.htmlspecialchars($ccpw_color_img_new).'" /> &nbsp;'.htmlspecialchars($key).'</td>'; 
}
$html .='<td class="text-center">1</td>';
$html .='<td>=</td>';
$html .=  '<td><img align="absmiddle" width="20" height="20" src="'.ccpw_url.'images/physical-currencies-icons/'.$data_url_currency_1.'.png" /> &nbsp;'.htmlspecialchars($ccpw_coinlist_currencys).'</td>';   
$html .=  '</tr>';
} }
$html .= '</tbody></table>';
if(count($get_total_count) > 30){
if(empty($_GET['ccpw_setpage']) || $_GET['ccpw_setpage'] == 1){
	$html .= '<div class="ccpw_custom-pagination"> 
	<a class="button button-primary ccpw_next-btn" href="?ccpw_setpage=2&select_option='.$data_url_currency_1.'">Next Page </a>
	</div>';
	} else {
	$prev_page = $_GET['ccpw_setpage']-1;
	$next_page = $_GET['ccpw_setpage']+1; 
	  $html .= '<div class="ccpw_custom-pagination">'; 
	if($maxlimit > count($get_total_count)){
	$html .= '<a class="button button-primary ccpw_prev-btn" href="?ccpw_setpage='.$prev_page.'&select_option='.$data_url_currency_1.'">Prev Page </a>';	
	} else {
	 $html .= '<a class="button button-primary ccpw_prev-btn" href="?ccpw_setpage='.$prev_page.'&select_option='.$data_url_currency_1.'">Prev Page </a>';
	$html .= '<a class="button button-primary ccpw_next-btn" href="?ccpw_setpage='.$next_page.'&select_option='.$data_url_currency_1.'">Next Page </a>';
	}
	$html .= '</div></div>';
	}
}
return $html;
}

}