<?php
function ccpw_news_ticker_shortcode($atts,$content = null ){
// begin output buffering
    ob_start();	
global $wpdb,$post_id,$pt_post_type;
$pt = get_post_type_object( 'ccpw_newsticker_post' );
$pt_post_type = $pt->name;
$atts = shortcode_atts(
		array(
			'id' => '',
		), $atts
	);
$post_id = $atts['id'];
if ( 'publish' == get_post_status ( $post_id ) ) {
$feeds=$categories='';
$news_ticker_type = get_post_meta( $post_id, 'ccpw_news_ticker_type',true );
$news_ticker_mobile_hide = get_post_meta( $post_id, 'ccpw_news_ticker_mobile_hide',true );
$newsticker_position = get_post_meta( $post_id, 'ccpw_newsticker_position',true );
$newsticker_speed = get_post_meta( $post_id, 'ccpw_newsticker_speed',true );
$newsbackground_color = get_post_meta( $post_id, 'ccpw_newsbackground_color',true );
$newsfont_color = get_post_meta( $post_id, 'ccpw_newsfont_color',true );
$news_custom_css = get_post_meta( $post_id, 'ccpw_news_custom_css',true );
$newspadding_top = get_post_meta( $post_id, 'ccpw_newspadding_from_top',true );
	if(empty($newspadding_top)){
	$newspadding_top = '0px';	
	} else {
	$newspadding_top = $newspadding_top.'px';
	}
$newspadding_bottom = get_post_meta( $post_id, 'ccpw_newspadding_from_bottom',true );
	if(empty($newspadding_bottom)){
	$newspadding_bottom = '0px';	
	} else {
	$newspadding_bottom = $newspadding_bottom.'px';
	}

$bd_color = get_post_meta( $post_id, 'ccpw_news_border_style',true );

$ccpw_coinlist_url = 'v2/news/?lang=EN';
$ccpw_request_response_array_set = ccpw_requests_get($ccpw_coinlist_url);
$data_all_news_titles = json_decode($ccpw_request_response_array_set['response_body'], true);
if($newsticker_position == "Header"){
echo '<style>#ticker_listwidget_container_'.$post_id.'{position:fixed;top:'.$newspadding_top.';width:100%;background:'.$newsbackground_color.';left:0;z-index:99999; color:'.$newsfont_color.';} #newswebTicker_'.$post_id.' li {border-right: 1px solid '.$bd_color.';} #newswebTicker_'.$post_id.' li a{color:'.$newsfont_color.';}</style>';
} elseif($newsticker_position == "Footer"){
echo '<style>#ticker_listwidget_container_'.$post_id.'{position:fixed;bottom:'.$newspadding_bottom.';width:100%;background:'.$newsbackground_color.';left:0;z-index:99999; color:'.$newsfont_color.';} #newswebTicker_'.$post_id.' li {border-right: 1px solid '.$bd_color.';} #newswebTicker_'.$post_id.' li a{color:'.$newsfont_color.';}</style>';
} elseif($newsticker_position == "Anywhere"){
echo '<style>#ticker_listwidget_container_'.$post_id.'{background:'.$newsbackground_color.'; color:'.$newsfont_color.'; margin-bottom: 10px;} #newswebTicker_'.$post_id.' li {border-right: 1px solid '.$bd_color.'; }#newswebTicker_'.$post_id.' li a{color:'.$newsfont_color.';}</style>';
}

if($news_ticker_type == "Horizontal"){
if(!wp_is_mobile()){
	
echo "<script>jQuery(document).ready(function(){
jQuery('#newswebTicker_".$post_id."').webTicker({
	speed:$newsticker_speed,
	moving:true,
	height:'30px',
	 duplicate:true,
	 hoverpause:true,
	  startEmpty:false,
	});
});</script>";	
echo '<div id="ticker_listwidget_container_'.$post_id.'" class="tickercontainer">
    <div class="mask">';
echo "<ul id='newswebTicker_".$post_id."' class='ccpwwebticker'>";
foreach ($data_all_news_titles['Data'] as $data_all_news_title) {
echo '<li class="newswebticker"><p><img class="ccpw_img_none" align="absmiddle" width="30" height="30" src="'.$data_all_news_title['imageurl'].'" /><a href="'.$data_all_news_title['url'].'">'.$data_all_news_title['title'].'</a></p>';
echo '</li>';
}
echo "</ul></div></div>";

}else{
if($news_ticker_mobile_hide!='on'){
	
echo "<script>jQuery(document).ready(function(){
jQuery('#newswebTicker_".$post_id."').webTicker({
	speed:$newsticker_speed,
	moving:true,
	height:'30px',
	 duplicate:true,
	 hoverpause:true,
	  startEmpty:false,
	});
});</script>";	
echo '<div id="ticker_listwidget_container_'.$post_id.'" class="tickercontainer">
    <div class="mask">';
echo "<ul id='newswebTicker_".$post_id."' class='ccpwwebticker'>";
foreach ($data_all_news_titles['Data'] as $data_all_news_title) {
echo '<li class="tooltip1" data-tooltip-content="#tooltip_content_'.$data_all_news_title['id'].'"><p><img class="ccpw_img_none" align="absmiddle" width="30" height="30" src="'.$data_all_news_title['imageurl'].'" /><a href="'.$data_all_news_title['url'].'">'.$data_all_news_title['title'].'</a></p>';
echo '<div class="tooltip_templates"><div class="tooltip_content" id="tooltip_content_'.$data_all_news_title['id'].'">
<div class="news_cover_popup">
		<div class="news_imagetitle">
            <div class="news_image"><img src="'.$data_all_news_title['imageurl'].'"/></div>
            <div class="news_titledate">
                <h1 class="news_title">'.$data_all_news_title['title'].'</h1>
                <span class="news_datetime">'.date('m-d-Y H:i:s', $data_all_news_title['published_on']).'</span>
            </div>
        </div>
        <p class="news_content">'.$data_all_news_title['body'].'</p>
        <a href="'.$data_all_news_title['url'].'" class="news_readmore">Readmore</a>
		</div>
</div></div>';
echo '</li>';
}
echo "</ul></div></div>";

}
}
	} 
// end output buffering, grab the buffer contents, and empty the buffer
    return ob_get_clean(); 
}
}
function newsticker_in_footer(){
$ccpw_query = query_posts(array('post_type'=> 'ccpw_newsticker_post', 'post_status' => 'publish','meta_query' => array(array('key' => 'ccpw_newsticker_position','value' => array('Header','Footer'),'compare' => 'IN'))));	
while (have_posts()): the_post();
$post_id = get_the_ID();
$newsticker_types = get_post_meta( $post_id, 'ccpw_news_ticker_type',true );
if(!empty($newsticker_types)){
$positions = get_post_meta( $post_id, 'ccpw_newsticker_position',true );
$news_ticker_mobile_hide = get_post_meta( $post_id, 'ccpw_news_ticker_mobile_hide',true );
if($post_id){
if($newsticker_types=="Horizontal"){
if($positions=="Header"||$positions=="Footer"){

	if(!wp_is_mobile() ){
		echo "mob";
		echo do_shortcode('[ccpw_news_ticker id="'.$post_id.'"]');
	}else{
		if($news_ticker_mobile_hide!='on'){
			echo do_shortcode('[ccpw_news_ticker id="'.$post_id.'"]');
		}
	}
}
}
}	
}
endwhile;
}
add_action( 'wp_footer', 'newsticker_in_footer',100);
?>