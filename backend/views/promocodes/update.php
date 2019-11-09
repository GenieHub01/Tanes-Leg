<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Promocodes */

$this->title = 'Update Promocodes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Promocodes', 'url' => ['/promocodes/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['/promocodes/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="   border my-1 p-3 ">

    <div class="row">
        <div class="col-md-2 col-sm-3 border-right">
            <?= $this->render('../site/_menu') ?>
        </div>
        <div class="col-md-10 col-sm-9">
            <p>

                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
