<?php

namespace common\components;

use Mailgun\Mailgun;
use YarCode\Yii2\Mailgun\Mailer as BaseMailer;
use yii\base\InvalidConfigException;

class Mailer extends BaseMailer
{

    public $apiEndpoint = 'api.mailgun.net';
    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (!isset($this->apiKey, $this->domain)) {
            throw new InvalidConfigException('Invalid mailer configuration');
        }


        $this->client = \Yii::createObject(Mailgun::class, [$this->apiKey,null,$this->apiEndpoint]);


    }

}