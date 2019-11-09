<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $model common\models\Promocodes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promocodes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->hint('letters, numbers, "_"')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_date')->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATE,
        'ajaxConversion'=>false,
        'widgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]
    ]);?>
    <?= $form->field($model, 'end_date')->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATE,
        'ajaxConversion'=>false,
        'widgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]
    ]); ?>

    <h5>Just fill one:</h5>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'sum')->hint('Value discount')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'percent')->hint('Percent discount')->textInput() ?>
        </div>
    </div>



    <hr>
    <?= $form->field($model, 'minorder_sum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList($model::$_status) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
