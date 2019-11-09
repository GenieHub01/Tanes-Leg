<?php

use yii\helpers\Url;
use yii\helpers\Html;

/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 11/4/18
 * Time: 10:12 PM
 * @var $widget \app\widgets\filesupload\ImagesUploadWidget
 * @var $model \app\models\Company
 */ ?>


    <div class="row    " style=" ">
        <div class="col-12">
            <? echo Html::tag('div', '', $widget->options); ?>
        </div>
        <div class="col-12">
            <a href="#" class="croppie-save <?=$widget->forceSubmit ? 'forcesubmit' : '' ?>"><?=$widget->forceSubmit ? 'Save' : '' ?></a>
        </div>
    </div>
    <?= $model->hasAttribute('croppieData') ? Html::activeHiddenInput($model, 'croppieData',['class'=>"input-croppiedata"]) : ''; ?>
    <?= $model->hasAttribute('croppie') ? Html::activeHiddenInput($model, 'croppie',['class'=>"input-croppie"]) : ''; ?>
<!--    --><?//= $model->hasAttribute('photo') ? Html::activeHiddenInput($model, 'photo') : ''; ?>
