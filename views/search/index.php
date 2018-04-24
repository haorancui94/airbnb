<?php
/**
 * Created by PhpStorm.
 * User: cuiha
 * Date: 2018/4/19
 * Time: 23:54
 */
use yii\helpers\Html;
use yii\widgets\LinkPager;
$this->registerJsFile("@web/js/addminus.js");
$this->registerJsFile("@web/js/jquery-ui.js");
$this->registerCSSFile("@web/css/jquery-ui.css",['depends'=>  'app\assets\AppAsset',]);
$search_key=empty(Yii::$app->request->get('search_key'))?"Chicago":Yii::$app->request->get('search_key');
$room_type = empty(Yii::$app->request->get('room_type'))?'':Yii::$app->request->get('room_type');
$score = empty(Yii::$app->request->get('score'))?'0':Yii::$app->request->get('score');
$price =empty(Yii::$app->request->get('price'))?$min_price.",".$max_price:Yii::$app->request->get('price');
$bedrooms = empty(Yii::$app->request->get('beds'))?"0":Yii::$app->request->get('beds');
$beds = empty(Yii::$app->request->get('beds'))?"0":Yii::$app->request->get('beds');
$bedrooms = empty(Yii::$app->request->get('bedrooms'))?"0":Yii::$app->request->get('bedrooms');
$bathrooms = empty(Yii::$app->request->get('bathrooms'))?"0":Yii::$app->request->get('bathrooms');

?>
<div class="container">
    <p>There are <strong><?=$count?></strong> Airbnb in <strong><?=$search_key?></strong></p>

    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a data-toggle="modal" data-target="#roomtype">Home Type</a></li>
                    <li><a data-toggle="modal" data-target="#bed">Room&Bed</a></li>
                    <li><a data-toggle="modal" data-target="#price">Price</a></li>
                    <li><a data-toggle="modal" data-target="#rating">Rating</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>
<!-- Modal -->
<div class="modal fade" id="roomtype" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:300px;margin-top: 120px;margin-left: 130px;">
        <div class="modal-content" style="width:300px;">
            <div class="modal-body">
                <div class="checkbox">
                    <label>
                        <input id = "privateroom" type="checkbox" value="Private room">
                        Private Room
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input id = "sharedroom" type="checkbox" value="Shared room">
                        Shared Room
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input id = "entireplace" type="checkbox" value="Entire home/apt">
                        Entire place
                    </label>
                </div>
            </div>
                <button type="button" class="btn btn-default" style="margin-left: 230px;margin-bottom: 10px" onclick="search()">Apply</button>
        </div>
    </div>
</div>
<div class="modal fade" id="bed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:300px;margin-top: 120px;margin-left: 230px;">
        <div class="modal-content" style="width:300px;">
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="beds" class="col-sm-4 control-label">Beds:</label>
                        <div class="col-sm-6">
                            <input type="number" id= "beds" class="form-control no-padding add-color text-center height-25" min="0" max="10" maxlength="3" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bedrooms" class="col-sm-4 control-label">Bedrooms:</label>
                        <div class="col-sm-6">
                            <input type="number" id= "bedrooms" class="form-control no-padding add-color text-center height-25" min="0" max="10" maxlength="3" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bathrooms" class="col-sm-4 control-label">Bathrooms:</label>
                        <div class="col-sm-6">
                            <input type="number" id= "bathrooms" class="form-control no-padding add-color text-center height-25" min="0" max="10" maxlength="3" value="0">
                        </div>
                    </div>
                </form>
            </div>
            <button type="button" class="btn btn-default" style="margin-left: 230px;margin-bottom: 10px" onclick="search()">Apply</button>
        </div>
    </div>
</div>
<div class="modal fade" id="price" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:300px;margin-top: 120px;margin-left: 330px;">
        <div class="modal-content" style="width:300px;">
            <div class="modal-body">
                <p>
                    <label for="amount">Price range:</label>
                    <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>

                <div id="slider-range"></div>
            </div>
            <button type="button" class="btn btn-default" style="margin-left: 230px;margin-bottom: 10px" onclick="search()">Apply</button>
        </div>
    </div>
