<?php
namespace frontend\controllers;

use common\components\BaseController;
use Omnipay\Omnipay;
use common\models\Order;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class PaymentController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
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

    public function actionIndex( ){

    }

    public function actionWorldpay($id){

        $request = \Yii::$app->request;
        if ($request && $card = $request->post()) {
            $id = $request->get('id', 1);
            $model = Order::find()->andWhere(['id'=>$id])->one();

            if (!$model){
                throw new NotFoundHttpException();
            }
            if (\Yii::$app->user->isGuest  ){
                if ($model->user_id ){
                    throw new NotFoundHttpException();
                }
            } else {
                if ($model->user_id <> \Yii::$app->user->id){
                    throw new NotFoundHttpException();
                }

            }
            // Create a gateway for the WorldPay Gateway
            // (routes to GatewayFactory::create)
            $gateway = Omnipay::create('\\lembdev\\WorldPay\\Gateway');

            // Initialise the gateway
            $gateway->initialize([
                'serviceKey' => 'T_S_9af61c25-85eb-4ac6-b643-d2fda8d71f8b',
                'clientKey'  => 'T_C_256f5a49-f78b-4ef8-bad4-5f45ca5c128c',
                'merchantId' => '8cbe01fe-3589-4d02-abec-af716948e1cc'
            ]);

            $amount = $model->total_sum + $model->shipping_cost;
            $country = $model->country_id = 2 ? 'GB' : 'RU';

            //now enterd test data
            $cardData = [
                'name' =>  $model->first_name.' '.$model->last_name,
                'number' => '4444333322221111', // real $card['cnumber']
                'expiryMonth' => 6, // real $card['expiryMonth']
                'expiryYear' => 2030, // real $card['expiryYear']
                'cvv' => 555, // real $card['cvv']
                'address1'    => $model->address,
                'address2'    => $model->address_optional,
                'city'        => $model->city,
                'postcode'    => $model->postcode ,
                'country'     => $country,
                'phone'       => $model->phone,
                'email'       => $model->email
            ];

            $ccard = new \Omnipay\Common\CreditCard($cardData );
            if ($card['method'] == 'purchase') {
                $tokenTransaction = $gateway->createCard([
                    'card'     => $ccard,
                    'reusable' => true,
                ]);
                $tokenResponse = $tokenTransaction->send();
                if (!$tokenResponse->isSuccessful()) {
                   echo 'Error: ' . $tokenResponse->getMessage(); die();
                }
                $token = $tokenResponse->getToken();

                $response = $gateway->purchase([
                    'description' => 'Payment for order №'.$id,
                    'currency' => 'GBP',
                    'amount' => $amount,
                    'token' =>$token
                ])->send();
            }elseif ($card['method'] == 'refund') {
                $amount = $model->total_sum;
                $response = $gateway->refund(['orderCode' => $model->wp_code, 'amount' => $amount])->send();
            }
            //var_dump ($response); die();

            if ($response->isRedirect()) {
                // redirect to offsite payment gateway
                $response->redirect();
            } elseif ($response->isSuccessful()) {
                if ($card['method'] == 'purchase') {
                    $orderCode = $response->getOrderCode();
                    $model->status = 10;
                    $model->wp_code = $orderCode;
                }elseif ($card['method'] == 'refund'){
                    $model->status = 2;
                }
                $model->save();
                \Yii::$app->session->setFlash('pay_seccess', 'Payment completed successfully');
                $this->redirect('/orders');

            } else {
                 \Yii::$app->session->setFlash('pay_error', 'Errors occurred while making a payment: ' . $response->getMessage());
                 $this->redirect('/orders');
            }
        }
    }
}