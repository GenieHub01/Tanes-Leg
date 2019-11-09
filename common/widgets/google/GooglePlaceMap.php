<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 11/3/18
 * Time: 3:13 PM
 */

namespace common\widgets\google;

use yii\web\View;

class GooglePlaceMap extends \yii\base\Widget {


    public $lat;
    public $lng;
    public $address;
    public $title;
    public $markers;
    public $places;

    public function run(){

        $this->registerAssets();
        return $this->render('place_render',['widget'=>$this]);
    }


    public function registerAssets()
    {

//        var_dump($this->places);
//        var_dump(json_encode($this->places));
//        var_dump(json_last_error());
//        exit;
        $view = $this->getView();
         GoogleAsset::register($view);

         if ($this->markers){
             $this->view->registerJs(" iMapWithMarkers(".json_encode($this->markers).", $this->lat,$this->lng,".($this->places ? json_encode($this->places) : 'null').");"
                 ,View::POS_READY
             );
         } else {
             $this->view->registerJs(" iMap($this->lat,$this->lng,'$this->address');"
                 ,View::POS_READY
             );
         }



    }


}
