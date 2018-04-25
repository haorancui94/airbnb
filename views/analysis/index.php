<?php
/**
 * Created by PhpStorm.
 * User: cuiha
 * Date: 2018/4/24
 * Time: 16:47
 */
$this->registerJsFile("@web/js/echarts.min.js",['position' => \yii\web\View::POS_HEAD]);
?>
<div class="container">
    <h1 class="text-center"><strong><?=$search_key?> Market Report<strong></h1>
    <div class="row">
        <div class="col-lg-6">
            <div id="popular" class = "center-block" style="width:500px;height:350px;"></div>
        </div>
        <div class="col-lg-6">
            <div id="price" class = "center-block" style="width:500px;height:350px;"></div>
        </div>
        <div class="col-lg-6">
            <div id="portion" class = "center-block" style="width:500px;height:350px;"></div>
        </div>
        <div class="col-lg-6">
            <div id="trend" class = "center-block" style="width:500px;height:350px;"></div>
        </div>
        <div class="col-lg-6">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#review" aria-controls="review" role="tab" data-toggle="tab">Most Reviewed</a></li>
                <li role="presentation"><a href="#hot" aria-controls="hot" role="tab" data-toggle="tab">Hot top 10</a></li>
                <li role="presentation"><a href="#host" aria-controls="host" role="tab" data-toggle="tab">Most Reviewed Host</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="review">
                        <ol>
                            <?php foreach ($reviewed as $review): ?>
                                <li><a onclick="detail(<?=$review['LISTING_ID']?>)"><h5><?=$review['NAME']?><small>Reviews: <?=$review['NUM']?></small></h5></a></li>
                            <?php endforeach; ?>
                        </ol>
                </div>
                <div role="tabpanel" class="tab-pane" id="hot">
                    <ol>
                        <?php foreach ($hots as $hot): ?>
                            <li><a onclick="detail(<?=$hot['LISTING_ID']?>)"><h5><?=$hot['NAME']?><small> <?=$hot['NUM']?></small></h5></a></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
                <div role="tabpanel" class="tab-pane" id="host">
                    <ol>
                        <?php foreach ($hosts as $host): ?>
                            <li><a href="<?=$host['HOST_URL']?>"><h5><?=$host['HOST_NAME']?><small> <?=$host['ALL_HOST_REVIEWS']?></small></h5></a></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

        </div>
    </div>
        <script type="text/javascript">
            function detail(id) {
                window.location.href="<?=HOST;?>/index.php?r=detail/detail&id="+id;
            }
            var myChart = echarts.init(document.getElementById('popular'));
            private = <?=$private['RATE']?>;
            private = private.toFixed(2).slice(2,4);
            share = <?=$share['RATE']?>;
            share = share.toFixed(2).slice(2,4);
            entire = <?=$entire['RATE']?>;
            entire = entire.toFixed(2).slice(2,4);
            total = <?=$total['RATE']?>;
            total = total.toFixed(2).slice(2,4);
            var option = {
                color: ['#3398DB'],
                title: {
                    text: 'Occupancy Rate',
                },
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {
                        type : 'shadow'
                    }
                },
                xAxis: [{
                    type: 'category',
                    data: ['Private room', 'Shared room', 'Entire Place','Total'],
                    axisTick: {
                        alignWithLabel: true
                    }
                }
                ],
                yAxis: {
                    type: 'value',
                    name: 'percentage %',
                    max: 100,
                    min: 0,
                },
                series: [{
                    data: [private, share, entire,total],
                    type: 'bar',
                    barWidth: '40%'
                }]
            };

            myChart.setOption(option,true)
            myChart.resize();
            var myChart1 = echarts.init(document.getElementById('price'));
            var option1 = {
                color: ['#3398DB'],
                title: {
                    text: 'Avg Price',
                },
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {
                        type : 'shadow'
                    }
                },
                xAxis: [{
                    type: 'category',
                    data: ['Private room', 'Shared room', 'Entire Place'],
                    axisTick: {
                        alignWithLabel: true
                    }
                }
                ],
                yAxis: {
                    type: 'value',
                    name: 'Dollar $',
                },
                series: [{
                    data: [<?=$price[0]['AVGPRICE']?>,<?=$price[1]['AVGPRICE']?>,<?=$price[2]['AVGPRICE']?>,],
                    type: 'bar',
                    barWidth: '40%'
                }]
            };

            myChart1.setOption(option1,true)
            myChart1.resize();
            var myChart2 = echarts.init(document.getElementById('portion'));
            var option2 = {
                title : {
                    text: 'Room Type Percentage',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: ['Private room','Shared room','Entire place',]
                },
                series : [
                    {
                        name:'Count',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[
                            {value:<?=$portion[0]['NUM']?>, name:'Private room'},
                            {value:<?=$portion[1]['NUM']?>, name:'Shared room'},
                            {value:<?=$portion[2]['NUM']?>, name:'Entire place'},
                        ],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };

            myChart2.setOption(option2,true)
            myChart2.resize();
            var myChart3 = echarts.init(document.getElementById('trend'));
            var option3 = {
                title: {
                    text: 'Booking Trend'
                },
                tooltip : {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: '#6a7985'
                        }
                    }
                },
                legend: {
                    data:['Private room','Shared room','Entire place'],
                    right: 'right',
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis : [
                    {
                        type : 'category',
                        boundaryGap : false,
                        data : ['First','Second','Third','Fourth']
                    }
                ],
                yAxis : [
                    {
                        type : 'value',
                        scale: true,
                        precision: 2,
                        splitNumber: 9,
                        boundaryGap: [0.01, 0.01],
                        splitArea: { show: true }
                    }
                ],
                series : [
                    {
                        name:'Private room',
                        type:'line',
                        label: {
                            normal: {
                                show: true,
                            }
                        },
                        areaStyle: {normal: {}},
                        data:[<?=$trends[0]['FIRST_WEEK']?>, <?=$trends[0]['SECOND_WEEK']?>, <?=$trends[0]['THIRD_WEEK']?>, <?=$trends[0]['FORTH_WEEK']?>]
                    },
                    {
                        name:'Shared room',
                        type:'line',
                        label: {
                            normal: {
                                show: true,
                                position: 'top'
                            }
                        },
                        areaStyle: {normal: {}},
                        data:[<?=$trends[1]['FIRST_WEEK']?>, <?=$trends[1]['SECOND_WEEK']?>, <?=$trends[1]['THIRD_WEEK']?>, <?=$trends[1]['FORTH_WEEK']?>]
                    },
                    {
                        name:'Entire place',
                        type:'line',
                        label: {
                            normal: {
                                show: true,
                            }
                        },
                        areaStyle: {normal: {}},
                        data:[<?=$trends[2]['FIRST_WEEK']?>, <?=$trends[2]['SECOND_WEEK']?>, <?=$trends[2]['THIRD_WEEK']?>, <?=$trends[2]['FORTH_WEEK']?>]
                    },
                ]
            };


            myChart3.setOption(option3,true)
            myChart3.resize();
        </script>
    </div>
</div>