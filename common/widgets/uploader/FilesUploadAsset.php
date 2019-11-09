<?php
/**
 * @package   yii2-editable
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015 - 2017
 * @version   1.7.6
 */

namespace common\widgets\uploader;

use Yii;
use kartik\base\AssetBundle;
use yii\web\View;

class FilesUploadAsset extends AssetBundle
{


    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->jsOptions['position'] = View::POS_END;
//        $this->setSourcePath('@app/kartik-v/yii2-editable/assets');
//        $this->setupAssets('css', ['css/editable']);
//        $this->setupAssets('js', ['js/editable']);
        parent::init();
    }
    public $sourcePath = '@common/widgets/uploader/src';

    public $css = [
        'css/imagesuploader.css'
    ];
    public $js = [
        'js/SimpleAjaxUploader.min.js',
        'js/imagesuploader.js'
    ];

    public $depends = [
        //  'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
//        'yii\jui\JuiAsset',
    ];
}