<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uri')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'import_id')->textInput()->hint('Used in import. Do not touch.') ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'purchase_price')->textInput(['maxlength' => true])->hint('System price') ?>

    <?= $form->field($model, 'regular_price')->textInput(['maxlength' => true])->hint('Price for product.') ?>

    <?= $form->field($model, 'sale_price')->textInput(['maxlength' => true])->hint('Field not currently used.') ?>
    <?= $form->field($model, 'holdingcharge_id')->dropDownList($depositCodes,['prompt'=>'-- Select -- ']) ?>
    <?= $form->field($model, 'extra_shipping_id')->dropDownList($shippingCodes,['prompt'=>'-- Select -- ']) ?>

<!--    --><?//= $form->field($model, 'images')->textInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList(\common\models\Category::getDropDownArray()) ?>
 
    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>
 
    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fuel')->textInput() ?>

    <?= $form->field($model, 'engine_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'add_info')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oem_exchange')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'engine_capacity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'engine_power')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'part_number_list')->textInput() ?>
    <?echo $form->field($model, 'part_number_list')->widget(Select2::classname(), [
//    'data' => $data,
    'options' => ['placeholder' => '', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'tokenSeparators' => [',', ' '],
//        'maximumInputLength' => 10
    ],
]) ;?>

    <?echo $form->field($model, 'comparison_number_list')->widget(Select2::classname(), [
//    'data' => $data,
        'options' => ['placeholder' => '', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
//        'maximumInputLength' => 10
        ],
    ]) ;?>


    <?echo $form->field($model, 'yearsArray')->widget(Select2::classname(), [
//    'data' => $data,
        'options' => ['placeholder' => '', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
//        'maximumInputLength' => 10
        ],
    ]) ;?>
<!--    --><?//= $form->field($model, 'comparison_number_list')->textInput() ?>

    <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stock_status')->checkbox() ?>

<!--    --><?//= $form->field($model, 'tax_status')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(\common\models\Goods::$_status) ?>

    <?= $form->field($model,'images')->widget(\common\widgets\uploader\ImagesUploadWidget::class,[
        'images'=>$model->images
    ]  ) ?>
<!--    --><?//= $form->field($model, 'category_string')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'years_string')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
