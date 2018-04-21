<?php
/**
 * Created by PhpStorm.
 * User: cuiha
 * Date: 2018/4/19
 * Time: 23:54
 */
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Listings</h1>
<ul>
    <?php foreach ($listings as $listing): ?>
        <li>
            <?= Html::encode("{$listing->CITY} ({$listing->STATE})") ?>:
            <?= $listing->ZIPCODE ?>
        </li>
    <?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>
