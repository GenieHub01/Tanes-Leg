<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\SearchGoods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'uri') ?>

    <?= $form->field($model, 'import_id') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'purchase_price') ?>

    <?php // echo $form->field($model, 'regular_price') ?>

    <?php // echo $form->field($model, 'sale_price') ?>

    <?php // echo $form->field($model, 'images') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'brand') ?>

    <?php // echo $form->field($model, 'model') ?>

    <?php // echo $form->field($model, 'fuel') ?>

    <?php // echo $form->field($model, 'engine_type') ?>

    <?php // echo $form->field($model, 'add_info') ?>

    <?php // echo $form->field($model, 'oem_exchange') ?>

    <?php // echo $form->field($model, 'engine_capacity') ?>

    <?php // echo $form->field($model, 'engine_power') ?>

    <?php // echo $form->field($model, 'part_number_list') ?>

    <?php // echo $form->field($model, 'comparison_number_list') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'stock_status') ?>

    <?php // echo $form->field($model, 'tax_status') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'category_string') ?>

    <?php // echo $form->field($model, 'years_string') ?>

    <?php // echo $form->field($model, 'tax_id') ?>

    <?php // echo $form->field($model, 'use_holdingcharge') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
