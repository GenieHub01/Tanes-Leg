<?php
?>
<?php if( Yii::$app->session->hasFlash('pay_seccess') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('pay_seccess'); ?>
    </div>
<?php endif;?>
<?php if( Yii::$app->session->hasFlash('pay_error') ): ?>
    <div class="alert alert-alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('pay_seccess'); ?>
    </div>
<?php endif;?>
<div class="row">
    <div class="col-sm-2">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-sm-10">
        <? if ($models): ?>

            <? foreach ($models as $model): ?>
                <div class="d-flex m-3 p-3  border-bottom">
                    <div class="px-3">
                        <span class="badge-info"><?= Yii::$app->formatter->asDate($model->created_ts) ?></span>
                    </div>
                    <div class="px-3">
                        <?= Yii::$app->formatter->asCurrency($model->total_sum) ?>
                    </div>
                    <div class="px-3">
                        <?= \yii\helpers\Html::a('link',$model->url) ?>
                    </div>
                    <div class="px-3">
                        <?php if  ($model->status == 1 || $model->status == 2) {
                          echo $model::$_status[$model->status] . '&nbsp;&nbsp;'
                         . \yii\helpers\Html::a('Pay with WorldPay',$model->url);
                         }?>
                         <?php if  ($model->status == 10 && $model->created_ts > time() - 30*24*60*60) {
                          echo $model::$_status[$model->status] . '&nbsp;&nbsp;'
                         . \yii\helpers\Html::a('Refund', $model->url);
                         }?>
                    </div>
                </div>
            <? endforeach; ?>
        <? else: ?>

            <h5>You haven't orders yet.</h5>

        <? endif; ?>
    </div>
</div>
