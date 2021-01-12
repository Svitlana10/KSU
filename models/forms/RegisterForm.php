<?php
declare(strict_types=1);

namespace app\models\forms;

use app\models\Show;
use app\services\PayKeeperApi;
use yii\base\Model;
use yii\db\Exception;

/**
 * Class RegisterForm
 * @package app\models\forms
 */
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
     * RegisterForm constructor.
     * @param array $config
     */
    public function __construct(
        $config = []
    )
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
            [['clientid'], 'required'],
            [['clientid'], 'string'],
        ];
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function create()
    {
        if (!$this->dog->validate()) {

            $this->addErrors($this->dog->errors);
            return false;
        }

        if (!$this->validate()) {

            $this->addErrors($this->errors);
            return false;
        }

        if (!$this->dog->create()) {

            $this->addErrors($this->dog->errors);
            return false;
        }

        $pay = new PayKeeperApi();

        $pay->getCreate($this->clientid, $this->show->price);

        return true;
    }

}