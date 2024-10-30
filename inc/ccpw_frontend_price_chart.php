<?php
function ccpw_currency_price_chart_shortcode($atts,$content = null ){
ob_start();
$atts = shortcode_atts(
    array(
      'id' => '',
    ), $atts
  );
$post_id = $atts['id'];
if ( 'publish' == get_post_status ( $post_id ) ) {
$ccpw_pc_font_color = get_post_meta( $post_id, 'ccpw_pc_font_color',true );
$ccpw_pc_line_color = get_post_meta( $post_id, 'ccpw_pc_line_color',true );
$ccpw_pc_border_color = get_post_meta( $post_id, 'ccpw_pc_border_color', true);
$unserialize_currency = get_post_meta( $post_id, 'ccpw_pc_display_phy_currencies',true );
$unserialize_cry_currency = get_post_meta( $post_id, 'ccpw_pc_display_currencies',true );
if(empty($unserialize_currency)){$unserialize_currency = "USD";}else {$unserialize_currency = $unserialize_currency;}

$ccpw_total_day =  date("z", mktime(0,0,0,12,31,2018)) + 1;
$total_day_min = $ccpw_total_day+1;


$ccpw_coinlist_url = 'histoday?fsym='.$unserialize_cry_currency.'&tsym='.$unserialize_currency.'&limit='.$ccpw_total_day.'&aggregate=1&e=CCCAGG';
$ccpw_request_response_array_set = ccpw_requests_get($ccpw_coinlist_url);
$data_all_currencies_raws = json_decode($ccpw_request_response_array_set['response_body'], true);
$data_all_currencies = $data_all_currencies_raws['Data'];
echo '<style>
#chartdiv_'.$post_id.' { width: 100%; height: 500px;}
.coin_detail-'.$post_id.' {border: 1px solid '.$ccpw_pc_border_color.';
box-shadow: '.$ccpw_pc_border_color.' 0px 0px 15px;

}
.c_info_price-'.$post_id.', .coin_details_'.$post_id.' {
	color: '.$ccpw_pc_font_color.';
}
</style>
<div class="ccpw_price_chart_container">
<div class="ccpw-special-heading">
<h4 class="ccpw-special-heading-tag">'.$unserialize_cry_currency.' to '.$unserialize_currency.' Price Chart</h4>
<div class="ccpw-special-heading-border">
<div class="ccpw-special-heading-inner-border"></div>
</div>
</div>
<section class="ccpw_textblock_section">
<div class="ccpw_textblock">
<div id="ccpw-price-chart-'.$post_id.'" class="ccpw-container chart">
<div class="ccpw-chart">';
echo '<div class="simple_style simple_style-'.$post_id.' coin_detail-'.$post_id.' coin_details graph_info">'; 
echo '<ul>';
$ccpw_coinlist_url1 = 'pricemultifull?fsyms='.$unserialize_cry_currency.'&tsyms='.$unserialize_currency.'';
$ccpw_request_response_array_set1 = ccpw_requests_get($ccpw_coinlist_url1);
$data_all_currencies_raws_1 = json_decode($ccpw_request_response_array_set1['response_body'], true);
foreach (reset($data_all_currencies_raws_1) as $data_all_currencies_raw) {
$currencu_sign =  next($data_all_currencies_raws_1)[$unserialize_cry_currency][$unserialize_currency]['TOSYMBOL'];
$name = $data_all_currencies_raw[$unserialize_currency]["FROMSYMBOL"];
$price = number_format($data_all_currencies_raw[$unserialize_currency]['PRICE'], 2);
$symbol = $data_all_currencies_raw[$unserialize_currency]["FROMSYMBOL"];
$market_cap_usd = $data_all_currencies_raw[$unserialize_currency]["MKTCAP"];
$check_coin = get_post_meta( $post_id, 'ccpw_pc_display_currencies',true );
echo '<li><div class="ccpw_icon"><img align="absmiddle" width="128" height="128" class="ccpw_img_none" src="'.ccpw_url.'images/crypto-currencies-icons/'.$symbol.'.png"/></div></li>
  <li><div class="ticker-name"><strong>'.$name.'<span>('.$symbol.')</span></strong></div>
</li>
<li class="c_info c_info-'.$post_id.'"><strong>Price </strong><div class="chart_coin_price c_info_price-'.$post_id.'"><span>'.$currencu_sign.''.$price.'</span></div></li>
<li class="c_info c_info-'.$post_id.'"> <strong>Market Cap</strong>
<div class="coin_market_cap c_info_price-'.$post_id.'"><span class="CCMC">'.$currencu_sign.''.$market_cap_usd.'</span></div></li>';
} 
echo '</ul>
</div>
<div class="ccpw_chartdiv" id="chartdiv_'.$post_id.'"></div>
</div>
</div>
</div>
</section>
</div>
<script>
    var chartData = [];
    var firstDate = new Date();
  firstDate.setDate( firstDate.getDate() - '.$total_day_min.' );
  firstDate.setHours( 0, 0, 0, 0 );';
$i=1; foreach ($data_all_currencies as $data_all_currencie) { $time = $data_all_currencie['time']; $open = $data_all_currencie['open']; $volumeto = $data_all_currencie['volumeto']; $date = date_create(); date_timestamp_set($date, $time); $full_date = date_format($date, 'Y-m-d');
       echo 'var a = '.$open.';
       var b = '.$volumeto.'; 
      var newDate = new Date( firstDate );
        newDate.setDate( newDate.getDate() + '.$i.' );
       chartData.push( {
      "date": newDate,
      "value": a,
      "volume": b
    } );';
$i++; } 
echo 'var chart = AmCharts.makeChart( "chartdiv_'.$post_id.'", {
  "type": "stock",
  "theme": "light",
  "categoryAxesSettings": {
    "minPeriod": "mm"
  },
  "dataSets": [ {
    "title": "'.$unserialize_currency.'",
    "color": "'.$ccpw_pc_line_color.'",
    "fieldMappings": [ {
      "fromField": "value",
      "toField": "value"
    }, {
      "fromField": "volume",
      "toField": "volume"
    } ],
    "dataProvider": chartData,
    "categoryField": "date"
  } ],
  "panels": [ {
    "showCategoryAxis": false,
    "title": "Price",
    "percentHeight": 70,
    "stockGraphs": [ {
      "id": "g1",
      "valueField": "value",
      "comparable": true,
      "compareField": "value",
	  "useDataSetColors": false,
	  "lineColor":"'.$ccpw_pc_line_color.'",
	  "fillAlphas": 0.5,
	  "fillColors":"'.$ccpw_pc_line_color.'",
      "balloonText": "[[title]]:<b>[[value]]</b>",
      "compareGraphBalloonText": "[[title]]:<b>[[value]]</b>",
      "type": "smoothedLine",
      "lineThickness": 3,
      "bullet": "round"
    } ],
   "stockLegend": {
    "periodValueTextComparing": "[[percents.value.close]]%",
      "periodValueTextRegular": "[[value.close]]",
    }
  }, {
    "title": "Volume",
    "percentHeight": 30,
    "stockGraphs": [ {
      "valueField": "volume",
      "type": "column",
      "showBalloon": false,
      "fillAlphas": 1
    } ],
    "stockLegend": {
      "periodValueTextRegular": "[[value.close]]",
    }
  } ],
  "chartScrollbarSettings": {
    "graph": "g1",
    "usePeriod": "10mm",
    "position": "bottom",
	"selectedBackgroundAlpha":0.4,
    "selectedBackgroundColor":"'.$ccpw_pc_line_color.'"
  },
  "chartCursorSettings": {
    "valueBalloonsEnabled": true,
    "fullWidth": true,
    "cursorAlpha": 0.1,
    "valueLineBalloonEnabled": true,
    "valueLineEnabled": true,
    "valueLineAlpha": 0.5
  },
  "periodSelector": {
    "position": "top",
     "periods": [ {
      "period": "DD",
      "count": 1,
      "label": "1D"
    }, {
      "period": "DD",
      "selected": true,
      "count": 7,
      "label": "7D"
    }, {
      "period": "MM",
      "count": 1,
      "label": "1M"
    }, {
      "period": "MM",
      "count": 3,
      "label": "3M"
    }, {
      "period": "MM",
      "count": 6,
      "label": "6M"
    }, {
      "period": "YYYY",
      "count": 1,
      "label": "1Y"
    }, {
      "period": "ALL",
      "label": "ALL"
    } ]
  },
  "panelsSettings": {
    "usePrefixes": true
  },
  "export": {
    "enabled": true,
    "position": "top-right"
  }
} );
</script>';
return ob_get_clean(); 
}
}