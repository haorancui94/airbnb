<?php
/**
 * Created by PhpStorm.
 * User: cuiha
 * Date: 2018/4/19
 * Time: 23:38
 */
namespace app\controllers;
use app\models\Listing;
use yii\data\Pagination;
use yii\web\Controller;
class SearchController extends Controller{
    public function actionCity(){
        $query = Listing::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $listings = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'listings' => $listings,
            'pagination' => $pagination,
        ]);
    }
}