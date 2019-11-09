<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html; ?>

<div class="row">
    <div class="col-sm-2">
        <?= $this->render('../orders/_menu') ?>
    </div>
    <div class="col-sm-10">


        <?php $form = ActiveForm::begin(['id' => 'newOrder']); ?>

        <h5>Main information</h5>
        <?= $form->field($model,'username') ?>
        <?= $form->field($model,'first_name') ?>
        <?= $form->field($model,'last_name') ?>

        <h5>Shipping Address</h5>
        <?= $form->field($model,'country_id')->dropDownList(\common\models\Countries::getList()) ?>
        <?= $form->field($model,'shipping_address') ?>
        <?= $form->field($model,'shipping_address_optional')->textarea() ?>
        <?= $form->field($model,'shipping_city') ?>
        <?= $form->field($model,'shipping_postcode') ?>
        <?= $form->field($model,'shipping_phone') ?>


        <h5>Security <small>Dont touch, if you don't want edit it.</small></h5>
        <?= $form->field($model,'email') ?>
        <?= $form->field($model,'password')->passwordInput() ?>


        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
