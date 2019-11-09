<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="regular-page clear-filter page-header-small">
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 border-left border-right">

                <h1><?= Html::encode($this->title) ?></h1>

                <p>Please fill out the following fields to signup:</p>


                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

<!--                        --><?//= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <div class="form-group">
                            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
