<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="   border my-1 p-3 ">

    <div class="row">
        <div class="col-md-2 col-sm-3 border-right">
            <?= $this->render('../site/_menu') ?>
        </div>
        <div class="col-md-10 col-sm-9">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--                --><?//= Html::a('Delete', ['delete', 'id' => $model->id], [
//                    'class' => 'btn btn-danger',
//                    'data' => [
//                        'confirm' => 'Are you sure you want to delete this item?',
//                        'method' => 'post',
//                    ],
//                ]) ?>
            </p>


            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
//            'uri',
                    'import_id',
                    'description',
                    'purchase_price:currency',
                    'regular_price:currency',
                    'sale_price:currency',
                    [
                        'attribute' => 'images',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $out = \yii\bootstrap4\Html::beginTag('div',['id'=>'goodsImages']);
                            if ($model->images):
                                foreach ($model->images as $image):
                                    $out.=Html::img($image,['style'=>'height: 130px']);
                                endforeach;
                            endif;
                             $out.= \yii\bootstrap4\Html::endTag('div');
//                             $out.= '<br>'.Html::a('Delete');
                            return $out;
                        }
                    ],
            [
                    'attribute'=>'category_id',
//                    'format'=>'raw',
                    'value'=>$model->category ? $model->category->title : null
            ],
            'brand',
            'model',
            'fuel',
            'engine_type',
            'add_info',
            'oem_exchange',
            'engine_capacity',
                    [
                        'attribute' => 'holdingcharge_id',
                        'format' => 'raw',
                        'value' => isset($depositCodes[$model->holdingcharge_id]) ? $depositCodes[$model->holdingcharge_id]  : null

                    ],
                    [
                        'attribute' => 'extra_shipping_id',
                        'format' => 'raw',
                        'value' => isset($shippingCodes[$model->extra_shipping_id]) ? $shippingCodes[$model->extra_shipping_id]  : null

                    ],
            'engine_power',

                    [
                        'attribute'=>'part_number_list',
//                    'format'=>'raw',
                        'value'=> join(', ',$model->part_number_list )
                    ],
                    [
                        'attribute'=>'comparison_number_list',
//                    'format'=>'raw',
                        'value'=> join(', ',$model->comparison_number_list )
                    ],
//            'sku',
            'stock_status:boolean',
//            'tax_status',
                    [
                        'attribute'=>'status',
//                    'format'=>'raw',
                        'value'=> $model::$_status[$model->status]
                    ],
//            'category_string',
            'years_string',
                    [
                        'label'=>'Years',
//                    'format'=>'raw',
                        'value'=> join(', ', \yii\helpers\ArrayHelper::map($model->years, 'year','year'))
                    ],
//            'tax_id',
//            'use_holdingcharge:boolean',
                ],
            ]) ?>

        </div>
    </div>
</div>
