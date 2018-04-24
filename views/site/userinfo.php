<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
?>
<div class="site-userinfo">
    <div class="row">
        <div class="col-md-6">
            <h2>UserInfo:</h2>
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'USER_ID')->input('text',['readonly'=>'true']) ?>
            <?= $form->field($model, 'PHONE')->input('text') ?>
            <?= $form->field($model, 'FIRST_NAME')->input('text') ?>
            <?= $form->field($model, 'LAST_NAME')->input('text') ?>
            <?= $form->field($model, 'EMAIL')->input('text') ?>
            <?= $form->field($model, 'GENDER')->input('text') ?>
            <?= $form->field($model, 'BIRTH_DATE')->input('text') ?>
            <?= $form->field($model, 'PASSWORD')->input('text') ?>
            <?= $form->field($model, 'USER_PICTURE')->input('text') ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-6">
            <h2>Reviews:</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>DATE</th>
                    <th>COMMENT</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($reviews)){ ?>
                <?php foreach ($reviews as $review): ?>
                <tr>
                    <td><?=$review['DATE'];?></td>
                    <td><?=$review['COMMENT'];?></td>
                </tr>
                <?php endforeach; ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
