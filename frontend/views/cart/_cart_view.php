<div id="cartItem_<?=$model->id?>">

<div class="d-flex   border-info border-secondary py-2 justify-content-between" >
    <div class="w-50"><?= \yii\helpers\Html::a($model->title,$model->url) ?></div>

    <div class="w-25"><span
            class="badge badge-info"><?= $count ?> x <?= Yii::$app->formatter->asCurrency($model->price) ?> = <?= Yii::$app->formatter->asCurrency($count * $model->price) ?> <?//= $model->tax ? "(incl. tax ". Yii::$app->formatter->asCurrency($model->tax).")" :''?></span>
    </div>
    <div class="w-25">
        <?= \yii\helpers\Html::a('<i class="fas fa-plus"></i>', '#', ['class' => 'btn btn-sm btn-primary float-right cart-plus-item', 'data-id' => $model->id]) ?>
        <?= \yii\helpers\Html::a('<i class="fas fa-minus"></i>', '#', ['class' => 'btn btn-sm btn-danger float-right cart-minus-item', 'data-id' => $model->id]) ?>
    </div>

</div>

<?if ($model->virtualItem):?>

    <div class="d-flex   border-info border-bottom py-2 justify-content-between" id="virtualItem_<?=$model->id?>">
        <div class="w-50"><?= \yii\helpers\Html::a('Holding Charge for '.$model->title,$model->url) ?></div>

        <div class="w-25"><span
                    class="badge badge-info"><?= $count ?> x <?= Yii::$app->formatter->asCurrency($model->virtualItem['price']) ?> = <?= Yii::$app->formatter->asCurrency($count * $model->virtualItem['price']) ?>
<!--                --><?//= $model->virtualItem['tax'] ? "(incl. tax ".Yii::$app->formatter->asCurrency($model->virtualItem['tax']).")" :''?>
            </span>
        </div>
        <div class="w-25">

        </div>

    </div>
<?endif;?>


</div>