<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 10/13/18
 * Time: 2:37 PM
 */

namespace common\widgets\uploader;

use yii\web\View;
use yii\widgets\InputWidget;

class ImagesUploadWidget extends InputWidget
{


    public $uploadUrl = ['/site/upload-image'];
    public $nologo = '/img/no-logo.png';
    public $previewImage;
    public $images;
    public $mainId;
    public $sorting;
    public $buttons = ['right', 'left', 'delete', 'main'];


    public function run()
    {
        $this->registerAssets();
        return $this->render('index', ['model' => $this->model, 'attribute' => $this->attribute, 'widget' => $this]);
    }

    public function registerAssets()
    {
        $view = $this->getView();
        FilesUploadAsset::register($view);

        if ($this->sorting) {
            foreach ($this->sorting as $key => $sort) {
                if (isset($this->images[$sort]))
                    $images[] = $this->images[$sort];


            }
            $this->images = $images;
        }


        $formName = $this->model->formName() . '[' . $this->attribute . ']';


        $this->view->registerJs("  startUploader('#" . $this->id . "');   "
            , View::POS_READY
        );

//
//        $buttons = [
//          isset($this->buttons['left']) ?
//        ];

        $this->view->registerJs(
            <<<JS
 
    uploaderTemplate = '<li class="{rotateClass}" data-key="{fileId}">' +
                    '<div class="img_block">' +
                    '<div class="img" style="background: url(' + escapeTags('{filePreview}') + ') center no-repeat; background-size: cover; "></div>' +
                    '<div class="shadow">' +
                    
                    '<a href="#" class="delete"></a>' +
                    '</div>' +  
                   
                    '</div>' +
                    '<input type="hidden" name="' +
                   '$formName'
                    +
                    '[]" value="{fileId}"">' +
                    '</div>' +
                    '</li>';
        
        
         
        
JS
            , View::POS_READY
        );

    }


}
