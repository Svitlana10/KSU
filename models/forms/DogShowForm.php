<?php
/**
 * Created by PhpStorm.
 * User: comrade
 * Date: 15.03.19
 * Time: 23:55
 */

namespace app\models\forms;

use app\models\Dog;
use app\models\DogBreeds;
use app\models\DogTypes;
use app\models\Show;
use Yii;
use yii\base\Model;
use yii\db\Exception;

/**
 * Class DogShowForm
 * @package app\models\forms
 */
class DogShowForm extends Model
{
    // region DOG_SHOW_ROWS

    /**
     * @var integer $id
     */
    public $id;

    /**
     * @var string $dog_name
     */
    public $dog_name;

    /**
     * @var integer $breed_id
     */
    public $breed_id;

    /**
     * @var string $breed_title
     */
    public $breed_title;

    /**
     * @var integer $pedigree_number
     */
    public $pedigree_number;

    /**
     * @var string $owner
     */
    public $owner;

    /**
     * @var integer $status
     */
    public $status;

    /**
     * @var integer $months
     */
    public $months;

    /**
     * @var integer $category_id
     */
    public $type_id;

    /**
     * @var string $payImage
     */
    public $payImage;

    /**
     * @var integer $created_at
     */
    public $created_at;

    /**
     * @var integer $updated_at
     */
    public $updated_at;

    // endregion

    /** @var string $email */
    public $email;

    /**
     * @var Dog $dog
     */
    public $dog;

    /**
     * @var DogBreeds $breed
     */
    public $breed;

    /**
     * @var DogTypes $type
     */
    public $type;

    /**
     * @var Show $show
     */
    public $show;

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
            [['email', 'owner', 'pedigree_number', 'dog_name', 'breed_title', 'type_id', 'pay_image'], 'required'],
            [['email'], 'email'],
            [['months', 'type_id', 'status'], 'integer'],
            [['dog_name', 'pedigree_number', 'owner', 'breed_title'], 'string', 'max' => 255],
            ['payImage', 'file', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'], 'checkExtensionByMimeType' => true, 'maxSize' => 15 * 1024 * 1024],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DogTypes::class, 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                => '№',
            'dog_name'          => 'Кличка',
            'breed_title'       => 'Порода',
            'breed_id'          => 'Порода',
            'pedigree_number'   => '# родословної',
            'owner'             => 'Хазяїн',
            'months'            => 'Вік (в місяцях)',
            'email'             => 'Почтова скринька',
            'type_id'           => 'Стать',
            'payImage'         => 'Скрін Чеку'
        ];
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function create()
    {
        if(!$this->validate()){
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();

        $this->dog = new Dog();
        $this->dog->setAttributes($this->getAttributes());

        if($this->checkDogBreed() && $this->dog->save()){

            $this->dog->link('show', $this->show);
            $transaction->commit();
            $this->sendMail();
            return true;
        }

        $transaction->rollBack();
        return false;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function update()
    {
        if(!$this->validate()){
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();

        $this->dog->setAttributes($this->getAttributes());
        $this->dog->link('show', $this->show);

        if($this->dog->save()){

            $transaction->commit();
            return true;
        }

        $transaction->rollBack();
        return false;
    }

    /**
     * @return bool
     */
    protected function checkDogBreed()
    {
        $this->breed = DogBreeds::find()->where(['like', 'title', $this->breed_title])->one();

        if(!$this->breed) {
            $this->breed = new DogBreeds();
            $this->breed->title = $this->breed_title;
            $this->breed->status = DogBreeds::STATUS_NEW;

            if(!$this->breed->save()){
                $this->addErrors($this->breed->getErrors());
                return false;
            }
        }

        $this->dog->breed_id = $this->breed->id;

        return true;
    }

    /**
     * Send email for dog`s confirm
     * @return bool
     */
    protected function sendMail()
    {
        return Yii::$app->mailer->compose(
            ['html' => 'approveDog-html', 'text' => 'approveDog-text'],
            ['dog' => $this->dog])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['appName']])
            ->setTo($this->email)
            ->setSubject(Yii::$app->params['appName']. ' - approve dog')
            ->send();
    }
}