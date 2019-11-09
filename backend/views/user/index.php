<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class=" user-index  border my-1 p-3 ">

    <div class="row">
        <div class="col-md-2 col-sm-3 border-right">
            <?= $this->render('../site/_menu') ?>
        </div>
        <div class="col-md-10 col-sm-9">
            <h1><?= Html::encode($this->title) ?></h1>

            <!--            <p>-->
            <!--                --><? //= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
            <!--            </p>-->

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
//                    'auth_key',
//                    'password_hash',
//                    'password_reset_token',
                    'first_name',
                    'last_name',
                    'email:email',

                    [
                        'attribute' => 'created_at',
                        'format' => 'date',
                        'filter' => false
                    ],
//                    'updated_at:datetime',
                    //'verification_token',
                    //'token',
                    [
                        'attribute' => 'role',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model::$_role[$model->role];
                        },
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'role',
                            \common\models\User::$_role,
                            ['class' => 'form-control', 'prompt' => '-- All --']
                        )
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model::$_status[$model->status];
                        },
                        'filter' => Html::activeDropDownList(
                            $searchModel,
                            'status',
                            \common\models\User::$_status,
                            ['class' => 'form-control', 'prompt' => '-- All --']
                        )
                    ],

                    //'shipping_address',
                    //'shipping_address_optional',
                    //'shipping_city',
                    //'shipping_postcode',
                    //'shipping_phone',
                    //'username',

                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view}  {update}  ',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                $customurl = Yii::$app->getUrlManager()->createUrl(['/user/view', 'id' => $model['id']]);
                                return \yii\helpers\Html::a('<i class="far fa-eye "></i>', $customurl,
                                    ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                            },
                            'update' => function ($url, $model) {
                                $customurl = Yii::$app->getUrlManager()->createUrl(['/user/update', 'id' => $model['id']]);
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
