<?php
namespace backend\controllers;

use common\models\Files;
use common\models\Restaurant;
use common\models\RestaurantFiles;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Yii;
use yii\imagine\Image;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
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
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','upload-image','ip'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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

    public function beforeAction($action)
    {
        // ...set `$this->enableCsrfValidation` here based on some conditions...
        // call parent method that will check CSRF if such property is true.
        if ($action->id === 'upload-image') {
            # code...
            $this->enableCsrfValidation = false;
        }

        if ($action->id === 'rotate-image') {
            # code...
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }


    public function actionIp(){
        echo Yii::$app->request->userIP;
    }
    public function actionUploadImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $file = UploadedFile::getInstanceByName('uploadfile');

        if ($file) {

            $filename = Files::getUniqueFilename(true);
            $imagine = new Imagine();
            $image = $imagine->open($file->tempName);

            $image
                ->resize(new Box(1000,1000))->save($filename,['jpeg_quality' => 75])
                ->resize(new Box(300,300))->save(str_replace('_big','_small', $filename),['jpeg_quality' => 75]);

            // @todo add auto moderation
//            $model->updateAttributes(['status' => Files::DEFAULT_STATUS]);

            return [
                'success' => true,
                'filename' => '/'.$filename,
                'preview' => '/'.str_replace('_big','_small', $filename),
            ];
        } else {
            return self::returnError(self::ERROR_BADREQUEST, 'NO_FILE');

        }
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
