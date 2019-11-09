<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-md-6">
            <h5>General info</h5>
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList($model::$_status) ?>

            <?= $form->field($model, 'role')->dropDownList($model::$_role) ?>
        </div>
        <div class="col-md-6">
            <h5>Shipping information</h5>
            <?= $form->field($model,'country_id')->dropDownList(\common\models\Countries::getList(),['prompt'=>'-- Select --']) ?>
            <?= $form->field($model, 'shipping_address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'shipping_address_optional')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'shipping_city')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'shipping_postcode')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'shipping_phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


<!--    --><?//= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
