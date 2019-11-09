<?php

/* @var $this yii\web\View */

$this->title = 'Index';
?>
<div class="  border border-info p-3 y-3 ">
        <h1 class="text-center">Choose your's engine heart!</h1>


    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="d-flex">
                <div class="w-25">
                    <?= \yii\helpers\Html::dropDownList('brand',null,$brandList,['class'=>'form-control','prompt'=>'-- Brand --']) ?>
                </div>
                <div class="w-25">
                    <?= \yii\helpers\Html::dropDownList('model',null,$brandList,['class'=>'form-control','disabled'=>'disabled','prompt'=>'-- Model --']) ?>
                </div>
                <div >
                    <?= \yii\helpers\Html::dropDownList('capacity',null,$brandList,['class'=>'form-control','disabled'=>'disabled','prompt'=>'-- Engine Capacity --']) ?>
                </div>

                <div>
                    <?= \yii\helpers\Html::dropDownList('year',null,$brandList,['class'=>'form-control','disabled'=>'disabled','prompt'=>'-- Year --']) ?>
                </div>
                <div>
                    <?= \yii\helpers\Html::dropDownList('fuel',null,$brandList,['class'=>'form-control','disabled'=>'disabled','prompt'=>'-- Fuel --']) ?>
                </div>
                <div class="w-25">
                    <?= \yii\helpers\Html::dropDownList('product',null,$brandList,['class'=>'form-control','disabled'=>'disabled','prompt'=>'-- Product --']) ?>
                </div>
            </div>
            <div class="d-flex-my-3">
                <?= \yii\helpers\Html::a('Show','#',['id'=>'showproduct','class'=>'float-right btn btn-primary']) ?>
            </div>
        </div>
    </div>

</div>
<div style="height:75vh"></div>