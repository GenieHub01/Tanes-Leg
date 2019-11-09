<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 11/4/18
 * Time: 10:12 PM
 * @var $widget \common\widgets\filesupload\ImagesUploadWidget
 */ ?>


<div id="<?= $widget->id ?>" class="images-uploader" data-url="<?= Url::to($widget->uploadUrl) ?>"
     data-paramname="<?= $model->formName() ?>">

    <?= Html::a('<i class="fa fa-plus"></i> Add image', '#', ['class' => 'img-uploader my-3 ','style'=>'z-index:16777280;']); ?>
    <p id="msgBox" class="msgBox"></p>

    <div id="files_block" class="files_block">
<!--        <input type="hidden" name="--><?//= $model->formName() ?><!--[--><?//=$widget->attribute?><!--][]" value="">-->
        <ul class="files-ui">

            <? if ($widget->images): ?>
                <!--            --><? //if ($widget->sorting)?>
                <? foreach ($widget->images as $key=>$image) : ?>
                    <li data-key="<?= isset( $image->id) ? $image->id : $key ?>"  >
                        <div class="img_block">
                            <div class="img"  style="background: url(<?= $image ?>) center no-repeat; background-size: cover; "></div>
                            <div class="shadow">
<!--                                <a href="#" class="revert"></a>-->
<!--                                <a href="#" class="revert_n"></a> <br>-->
<!--                                <a href="#" class="checkbox"></a>-->
                                <a href="#" class="delete"></a>
                            </div>
                            <input type="hidden" name="<?= $model->formName() ?>[<?=$widget->attribute?>][]" value="<?= $image ?>">
                        </div>
                    </li>
                <? endforeach; ?>
            <? endif; ?>
        </ul>
    </div>

<!--    --><?//= $model->hasAttribute('mainPhotoId')  ? Html::activeHiddenInput($model, 'mainPhotoId', ['class' => 'main_image']) : ''; ?>
<!--    --><?//= $model->hasAttribute('main_image')  ? Html::activeHiddenInput($model, 'main_image', ['class' => 'main_image']) : ''; ?>

    <div class="help-block">
<!--        --><?//= $model->hasAttribute('mainPhotoId')  ? Html::error($model, 'mainPhotoId') : '' ?>
<!--        --><?//= $model->hasAttribute('main_image')  ? Html::error($model, 'main_image') : '' ?>
    </div>
    <div class="help-block"> <?= Html::error($model, $widget->attribute) ?></div>


</div>
