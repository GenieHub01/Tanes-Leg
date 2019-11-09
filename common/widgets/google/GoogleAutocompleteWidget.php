<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 10/13/18
 * Time: 2:37 PM
 */

namespace common\widgets\google;

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\InputWidget;

class GoogleAutocompleteWidget extends InputWidget
{


//    public $nologo = '/img/no-logo.png';
//    public $previewImage ;

    public $fields = [
        'place_location',
        'city_text',
//        'city_text',
    ];

    public function run()
    {

        $text = Html::beginTag('div', ['class' => 'maps']);
        $text .= Html::activeTextInput($this->model, $this->attribute, ['class' => 'controls form-control  ', 'id' => 'pac-input', 'placeholder' => \Yii::t('app', 'Enter a location')]);
//        $text.=  $this->model->hasProperty('place_location') ?  Html::activeHiddenInput ($this->model,'place_location'): '';
//        $text.=  $this->model->hasProperty('city_title') ?  Html::activeHiddenInput ($this->model,'city_title'): '';

        $text .= $this->model->hasProperty('lat') ?
            Html::activeHiddenInput($this->model, 'lat', ['placeholder' => \Yii::t('app', 'LAT')])  : "";

        $text .= $this->model->hasProperty('lng') ?
            Html::activeHiddenInput($this->model, 'lng', ['placeholder' => \Yii::t('app', 'LNG')])  : "";
        $text .= Html::tag('div', '', ['id' => 'map']);
        $text .= Html::endTag('div');


        $this->registerAssets();
        return $text;
    }

    public function registerAssets()
    {
        $view = $this->getView();


        $components = [];
        if ($this->model->hasProperty('lat'))
            $components[] = 'lat: "#' . Html::getInputId($this->model, 'lat') . '"';

        if ($this->model->hasProperty('lng'))
            $components[] = 'lng: "#' . Html::getInputId($this->model, 'lng') . '"';


        $com = join(',', $components);

        $this->view->registerJs(" var placeSearch, autocomplete;
    var componentForm = { $com  };", View::POS_HEAD);
        $this->view->registerJs(" initMap();"
            , View::POS_READY
        );
        $timeAssetBundle = GoogleAsset::register($view);
//        $this->view->registerJsFile(, ['position'=>View::POS_READY]);

    }


}