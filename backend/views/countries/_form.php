<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Countries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="countries-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shortcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tax_id')->dropDownList($taxCodes,['prompt'=>'Select TAX CODE']) ?>

    <?= $form->field($model, 'shipping_id')->dropDownList($shippingCodes,['prompt'=>'Select shipping CODE']) ?>

<!--    --><?//= $form->field($model, 'created_ts')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
