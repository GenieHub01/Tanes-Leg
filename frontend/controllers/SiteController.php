<?php

namespace frontend\controllers;

use common\components\BaseController;
use common\models\Countries;
use common\models\LoginForm;
use common\models\Restaurant;
use common\models\RestaurantFiles;
use common\models\User;
use frontend\models\ContactForm;
use frontend\models\Goods;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SettingsForm;
use frontend\models\SignupForm;
use frontend\models\VerifyEmailForm;
use frontend\models\Years;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','edit-profile'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'upload-image', 'test','edit-profile'],
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


    public function actionComparsionImport()
    {
        set_time_limit(0);
        $i = 1;
        foreach (Goods::find()->orderBy('id')->andWhere(['import'=>0])->each(200) as $product) :

            /**
             * @var $product Goods
             */
            $i++;
//            if ($i > 10) exit;

            $options = explode(' | ', $product->description);
//            var_dump($options);
            if ($options):
                foreach ($options as $option):
                    $o = explode(': ', $option);


                    if ($o) {

                        if ($o[0] == 'Part-Number List'):

                            $product->part_number_list = explode('|', $o[1]);
                        endif;
                        if ($o[0] == 'Comparison-Number List'):
                            $product->comparison_number_list = explode('|', $o[1]);
                        endif;
                        if ($o[0] == 'OEM Exchange'):
                            $product->oem_exchange = $o[1];
                        endif;
                        if ($o[0] == 'Additional Info'):
                            $product->add_info = $o[1];
                        endif;
                        if ($o[0] == 'Engine Power(BHP)'):
                            $product->engine_power = $o[1];
                        endif;
                    }

                endforeach;
//                echo '<hr>';
            endif;
            $product->import = 1;


//            var_dump($product->part_number_list);
//            echo '<hr>';

//        echo $product->id;
        if (!$product->save()){
            var_dump($product->getFirstErrors());
        }
//             var_dump($product->save());
//              $product->save();
//            var_dump($product->getFirstErrors());
//            exit;
        endforeach;
//        exi
//        echo 1;
    }

    public function actionSetCountry($id){
        $country = Countries::findOne(['id'=>$id]);

        if ($country){
            $session = \Yii::$app->session;
            $c  =  $session->set('country', $country->id);
        }

        return $this->goBack();

    }
    public function actionEditProfile(){
        $model = new SettingsForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success', 'Saved.');
        }

        return $this->render('edit-profile',['model'=>$model]);
    }

    public function actionCsv()
    {
        set_time_limit(0);

        $csv = array_map('str_getcsv', file('1.csv'));
        $row = 1;
        $out = [];


        foreach ($csv as $key => $data) {

            $num = count($data);


            if ($num <> 80) {
                echo "<p> $num полей в строке $key: <br /></p>\n";


                continue;

            }

//                continue;
            $row++;




                if ($key == 0) {
                    $labels = [];
                    for ($c = 0; $c < $num; $c++) {


                        if ($c == 0) {
                            $labels[$c] = 'title';
                        } elseif ($c == 1) {
                            $labels[$c] = 'uri';
                        } elseif ($c == 2) {
                            $labels[$c] = 'import_id';
                        } elseif ($c == 4) {
                            $labels[$c] = 'description';
                        } elseif ($c == 41) {
                            $labels[$c] = 'category';
                        } elseif ($c == 50) {
                            $labels[$c] = 'years_string';
                        } elseif ($c == 68) {
                            $labels[$c] = 'brand';
                        } elseif ($c == 71) {
                            $labels[$c] = 'model';
                        } elseif ($c == 65) {
                            $labels[$c] = 'fuel';
                        } elseif ($c == 62) {
                            $labels[$c] = 'engine_type';
                        } elseif ($c == 56) {
                            $labels[$c] = 'engine_capacity';
                        } elseif ($c == 47) {
                            $labels[$c] = 'add_info';
                        } elseif ($c == 74) {
                            $labels[$c] = 'oem_exchange';
                        } elseif ($c == 59) {
                            $labels[$c] = 'engine_power';
                        } elseif ($c == 77) {
                            $labels[$c] = 'part_number_list';
                        } elseif ($c == 53) {
                            $labels[$c] = 'comparison_number_list';
                        } elseif ($c == 44) {
                            $labels[$c] = 'sku';
                        } //                        elseif($c==44){  $labels[$c] = 'sku';   }

                        else {

                            if (in_array($c, [
                                14, 15, 37, 22, 25
                            ]))
//                            continue;
                                $labels[$c] = $data[$c];
                        }

                        // название колонок
//                        echo $c . ') ' . $data[$c] . '<br>';
                    }
                    foreach ($labels as $label) :
                        echo $c . ') ' . $label . '<br>';
                    endforeach;
//                    exit;
                }
                else {


                    for ($c = 0; $c < $num; $c++) {
//                        echo $c.') '.$labels[$c]. " : " .$data[$c] . "<br />\n";

//                        if ($c == 4){
//                            $out[$row][$labels[$c]] = explode(' | ',$data[$c]);
//                        } else {
                        if (isset($labels[$c])) {
                            if ($labels[$c] == 'images' || $labels[$c] == 'part_number_list' || $labels[$c] == 'comparison_number_list') {
                                if ($data[$c]) {

                                    $images = explode(',', $data[$c]);
                                    if ($images) {
                                        foreach ($images as $k => $image) {
                                            $images[$k] = trim($image);
                                        }
                                    }

                                    $out[$row][$labels[$c]] = $images;
                                } else {
                                    $out[$row][$labels[$c]] = null;
                                }
                            } elseif ($labels[$c] == 'stock_status') {
                                $out[$row]['stock_status'] = 1;
                            } elseif ($labels[$c] == 'engine_capacity') {
                                $out[$row]['engine_capacity'] = $data[$c];

                            } elseif ($labels[$c] == 'tax_status') {
                                $tax[$data[$c]] = 5;
                            } elseif ($labels[$c] == 'fuel') {

                                if ($data[$c]=='Petrol'){
                                    $out[$row]['fuel'] = Goods::FUEL_PETROL;
                                } elseif ($data[$c]=='Diesel'){
                                    $out[$row]['fuel'] = Goods::FUEL_DIESEL;
                                } else {
                                    $out[$row]['fuel'] = null;
                                }


                                $fuel[$data[$c]] = 1;
                            } elseif ($labels[$c] == 'category') {


//                                $category = Category::findOne(['title' => $data[$c]]);
//                                if (!$category) {
//                                    $category = new Category();
//                                    $category->title = $data[$c];
//                                    $category->save();
//                                }
//                                $out[$row]['category_id'] = $category->id;
                                $out[$row]['category_string'] = $data[$c];

                            } else {
                                $out[$row][$labels[$c]] = $data[$c];
                            }


                        }

//                        }


                    }
                }


                if ($row == 10) {
                    break;

                }

//                exit;
//            }
//            fclose($handle);
        }

//        var_dump($status); echo '<br>';
//        var_dump($tax); echo '<br>';
//        var_dump($fuel); echo '<br>';
////
////
//   foreach ($out as $item) {
//       Yii::$app->formatter->asNtext(var_export($item));
//       echo '<br>';
//   }
//        exit;

        unset($csv);
        foreach ($out as $item) {
            $model = Goods::findOne(['import_id' => $item['import_id']]);

//            $model = false;
            if (!$model) {
                $model = new Goods();
                $model->setAttributes($item);
                $model->status = Goods::STATUS_DEFAULT;
//               var_dump($item);
                echo '<pre>';
//               var_dump($model->attributes);
               echo '</pre>';

               try{
                   if (!$model->save()) {
                       echo '<pre>';
                       var_dump($model->getFirstErrors());
                       echo '</pre>';
//                    exit;
                   }
               }catch (\Exception $exception) {

                   echo $exception->getMessage().'<br>';
               }

            }
        }
        exit;


    }

    public function actionYear(){
        set_time_limit(0);
//        $models = Goods::find()->limit(10)->all();



        $i = 1;
        foreach (Goods::find()->orderBy('id')->andWhere(['import'=>0])->each(200) as $product) :
//            foreach ($models as $model):
            /**
             * @var $product Goods;
             */
            $years = unserialize($product->p_year_list);
            if ($years):

                foreach ($years as $year) {
                    $model = new Years();
                    $model->goods_id = $product->id;
                    $model->year = $year;

                    try {
                        $model->save(false);
                    } catch (\Exception $exception) {
                        echo $exception->getMessage() . '<br>';
                    }
                    $i++;

                }
             endif;

                $product->updateAttributes(['import'=>1]);
//            endforeach;
        endforeach;


        echo $i;


    }

    public function actfew()
    {
        set_time_limit(0);
        $sql = "select w.id, w.title, w.years_string, y.p_year_list from carparts.goods w  
inner join wp.wp_products y on w.import_id=y.product_id 
 ";
        $rows = Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rows as $row){
            echo $row['years_string'].' : '.$row['p_year_list'].'<br>';

            $years = unserialize($row['p_year_list']);

            foreach ($years as $year){
                $model = new Years();
                $model->goods_id = $row['id'];
                $model->year = $year;

                try {
                    $model->save(false);
                } catch (\Exception $exception) {
                    echo $exception->getMessage() . '<br>';
                }


            }
        }
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


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }


    // @todo soc auth
    public function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();

        /* @var $auth Auth */
        $auth = Auth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // авторизация
                $user = $auth->user;
                Yii::$app->user->login($user);
            } else { // регистрация
                if (isset($attributes['email']) && User::find()->where(['email' => $attributes['email']])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "Пользователь с такой электронной почтой как в {client} уже существует, но с ним не связан. Для начала войдите на сайт использую электронную почту, для того, что бы связать её.", ['client' => $client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'username' => $attributes['login'],
                        'email' => $attributes['email'],
                        'password' => $password,
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();
                    $transaction = $user->getDb()->beginTransaction();
                    if ($user->save()) {
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user);
                        } else {
                            print_r($auth->getErrors());
                        }
                    } else {
                        print_r($user->getErrors());
                    }
                }
            }
        } else { // Пользователь уже зарегистрирован
            if (!$auth) { // добавляем внешний сервис аутентификации
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);
                $auth->save();
            }
        }
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {


        $sql = 'select brand from goods group by brand having brand <> ""';
        $brandList = ArrayHelper::map(Yii::$app->db->createCommand($sql)->queryAll(),'brand','brand');



        return $this->render('index',[
            'brandList'=>$brandList
        ]);
    }

    public function actionProductSearch($brand, $model  = null, $capacity = null, $year = null, $fuel = null){

        if ($brand && !$model && !$capacity && !$year) {
            $sql = 'select  model from goods g
        where brand=:brand 
        group by model
        ';
            $out =
                ArrayHelper::map(
                    Yii::$app->db->createCommand($sql,[
                        'brand'=>$brand
                    ])->queryAll(),'model','model' );

            return $this->asJson([
                'items'=>$out
            ]);
        } elseif ($brand && $model && !$capacity && !$year  && !$fuel ) {
            $sql = 'select  engine_capacity from goods g
        where brand=:brand and model=:model
        group by engine_capacity
        ';


            $out =
                ArrayHelper::map(
                    Yii::$app->db->createCommand($sql,[
                        'model'=>$model,
                        'brand'=>$brand
                    ])->queryAll(),'engine_capacity','engine_capacity' );


            return $this->asJson([
                'items'=>$out
            ]);
        } elseif ($brand && $model && $capacity && $year===null  && !$fuel ) {

//            echo 1; exit;
            $sql = 'select  `year` from goods g
inner join years y on  g.id=y.goods_id
        where brand=:brand and model=:model and engine_capacity=:capacity
        group by `year`
        ';

            $out =
                ArrayHelper::map(
                    Yii::$app->db->createCommand($sql,[
                        'model'=>$model,
                        'brand'=>$brand,
                        'capacity'=>$capacity
                    ])->queryAll(),'year','year' );

            $out['all']='all';

            return $this->asJson([
                'items'=>$out
            ]);
        }elseif ($brand && $model && $capacity && $year!==null && $year=='all' && !$fuel ) {
            $sql = 'select  fuel from goods g
 
        where brand=:brand and model=:model and engine_capacity=:capacity  
        
        group by fuel
        
        ';


            $out =
                ArrayHelper::map(
                    Yii::$app->db->createCommand($sql,[
                        'model'=>$model,
                        'brand'=>$brand,
                        'capacity'=>$capacity
                    ])->queryAll(),function($model){
                    return $model['fuel'] ? $model['fuel'] : 'na';
                },function($model){
                        return isset(Goods::$_fuel[$model['fuel']]) ? Goods::$_fuel[$model['fuel']] : 'N/A';
                });

            return $this->asJson([
                'items'=>$out
            ]);

        }elseif ($brand && $model && $capacity && $year!==null && !$fuel) {


            $sql = 'select   fuel from goods g
inner join years y on  g.id=y.goods_id
        where brand=:brand and model=:model and engine_capacity=:capacity and `year`=:year
       
        group by   fuel
         
        
        
        ';


            $out =
                ArrayHelper::map(
                    Yii::$app->db->createCommand($sql,[
                        'model'=>$model,
                        'brand'=>$brand,
                        'capacity'=>$capacity,
                        'year'=>$year,
                    ])->queryAll(), function($model){
                    return $model['fuel'] ? $model['fuel'] : 'na';
                },function($model){
                    return isset(Goods::$_fuel[$model['fuel']]) ? Goods::$_fuel[$model['fuel']] : 'N/A';
                } );

            return $this->asJson([
                'items'=>$out
            ]);
        } elseif ($brand && $model && $capacity   && $fuel=='na') {

//            echo 1; exit;
            $sql = 'select  `id`, title, fuel from goods g
inner join years y on  g.id=y.goods_id
        where brand=:brand and model=:model and engine_capacity=:capacity and `year`=:year   and fuel is null
       
        group by `id`, title, fuel
         order by fuel, title
        
        
        ';


            $out =
                ArrayHelper::map(
                    Yii::$app->db->createCommand($sql,[
                        'model'=>$model,
                        'brand'=>$brand,
//                        'fuel'=>$fuel,
                        'capacity'=>$capacity,
                        'year'=>$year,
                    ])->queryAll(),'id',function($model){
                    return $model['title']
//                            .(isset(\common\models\Goods::$_fuel[$model['fuel']]) ? ' ('.\common\models\Goods::$_fuel[$model['fuel']].')' : '')
                        ;
                } );

            return $this->asJson([
                'items'=>$out
            ]);
        } elseif ($brand && $model && $capacity   && $fuel) {
//            echo 1; exit;
            $sql = 'select  `id`, title, fuel from goods g
inner join years y on  g.id=y.goods_id
        where brand=:brand and model=:model and engine_capacity=:capacity and `year`=:year and `fuel`=:fuel
       
        group by `id`, title, fuel
         order by fuel, title
        
        
        ';


            $out =
                ArrayHelper::map(
                    Yii::$app->db->createCommand($sql,[
                        'model'=>$model,
                        'brand'=>$brand,
                        'fuel'=>$fuel,
                        'capacity'=>$capacity,
                        'year'=>$year,
                    ])->queryAll(),'id',function($model){
                    return $model['title']
//                            .(isset(\common\models\Goods::$_fuel[$model['fuel']]) ? ' ('.\common\models\Goods::$_fuel[$model['fuel']].')' : '')
                        ;
                } );

            return $this->asJson([
                'items'=>$out
            ]);
        }else {
            return self::returnError(self::ERROR_BADREQUEST);
        }

    }

    public function actionPrivacy()
    {
        return $this->render('privacy');
    }

    /**
     * Credits
     *
     * @return mixed
     */
    public function actionCredits()
    {
        // TODO Credits page
//        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }


    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
