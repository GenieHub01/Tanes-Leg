<?php
/**
 * @var $order \frontend\models\Order
 */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

?>


<div class="  border border-info  p-3 y-3 " style="min-height: 75vh">


    <?if (count($items) <> 0){?>
    <h5>Cart (<?= count($items) ?>)</h5>
    <? if ($items): ?>

        <? foreach ($items as $key => $count): ?>

            <? if (isset($models[$key])) : ?>

                    <? $model = $models[$key]; ?>

                    <?= $this->render('_cart_view', ['model' => $model, 'count' => $count,'key'=>$key]) ?>


            <? else: ?>
                <div class="d-flex   border-info border-bottom py-2 justify-content-between">
                    <div>Some problem with this Product. Its no longer available.</div>
                </div>
            <? endif; ?>

        <? endforeach; ?>

    <? endif; ?>

    <div class="d-flex justify-content-end my-2">
        <div class="w-50">
<!--            --><?//$sum =Yii::$app->cart->sum ?>
<!--            --><?//$tax =Yii::$app->cart->tax ?>
<!--            --><?//= \yii\helpers\Html::a('Proceed To Checkout',['/cart/order'],['class'=>'btn btn-sm btn-primary float-right']) ?>
            <div>
                Subtotal: <span id="subTotal" class="subTotal"><?= Yii::$app->formatter->asCurrency(Yii::$app->cart->subAmount) ?></span>
            </div>
            <div>
                Holding Deposit: <span class="holdingDeposit"><?= Yii::$app->formatter->asCurrency(Yii::$app->cart->subHoldingDeposit) ?></span>
            </div>
            <div>
                Tax: <span class="taxAmount"><?=Yii::$app->formatter->asCurrency(Yii::$app->cart->taxAmount)?></span>
            </div>


            <div>
                Shipping: <span  class="shippingAmount" id="shippingAmount"><?= Yii::$app->formatter->asCurrency(Yii::$app->cart->shippingAmount) ?></span> <?=  (Yii::$app->cart->extraShippingAmount>0) ? '<span class="extraShipping" id="extraShipping">*</span>' : '<span class="extraShipping" id="extraShipping" style="display: none;">*</span>' ?>
            </div>
            <div>
                Total: <span id="cartTotal" class="cartTotal"><?= Yii::$app->formatter->asCurrency(Yii::$app->cart->shippingAmount + Yii::$app->cart->totalAmount) ?></span>
            </div>
            <div class="promocodeBlock   border  border-warning p-2" <?= Yii::$app->cart->promocode ? '' : 'style="display: none" '?>  >
                After Applied Promocode: <span class="promocodeTotal" id="promocodeTotal"><?= Yii::$app->cart->promocode ? \Yii::$app->formatter->asCurrency(Yii::$app->cart->getPromoTotal() + Yii::$app->cart->getShippingAmount()) : '' ?></span> <span id="promocodeDesc" class="promocodeDesc"><?= Yii::$app->cart->promocode ? Yii::$app->cart->promocode->desc : '' ?></span>
            </div>
            <br>
            <br>

            <?php $form = ActiveForm::begin(['id' => 'promocodeApply','action'=>'/cart/promocode-apply']); ?>
            Do you have Promocode?
            <div class="d-flex">
                <?= Html::textInput('promocode',Yii::$app->cart->promocode ? Yii::$app->cart->promocode->code : null,['class'=>'form-control','placeholder'=>'Promocode']) ?>
                <?= Html::submitButton('Apply',['class'=>'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>


        </div>

    </div>


    <div class="newOrder">
        <h5>Proceed To Checkout</h5>
        <?php $form = ActiveForm::begin(['id' => 'newOrder']); ?>

        <?= $form->field($order,'first_name') ?>
        <?= $form->field($order,'last_name') ?>
        <?= $form->field($order,'company_name') ?>
        <?= $form->field($order,'note')->textarea() ?>
        <?= $form->field($order,'country_id')->dropDownList(\common\models\Countries::getList(),['prompt'=>'-- Country --' ]) ?>
        <?= $form->field($order,'address') ?>
        <?= $form->field($order,'address_optional') ?>
        <?= $form->field($order,'city') ?>
        <?= $form->field($order,'postcode') ?>
        <?= $form->field($order,'promocode') ?>
        <?= $form->field($order,'phone') ?>
        <?= $form->field($order,'email') ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <?}else {?>
        <h5>Cart is empty</h5>
    <?}?>
      

</div>


<?
$js = <<<JS
$('#promocodeApply').on('beforeSubmit', function () {
        var form = jQuery(this);
        jQuery.get(
            form.attr("action"),
            form.serialize()
        )
            .done(function (respond) { 
                
                    // data is saved
                    $.growl({ title: "Success", message: "Promocode applied!" });
                     // $('#id' + respond.id).replaceWith(respond.html);
                     updateCartCount(respond.cart.count);
                    updateCartLine(respond.item);
                    updateCart(respond.cart);
                 $('#order-promocode').val(respond.cart.promocode.code);
            })
            .fail(function (xhr, status, error) {
                showError(xhr, status, error);
            });
        return false;
    });

JS;
$this->registerJs($js, \yii\web\View::POS_READY);

?>
