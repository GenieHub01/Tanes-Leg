<?php

namespace common\widgets\google;

use yii\web\AssetBundle;

class GoogleAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@common/widgets/google/src';
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
    /**
     * @var string language to register translation file for
     */
    public $language;

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        $this->js[] = 'maps' . '.js';
        $this->css[] = 'google' . '.css';
        $this->js[] = '//maps.googleapis.com/maps/api/js?key='.\Yii::$app->params['GoogleJsAPI'].'&libraries=places&signed_in=true';
        $this->js[] = '/dist/latlon-geohash.js';
        //&callback=initMap

        $language = $this->language;
        parent::registerAssetFiles($view);
    }
}
