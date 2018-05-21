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
        <div class="col-lg-6" style="height:350px ">
            <img class= "img-responsive center-block" style="height: inherit" src="<?=$listing->PICTURE_URL?>">
        </div>
        <div class="col-lg-6">
            <h3>Booking Trends</h3>
            <div id="trends" class = "center-block" style="width:450px;height:350px;">
            </div>
        </div>
            <div class="col-lg-6">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">House</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Host</a></li>
                <li role="presentation"><a href="#rating" aria-controls="rating" role="tab" data-toggle="tab">Rating</a></li>
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
                        <dt>Room Type</dt>
                        <dd><?=$listing->ROOM_TYPE?></dd>
                        <dt>Min Nights</dt>
                        <dd><?=$listing->MINIMUM_NIGHTS?></dd>
                        <dt>Max Nights</dt>
                        <dd><?=$listing->MAXIMUM_NIGHTS?></dd>
                        <dt>Price per Night</dt>
                        <dd>$<?=$listing->PRICE_PER_NIGHT?></dd>
                        <dt>Weekly Price</dt>
                        <dd>$<?=$listing->WEAKLY_PRICE?></dd>
                        <dt>Monthly Price</dt>
                        <dd>$<?=$listing->MONTHLY_PRICE?></dd>
                        <dt>Security Deposit</dt>
                        <dd>$<?=$listing->SECURITY_DEPOSIT?></dd>
                        <dt>Cleaning Fee</dt>
                        <dd>$<?=$listing->CLEANING_FEE?></dd>
                        <dt>Extra People</dt>
                        <dd>$<?=$listing->EXTRA_PEOPLE?></dd>
                        <dt>Beds</dt>
                        <dd><?=$listing->BEDS?></dd>
                        <dt>Bed Type</dt>
                        <dd><?=$listing->BED_TYPE?></dd>
                        <dt>Bedrooms</dt>
                        <dd><?=$listing->BEDROOM?></dd>
                        <dt>Bathrooms</dt>
                        <dd><?=$listing->BATHROOMS?></dd>
                        <dt>Accommodates</dt>
                        <dd><?=$listing->ACCOMODATES?></dd>

                    </dl>
                   </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="thumbnail">
                                <img src="<?=$host->HOST_PICTURE_URL?>" alt="Not Found">
                                <div class="caption">
                                    <h3 class="center-block"><?=$host->HOST_NAME?></h3>
                                    <a href="<?=$host->HOST_URL?>"><?=$host->HOST_URL?></a>
                                    <dl class="dl-horizontal">
                                        <dt>Host About</dt>
                                        <dd><?=$host->HOST_ABOUT?></dd>
                                        <dt>Host Location</dt>
                                        <dd><?=$host->HOST_LOCATION?></dd>
                                        <dt>Host Listing Count</dt>
                                        <dd><?=$host->HOST_LISTINGS_COUNT?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="rating">
                    <div style="margin-top: 20px;">
                        <dl class="dl-horizontal">
                            <dt>Overall Rating</dt>
                            <dd><?=$listing->REVIEW_SCORES_RATING?>/100</dd>
                            <dt>Accuracy</dt>
                            <dd><?=$listing->REVIEW_SCORES_ACCURACY?>/10</dd>
                            <dt>Cleanliness</dt>
                            <dd><?=$listing->REVIEW_SCORES_CLEANLINESS?>/10</dd>
                            <dt>Check-in</dt>
                            <dd><?=$listing->REVIEW_SCORES_CHECKIN?>/10</dd>
                            <dt>Communication</dt>
                            <dd><?=$listing->REVIEW_SCORES_COMMUNICATION?>/10</dd>
                            <dt>Location</dt>
                            <dd><?=$listing->REVIEW_SCORES_LOCATION?>/10</dd>
                            <dt>Value</dt>
                            <dd><?=$listing->REVIEW_SCORES_VALUE?>/10</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Reviews</a></li>
                <li role="presentation"><a href="#maps" aria-controls="maps" role="tab" data-toggle="tab">Map</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="reviews">
                    <?php foreach ($reviews as $review): ?>
                        <div class="well"><?=$review->COMMENTS?><br>
                            <p class="text-right"><?=$review->IDATE?></p>
                        </div>
                    <?php endforeach; ?>
                    <?= LinkPager::widget(['pagination' => $pagination]) ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="maps">
                    <div id="map"></div>
                    <script>
                        function initMap() {
                            var place = {lat: <?=$listing->LATITUDE?>, lng: <?=$listing->LONGITUDE?>};
                            var map = new google.maps.Map(document.getElementById('map'), {
                                center: place,
                                zoom: 15
                            });
                            var marker = new google.maps.Marker({
                                position: place,
                                map: map
                            });
                        }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtHYiCTNV2ung9PUph6cOHktt25qGtq_U&language=en&callback=initMap"
                            async defer></script>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('trends'));
    option = {
        xAxis: {
            name: 'week',
            type: 'category',
            data: ['first', 'second', 'third', 'fourth']
        },
        yAxis: {
            name: 'day',
            type: 'value',
            max:7,
            min:0,
        },
        series: [{
            data: [<?=$first?>,<?=$second?>,<?=$third?>,<?=$forth?>],
            type: 'line'
        }]
    };

    myChart.setOption(option,true)
    myChart.resize();
</script>