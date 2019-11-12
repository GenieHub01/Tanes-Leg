<?php
/**
 * @var $model \frontend\models\Goods
 */?>


<div class="row">
    <div class="col">
        <h1><?= $model->title ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?if ($model->images):?>
            <?foreach ($model->images as $image):?>
                <?= \yii\helpers\Html::img($image,['class'=>'img-fluid']) ?>
            <?endforeach;?>
        <?endif;?>



    </div>

    <div class="col-md-6">
        <? if (Yii::$app->user->isGuest): ?>

            <div class="alert alert-warning">
                You must login or sign up to make a purchase
            </div>

        <? else: ?>

            <?= \yii\helpers\Html::a('Add to CART','#',['class'=>'btn btn-primary add_to_cart ','data-id'=>$model->id])  ?>

        <? endif; ?>

        <div class="row">
            <div class="col-sm-6">
                <p>QTY:<? echo \kartik\widgets\TouchSpin::widget([
                        'id'=>'qty',
                        'class'=>'2',
                        'name' => 'qty',
                        'value'=>1,
                        'options' => ['class' => ' 1'],
                        'pluginOptions' => [
                            'class'=>'2',
                            'buttonup_class' => 'btn-sm btn-primary',
                            'buttondown_class' => 'btn-sm btn-info',
                            'buttonup_txt' => '<i class="fas fa-plus"></i>',
                            'buttondown_txt' => '<i class="fas fa-minus"></i>'
                        ]
                    ]);?></p>
            </div>
        </div>


        <p>Category: <?= $model->category_string ?></p>
        <p>Price: <?= Yii::$app->formatter->asCurrency($model->price) ?> </p>
<!--        <p>Tax:  --><?//= Yii::$app->formatter->asCurrency($model->tax) ?><!-- </p>-->
         <?php if ($model->virtualItem):?>
            <p>Holding charge: <?= Yii::$app->formatter->asCurrency($model->virtualItem['price']) ?>  </p>

        <?php endif; ?>
        <p>Description: <?= $model->description ?></p>
        <p>Brand: <?= $model->brand ?></p>
        <p>Model: <?= $model->model ?></p>
        <p>Fuel: <?= $model->fuel ?></p>
        <p>Engine type: <?= $model->engine_type ?></p>
        <p>Additional information: <?= $model->add_info ?></p>
        <p>OEM excahne: <?= $model->oem_exchange ?></p>
        <p>Engine capacity: <?= $model->engine_capacity ?></p>
        <p>Engine power: <?= $model->engine_power ?></p>
        <? if ($model->part_number_list): ?>
            <p>Part number list: <?= join(',',$model->part_number_list) ?></p>
        <? endif; ?>
        <? if ($model->comparison_number_list): ?>
            <p>Comparison number list: <?= join(',',$model->comparison_number_list) ?></p>
        <? endif; ?>
    </div>
</div>
