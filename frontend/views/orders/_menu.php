<?php


use yii\widgets\Menu;


?>
<?
$items = [

    [
        'label' => Yii::t('app', 'My orders'),
        'url' => ['/orders/index'],
        // 'icon'=>'users',
//        'active'=> Yii::$app->controller->id == 'groups' && !Yii::$app->request->get('type')

    ],


    [
        'label' => Yii::t('app', 'Edit profile'),
        'url' => ['/site/edit-profile'],
        // 'icon'=>'users',
//        'active'=> Yii::$app->controller->id == 'groups' && Yii::$app->request->get('type')== 'my'
    ],

];
?>
<? if (!Yii::$app->user->isGuest): ?>

    <?= Menu::widget([
        'linkTemplate' => '<a href="{url}" class="nav-link">{label}</a>',
        'itemOptions' => ['class' => 'nav-item'],
        'options' => [
            'class' => 'nav flex-column',
        ],
        'items' => $items
    ]) ?>
<? endif; ?>


