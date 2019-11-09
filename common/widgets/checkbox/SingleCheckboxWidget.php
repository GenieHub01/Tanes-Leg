<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 10/13/18
 * Time: 2:37 PM
 */

namespace common\widgets\checkbox;

use yii\helpers\Html;
use yii\widgets\InputWidget;

class SingleCheckboxWidget extends InputWidget
{


    public function run()
    {

        return
            Html::beginTag('div', ['class' => 'checkbox-list-alone']) .
            Html::activeCheckbox($this->model, $this->attribute, [
                'class' => '',
                'labelOptions' => ['class' => 'checkbox'],
                'label' => "<div class='checkbox__text'>" . $this->model->getAttributeLabel($this->attribute) . "</div>",
                'encode' => false]) .
            Html::endTag('div');
    }


}