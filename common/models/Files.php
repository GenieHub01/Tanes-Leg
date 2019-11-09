<?php

namespace common\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "Files".
 *
 * @property int $id
 * @property string $filename
 * @property int $status
 * @property int $user_id
 * @property int $is_ready
 */
class Files extends \yii\db\ActiveRecord
{


    const SIZE_ORIGINAL = '';
    const SIZE_BIG = '_big';
    const SIZE_MID = '_mid';
    const SIZE_THUMB = '_thumb';

    const TYPE_IMAGE = 1;
    const TYPE_FILE = 2;

    const STATUS_DELETED = 0;
    const STATUS_BLOCK_DELETED = 2;
    const STATUS_BLOCK_DELETED_API = 3;
    const STATUS_APPROVED = 10;

    const DEFAULT_STATUS = self::STATUS_APPROVED;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }


    public function behaviors()
    {
        return [
//            'timestamp' => [
//                'class' => TimestampBehavior::className(),
//                'attributes' => [
//                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_ts',
//                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_ts',
//                    // ActiveRecord::EVENT_BEFORE_UPDATE => 'date_updated',
//                ],
//                'value' => function () {
//                    return time(); //
//                },
//            ],

            'user_ud' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'user_id',
                    //  ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_ts',
                    // ActiveRecord::EVENT_BEFORE_UPDATE => 'date_updated',
                ],
                'value' => function () {
                    return !Yii::$app->user->isGuest ? Yii::$app->user->id : null; //
                }
            ],
            'status' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'status',
                    //  ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_ts',
                    // ActiveRecord::EVENT_BEFORE_UPDATE => 'date_updated',
                ],
                'value' => function () {
                    return self::DEFAULT_STATUS; //
                }
            ]
        ];
    }





    public function getRestaurantFiles()
    {
        return $this->hasMany(RestaurantFiles::className(), ['files_id' => 'id']);
    }

    /**
     * @param null $create_dir
     * @param null $model
     * @return string
     * @throws \yii\base\Exception
     */
    static function getUniqueFilename($create_dir = null, $model = null)
    {
        // @todo filename, based on model
        $s = "qazwsxedcrfvtgbyhnujmikolp";
        $g = substr($s, rand(0, strlen($s)), 1) . substr($s, rand(0, strlen($s)), 1);
        //$g = substr ($s, rand(0, strlen($s)) , 1).substr ($s, rand(0, strlen($s)) , 1);
        $g .= '/' . substr($s, rand(0, strlen($s)), 1) . substr($s, rand(0, strlen($s)), 1);
        $g .= '/' . substr($s, rand(0, strlen($s)), 1) . substr($s, rand(0, strlen($s)), 1);
        $dir = 'uploads/images/' . $g;


        if ($create_dir && !is_dir($dir)) {
            FileHelper::createDirectory($dir);
            // var_dump(mkdir($this->upload_dir.$dir, 0777));
            //chmod($this->upload_dir.$dir_file_str, 0777);
        }

        $f = uniqid();


        $filename = $dir . '/' . $f . '_big.jpg';

        return $filename;
    }

    static function sendImgToS3($file, $model = null)
    {
        $s3 = Yii::$app->get('s3');

        $filename = self::getUniqueFilename(null, $model ? $model->id : null);

        $masterFilename = str_replace('_big', '_master', $filename);
        // master
        $result = $s3->commands()->upload($masterFilename, $file->tempName)->execute();
        $s3Url = $result->get('ObjectURL');


        if (!$model) {
            $model = new self;


        } else {
            $s3->delete($model->filename);
            $s3->delete(str_replace('_big', '_mid', $model->filename));
            $s3->delete(str_replace('_big', '_thumb', $model->filename));
        }
        $model->filename = str_replace('_master', '_big', $s3Url);
        $model->is_ready = 0;


        //@todo валидации и исключения

        $model->save(false);
        $response = \Yii::$app->blitline->upload($s3Url, $masterFilename, $model->id);

//        $model->job_id = $response->$response->getJobId() ;


        return $model;
    }

    public function getSize($size = self::SIZE_BIG)
    {
        return str_replace('_big', $size, $this->filename);
    }

    public function getPreview(){
        return $this->getSize(self::SIZE_THUMB);
    }

    public function getMaster(){
        return $this->getSize('_master');
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['status', 'user_id'], 'integer'],
//            [['filename'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'Filename',
            'status' => 'Status',
            'user_id' => 'User ID',
        ];
    }
}
