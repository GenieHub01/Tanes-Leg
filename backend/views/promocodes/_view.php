<?php


?>

<div class="p-3 my-2 border">
    <div>
        <span class="float-right badge badge-info"><?= Yii::$app->formatter->asText($model::$_status[$model->status]) ?></span>
        <a href="<?= \yii\helpers\Url::to(['/promocodes/view','id'=>$model->id]) ?>">
            <span class="badge badge-info"><?= $model->code ?></span>, until <?= Yii::$app->formatter->asDate($model->end_date) ?>
        </a>
    </div>

    <div>
        <?= $model->percent ? "Percent discount: ".Yii::$app->formatter->asPercent($model->percent/100).' | ' : '' ?>
        <?= $model->sum ? "Sum discount: ".Yii::$app->formatter->asCurrency($model->sum).' | ' : '' ?>
    </div>

</div>
