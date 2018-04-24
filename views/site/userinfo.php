<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
?>
<div class="site-userinfo">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'USER_ID')->label('国别码')->input('text',['value'=>'ceshi']) ?>
        <?= $form->field($model, 'PHONE')->input('text',['value'=>'ceshi']) ?>
        <?= $form->field($model, 'FIRST_NAME')->input('text',['value'=>'ceshi']) ?>
        <?= $form->field($model, 'LAST_NAME')->input('text',['value'=>'ceshi']) ?>
        <?= $form->field($model, 'EMAIL')->input('text',['value'=>'ceshi']) ?>
        <?= $form->field($model, 'GENDER')->input('text',['value'=>'ceshi']) ?>
        <?= $form->field($model, 'BIRTH_DATE')->input('text',['value'=>'ceshi']) ?>
        <?= $form->field($model, 'PASSWORD')->input('text',['value'=>'ceshi']) ?>
        <?= $form->field($model, 'USER_PICTURE')->input('text',['value'=>'ceshi']) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-userinfo -->
