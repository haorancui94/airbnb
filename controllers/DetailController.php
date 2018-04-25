<?php
/**
 * Created by PhpStorm.
 * User: cuiha
 * Date: 2018/4/23
 * Time: 19:55
 */
namespace app\controllers;
use app\models\Reviews;
use app\models\Hosts;
use app\models\Listing;
use yii\data\Pagination;
use yii\web\Controller;
use Yii;
class DetailController extends Controller{
    public function actionDetail(){
        $listing_id= Yii::$app->request->get('id');
        $listing = Listing::find()->where(['=','LISTING_ID',$listing_id])->one();
        $host = Hosts::find()->where(['=','HOST_ID', $listing->OWNS])->one();
        $query= Reviews::find()->where(['HAS' => $listing_id]);
        $trends = Yii::$app->db->createCommand('select firstweek, secondweek, thirdweek, forthweek from
    (select count(*) as firstweek from CALENDAR 
        where LISTING_ID = :id and IDATE >= TO_DATE(\'03/01/2018\',\'mm/dd/yyyy\') 
        and IDATE <= TO_DATE(\'03/07/2018\',\'mm/dd/yyyy\') and AVAILABLE = \'f\'),
    (select count(*) as secondweek from CALENDAR 
        where LISTING_ID = :id and IDATE >= TO_DATE(\'03/08/2018\',\'mm/dd/yyyy\')
        and IDATE <= TO_DATE(\'03/14/2018\',\'mm/dd/yyyy\') and AVAILABLE = \'f\'),
    (select count(*) as thirdweek from CALENDAR 
        where LISTING_ID = :id and IDATE >= TO_DATE(\'03/15/2018\',\'mm/dd/yyyy\') 
        and IDATE <= TO_DATE(\'03/21/2018\',\'mm/dd/yyyy\') and AVAILABLE = \'f\'),
    (select count(*) as forthweek from CALENDAR 
        where LISTING_ID = :id and IDATE >= TO_DATE(\'03/22/2018\',\'mm/dd/yyyy\') 
        and IDATE <= TO_DATE(\'03/28/2018\',\'mm/dd/yyyy\') and AVAILABLE = \'f\')')->bindValue(':id',$listing_id)->queryone();
        //echo var_dump($trends);
        //die;
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);
        $reviews = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('detail', [
            'listing' => $listing,
            'pagination' => $pagination,
            'host' => $host,
            'reviews' => $reviews,
            'trends' => $trends,
        ]);
    }
}