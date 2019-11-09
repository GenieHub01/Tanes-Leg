<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app','Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regular-page clear-filter page-header-small">
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 border-left border-right">
                <h1><?= Html::encode($this->title) ?></h1>

                <p><?= Yii::t('app','Please fill out the following fields to login:') ?></p>


                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

<!--                --><?//= $form->field($model, 'rememberMe')->checkbox([
//                        'class'=>'check'
//                ]) ?>
                <?= \common\widgets\checkbox\SingleCheckboxWidget::widget([
                    'model' => $model,
                    'attribute' => 'rememberMe'
                ]) ?>


                <div style="color:#999;margin:1em 0">
                   <?=Yii::t('app','If you forgot your password you can')?> <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                    <br>
                    <?=Yii::t('app','Need new verification email?')?> <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                </div>


                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
