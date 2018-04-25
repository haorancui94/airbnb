<?php
/**
 * Created by PhpStorm.
 * User: cuiha
 * Date: 2018/4/24
 * Time: 16:45
 */
namespace app\controllers;
use app\models\Reviews;
use app\models\Hosts;
use app\models\Listing;
use yii\web\Controller;
use Yii;
class AnalysisController extends Controller{
    function actionAnalysis(){
        $search_key = Yii::$app->request->get('search_key');
        $popular = Yii::$app->db->createCommand('select ROOM_TYPE, count(*) AS COUNT from LISTING l,
    (select LISTING_ID as LID from CALENDAR 
        where AVAILABLE = \'f\') 
        where l.LISTING_ID = LID and l.city = :city
        group by ROOM_TYPE')->bindValue(':city',$search_key)->queryall();
        $query = Yii::$app->db->createCommand('select sum1/sum2 as Rate from
    (select count(*) as sum2 from LISTING l, CALENDAR 
        where l.LISTING_ID = CALENDAR.LISTING_ID and l.city = :city 
        and l.ROOM_TYPE = :room),
    (select count(*) as sum1 from LISTING l, 
        (select LISTING_ID as LID from CALENDAR 
            where AVAILABLE = \'f\') 
        where l.LISTING_ID = LID and l.city = :city 
        and l.ROOM_TYPE = :room)')->bindValue(':city',$search_key);
        $private = $query->bindValue(':room','Private room')->queryone();
        $share = Yii::$app->db->createCommand('select sum1/sum2 as Rate from
    (select count(*) as sum2 from LISTING l, CALENDAR 
        where l.LISTING_ID = CALENDAR.LISTING_ID and l.city = :city 
        and l.ROOM_TYPE = :room),
    (select count(*) as sum1 from LISTING l, 
        (select LISTING_ID as LID from CALENDAR 
            where AVAILABLE = \'f\') 
        where l.LISTING_ID = LID and l.city = :city 
        and l.ROOM_TYPE = :room)')->bindValue(':city',$search_key)->bindValue(':room','Shared room')->queryone();
        $entire = Yii::$app->db->createCommand('select sum1/sum2 as Rate from
        (select count(*) as sum2 from LISTING l, CALENDAR 
        where l.LISTING_ID = CALENDAR.LISTING_ID and l.city = :city
        and l.ROOM_TYPE = :room),
    (select count(*) as sum1 from LISTING l, 
        (select LISTING_ID as LID from CALENDAR 
            where AVAILABLE = \'f\') 
        where l.LISTING_ID = LID and l.city = :city 
        and l.ROOM_TYPE = :room)')->bindValue(':city',$search_key)->bindValue(':room',"Entire home/apt")->queryOne();

        $total = Yii::$app->db->createCommand('select occupied/(occupied + unoccupied) as rate from(
select count(*) as unoccupied from CALENDAR c, LISTING l
    where c.LISTING_ID = l.LISTING_ID and l.CITY = :city and c.AVAILABLE = \'t\'),
(select count(*) as occupied from CALENDAR c, LISTING l
    where c.LISTING_ID = l.LISTING_ID and l.CITY = :city and c.AVAILABLE = \'f\')')->bindValue(':city',$search_key)->queryOne();

        $reviewed = Yii::$app->db->createCommand('select listing_id, name, num
from
(select l.listing_id, l.name, count(*) as num
from reviews r, listing l
where r.has = l.listing_id 
and 
l.city = :city
group by l.listing_id, l.name
order by Num desc)
where rownum <=10')->bindValue(':city',$search_key)->queryAll();
        $hot = Yii::$app->db->createCommand('select listing_id, name, num
from
(select l.listing_id, l.name, count(c.IDATE) as num
from calendar c, listing l
where c.listing_id = l.listing_id
and
l.city = :city
and
c.available = \'f\' 
and 
c.IDATE >= TO_DATE(\'03/01/2018\',\'mm/dd/yyyy\')
and
c.IDATE <= TO_DATE(\'03/31/2018\',\'mm/dd/yyyy\')
group by l.listing_id, l.name
order by num desc)
where rownum <= 10')->bindValue(':city',$search_key)->queryAll();
        $price  = Yii::$app->db->createCommand('SELECT ROOM_TYPE,AVG(PRICE_PER_NIGHT) AS AVGPRICE
FROM LISTING
WHERE 
CITY = :city 
GROUP BY ROOM_TYPE')->bindValue(':city',$search_key)->queryAll();
        $portion = Yii::$app->db->createCommand('SELECT ROOM_TYPE,COUNT(*)AS NUM
FROM LISTING
WHERE 
CITY = :city 
GROUP BY ROOM_TYPE')->bindValue(':city',$search_key)->queryAll();
        $hosts = Yii::$app->db->createCommand('SELECT H.HOST_URL, H.HOST_NAME, HR.ALL_HOST_REVIEWS
FROM
(SELECT OWNS AS HOST_ID, ALL_NUM AS ALL_HOST_REVIEWS
FROM
(SELECT OWNS, SUM(NUM) AS ALL_NUM
FROM
(SELECT L.OWNS, L.LISTING_ID, R.NUM
FROM
(SELECT HAS, COUNT(*) AS NUM
FROM REVIEWS
GROUP BY HAS) R, LISTING L
WHERE 
L.LISTING_ID = R.HAS
AND 
L.CITY = :city )
GROUP BY OWNS
ORDER BY ALL_NUM DESC)
WHERE ROWNUM <= 10) HR, HOSTS H
WHERE HR.HOST_ID = H.HOST_ID
ORDER BY HR.ALL_HOST_REVIEWS DESC')->bindValue(':city',$search_key)->queryAll();
        $trends = Yii::$app->db->createCommand('select R1.room_type, ROUND(R1.first_week_sum/R2.first_week_all, 4) as first_week, 
ROUND(R3.second_week_sum/R4.second_week_all, 4) as second_week,
ROUND(R5.third_week_sum/R6.third_week_all, 4) as third_week,
ROUND(R7.forth_week_sum/R8.forth_week_all, 4) as forth_week
from
(select room_type, count(c.IDATE) as first_week_sum
from calendar c, listing l
where c.listing_id = l.listing_id
and
l.city = :city
and
c.available = \'f\' 
and 
c.IDATE >= TO_DATE(\'03/01/2018\',\'mm/dd/yyyy\')
and
c.IDATE <= TO_DATE(\'03/07/2018\',\'mm/dd/yyyy\')
group by room_type) R1,

(select room_type, count(c.IDATE) as first_week_all
from calendar c, listing l
where c.listing_id = l.listing_id
and
l.city = :city
and 
c.IDATE >= TO_DATE(\'03/01/2018\',\'mm/dd/yyyy\')
and
c.IDATE <= TO_DATE(\'03/07/2018\',\'mm/dd/yyyy\')
group by room_type) R2,

(select room_type, count(c.IDATE) as second_week_sum
from calendar c, listing l
where c.listing_id = l.listing_id
and
l.city = :city
and
c.available = \'f\' 
and 
c.IDATE >= TO_DATE(\'03/08/2018\',\'mm/dd/yyyy\')
and
c.IDATE <= TO_DATE(\'03/14/2018\',\'mm/dd/yyyy\')
group by room_type) R3,

(select room_type, count(c.IDATE) as second_week_all
from calendar c, listing l
where c.listing_id = l.listing_id
and
l.city  = :city
and 
c.IDATE >= TO_DATE(\'03/08/2018\',\'mm/dd/yyyy\')
and
c.IDATE <= TO_DATE(\'03/14/2018\',\'mm/dd/yyyy\')
group by room_type) R4,

(select room_type, count(c.IDATE) as third_week_sum
from calendar c, listing l
where c.listing_id = l.listing_id
and
l.city = :city
and
c.available = \'f\' 
and 
c.IDATE >= TO_DATE(\'03/15/2018\',\'mm/dd/yyyy\')
and
c.IDATE <= TO_DATE(\'03/21/2018\',\'mm/dd/yyyy\')
group by room_type) R5,

(select room_type, count(c.IDATE) as third_week_all
from calendar c, listing l
where c.listing_id = l.listing_id
and
l.city = :city
and 
c.IDATE >= TO_DATE(\'03/15/2018\',\'mm/dd/yyyy\')
and
c.IDATE <= TO_DATE(\'03/21/2018\',\'mm/dd/yyyy\')
group by room_type) R6,

(select room_type, count(c.IDATE) as forth_week_sum
from calendar c, listing l
where c.listing_id = l.listing_id
and
l.city = :city
and
c.available = \'f\' 
and 
c.IDATE >= TO_DATE(\'03/22/2018\',\'mm/dd/yyyy\')
and
c.IDATE <= TO_DATE(\'03/28/2018\',\'mm/dd/yyyy\')
group by room_type) R7,

(select room_type, count(c.IDATE) as forth_week_all
from calendar c, listing l
where c.listing_id = l.listing_id
and
l.city = :city
and 
c.IDATE >= TO_DATE(\'03/22/2018\',\'mm/dd/yyyy\')
and
c.IDATE <= TO_DATE(\'03/28/2018\',\'mm/dd/yyyy\')
group by room_type) R8

where 

R1.room_type = R2.room_type 
and 
R2.room_type = R3.room_type 
and 
R3.room_type = R4.room_type 
and 
R4.room_type = R5.room_type 
and
R5.room_type = R6.room_type
and
R6.room_type = R7.room_type
and
R7.room_type = R8.room_type')->bindValue(':city',$search_key)->queryAll();
        return $this->render('index', [
            'search_key' => $search_key,
            'popular' => $popular,
            'private' =>$private,
            'share' => $share,
            'entire' => $entire,
            'total' => $total,
            'reviewed' => $reviewed,
            'hots' => $hot,
            'price' => $price,
            'portion' => $portion,
            'hosts' => $hosts,
            'trends' => $trends,
        ]);
    }
}