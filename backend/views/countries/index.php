<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SearchCountries */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
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
                    'shortcode',
//                    'tax_id',
                    [
                        'attribute' => 'tax_id',
                        'format' => 'raw',
                        'value' => function ($model) use ($taxCodes) {
                            return  isset($taxCodes[$model->tax_id]) ? $taxCodes[$model->tax_id]  : null;
                        },
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'tax_id',
                            $taxCodes,
                            ['class' => 'form-control', 'prompt' => '-- All --']
                        )
                    ],
                    [
                        'attribute' => 'shipping_id',
                        'format' => 'raw',
                        'value' => function ($model) use ($shippingCodes) {
                            return  isset($shippingCodes[$model->shipping_id]) ? $shippingCodes[$model->shipping_id]  : null;
                        },
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'shipping_id',
                            $shippingCodes,
                            ['class' => 'form-control', 'prompt' => '-- All --']
                        )
                    ],
//                    'shipping_id',
//                    'tax:integer',
//                    'shipping:currency',
                    //'created_ts',

                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view}  {update}  ',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                $customurl = Yii::$app->getUrlManager()->createUrl(['/countries/view', 'id' => $model['id']]);
                                return \yii\helpers\Html::a('<i class="far fa-eye "></i>', $customurl,
                                    ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                            },
                            'update' => function ($url, $model) {
                                $customurl = Yii::$app->getUrlManager()->createUrl(['/countries/update', 'id' => $model['id']]);
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
