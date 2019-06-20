<?php


namespace app\models\forms;


use app\models\Show;
use yii\base\Model;
use yii\db\Exception;

class RegisterForm extends Model
{

    /**
     * @var DogShowForm $dog
     */
    public $dog;

    /**
     * @var string $clientid
     */
    public $clientid;

    /**
     * @var Show $show
     */
    public $show;

    /**
     * @var string $optional_phone
     */
    public $optional_phone;

    /**
     * RegisterForm constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->dog = new DogShowForm(['show' => $this->show]);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['show', 'optional_phone'], 'required'],
            [['show', 'optional_phone'], 'string'],
        ];
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function create()
    {
        if(!$this->dog->validate()) {

            $this->addErrors($this->dog->errors);
            return false;
        }

        if(!$this->validate()) {

            return false;
        }

        if(!$this->dog->create()) {

            return false;
        }



        return true;
    }

}