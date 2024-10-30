<?php
function ccpw_changelly_widget_shortcode($atts,$content = null ){
// begin output buffering
    ob_start();	
global $wpdb;
$ccpw_cew_customize_color=$ccpw_cew_affilate_id=$ccpw_cew_customize_width=$ccpw_cew_customize_height='';
$ccpw_cew_customize_color = esc_attr(get_option('ccpw_cew_customize_color'));	
$ccpw_cew_affilate_id = esc_attr(get_option('ccpw_cew_affilate_id'));	
$ccpw_cew_customize_width = esc_attr(get_option('ccpw_cew_customize_width'));	
$ccpw_cew_customize_height = esc_attr(get_option('ccpw_cew_customize_height'));	

if($ccpw_cew_affilate_id==''){
$ccpw_cew_affilate_id  ='17ccc4b3e943';
}else{
$ccpw_cew_affilate_id = esc_attr(get_option('ccpw_cew_affilate_id'));	
}

if($ccpw_cew_customize_color==''){
$ccpw_cew_customize_color = '00cf70';
}else{
$ccpw_cew_customize_color = str_replace("#","",esc_attr(get_option('ccpw_cew_customize_color')));
}
if($ccpw_cew_customize_width==''){
$ccpw_cew_customize_width = '600';
}else{
$ccpw_cew_customize_width = preg_replace('/[^0-9]/', '', esc_attr(get_option('ccpw_cew_customize_width')));
}

if($ccpw_cew_customize_height==''){
$ccpw_cew_customize_height = '500';
}else{
$ccpw_cew_customize_height = preg_replace('/[^0-9]/', '', esc_attr(get_option('ccpw_cew_customize_height')));
}

echo '<iframe src="https://changelly.com/widget/v1?auth=email&from=BTC&to=ETH&merchant_id='.$ccpw_cew_affilate_id.'&address=&amount=1&ref_id='.$ccpw_cew_affilate_id.'&color='.$ccpw_cew_customize_color.'" width="'.$ccpw_cew_customize_width.'" height="'.$ccpw_cew_customize_height.'" class="changelly" scrolling="no" style="overflow-y: hidden; border: none" > Can\'t load Changelly Exchange Widget </iframe>';

// end output buffering, grab the buffer contents, and empty the buffer
    return ob_get_clean(); 
}