<?php


namespace app\models\forms;


use app\models\Show;
use yii\base\Model;

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

    public function create()
    {

    }

}