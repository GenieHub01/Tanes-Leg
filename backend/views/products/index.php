<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SearchGoods */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="   border my-1 p-3 ">

    <div class="row">
        <div class="col-md-2 col-sm-3 border-right">
            <?= $this->render('../site/_menu') ?>
        </div>
        <div class="col-md-10 col-sm-9">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'title',
//                    'uri',
                    'import_id',
//                    'description',
                    //'purchase_price',
                    //'regular_price',
                    //'sale_price',
                    //'images',
//                    'category_id',
                    [
                        'attribute' => 'category_id',
                        'format' => 'raw',
                        'value' => function ($model) use ($categories) {
                            return  isset($categories[$model->category_id]) ? $categories[$model->category_id]  : null;
                        },
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'category_id',
                            $categories,
                            ['class' => 'form-control', 'prompt' => '-- All --']
                        )
                    ],
                    'brand',
                    'model',
                    [
                        'attribute' => 'fuel',
                        'format' => 'raw',
                        'value' => function ($model)  {
                            return  isset($model::$_fuel[$model->fuel]) ? $model::$_fuel[$model->fuel]  : null;
                        },
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'fuel',
                            $searchModel::$_fuel,
                            ['class' => 'form-control', 'prompt' => '-- All --']
                        )
                    ],
                    'engine_type',

                    [
                        'attribute' => 'holdingcharge_id',
                        'format' => 'raw',
                        'value' => function ($model) use ($depositCodes) {
                            return  isset($depositCodes[$model->holdingcharge_id]) ? $depositCodes[$model->holdingcharge_id]  : null;
                        },
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'holdingcharge_id',
                            $depositCodes,
                            ['class' => 'form-control', 'prompt' => '-- All --']
                        )
                    ],
                    [
                        'attribute' => 'extra_shipping_id',
                        'format' => 'raw',
                        'value' => function ($model) use ($shippingCodes) {
                            return  isset($shippingCodes[$model->extra_shipping_id]) ? $shippingCodes[$model->extra_shipping_id]  : null;
                        },
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'extra_shipping_id',
                            $shippingCodes,
                            ['class' => 'form-control', 'prompt' => '-- All --']
                        )
                    ],
                    //'add_info',
                    //'oem_exchange',
                    //'engine_capacity',
                    //'engine_power',
                    //'part_number_list',
                    //'comparison_number_list',
                    //'sku',
                    //'stock_status',
                    //'tax_status',
                    //'status',
                    //'category_string',
                    //'years_string',
                    //'tax_id',
                    //'use_holdingcharge',

                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view}  {update}  ',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                $customurl = Yii::$app->getUrlManager()->createUrl(['/products/view', 'id' => $model['id']]);
                                return \yii\helpers\Html::a('<i class="far fa-eye "></i>', $customurl,
                                    ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                            },
                            'update' => function ($url, $model) {
                                $customurl = Yii::$app->getUrlManager()->createUrl(['/products/update', 'id' => $model['id']]);
                                return \yii\helpers\Html::a('<i class="far fa-edit "></i>', $customurl,
                                    ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                            },
//                            'delete'=>function ($url, $model) {
//                                $customurl=Yii::$app->getUrlManager()->createUrl(['/user/delete','id'=>$model['id'] ]);
//                                return \yii\helpers\Html::a( '<i class="fas fa-trash "></i>', $customurl,
//                                    ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
//                            }
                        ],
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>
