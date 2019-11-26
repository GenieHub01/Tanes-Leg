<?php
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;


$hc = 0;
$sub = 0;
if ($model->orderItems):
    foreach ($model->orderItems as $item):
        $sub+=$item->price* $item->count;
        if ($item->holding_charge) {
            $hc += $item->holding_charge * $item->count  ;

        }

    endforeach;
endif;
?>

<div class="row">
    <div class="col-sm-2">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-sm-10">

        <div class="d-flex p-3 border-bottom">
            <?= Html::a('<i class="fas fa-arrow-left"></i> Return to My Orders',['/orders/index'],['class'=>'']) ?>

        </div>

        <div class="d-flex p-3 flex-column border-bottom ">
            <div>№<?=$model->id?></div>
            <div>Status: <?=$model::$_status[$model->status]?></div>
            <div>Time: <?=Yii::$app->formatter->asDatetime($model->created_ts)?></div>
            <div>Sub Total: <?=Yii::$app->formatter->asCurrency($sub)?></div>
            <div>Holding Deposit: <?=Yii::$app->formatter->asCurrency($hc)?></div>

            <div>Tax: <?= Yii::$app->formatter->asCurrency($model->total_tax) ?></div>
            <div>Shipping: <?=Yii::$app->formatter->asCurrency($model->shipping_cost)?></div>
            <div>Total: <?= Yii::$app->formatter->asCurrency($model->total_sum+ $model->shipping_cost) ?></div>

<!--            <div>Total: --><?//= Yii::$app->formatter->asCurrency(($model->total_sum_discount > 0 ? $model->total_sum_discount :( $model->total_sum + $model->shipping_cost )) ) ?><!--</div>-->

            <? if ($model->total_sum_discount > 0): ?>
                <div>Total After Discount: <?=Yii::$app->formatter->asCurrency($model->total_sum_discount + $model->shipping_cost)?></div>
            <?endif;?>


        </div>
        <div class="d-flex p-3 flex-column border-bottom ">
            <?if ($model->orderItems):?>
                <?foreach ($model->orderItems as $item):?>
                    <div class="d-flex">
                        <?=  $item->goods->title?> | <?= Yii::$app->formatter->asCurrency($item->price) ?> | Count: <?= Yii::$app->formatter->asInteger($item->count)?> | Sum: <?= Yii::$app->formatter->asCurrency($item->price* $item->count) ?>
                    </div>
                    <? if ($item->holding_charge): ?>


                        <div class="d-flex">
                            Holding charge for <?=  $item->goods->title?> | <?= Yii::$app->formatter->asCurrency($item->holding_charge) ?> | Count: <?= Yii::$app->formatter->asInteger($item->count)?> | Sum: <?= Yii::$app->formatter->asCurrency($item->holding_charge* $item->count) ?>
                        </div>

                    <? endif; ?>
                <?endforeach;?>
            <?endif;?>

        </div>
        <? if (Yii::$app->user->isGuest): ?>

            <div class="alert alert-warning">
                You must login or sign up to make a purchase
            </div>

        <? else: ?>

            <?php
            $items_month = ['01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12'];
            $items_year =  ['2020'=>'2020','2021'=>'2021','2022'=>'2022','2023'=>'2023','2024'=>'2024','2025'=>'2025'];
            if ($model->status == 1 || $model->status == 2) {
            $form = ActiveForm::begin(['id' => 'Worldpay','action'=>'/payment/worldpay?id=' . $model->id]); ?>
            Credit Card Parameters
            <div class="d-flex">
                <?= Html::hiddenInput('method', 'purchase'); ?>
                <?= Html::textInput('cnumber',  null, ['class'=>'form-control','placeholder'=>'Card Number 16 digits']) ?>
                <?= Html::dropDownList('expiryMonth', 'null', $items_month, ['class'=>'form-control']); ?>
                <?= Html::dropDownList('expiryYear', 'null', $items_year, ['class'=>'form-control']); ?>
                <?= Html::textInput('cvv',  null, ['class'=>'form-control','placeholder'=>'Card CVV 3 digits']) ?>
                <?= Html::submitButton('Pay',['class'=>'btn btn-primary']) ?>
            </div>
            <?php
            } elseif  ($model->status == 10 && $model->created_ts > time() - 30*24*60*60) {
            $form = ActiveForm::begin(['id' => 'Worldpay','action'=>'/payment/worldpay?id=' . $model->id]); ?>
            Order Refund Parameters
            <div class="d-flex">
                <?= Html::hiddenInput('method', 'refund'); ?>
                <?= Html::textInput('number', $model->wp_code, ['class'=>'form-control','placeholder'=>'Order Code']) ?>
                <?= Html::submitButton('Refund',['class'=>'btn btn-primary']) ?>
            </div>
            <?php } ActiveForm::end();?>

        <? endif; ?>

       <p></p>

    </div>
</div>
