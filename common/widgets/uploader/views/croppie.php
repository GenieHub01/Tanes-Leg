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



<div id="uploader<?= $widget->id ?>" class="croppie" data-prefixid="<?= Html::getInputId($model,'photo')?>" data-paramname="<?= $model->formName() ?>">

    <p id="msgBox" class="msgBox"></p>
    <p id="progressBar" class="progressBar"></p>
    <p id="progressOuter" class="progressOuter"></p>


    <div id="croppie" class=" ">


    <div class="d-flex" style=" ">
        <div class="w-50">
            <?= Html::a('<i class="fa fa-plus"></i> Upload New', '#', ['class' => 'img-uploader ']); ?>
        </div>
<!--        <div class="w-50">-->
<!--            --><?//= Html::a('Delete Image', '#', ['class' => 'pull-right']) ?>
<!--        </div>-->
    </div>
    <div class="row    " style=" ">
        <div class="col">
            <? echo Html::tag('div', '', $widget->options); ?>
        </div>
    </div>
    <?= $model->hasAttribute('croppieData') ? Html::activeHiddenInput($model, 'croppieData',['class'=>"input-croppiedata"]) : ''; ?>
    <?= $model->hasAttribute('croppie') ? Html::activeHiddenInput($model, 'croppie',['class'=>"input-croppie"]) : ''; ?>
    <?= $model->hasAttribute('photo') ? Html::activeHiddenInput($model, 'photo') : ''; ?>
    <div class="row">
        <div class="col">

            <div class="help-block">
<!--                --><?//= $model->hasAttribute('croppieData') ? Html::error($model, 'croppieData') : '' ?>
            </div>
            <div class="help-block"> <?= Html::error($model, $widget->attribute) ?></div>
        </div>
    </div>
    <div class="row">
<!--        <div class="col-md-4">-->
<!--            <a class="croppie-rotate " data-deg="-90">Rotate Left</a>-->
<!--        </div>-->
        <div class="col-md-4">
            <a href="#" class="croppie-save <?=$widget->forceSubmit ? 'forcesubmit' : '' ?>"><?=$widget->forceSubmit ? 'Save' : 'Crop' ?></a>
        </div>
<!--        <div class="col-md-4">-->
<!--            <a class="croppie-rotate pull-right" data-deg="90">Rotate Right</a>-->
<!--        </div>-->
    </div>
    </div>

    <div id="croppie-result" class="hidden">
        <img src="<?= $model->croppie ?>" class="img-fluid circle" alt="">

        <div class="text-center">
            <a href="#" class="croppie-edit">Edit</a>

        </div>
    </div>

    <!--        <a class="vanilla-result">Result</a>-->


</div>
