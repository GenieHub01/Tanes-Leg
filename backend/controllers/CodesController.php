<?php

namespace backend\controllers;

use common\models\Countries;
use common\models\Goods;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Yii;
use common\models\Codes;
use backend\models\search\CodesSearch;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CodesController implements the CRUD actions for Codes model.
 */
class CodesController extends Controller
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
     * Lists all Codes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CodesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Codes model.
     * @param string $title
     * @param integer $type
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Codes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Codes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Codes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $title
     * @param integer $type
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Codes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $title
     * @param integer $type
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $target = false;
        switch ($model->type){
            case(Codes::COUNTRY_SHIPPING_CODE):
                $target = Countries::findOne(['shipping_id'=>$model->id]);
                break;
            case(Codes::COUNTRY_TAX_CODE):
                $target = Countries::findOne(['tax_id'=>$model->id]);
                break;
            break;
            case(Codes::HOLDING_CHARGE_CODE):
                $target = Goods::findOne(['holdingcharge_id'=>$model->id]);

                break;
            case(Codes::PRODUCT_EXTRA_SHIPPING_CODE):

                $target = Goods::findOne(['extra_shipping_id'=>$model->id]);
                break;
        }

        if ($target){
            Yii::$app->session->setFlash('error', 'You cannot delete this item, while it uses by system.');
            return $this->redirect(['/codes/view','id'=>$model->id]);
//            throw new NotFoundHttpException('');
        }

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Codes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $title
     * @param integer $type
     * @return Codes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Codes::findOne(['id' => $id ])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
