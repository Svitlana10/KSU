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
    /** @var integer $show_date */
    public $show_date;
    /** @var string $image */
    public $img;
    /** @var integer $start_reg_date */
    public $start_reg_date;
    /** @var integer $end_reg_date */
    public $end_reg_date;

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
                'title', 'description', 'address',
                'show_date', 'start_reg_da', 'end_reg_date'
            ], 'required'],
            [['description'], 'string'],
            [['show_date', 'start_reg_date', 'end_reg_date', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'address', 'img'], 'string', 'max' => 255],
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

        $this->show->setAttributes($this->getAttributes());
        $this->show->user_id = \Yii::$app->user->id;

        if($this->show->save()){

            $transaction->commit();
            return true;
        }

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