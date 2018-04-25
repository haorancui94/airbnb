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
use Yii;
class SearchController extends Controller{
    public function actionCity(){
        $search_key = Yii::$app->request->get('search_key');
        $query = Listing::find()->select(['CITY'])->where(['like',"UPPER(CITY)",strtoupper($search_key)])->distinct()->all();
        return $this->render('city', [
            'citys' => $query,
        ]);
    }
    public function actionSearchCityByKey(){
    	$search_key = Yii::$app->request->get('search_key');
		$query = Listing::find()->where(['like','CITY',$search_key]);
		$pagination = new Pagination([
			'defaultPageSize' => 12,
			'totalCount' => $query->count(),
		]);
		$listings = $query
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
		$count = $query->count();
		$max_price = $query->max("PRICE_PER_NIGHT");
        $min_price = $query->min("PRICE_PER_NIGHT");
		return $this->render('index', [
			'listings' => $listings,
			'pagination' => $pagination,
            'count' => $count,
            'max_price' => $max_price,
            'min_price' => $min_price,
		]);
	}
    public function actionSearchByAttributes(){
        $search_key = Yii::$app->request->get('search_key');
        $roomtype =empty(Yii::$app->request->get('room_type'))?["Private room","Shared room","Entire home/apt"]:explode(',',Yii::$app->request->get('room_type'));
        $score = Yii::$app->request->get('score');
        $price = explode(",",Yii::$app->request->get('price'));
        $beds = Yii::$app->request->get('beds');
        $bedrooms = Yii::$app->request->get('bedrooms');
        $bathrooms =Yii::$app->request->get('bathrooms');
        $query = Listing::find()->where(['like','CITY',$search_key])
            ->andWhere(['in', 'ROOM_TYPE',$roomtype])
            ->andWhere(['>', 'PRICE_PER_NIGHT',$price[0]])
            ->andWhere(['<', 'PRICE_PER_NIGHT',$price[1]])
            ->andWhere(['>', 'REVIEW_SCORES_RATING',$score])
            ->andWhere(['>', 'BEDS',$beds])
            ->andWhere(['>', 'BEDROOM',$bedrooms])
            ->andWhere(['>', 'BATHROOMS',$bathrooms]);
        $pagination = new Pagination([
            'defaultPageSize' => 12,
            'totalCount' => $query->count(),
        ]);
        $listings = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $count = $query->count();
        $max_price = Listing::find()->where(['like','CITY',$search_key])->max("PRICE_PER_NIGHT");
        $min_price = Listing::find()->where(['like','CITY',$search_key])->min("PRICE_PER_NIGHT");
        return $this->render('index', [
            'listings' => $listings,
            'pagination' => $pagination,
            'count' => $count,
            'max_price' => $max_price,
            'min_price' => $min_price,
            'roomtype' =>$roomtype,
        ]);
    }
}
