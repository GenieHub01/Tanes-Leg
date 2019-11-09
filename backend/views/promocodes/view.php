<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Promocodes */

$this->title = 'Promocode '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Promocodes', 'url' => ['/promocodes/index']];
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
                <?= Html::a('Update', ['/promocodes/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['/promocodes/delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Be careful with deleting. You can set - Inactive status.',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'code',
                    'start_date:date',
                    'end_date:date',
                    'percent',
                    'created_ts:date',
                    'updated_ts:date',
                    'sum:currency',
                    'minorder_sum:currency',
                    [
                            'attribute'=>'status',
                        'value'=> isset(\common\models\Promocodes::$_status[$model->status]) ? \common\models\Promocodes::$_status[$model->status] :null
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>
