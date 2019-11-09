<?php
use yii\helpers\Html;
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark static-top">
    <div class="container">


    <a class="navbar-brand" href="/"><?= Yii::$app->name ?></a>


    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">


<!--            <form class="form-inline my-2 my-lg-0 mr-auto">-->
<!--                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">-->
<!--                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
<!--            </form>-->



        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?=Yii::$app->cart->country->title?>
                </a>
                <div class="dropdown-menu"  aria-labelledby="navbarDropdown">
                    <?$countries = \common\models\Countries::getList()?>
                    <? foreach ($countries as $key=>$country):?>
                        <?= Html::a($country,['/site/set-country','id'=>$key],['class'=>'dropdown-item']) ?>
                    <?endforeach;?>

                </div>
            </li>

            <? if (Yii::$app->user->isGuest): ?>
                <li class="nav-item">
                    <?= Html::a('<i class="fas fa-cart"></i> Cart'.(Yii::$app->cart->count>0 ?  ' <span class="badge badge-light cart_count">'.Yii::$app->cart->count.'</span>' : '' ),['/cart/index'],['class'=>'nav-link']) ?>
                </li>
                <li class="nav-item">

                    <?= Html::a('Login',['/site/login'],['class'=>'nav-link']) ?>

                </li>
                <li class="nav-item">
                    <?= Html::a('Signup',['/site/signup'],['class'=>'nav-link']) ?>
                </li>

            <? else: ?>

                <li class="nav-item">
                    <?= Html::a('My orders',['/orders/index'],['class'=>'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= Html::a('<i class="fas fa-cart"></i> Cart'.(Yii::$app->cart->count>0 ?  ' <span class="badge badge-light cart_count">'.Yii::$app->cart->count.'</span>' : '' ),['/cart/index'],['class'=>'nav-link']) ?>
                </li>
               <? echo  '<li  class="nav-item">'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->publicname . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>';

            endif; ?>
        </ul>

    </div>
    </div>
</nav>
