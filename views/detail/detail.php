<?php
/**
 * Created by PhpStorm.
 * User: cuiha
 * Date: 2018/4/23
 * Time: 19:40
 */
use yii\widgets\LinkPager;

$this->registerJsFile("@web/js/echarts.min.js",['position' => \yii\web\View::POS_HEAD]);
$first = $trends['FIRSTWEEK'];
$second = $trends['SECONDWEEK'];
$third = $trends['THIRDWEEK'];
$forth = $trends['FORTHWEEK'];
if(empty($trends['FIRSTWEEK'])){
    $first = 0;
}
if(empty($trends['SECONDWEEK'])){
    $second = 0;
}
if(empty($trends['THIRDWEEK'])){
    $third = 0;
}
if(empty($trends['FORTHWEEK'])){
    $forth = 0;
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <img class= "img-responsive center-block" src="<?=$listing->PICTURE_URL?>">
        </div>
        <div class="col-lg-6">
            <h3>Booking Trends</h3>
            <div id="trends" class = "center-block" style="width:400px;height:350px;">
            </div>
        </div>
            <div class="col-lg-6">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">House</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Host</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                   <div style="margin-top: 20px;">
                    <dl class="dl-horizontal">
                        <dt>Name:</dt>
                        <dd><?=$listing->NAME?></dd>
                        <dt>Summary:</dt>
                        <dd><?=$listing->SUMMARY?></dd>
                        <dt>Description:</dt>
                        <dd><?=$listing->DESCRIPTION?></dd>
                        <dt>House Rules:</dt>
                        <dd><?=$listing->HOUSE_RULES?></dd>
                        <dt>Address:</dt>
                        <dd><address>
                                <?=$listing->STREET?><br>
                                <?=$listing->CITY?>, <?=$listing->STATE?> <?=$listing->ZIPCODE?><br>
                                <?=$listing->COUNTRY?>, <?=$listing->COUNTRY_CODE?><br>
                            </address></dd>
                        <dt>Property Type</dt>
                        <dd><?=$listing->PROPERTY_TYPE?></dd>
                    </dl>
                   </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <dl class="dl-horizontal">
                        <dt>...</dt>
                        <dd>...</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('trends'));
    option = {
        xAxis: {
            type: 'category',
            data: ['first', 'second', 'third', 'forth']
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: [<?=$first?>,<?=$second?>,<?=$third?>,<?=$forth?>],
            type: 'line'
        }]
    };

    myChart.setOption(option,true)
    myChart.resize();
</script>