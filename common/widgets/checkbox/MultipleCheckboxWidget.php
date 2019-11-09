<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 10/13/18
 * Time: 2:37 PM
 */

namespace common\widgets\checkbox;

use app\models\Rent;
use common\models\Restaurant;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class MultipleCheckboxWidget extends InputWidget
{

    public $list;
    public $label;

    public function run()
    {

        return


            " <label class=\"control-label\">{$this->model->getAttributeLabel($this->attribute)}</label>".
            Html::activeCheckboxList($this->model, $this->attribute,$this->list, [

                'class' => 'checkbox-list-inline ',
                'item' => function ($index, $label, $name, $checked, $value) {
                    $checkedLabel = $checked ? 'checked' : '';
                    $inputId = str_replace(['[', ']'], ['', ''], $name) . '_' . $index;

                    return " <label for=$inputId class=\"checkbox\">
                             <input type='checkbox' name=$name value=$value id=$inputId $checkedLabel />
                            <div class=\"checkbox__text\">$label</div>
                        </label>
                    ";

                }

            ]);


    }


}