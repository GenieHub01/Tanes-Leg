<?php

namespace backend\controllers;

use common\models\Category;
use common\models\Codes;
use Yii;
use common\models\Goods;
use backend\models\search\SearchGoods;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductsController implements the CRUD actions for Goods model.
 */
class ProductsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
                    [
//                        'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchGoods();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $shippingCodes = Codes::getCodes(Codes::PRODUCT_EXTRA_SHIPPING_CODE);
        $depositCodes = Codes::getCodes(Codes::HOLDING_CHARGE_CODE);
        $categories = \common\models\Category::getDropDownArray();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'shippingCodes'=>$shippingCodes,
            'depositCodes'=>$depositCodes,
            'categories'=>$categories
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);
        $shippingCodes = Codes::getCodes(Codes::PRODUCT_EXTRA_SHIPPING_CODE);
        $depositCodes = Codes::getCodes(Codes::HOLDING_CHARGE_CODE);
        $categories = \common\models\Category::getDropDownArray();
//        var_dump($model->attributes); exit;
        return $this->render('view', [
            'model' => $model,
            'shippingCodes'=>$shippingCodes,
            'depositCodes'=>$depositCodes,

        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $shippingCodes = Codes::getCodes(Codes::PRODUCT_EXTRA_SHIPPING_CODE);
        $depositCodes = Codes::getCodes(Codes::HOLDING_CHARGE_CODE);
        return $this->render('create', [
            'model' => $model,
            'shippingCodes'=>$shippingCodes,
            'depositCodes'=>$depositCodes
        ]);
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $shippingCodes = Codes::getCodes(Codes::PRODUCT_EXTRA_SHIPPING_CODE);
        $depositCodes = Codes::getCodes(Codes::HOLDING_CHARGE_CODE);

        return $this->render('update', [
            'model' => $model,
            'shippingCodes'=>$shippingCodes,
            'depositCodes'=>$depositCodes
        ]);
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
