<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
?>
<div class="site-userinfo">
    <h2>UserInfo:</h2>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'USER_ID')->input('text',['value'=>$userinfo['USER_ID'], 'style'=>'width:30%', 'readonly'=>'true']) ?>
        <?= $form->field($model, 'PHONE')->input('text',['value'=>$userinfo['PHONE'], 'style'=>'width:30%']) ?>
        <?= $form->field($model, 'FIRST_NAME')->input('text',['value'=>$userinfo['FIRST_NAME'], 'style'=>'width:30%']) ?>
        <?= $form->field($model, 'LAST_NAME')->input('text',['value'=>$userinfo['LAST_NAME'], 'style'=>'width:30%']) ?>
        <?= $form->field($model, 'EMAIL')->input('text',['value'=>$userinfo['EMAIL'], 'style'=>'width:30%']) ?>
        <?= $form->field($model, 'GENDER')->input('text',['value'=>$userinfo['GENDER'], 'style'=>'width:30%']) ?>
        <?= $form->field($model, 'BIRTH_DATE')->input('text',['value'=>$userinfo['BIRTH_DATE'], 'style'=>'width:30%']) ?>
        <?= $form->field($model, 'PASSWORD')->input('text',['value'=>$userinfo['PASSWORD'], 'style'=>'width:30%']) ?>
        <?= $form->field($model, 'USER_PICTURE')->input('text',['value'=>$userinfo['USER_PICTURE'], 'style'=>'width:30%']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-userinfo -->
