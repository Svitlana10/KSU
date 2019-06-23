<?php

namespace app\models;

use app\models\forms\ShowForm;
use app\validators\JsonValidator;
use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\Json;
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
 * @property float $price
 * @property Json $google_location
 * @property int $created_at
 * @property int $updated_at
 *
 * @property bool $finishRegStatus
 * @property bool $startRegStatus
 * @property string $image
 * @property string $status
 * @property string $showDate
 * @property string $endRegDate
 * @property string $startRegDate
 * @property array $location
 * @property Dog[] $dogs
 * @property User $user
 */
class Show extends ActiveRecord
{

    const STATUS_REG_COMING_SOON = 'Скоро буде..';
    const STATUS_REG_GOING = 'Йде реєстрація..';
    const STATUS_REG_END = 'Рєстрація закінчена..';

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
            [['title', 'description', 'address', 'showDate', 'startRegDate', 'endRegDate', 'price'], 'required'],
            [['description'], 'string'],
            [['show_date', 'start_reg_date', 'end_reg_date', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'address'], 'string', 'max' => 255],
            [['price'], 'double'],
            ['google_location', JsonValidator::class],
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
            'price' => 'Ціна',
            'google_location' => 'Локація',
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
        return ($this->start_reg_date <= time()) ? true : false;
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
        return ($this->startRegStatus) ? ($this->finishRegStatus) ? self::STATUS_REG_GOING : self::STATUS_REG_END : self::STATUS_REG_COMING_SOON;
    }

    /**
     * @return Show|array|ActiveRecord|null
     */
    public static function getOneRegShow()
    {
        $result =  static::find()
            ->where(['<=', 'start_reg_date', time()])
            ->andWhere(['>=', 'end_reg_date', time()])
            ->orderBy(['start_reg_date' => SORT_DESC])
            ->one();
        return $result;
    }

    /**
     * @return array
     */
    public function getLocation()
    {
        return Json::decode($this->google_location);
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function getShowDate()
    {
        return Yii::$app->formatter->asDatetime(($this->show_date) ?: time(), "php:d-m-Y  H:i:s");
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function getStartRegDate()
    {
        return Yii::$app->formatter->asDatetime(($this->start_reg_date) ?: time(), "php:d-m-Y  H:i:s");
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function getEndRegDate()
    {
        return Yii::$app->formatter->asDatetime(($this->end_reg_date) ?: time(), "php:d-m-Y  H:i:s");
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getDogs()
    {
        return $this->hasMany(Dog::class, ['id' => 'dog_id'])
            ->viaTable('dog_show', ['show_id' => 'id']);
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws Exception
     */
    public function beforeSave($insert)
    {
        $photo = new ImageUpload();
        $form = new ShowForm();
        $file = UploadedFile::getInstance($form, 'img') ?: UploadedFile::getInstanceByName('img');
        if($file){
            $this->img = $photo->uploadFile($file, $this->img);
        }

        return parent::beforeSave($insert);
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function beforeDelete()
    {
        (new ImageUpload())->deleteCurrentImage($this->img);
        return parent::beforeDelete();
    }

    /**
     * @param $lat
     * @param $long
     */
    public function setGoogleLocation($lat, $long)
    {
        $array = [
            'latitude'  => $lat,
            'longitude' => $long
        ];
        $this->google_location = Json::encode($array);
    }
}
