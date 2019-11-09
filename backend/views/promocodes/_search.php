<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\Promocodes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promocodes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'id') ?>

            <?= $form->field($model, 'code') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList($model::$_status) ?>

            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>

            </div>
        </div>
    </div>




<!--    --><?//= $form->field($model, 'start_date') ?>
<!--    --><?//= $form->field($model, 'end_date') ?>

<!--    --><?//= $form->field($model, 'percent') ?>

    <?php // echo $form->field($model, 'created_ts') ?>

    <?php // echo $form->field($model, 'updated_ts') ?>

    <?php // echo $form->field($model, 'sum') ?>

    <?php // echo $form->field($model, 'minorder_sum') ?>



    <?php ActiveForm::end(); ?>

</div>
