<?php
/**
 * Created by PhpStorm.
 * User: cuiha
 * Date: 2018/4/24
 * Time: 15:42
 */
?>
<h3> What do you mean?</h3><br>
<p>Please select a city</p><br>
<?php foreach ($citys as $city): ?>
    <a href="<?=HOST;?>/index.php?r=search/search-city-by-key&search_key=<?=$city->CITY?>"><?=$city->CITY?></a><br>
<?php endforeach; ?>