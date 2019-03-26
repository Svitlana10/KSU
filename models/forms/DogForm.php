<?php
/**
 * Created by PhpStorm.
 * User: comrade
 * Date: 15.03.19
 * Time: 23:55
 */

namespace app\models\forms;

use app\models\Article;
use app\models\Category;
use app\models\Dog;
use app\models\DogBreeds;
use app\models\DogTypes;
use app\models\ImageUpload;
use app\models\User;
use yii\base\Model;

/**
 * Class ArticleForm
 * @package app\models\forms
 */
class DogForm extends Model
{
    /** @var integer $id */
    public $id;

    /** @var string $dog_name */
    public $dog_name;

    /** @var integer $breed_id*/
    public $breed_id;

    /** @var string $breed_title */
    public $breed_title;

    /** @var integer $pedigree_number*/
    public $pedigree_number;

    /** @var string $owner*/
    public $owner;

    /** @var integer $status */
    public $status;

    /** @var integer $months */
    public $months;

    /** @var integer $category_id */
    public $type_id;

    /** @var integer $created_at */
    public $created_at;

    /** @var integer $updated_at */
    public $updated_at;

    /** @var Dog $dog */
    public $dog;

    /** @var DogBreeds $breed*/
    public $breed;

    /** @var DogTypes $type*/
    public $type;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if($this->dog){
            $this->setAttributes($this->dog->getAttributes());
        }
    }

    /**
     * {@inheritdoc}
     * @return array
     */
    public function rules()
    {
        return[
            [['months', 'type_id', 'status'], 'integer'],
            [['dog_name', 'pedigree_number', 'owner'], 'string', 'max' => 255],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DogTypes::class, 'targetAttribute' => ['type_id' => 'id']],
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

        $this->dog->setAttributes($this->getAttributes());

        if($this->dog->save()){

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

        $this->dog->setAttributes($this->getAttributes());

        if($this->dog->save()){

            $transaction->commit();
            return true;
        }

        $transaction->rollBack();
        return false;
    }
}