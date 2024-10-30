<?php
function ccpw_all_currencies_shortcode($atts){
	global $wpdb;
	$ccpw_table_name = $wpdb->prefix . 'ccpw';
	$atts = shortcode_atts(
		array(
			'pagination' => '',
			'coinlist' => '',
		), $atts
	);
// Coin List
	$html = '';
	// Coin List if pagination true & type all
	if($atts['pagination'] == "true" && $atts['coinlist'] == "all"){

	$ccpw_coinlist_url = 'all/coinlist';
	$ccpw_request_response_array_set = ccpw_requests_get($ccpw_coinlist_url);
	$ccpw_coinlist_all_currencies_raw = json_decode($ccpw_request_response_array_set['response_body'], true);
	$ccpw_imagebaseurl = $ccpw_coinlist_all_currencies_raw['BaseImageUrl'];
	$ccpw_coinlist_all_currencies = $ccpw_coinlist_all_currencies_raw['Data'];
	//sort currencies by order
    usort($ccpw_coinlist_all_currencies, 'ccpw_sortByOrder');	
    $html .= '<div class="ccpw_loader_img"><img src="'.ccpw_url.'images/loader.gif"></div>';
	$html .= '<div class="ccpw_all_currency_list_table">';	
	$html .= '<table class="ccpw_cp-table cp-cryptocurrencies-table">';	
	$html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>'.__('Coin', 'CCPW').'</th>';
    $html .= '<th>'.__('Algorithm', 'CCPW').'</th>';
    $html .= '<th>'.__('Proof type', 'CCPW').'</th>';
    $html .= '<th>'.__('Total supply', 'CCPW').'</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
	if(isset($_GET['ccpw_setpage'])) {
	$ccpw_setpage = $_GET['ccpw_setpage'];
	}
	if(!empty($_GET['ccpw_setpage']) && $_GET['ccpw_setpage']==2){$ccpw_setpage = ($_GET['ccpw_setpage']-1)+30;$maxlimit=$_GET['ccpw_setpage']*30;}
	elseif(!empty($_GET['ccpw_setpage'])&& $_GET['ccpw_setpage']>=3){
		$ccpw_setpage = ($_GET['ccpw_setpage']-1)*30+1;$maxlimit=$_GET['ccpw_setpage']*30;
	} else{$ccpw_setpage = 0;$maxlimit=30;}
	for ($i=$ccpw_setpage;  $i <= $maxlimit; $i++ ){
	if(empty($ccpw_coinlist_all_currencies[$i]["FullName"])){} else {
	if($atts['coinlist'] == "all"){
	if ( isset($ccpw_coinlist_all_currencies[$i]['TotalCoinSupply']) && $ccpw_coinlist_all_currencies[$i]['TotalCoinSupply']!= 0 ){
    $total_supply = htmlspecialchars($ccpw_coinlist_all_currencies[$i]['TotalCoinSupply']);
    } else {
        $total_supply = '-';
	}
	if (isset($ccpw_coinlist_all_currencies[$i]["ImageUrl"])) {
	$ccpw_get_ImageUrl = $ccpw_imagebaseurl.$ccpw_coinlist_all_currencies[$i]["ImageUrl"];
	}
	$html .=  '<tr>';
	$html .=  '<td><img align="absmiddle" width="20" height="20" src="'.$ccpw_get_ImageUrl.'" alt="'.htmlspecialchars($ccpw_coinlist_all_currencies[$i]['FullName']).'" />&nbsp;&nbsp;&nbsp;'.htmlspecialchars($ccpw_coinlist_all_currencies[$i]['FullName']).'</td>'; 
       $html .='<td>'.htmlspecialchars($ccpw_coinlist_all_currencies[$i]['Algorithm']).'</td>';
       $html .='<td>'.htmlspecialchars($ccpw_coinlist_all_currencies[$i]['ProofType']).'</td>';    
        $html .=  '<td>'.$total_supply.'</td>';   
	$html .=  '</tr>';
	} 
	}
	}
	$html .= '</tbody></table>';
	if(empty($_GET['ccpw_setpage']) || $_GET['ccpw_setpage'] == 1){
	$html .= '<div class="ccpw_custom-pagination"> 
	<a class="button button-primary ccpw_next-btn" href="?ccpw_setpage=2">Next Page </a>
	</div>';
	} else {
	$prev_page = $_GET['ccpw_setpage']-1;
	$next_page = $_GET['ccpw_setpage']+1; 
	  $html .= '<div class="ccpw_custom-pagination">'; 
	if($maxlimit > count($ccpw_coinlist_all_currencies)){
	$html .= '<a class="button button-primary ccpw_prev-btn" href="?ccpw_setpage='.$prev_page.'">Prev Page </a>';	
	} else {
	 $html .= '<a class="button button-primary ccpw_prev-btn" href="?ccpw_setpage='.$prev_page.'">Prev Page </a>';
	$html .= '<a class="button button-primary ccpw_next-btn" href="?ccpw_setpage='.$next_page.'">Next Page </a>';
	}
	$html .= '</div>';
	}
	$html .= '</div>';
	} elseif(empty($atts['pagination']) && $atts['coinlist'] == "all"){

	$ccpw_coinlist_url = 'all/coinlist';
	$ccpw_request_response_array_set = ccpw_requests_get($ccpw_coinlist_url);
	$ccpw_coinlist_all_currencies_raw = json_decode($ccpw_request_response_array_set['response_body'], true);	
	$ccpw_imagebaseurl = $ccpw_coinlist_all_currencies_raw['BaseImageUrl'];
	$ccpw_coinlist_all_currencies = $ccpw_coinlist_all_currencies_raw['Data'];
	//sort currencies by order
    usort($ccpw_coinlist_all_currencies, 'ccpw_sortByOrder');	
	// Coin List if pagination empty & type all
	$html .= '<div class="ccpw_loader_img"><img src="'.ccpw_url.'images/loader.gif"></div>';
	$html .= '<div class="ccpw_all_currency_list_table">';	
	$html .= '<table class="ccpw_cp-table cp-cryptocurrencies-table">';	
	$html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>'.__('Coin', 'CCPW').'</th>';
    $html .= '<th>'.__('Algorithm', 'CCPW').'</th>';
    $html .= '<th>'.__('Proof type', 'CCPW').'</th>';
    $html .= '<th>'.__('Total supply', 'CCPW').'</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    foreach ($ccpw_coinlist_all_currencies as $ccpw_coinlist_currency){
	if ( isset($ccpw_coinlist_currency['TotalCoinSupply']) && $ccpw_coinlist_currency['TotalCoinSupply']!= 0 ){
    $total_supply = htmlspecialchars($ccpw_coinlist_currency['TotalCoinSupply']);
    } else {
        $total_supply = '-';
	}
	if (isset($ccpw_coinlist_currency["ImageUrl"])) {
	$ccpw_get_ImageUrl = $ccpw_imagebaseurl.$ccpw_coinlist_currency["ImageUrl"];
	}
	$html .=  '<tr>';
	$html .=  '<td><img align="absmiddle" width="20" height="20" src="'.$ccpw_get_ImageUrl.'" alt="'.htmlspecialchars($ccpw_coinlist_currency['FullName']).'" />&nbsp;&nbsp;&nbsp;'.htmlspecialchars($ccpw_coinlist_currency['FullName']).'</td>'; 
       $html .='<td>'.htmlspecialchars($ccpw_coinlist_currency['Algorithm']).'</td>';
       $html .='<td>'.htmlspecialchars($ccpw_coinlist_currency['ProofType']).'</td>';    
        $html .=  '<td>'.$total_supply.'</td>';   
	$html .=  '</tr>';
	}
	$html .= '</tbody></table>';	
	} elseif(empty($atts['pagination']) && $atts['coinlist'] == "checked") {
	// Coin List if pagination empty & type checked
	$ccpw_coinlists = $wpdb->get_results("SELECT * FROM $ccpw_table_name",ARRAY_A);
	if(!empty($ccpw_coinlists)){
	$html .= '<div class="ccpw_all_currency_list_table">';	
	$html .= '<table class="ccpw_cp-table cp-cryptocurrencies-table">';	
	$html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>'.__('Coin', 'ccpw').'</th>';
    $html .= '<th>'.__('Algorithm', 'ccpw').'</th>';
    $html .= '<th>'.__('Proof type', 'ccpw').'</th>';
    $html .= '<th>'.__('Total supply', 'ccpw').'</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
	foreach ($ccpw_coinlists as $ccpw_coindetail){
		if ($ccpw_coindetail['coin_supply']!= 0 ){$ccpw_total_supply = htmlspecialchars($ccpw_coindetail['coin_supply']);}
		else {$ccpw_total_supply = '-';}
		$html .=  '<tr>';
		$html .=  '<td data-th="Coin"><div class="ccpw_coin_table_icon"><img align="absmiddle" width="20" height="20" src="'.$ccpw_coindetail['coin_img'].'" alt="'.htmlspecialchars($ccpw_coindetail['coin_fullname']).'" /> &nbsp;'.htmlspecialchars($ccpw_coindetail['coin_fullname']).'</div></td>'; 
       $html .='<td data-th="Algorithm"><div>'.htmlspecialchars($ccpw_coindetail['coin_algo']).'</div></td>';
       $html .='<td data-th="Proof type"><div>'.htmlspecialchars($ccpw_coindetail['coin_proof']).'</div></td>'; 
        $html .=  '<td data-th="Coin"><div>'.$ccpw_total_supply.'</div></td>';   
	$html .=  '</tr>';
	}
	$html .= '</tbody></table></div>';
	}else{
	echo '<div class="ccpw_cryptocurrency_not_select">Please choose atleast one Cryptocurrency.</div>';
	}
	} elseif($atts['pagination'] == "true" && $atts['coinlist'] == "checked"){
	// Coin List if pagination true & type checked
	$perpage = 20;
	if (isset($_GET["ccpw_setpage"])) { $currentpage  = $_GET["ccpw_setpage"]; } else { $currentpage=1; }; 
	$start_from = ($currentpage-1) * $perpage; 
	$ccpw_coinlists = $wpdb->get_results("SELECT * FROM $ccpw_table_name LIMIT $start_from, $perpage",ARRAY_A);   $ccpw_cointotal = $wpdb->get_results("SELECT * FROM $ccpw_table_name",ARRAY_A);
	$total_records = count($ccpw_cointotal);
	$setLastpage = ceil($total_records / $perpage);	
	if(!empty($ccpw_coinlists)){
	$html .= '<div class="ccpw_all_currency_list_table">';	
	$html .= '<table class="ccpw_cp-table cp-cryptocurrencies-table">';	
	$html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>'.__('Coin', 'ccpw').'</th>';
    $html .= '<th>'.__('Algorithm', 'ccpw').'</th>';
    $html .= '<th>'.__('Proof type', 'ccpw').'</th>';
    $html .= '<th>'.__('Total supply', 'ccpw').'</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
	foreach ($ccpw_coinlists as $ccpw_coindetail){
		if ($ccpw_coindetail['coin_supply']!= 0 ){$ccpw_total_supply = htmlspecialchars($ccpw_coindetail['coin_supply']);}
		else {$ccpw_total_supply = '-';}
		$html .=  '<tr>';
		$html .=  '<td data-th="Coin"><div class="ccpw_coin_table_icon"><img align="absmiddle" width="20" height="20" src="'.$ccpw_coindetail['coin_img'].'" alt="'.htmlspecialchars($ccpw_coindetail['coin_fullname']).'" /> &nbsp;'.htmlspecialchars($ccpw_coindetail['coin_fullname']).'</div></td>'; 
       $html .='<td data-th="Algorithm"><div>'.htmlspecialchars($ccpw_coindetail['coin_algo']).'</div></td>';
       $html .='<td data-th="Proof type"><div>'.htmlspecialchars($ccpw_coindetail['coin_proof']).'</div></td>'; 
        $html .=  '<td data-th="Coin"><div>'.$ccpw_total_supply.'</div></td>';   
	$html .=  '</tr>';
	}
	$html .= '</tbody></table></div>';
	}else{
	echo '<div class="ccpw_cryptocurrency_not_select">Please choose atleast one Cryptocurrency.</div>';
	}
	if(empty($_GET['ccpw_setpage']) || $_GET['ccpw_setpage'] == 1){
	$html .= '<div class="ccpw_custom-pagination"> 
	<a class="button button-primary ccpw_next-btn" href="?ccpw_setpage=2">Next Page </a>
	</div>';
	} else {
	
	$ccpw_prev_page = $_GET['ccpw_setpage']-1;
	$ccpw_next_page = $_GET['ccpw_setpage']+1; 
	$html .= '<div class="ccpw_custom-pagination">'; 
	if($setLastpage == $currentpage){
	$html .= '<a class="button button-primary ccpw_prev-btn" href="?ccpw_setpage='.$ccpw_prev_page.'">Prev Page </a>';	
	} else {
	 $html .= '<a class="button button-primary ccpw_prev-btn" href="?ccpw_setpage='.$ccpw_prev_page.'">Prev Page </a>';
	$html .= '<a class="button button-primary ccpw_next-btn" href="?ccpw_setpage='.$ccpw_next_page.'">Next Page </a>';
	}
	$html .= '</div>';
	}
	
	} else {
	echo '<style>.cp-table.cp-cryptocurrencies-table {display: none;}</style>';
	} 
return $html;

}