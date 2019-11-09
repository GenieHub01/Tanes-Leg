<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\Promocodes */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promocodes';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="   border my-1 p-3 ">

    <div class="row">
        <div class="col-md-2 col-sm-3 border-right">
            <?= $this->render('../site/_menu') ?>
        </div>
        <div class="col-md-10 col-sm-9">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a('Create', ['/promocodes/create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <hr>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => '_view',
            ]) ?>

            <?php Pjax::end(); ?>

        </div>
    </div>
</div>
