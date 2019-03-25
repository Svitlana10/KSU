<?php
/**
 * Created by PhpStorm.
 * User: comrade
 * Date: 18.03.19
 * Time: 1:48
 */

namespace app\models\forms;


use app\models\Show;
use app\models\ImageUpload;
use app\models\User;
use yii\base\Model;

/**
 * Class ShowForm
 * @package app\models\forms
 *
 * @property mixed $image
 */
class ShowForm extends Model
{
    /** @var integer $id */
    public $id;

    /** @var string $title */
    public $title;

    /** @var string $description */
    public $description;

    /** @var string $address */
    public $address;

    /** @var string $showDate */
    public $showDate;

    public $img;

    /** @var string $start_reg_date */
    public $startRegDate;

    /** @var string $end_reg_date */
    public $endRegDate;

    /** @var User $user */
    public $user;
    /** @var integer $user_id */
    public $user_id;

    /** @var Show $show */
    public $show;

    /** @var integer $created_at */
    public $created_at;
    /** @var integer $updated_at */
    public $updated_at;

    /** @var ImageUpload $imageUpload */
    public $imageUpload;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->show = new Show();

        if($this->show){
            $this->setAttributes($this->show->getAttributes());
            $this->showDate     = $this->show->showDate;
            $this->startRegDate = $this->show->startRegDate;
            $this->endRegDate   = $this->show->endRegDate;
            $this->user = User::findOne($this->show->user_id);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'title', 'address',
                'showDate', 'startRegDate', 'endRegDate'
            ], 'required'],
            [['description'], 'string'],
            [[
                'user_id', 'created_at', 'updated_at'
            ], 'integer'],
            [[
                'showDate', 'startRegDate', 'endRegDate'
            ], 'safe'],
            [['title', 'address'], 'string', 'max' => 255],
            ['img', 'file', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'], 'checkExtensionByMimeType' => true, 'maxSize' => 15 * 1024 * 1024],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function create()
    {
        if(!$this->validate()){
            return false;
        }

        $transaction = \Yii::$app->db->beginTransaction();

        $this->show = new Show();
        $this->show->setAttributes($this->getAttributes());
        $this->show->user_id = \Yii::$app->user->id;

        if($this->show->save()){

            $transaction->commit();
            return true;
        }
        $this->addErrors($this->show->getErrors());
        $transaction->rollBack();
        return false;
    }

    /**
     * @return bool
     * @throws \yii\db\Exception
     */
    public function update()
    {
        if(!$this->validate()){
            return false;
        }

        $transaction = \Yii::$app->db->beginTransaction();

        $this->show->setAttributes($this->getAttributes());
        $this->show->user_id = \Yii::$app->user->id;

        if($this->show->save()){

            $transaction->commit();
            return true;
        }

        $transaction->rollBack();
        return false;
    }

    public function getImage()
    {
        return $this->show->getImage();
    }
}