</div>
<div class="modal fade" id="rating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:300px;margin-top: 120px;margin-left: 400px;">
        <div class="modal-content" style="width:300px;">
            <div class="modal-body">
                <p>
                    <label for="amount">Score:</label>
                    <input type="text" id="score" readonly style="border:0; color:#f6931f; font-weight:bold;">
                </p>

                <div id="slider-range-min"></div>
            </div>
            <button type="button" class="btn btn-default" style="margin-left: 230px;margin-bottom: 10px" onclick="search()">Apply</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-9">
        <div class="row">
            <?php foreach ($listings as $listing): ?>
            <div class="col-lg-4">
                <div class="thumbnail" style="height: 350px">
                    <a onclick="detail(<?=$listing->LISTING_ID?>)">
                    <img src="<?=$listing->MEDIUM_URL?>" alt="Not Find">
                    </a>
                    <div class="caption">
                        <p><?=$listing->ROOM_TYPE?></p>
                        <h4><strong><?=$listing->NAME?></strong></h4>
                        <p><mark>$<?=$listing->PRICE_PER_NIGHT?></mark> per night</p>
                        <p>Rating : <?=$listing->REVIEW_SCORES_RATING?></p>
                    </div>
                </div>
            </div>
             <?php endforeach; ?>
        </div>
    </div>
</div>
        <script>
            $( function() {
                $( "#slider-range" ).slider({
                    range: true,
                    min: 0,
                    max: 500,
                    values: [0, 100],
                    slide: function( event, ui ) {
                        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                    }
                });

            } );
            $( function() {
                $( "#slider-range" ).slider( "option", "min", <?=$min_price?>);
                $( "#slider-range" ).slider( "option", "max", <?=$max_price?>);
                $( "#slider-range" ).slider( "option", "values", [<?=$price?>]);
                $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
                    " - $" + $( "#slider-range" ).slider( "values", 1 ) );
            } );
            $( function() {
                $( "#slider-range-min" ).slider({
                    range: "min",
                    min: 0,
                    max: 100,
                    value: 0,
                    slide: function( event, ui ) {
                        $( "#score" ).val( ui.value );
                    }
                });
                $( "#score" ).val( $( "#slider-range-min" ).slider( "value" ) );
            } );
            $( function() {
                $( "#slider-range-min" ).slider( "option", "value", <?=$score?>);
                $( "#score" ).val( $( "#slider-range-min" ).slider( "value" ) );
                document.getElementById("beds").value = <?=$beds?>;
                document.getElementById("bedrooms").value = <?=$bedrooms?>;
                document.getElementById("bathrooms").value = <?=$bathrooms?>;
                room_type = "<?=$room_type?>";
                if(room_type!==""){
                    room_type = room_type.split();
                    for(var i=0;i<room_type.length;i++){
                        if(room_type[i] === document.getElementById("privateroom").value)
                        {
                            document.getElementById("privateroom").checked = true;
                        }
                        if(room_type[i] === document.getElementById("sharedroom").value)
                        {
                            document.getElementById("sharedroom").checked = true;
                        }
                        if(room_type[i] === document.getElementById("entireplace").value)
                        {
                            document.getElementById("entireplace").checked = true;
                        }
                    }
                }
            } );
            function detail(id) {
                window.location.href="<?=HOST;?>/index.php?r=detail/detail&id="+id;
            }
            function search() {
                search_key = document.getElementById("searchbox1").placeholder;
                roomtype = new Array();
                score = document.getElementById("score").value;
                beds = document.getElementById("beds").value;
                bedrooms = document.getElementById("bedrooms").value;
                bathrooms = document.getElementById("bathrooms").value;

                price = $( "#slider-range" ).slider( "option", "values").join();
                if(document.getElementById("privateroom").checked){
                    roomtype.push(document.getElementById("privateroom").value);
                }
                if(document.getElementById("sharedroom").checked){
                    roomtype.push(document.getElementById("sharedroom").value);
                }
                if(document.getElementById("entireplace").checked){
                    roomtype.push(document.getElementById("entireplace").value);
                }
                window.location.href="<?=HOST;?>/index.php?r=search/search-by-attributes&search_key="+search_key+"&room_type="+roomtype.join()+"&score="+score
                +"&price="+price+"&beds="+beds+"&bedrooms="+bedrooms+"&bathrooms="+bathrooms;
            }
        </script>
<?= LinkPager::widget(['pagination' => $pagination]) ?>

