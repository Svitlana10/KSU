<?php

namespace app\models;

use app\models\forms\ShowForm;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "show".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $address
 * @property int $show_date
 * @property string $img
 * @property int $start_reg_date
 * @property int $end_reg_date
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property bool $finishRegStatus
 * @property string $image
 * @property bool $startRegStatus
 * @property string $status
 * @property string $showDate
 * @property string $endRegDate
 * @property string $startRegDate
 * @property User $user
 */
class Show extends \yii\db\ActiveRecord
{

    const STATUS_REG_COMING_SOON = 'Скоро буде..';
    const STATUS_REG_GOING = 'Йде реєстрація..';
    const STATUS_REH_END = 'Рєстрація закінчена..';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%show}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'address', 'showDate', 'startRegDate', 'endRegDate'], 'required'],
            [['description'], 'string'],
            [['show_date', 'start_reg_date', 'end_reg_date', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'address'], 'string', 'max' => 255],
            ['img', 'file', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'], 'checkExtensionByMimeType' => true, 'maxSize' => 15 * 1024 * 1024],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'title' => 'Назва',
            'description' => 'Опис',
            'address' => 'Адреса',
            'show_date' => 'Дата виставки',
            'img' => 'Картинка',
            'start_reg_date' => 'Початок реєстрації',
            'end_reg_date' => 'Кінець реєстрації',
            'user_id' => 'Користувач',
            'created_at' => 'Дата створення',
            'updated_at' => 'Дата оновлення',
        ];
    }

    /**
     * @param $value
     */
    public function setShowDate($value)
    {
        $this->show_date = strtotime($value);
    }

    /**
     * @param $value
     */
    public function setStartRegDate($value)
    {
        $this->start_reg_date = strtotime($value);
    }

    /**
     * @param $value
     */
    public function setEndRegDate($value)
    {
        $this->end_reg_date = strtotime($value);
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return ($this->img) ? '/img/uploads/' . $this->img : '/no-image.png';
    }

    /**
     * @return bool
     */
    public function getStartRegStatus()
    {
        return ($this->start_reg_date >= time()) ? true : false;
    }

    /**
     * @return bool
     */
    public function getFinishRegStatus()
    {
        return ($this->startRegStatus && $this->end_reg_date >= time()) ? true : false;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return ($this->startRegStatus) ? ($this->finishRegStatus) ? self::STATUS_REH_END : self::STATUS_REG_GOING : self::STATUS_REG_COMING_SOON;
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getShowDate()
    {
        return Yii::$app->formatter->asDatetime(($this->show_date) ?: time(), "php:d-m-Y  H:i:s");
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getStartRegDate()
    {
        return Yii::$app->formatter->asDatetime(($this->start_reg_date) ?: time(), "php:d-m-Y  H:i:s");
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getEndRegDate()
    {
        return Yii::$app->formatter->asDatetime(($this->end_reg_date) ?: time(), "php:d-m-Y  H:i:s");
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        $photo = new ImageUpload();
        $form = new ShowForm();

        if($file = UploadedFile::getInstance($form, 'img') ?: UploadedFile::getInstanceByName('img')){
            $this->img = $photo->uploadFile($file, $this->img);
        }

        return parent::beforeSave($insert);
    }

    /**
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeDelete()
    {
        (new ImageUpload())->deleteCurrentImage($this->img);
        return parent::beforeDelete();
    }
}
