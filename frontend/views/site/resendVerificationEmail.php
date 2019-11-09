<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \frontend\models\ResetPasswordForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app','Resend verification email');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regular-page clear-filter page-header-small">
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 border-left border-right">
                <h1><?= Html::encode($this->title) ?></h1>

                <p><?= Yii::t('app','Please fill out your email. A verification email will be sent there.') ?></p>


                <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
