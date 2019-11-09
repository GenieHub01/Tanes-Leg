<?php

namespace frontend\controllers;

use common\components\BaseController;
use frontend\models\Goods;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class StoreController extends BaseController
{


    public function actionView($id){
        $model = Goods::findOne(['id'=>$id]);

        if (!$model){
            throw  new NotFoundHttpException('Not Found');
        }

        return $this->render('view',['model'=>$model]);
    }


}