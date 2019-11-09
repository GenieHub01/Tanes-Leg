<?php

namespace frontend\controllers;

use common\components\BaseController;
use common\components\OmnipayComponent;
use common\models\Order;
use frontend\models\Goods;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class OrdersController extends BaseController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'  ],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
//                    [
//                        'actions' => ['logout', 'upload-image', 'test'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex( ){
        $models = Order::find()->andWhere(['user_id'=>\Yii::$app->user->id])->all();



        return $this->render('index',['models'=>$models]);
    }
    public function actionView($id, $hash = null){

        $model = Order::find()->andWhere(['id'=>$id])->one();

        if (!$model){
            throw new NotFoundHttpException();
        }


        if (\Yii::$app->user->isGuest  ){
            if ($model->user_id ){
                throw new NotFoundHttpException();
            }

            if ($model->md5_link <> $hash) {
                throw new NotFoundHttpException();
            }
        } else {
            if ($model->user_id <> \Yii::$app->user->id){
                throw new NotFoundHttpException();
            }

        }

        return $this->render('view',['model'=>$model]);



    }
   
}