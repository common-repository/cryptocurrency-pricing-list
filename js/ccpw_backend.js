/*Version: 1.5*/
(function($) {
$(document).ready(function(){
$(".ccpw_coin_click").click(function(){
if(this.checked) {
var imgurl = $(this).attr("ccpw_crypto_img_url");
var algo = $(this).attr("ccpw_algo");
var proof = $(this).attr("ccpw_proof");
var supply = $(this).attr("ccpw_supply");
var fullname = $(this).attr("ccpw_fullname");
$(this).parent().find(".ccpw_img_url").val(imgurl);
$(this).parent().find(".ccpw_algo").val(algo);
$(this).parent().find(".ccpw_proof").val(proof);
$(this).parent().find(".ccpw_supply").val(supply);
$(this).parent().find(".ccpw_fullname").val(fullname);
$(this).parent().find(".ccpw_delete_coin").val("");
} else {
var input_val = $(this).val();
$(this).parent().find(".ccpw_img_url").val(""); 
$(this).parent().find(".ccpw_algo").val("");
$(this).parent().find(".ccpw_proof").val("");
$(this).parent().find(".ccpw_supply").val("");
$(this).parent().find(".ccpw_fullname").val("");
$(this).parent().find(".ccpw_delete_coin").val(input_val);}
});
$(".ccpw_crypto_cr_click").click(function(){
if(this.checked) {
var url = $(this).attr("ccpw_crypto_cr_img_url");
$(this).next(".ccpw_get_cal_cry_img").val(url);
} else {
$(this).next(".ccpw_get_cal_cry_img").val("");
}
});


/*****Select All*******/
$("#select_all").change(function(){
	$(".ccpw_coin_click").prop('checked', $(this).prop("checked"));
	$(".ccpw_coin_click").each(function(){
	if(this.checked) {
var imgurl = $(this).attr("ccpw_crypto_img_url");
var algo = $(this).attr("ccpw_algo");
var proof = $(this).attr("ccpw_proof");
var supply = $(this).attr("ccpw_supply");
var fullname = $(this).attr("ccpw_fullname");
$(this).parent().find(".ccpw_img_url").val(imgurl);
$(this).parent().find(".ccpw_algo").val(algo);
$(this).parent().find(".ccpw_proof").val(proof);
$(this).parent().find(".ccpw_supply").val(supply);
$(this).parent().find(".ccpw_fullname").val(fullname);
$(this).parent().find(".ccpw_delete_coin").val("");
} else {
var input_val = $(this).val();
$(this).parent().find(".ccpw_img_url").val(""); 
$(this).parent().find(".ccpw_algo").val("");
$(this).parent().find(".ccpw_proof").val("");
$(this).parent().find(".ccpw_supply").val("");
$(this).parent().find(".ccpw_fullname").val("");
$(this).parent().find(".ccpw_delete_coin").val(input_val);
}
	});
  });
$('.ccpw_coin_click').change(function(){
    if(false == $(this).prop("checked")){
        $("#select_all").prop('checked', false);
    }
    if ($('.ccpw_coin_click:checked').length == $('.ccpw_coin_click').length ){
        $("#select_all").prop('checked', true);
    }
});

$(window).load(function() { 
$(".ccpw_coin_click").each(function(){
	if ($('.ccpw_coin_click:checked').length >= 100){
	$("#select_all").prop('checked', true);	
	} else {
	$("#select_all").prop('checked', false);	
	} 
});
});

$("#ccpw_ticker-type").click(function(){
ticker_val = $('input[name=ccpw_ticker-type]:checked').val();
if(ticker_val == "list-widget"){
$("#ccpw_ticker_position").css('display', "none");
$("#ccpw_ticker_hide_on_mobile").css('display', "none");
$("#ccpw_ticker_speed").css('display', "none");
$("#ccpw_padding_from_top").css('display', "none");
$("#ccpw_padding_from_bottom").css('display', "none");
} else if(ticker_val == "Ticker"){
$("#ccpw_ticker_position").css('display', "block");	
$("#ccpw_ticker_hide_on_mobile").css('display', "block");
$("#ccpw_ticker_speed").css('display', "block");	
$("#ccpw_padding_from_top").css('display', "block");
$("#ccpw_padding_from_bottom").css('display', "block");
}
});
$("#ccpw_ticker_position").click(function(){
position_val = $('input[name=ccpw_ticker_position]:checked').val();
if(position_val == "Header"){
$("#ccpw_padding_from_top").css('display', "block");
} else {
$("#ccpw_padding_from_top").css('display', "none");	
}
if(position_val == "Footer"){
$("#ccpw_padding_from_bottom").css('display', "block");
} else {
$("#ccpw_padding_from_bottom").css('display', "none");	
}
});
ticker_val = $('input[name=ccpw_ticker-type]:checked').val();
if(ticker_val == "list-widget"){
$("#ccpw_ticker_position").css('display', "none");
$("#ccpw_ticker_hide_on_mobile").css('display', "none");
$("#ccpw_padding_from_top").css('display', "none");
$("#ccpw_padding_from_bottom").css('display', "none");
$("#ccpw_ticker_speed").css('display', "none");
} else {
$("#ccpw_ticker_position").css('display', "block");	
$("#ccpw_ticker_hide_on_mobile").css('display', "block");
$("#ccpw_padding_from_top").css('display', "block");	
$("#ccpw_padding_from_bottom").css('display', "block");
$("#ccpw_ticker_speed").css('display', "block");	
}
position_val = $('input[name=ccpw_ticker_position]:checked').val();
position_type = $('input[name=ccpw_ticker-type]:checked').val();
if(position_val == "Header" && position_type=="Ticker"){
$("#ccpw_padding_from_top").css('display', "block");
} else {
$("#ccpw_padding_from_top").css('display', "none");	
}
if(position_val == "Footer" && position_type=="Ticker"){
$("#ccpw_padding_from_bottom").css('display', "block");
} else {
$("#ccpw_padding_from_bottom").css('display', "none");	
}
$(".ccpw_full_currency").click(function(){
$(".input_curr_name").removeAttr("data-val");
name_val = $(this).find(".ccpw_full_currency_input").attr("data-val");
$(".input_curr_name").val(name_val);
});


/*News Ticker*/
newsticker_val = $('input[name=ccpw_news_ticker_type]:checked').val();
if(newsticker_val == "Vertical"){
$("#ccpw_newsticker_position").css('display', "none");
$("#ccpw_newspadding_from_top").css('display', "none");
$("#ccpw_newspadding_from_bottom").css('display', "none");
} else {
$("#ccpw_newsticker_position").css('display', "block");
$("#ccpw_newspadding_from_top").css('display', "block");
$("#ccpw_newspadding_from_bottom").css('display', "block");
}
$("#ccpw_news_ticker_type").click(function(){
newsticker_val = $('input[name=ccpw_news_ticker_type]:checked').val();
if(newsticker_val == "Vertical"){
$("#ccpw_newsticker_position").css('display', "none");
$("#ccpw_newspadding_from_top").css('display', "none");
$("#ccpw_newspadding_from_bottom").css('display', "none");
} else {
$("#ccpw_newsticker_position").css('display', "block");
$("#ccpw_newspadding_from_top").css('display', "block");
$("#ccpw_newspadding_from_bottom").css('display', "block");
}
});
$("#ccpw_newsticker_position").click(function(){
position_val = $('input[name=ccpw_newsticker_position]:checked').val();
if(position_val == "Header"){
$("#ccpw_newspadding_from_top").css('display', "block");
} else {
$("#ccpw_newspadding_from_top").css('display', "none");	
}
if(position_val == "Footer"){
$("#ccpw_newspadding_from_bottom").css('display', "block");
} else {
$("#ccpw_newspadding_from_bottom").css('display', "none");	
}
});
position_val = $('input[name=ccpw_newsticker_position]:checked').val();
position_type = $('input[name=ccpw_news_ticker_type]:checked').val();
if(position_val == "Header" && position_type=="Horizontal"){
$("#ccpw_newspadding_from_top").css('display', "block");
} else {
$("#ccpw_newspadding_from_top").css('display', "none");	
}
if(position_val == "Footer" && position_type=="Horizontal"){
$("#ccpw_newspadding_from_bottom").css('display', "block");
} else {
$("#ccpw_newspadding_from_bottom").css('display', "none");	
}


});
}(jQuery)); 