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
        <?= $form->field($model, 'USER_ID')->input('text',['style'=>'width:30%', 'readonly'=>'true']) ?>
        <?= $form->field($model, 'PHONE')->input('text',['style'=>'width:30%']) ?>
        <?= $form->field($model, 'FIRST_NAME')->input('text',['style'=>'width:30%']) ?>
        <?= $form->field($model, 'LAST_NAME')->input('text',['style'=>'width:30%']) ?>
        <?= $form->field($model, 'EMAIL')->input('text',['style'=>'width:30%']) ?>
        <?= $form->field($model, 'GENDER')->input('text',['style'=>'width:30%']) ?>
        <?= $form->field($model, 'BIRTH_DATE')->input('text',['style'=>'width:30%']) ?>
        <?= $form->field($model, 'PASSWORD')->input('text',['style'=>'width:30%']) ?>
        <?= $form->field($model, 'USER_PICTURE')->input('text',['style'=>'width:30%']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-userinfo -->
