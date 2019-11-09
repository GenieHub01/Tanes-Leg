<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>



<div class="page-header clear-filter" filter-color="orange">
    <div class="page-header-image" data-parallax="true" style="background-image:url('/img/main-back.jpeg');">
    </div>
    <div class="container">
        <div class="content-center brand">
<!--            <img class="n-logo" src="/img/logo.png" alt="">-->
            <h1 class="h1-seo"><?= Html::encode($this->title) ?></h1>
            <p><?= nl2br(Html::encode($message)) ?> </p>

                <p>
                    Please, Contact Us, if you think, that is Server Error.
                </p>
        </div>
    </div>
</div>