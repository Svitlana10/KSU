<?php
declare(strict_types=1);

namespace app\models\forms;

use app\models\ImageUpload;
use app\models\Show;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\db\Exception;

/**
 * Class ShowForm
 * @package app\models\forms
 *
 * @property mixed $image
 */
class ShowForm extends Model
{
    /**
     * @var integer $id
     */
    public $id;

    /**
     * @var string $title
     */
    public $title;

    /**
     * @var string $description
     */
    public $description;

    /**
     * @var string $address
     */
    public $address;

    /**
     * @var string $showDate
     */
    public $showDate;

    /**
     * @var string $img
     */
    public $img;

    /**
     * @var string $start_reg_date
     */
    public $startRegDate;

    /**
     * @var string $end_reg_date
     */
    public $endRegDate;

    /**
     * @var User $user
     */
    public $user;

    /**
     * @var integer $user_id
     */
    public $user_id;

    /**
     * @var Show $show
     */
    public $show;

    /**
     * @var float $price
     */
    public $price;

    /**
     * @var integer $created_at
     */
    public $created_at;

    /**
     * @var integer $updated_at
     */
    public $updated_at;

    /**
     * @var ImageUpload $imageUpload
     */
    public $imageUpload;

    /**
     * @var float $latitude
     */
    public $latitude;

    /**
     * @var float $longitude
     */
    public $longitude;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if ($this->show && !$this->show->isNewRecord) {
            $this->setAttributes($this->show->getAttributes());
            $this->showDate = $this->show->showDate;
            $this->startRegDate = $this->show->startRegDate;
            $this->endRegDate = $this->show->endRegDate;
            if ($this->show->google_location) {
                $cords = $this->show->location;
                $this->latitude = $cords['latitude'];
                $this->longitude = $cords['longitude'];
            }
            $this->user = User::findOne($this->show->user_id);
        } else {
            $this->show = new Show();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'title', 'address', 'price',
                'showDate', 'startRegDate', 'endRegDate'
            ], 'required'],
            [['description'], 'string'],
            [[
                'user_id', 'created_at', 'updated_at'
            ], 'integer'],
            [[
                'showDate', 'startRegDate', 'endRegDate',
                'longitude', 'latitude'
            ], 'safe'],
            [['price'], 'string'],
            [['title', 'address'], 'string', 'max' => 255],
            ['img', 'file', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'], 'checkExtensionByMimeType' => true, 'maxSize' => 15 * 1024 * 1024],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function create()
    {
        if (!$this->validate()) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();

        $this->show->setAttributes($this->getAttributes());
        $this->show->user_id = Yii::$app->user->id;

        if (!$this->setLocation()) {

            $transaction->rollBack();
            return false;
        }

        if ($this->show->save()) {

            $transaction->commit();
            return true;
        }
        $this->addErrors($this->show->getErrors());
        $transaction->rollBack();
        return false;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function update()
    {
        if (!$this->validate()) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();

        $this->img = $this->show->img;
        $this->show->setAttributes($this->getAttributes());
        $this->show->user_id = Yii::$app->user->id;

        if (!$this->setLocation()) {

            $transaction->rollBack();
            return false;
        }

        if ($this->show->save()) {

            $transaction->commit();
            return true;
        }

        $transaction->rollBack();
        return false;
    }

    /**
     * @return bool
     */
    public function setLocation()
    {
        if ($this->latitude && $this->longitude) {
            $this->show->setGoogleLocation($this->latitude, $this->longitude);
        }

        $location = explode(', ', $this->address);
        $count = count($location);

        if ($count < 3) {

            $this->addError('address', 'Выберете, как минимум, город, а лучше еще и адресс указать');
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->show->getImage();
    }
}