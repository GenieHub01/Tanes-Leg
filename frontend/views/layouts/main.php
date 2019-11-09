<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

?>
<? unset($this->assetBundles['yii\bootstrap\BootstrapAsset']);?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="icon" type="image/png" href="/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?=  Yii::$app->name.' - '.Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body class="index-page sidebar-collapse">
<?php $this->beginBody() ?>
<div class="wrapper" >
    <?= $this->render('_top_menu',[
          'options'=>[
                  'transparent'=>false,
                    'color_on_scroll'=>false
          ]
    ]) ?>
    <main class="container">
        <?= \common\widgets\Alert::widget() ?>
        <?= $content ?>

    </main>
    <?= $this->render('footer') ?>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
