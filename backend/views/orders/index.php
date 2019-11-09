<?php
/**
 * @var $models \app\models\Link
 * @var $newCode \app\models\Link
 */

$this->title = 'Dashboard';

use yii\bootstrap4\ActiveForm;

?>


<div class="   border my-1 p-3 ">

    <div class="row">
        <div class="col-md-2 col-sm-3 border-right">
            <?= $this->render('../site/_menu') ?>
        </div>
        <div class="col-md-10 col-sm-9">



            <h5>Orders</h5>

            <?php $form =  ActiveForm::begin([
                'action' => ['/orders/index'],
                'method' => 'get',
            ]); ?>


            <div class="d-flex p-3 border">

                <div class="w-25">
                    <?php echo $form->field($findModel, 'email')->label(false)->textInput(['placeholder'=>'email']) ?>
                </div>

                <div class="w-25">
                    <?php echo $form->field($findModel, 'status')->label(false)->dropDownList(\common\models\Order::$_status,['prompt'=>'-- Select Status --']) ?>
                </div>

                <div class="w-25">
                    <?= \yii\helpers\Html::submitButton('Show', ['class' => ' btn  btn-primary float-right']) ?>
                </div>

            </div>
            <?php ActiveForm::end(); ?>


            <? if ($dataProvider->getModels()): ?>

                <? foreach ($dataProvider->getModels() as $model): ?>
                    <?= $this->render('_view', ['model' => $model]) ?>
                <? endforeach; ?>


                <?= \yii\bootstrap4\LinkPager::widget([
                    'pagination' => $pages,
                ]); ?>



            <? else: ?>
                <div class="border">
                    <h5>You haven't codes. Please, create new one.</h5>
                </div>


            <? endif; ?>
        </div>
    </div>



</div>

