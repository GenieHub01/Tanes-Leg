<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Countries */

$this->title = 'Create Countries';
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="   border my-1 p-3 ">

    <div class="row">
        <div class="col-md-2 col-sm-3 border-right">
            <?= $this->render('../site/_menu') ?>
        </div>
        <div class="col-md-10 col-sm-9">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'taxCodes'=>$taxCodes,
        'shippingCodes'=>$shippingCodes
    ]) ?>

</div>
</div>
</div>
