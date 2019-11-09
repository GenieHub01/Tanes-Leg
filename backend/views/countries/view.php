<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Countries */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="   border my-1 p-3 ">

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
                    'title',
                    'shortcode',
                    [
                        'attribute' => 'tax_id',
                        'format' => 'raw',
                        'value' => isset($taxCodes[$model->tax_id]) ? $taxCodes[$model->tax_id]  : null

                    ],
                    [
                        'attribute' => 'shipping_id',
                        'format' => 'raw',
                        'value' => isset($shippingCodes[$model->shipping_id]) ? $shippingCodes[$model->shipping_id]  : null

                    ],
//                    'tax',
//                    'shipping:currency',
                    'created_ts:date',
                ],
            ]) ?>

        </div>
    </div>
</div>
