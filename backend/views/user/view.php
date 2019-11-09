<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->first_name . ' ' . $model->last_name;;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class=" user-index  border my-1 p-3 ">

    <div class="row">
        <div class="col-md-2 col-sm-3 border-right">
            <?= $this->render('../site/_menu') ?>
        </div>
        <div class="col-md-10 col-sm-9">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'first_name',
                    'last_name',
                    'email:email',
                    [
                        'attribute'=>'status',
                        'value'=>$model::$_status[$model->status]
                    ],
                    [
                        'attribute'=>'role',
                        'value'=>$model::$_role[$model->role]
                    ],
                    'created_at:datetime',
//                    'updated_at:datetime',
//                    'verification_token',
//                    'token',


                    'shipping_address',
                    'shipping_address_optional',
                    'shipping_city',
                    'shipping_postcode',
                    'shipping_phone',
//                    'username',
                ],
            ]) ?>

            <div class="user-orders">


                <? if ($orders):?>
                    <h5>User's Orders:</h5>
                    <?php foreach ($orders as $order): ?>

                        <div id="id<?=$order->id?>" class="link_view my-1 p-3 border <?= $order::$_statusClass[$order->status] ?>" style="">
                            <div>
                                <?= Html::a(Yii::$app->formatter->asDatetime($order->created_ts),['/orders/view','id'=>$order->id],['class'=>' ']) ?>

                                <div class="float-right">Status: <span class="label label-info"><?=\common\models\Order::$_status[$order->status];?></span></div>

                            </div>
                            <div class="d-flex">
                                <div class="w-50">Total sum: <?= Yii::$app->formatter->asCurrency(100) ?></div>
                                <div class="w-25">Items: <?= Yii::$app->formatter->asInteger(5) ?></div>
<!--                                <div class="w-25">Email: --><?//= Yii::$app->formatter->asEmail($order->email) ?><!--</div>-->
                            </div>
                            <div>

                            </div>

                        </div>
                    <?endforeach;?>
                <?else:?>
                    <h5>User haven't orders.</h5>
                <?endif;?>

            </div>

        </div>
    </div>
</div>
