<?php

namespace common\components;

use yii\web\Controller;
use Yii;
class BaseController extends Controller {

    const ERROR_NOTFOUND = 70;
    const ERROR_BADREQUEST = 52;
    const ERROR_VALIDATION = 60;
    const ERROR_LOGIN_VALIDATION = 61;
    const ERROR_FACEBOOKSDK = 62;
    const ERROR_NOACCESS = 12;
    const ERROR_SAVING = 13;
    const ERROR_ANOTHER = 14;
    const ERROR_CANT_LIKE = 15;
    const ERROR_WRONG_ACTION = 18;


    static function errorText()
    {
        return [
            self::ERROR_NOTFOUND => Yii::t('app', 'ERROR_NOTFOUND'),
            self::ERROR_VALIDATION => Yii::t('app', 'ERROR_VALIDATION'),
            self::ERROR_NOACCESS => Yii::t('app', 'ERROR_NOACCESS'),
            self::ERROR_SAVING => Yii::t('app', 'ERROR_SAVING'),
            self::ERROR_ANOTHER => Yii::t('app', 'ERROR_ANOTHER'),
            self::ERROR_CANT_LIKE => Yii::t('app', 'ERROR_CANT_LIKE'),

            self::ERROR_WRONG_ACTION => Yii::t('app', 'ERROR_WRONG_ACTION'),
            self::ERROR_LOGIN_VALIDATION => Yii::t('app', 'ERROR_LOGIN_VALIDATION'),
            self::ERROR_FACEBOOKSDK => Yii::t('app', 'ERROR_FACEBOOKSDK'),
            self::ERROR_BADREQUEST => Yii::t('app', 'BAD_REQUEST'),
        ];
    }

    public static function returnError($errorCode, $message = null, $errors = null, $statusCode = null)
    {

        if (Yii::$app->request->isAjax){
            Yii::$app->response->format = 'json';
        }


        switch ($errorCode) {
            case(self::ERROR_LOGIN_VALIDATION) :
                Yii::$app->response->statusCode = 401;
                break;
            case(self::ERROR_VALIDATION) :
                Yii::$app->response->statusCode = 401;
                break;
            case(self::ERROR_NOACCESS) :
                Yii::$app->response->statusCode = 403;
                break;

            case(self::ERROR_BADREQUEST) :
                Yii::$app->response->statusCode = 404;
                break;
            case(self::ERROR_NOTFOUND) :
                Yii::$app->response->statusCode = 404;
                break;
            default :
                Yii::$app->response->statusCode = $statusCode ? $statusCode : 500;

        }

        $out['error_code'] = $errorCode;
        if ($errors) {
            $err = [];
            foreach ($errors as $key => $error) {
                $err[] = [
                    'attribute' => $key,
                    'message' => $error
                ];
            }

            $out['errors'] = $err;
        }
        $out['error_text'] = $message ? $message : self::errorText()[$errorCode];
        return $out;
    }




}