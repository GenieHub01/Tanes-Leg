<?php
/**
 * @var $model \backend\models\Order
 */

$this->title = 'View Order';

use yii\helpers\Html;

$hc = 0;
$sub = 0;
if ($model->orderItems):
    foreach ($model->orderItems as $item):
        $sub += $item->price * $item->count;
        if ($item->holding_charge) {
            $hc += $item->holding_charge * $item->count;

        }

    endforeach;
endif;
?>


    <div class="   border my-1 p-3 ">

        <div class="row">
            <div class="col-md-2 col-sm-3 border-right">
                <?= $this->render('../site/_menu') ?>
            </div>
            <div class="col-md-10 col-sm-9">
                <h5>View Order <?= $model->id ?></h5>
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



                <?= \yii\widgets\DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        [
                                'label'=>'Name',
                            'value'=>$model->first_name.' '.$model->last_name
                        ],
//                        'first_name',
//                        'last_name',
                        'company_name',
                        'note',
                        'admin_note',
                        [
                            'attribute' => 'country_id',
                            'value' => $model->country->title
                        ],
                        'address',

                        'address_optional',
                        'city',
                        'postcode',
                        'phone',
                        'email:email',
                        [
                            'label'=>'Holding Deposit',
                            'format'=> 'currency',
                            'value'=>$hc
                        ],
                        'total_sum:currency',
                        'total_sum_discount:currency',
                        'shipping_cost:currency',
//                        'promocodes_id',
                        [
                                'attribute'=>'promocodes_id',
                            'value'=>$model->promocode ? $model->promocode->code : null
                        ],
                        'created_ts:datetime',
                        'updated_ts:datetime',
                         [
                                'label'=>'total with shipping',
                            'format'=>'currency',
                            'value'=>   $model->total_sum + $model->shipping_cost
                        ],
                        [
                            'label'=>'total with shipping after discount',
                            'format'=>'currency',
                            'value'=> $model->total_sum_discount > 0  ? $model->total_sum_discount + $model->shipping_cost : null
                        ],

                        [
                                'attribute'=>'status',
                            'value'=>$model::$_status[$model->status]
                        ]
//                        'user_id',
                    ],
                ]) ?>
                <div class="d-flex p-3 flex-column border-bottom ">
                    <?if ($model->orderItems):?>
                        <?foreach ($model->orderItems as $item):?>

                            <div class="mt-2 border-bottom border-warning">
                                <div class="d-flex ">
                                <?=  $item->goods->title?> | <?= Yii::$app->formatter->asCurrency($item->price) ?> | Count: <?= Yii::$app->formatter->asInteger($item->count)?> | Sum: <?= Yii::$app->formatter->asCurrency($item->price* $item->count) ?>
                            </div>
                                <? if ($item->holding_charge): ?>

                                    <div class="d-flex">
                                        Holding charge for <?= $item->goods->title ?>
                                        | <?= Yii::$app->formatter->asCurrency($item->holding_charge) ?> |
                                        Count: <?= Yii::$app->formatter->asInteger($item->count) ?> |
                                        Sum: <?= Yii::$app->formatter->asCurrency($item->holding_charge * $item->count) ?>
                                    </div>

                                <? endif; ?>
                            </div>
                        <?endforeach;?>
                    <?endif;?>

                </div>


            </div>

        </div>





    </div>



