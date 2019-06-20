<?php

namespace app\services;

use GuzzleHttp\Client;
use yii\helpers\Json;

/**
 * Class ShinaApi
 * @package app\services
 *
 * @property bool|mixed partnerInfo
 * @property bool|mixed categories
 * @property bool|mixed regions
 * @property bool|mixed billList
 * @property bool|mixed billInfo
 * @property bool|mixed billFields
 * @property bool|mixed billValidate
 * @property bool|mixed cartCreate
 * @property bool|mixed cartInfo
 * @property bool|mixed cartSetUser
 * @property bool|mixed cartAdd
 * @property bool|mixed cartPay
 * @property bool|mixed cartCancel
 * @property bool|mixed cartVerificationPay
 * @property bool|mixed cartOperations
 * @property bool|mixed sig
 */
class ShinaApi
{

    /**
     * @var string $app_id
     */
    private $app_id;

    /**
     * @var string $app_key
     */
    private $app_key;

    /**
     * @var string $domain
     */
    private $domain = 'https://www.ipay.ua/shina';

    /**
     * @var bool $uri
     */
    private $uri = false;

    /**
     * @var array $request
     */
    public $request = [];

    /**
     * @var string $time
     */
    public $time;

    /**
     * @var bool $enable_caching
     */
    private $enable_caching = false;

    /**
     * @var int $CART_STATUS_0
     * на оплату не подавалась
     */
    public static $CART_STATUS_0 = 0;

    /**
     * @var int $CART_STATUS_1
     * был создан платеж
     */
    public static $CART_STATUS_1 = 1;

    /**
     * @var int $CART_STATUS_4
     * неуспех
     */
    public static $CART_STATUS_4 = 4;

    /**
     * @var int $CART_STATUS_5
     * успех
     */
    public static $CART_STATUS_5 = 5;

    /**
     * ShinaApi constructor.
     * @param array $params
     */
    public function __construct( $params = array() )
    {
        $this->app_id  = env('PAY_APP_ID', 'localhost');
        $this->app_key = env('PAY_APP_KEY', 'localhost');
        $this->item = date('Y:m:d H:i:s');
    }

    /**
     * @return bool|mixed
     */
    public function getPartnerInfo()
    {
        $this->uri = $this->domain . '/connect';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function getCategories()
    {
        $this->uri = $this->domain . '/category/list';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function getRegions()
    {
        $this->uri = $this->domain . '/region/list';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function getBillList()
    {
        $hash = md5( Json::encode( array_merge( [ 'name' => 'ShinaApi_getBillList' ], $this->request ) ) );
        
        $response = false;
        
        if( empty($respons) ){
        
            $this->uri = $this->domain . '/bill/list';

            $response = $this->sendRequest();
        }
        
        return $respons;
    }

    /**\
     * @return bool|mixed
     */
    public function getBillInfo()
    {

        $hash = md5( Json::encode( array_merge( [ 'name' => 'ShinaApi_getBillInfo' ], $this->request ) ) );
        
        $response =  false;
        
        if( empty($response) ){
        
            $this->uri = $this->domain . '/bill/info';

            $response = $this->sendRequest();
        }
        
        return $response;
    }

    /**
     * @return bool|mixed
     */
    public function getBillFields()
    {
        $this->uri = $this->domain . '/bill/fields';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function getBillValidate()
    {
        $this->uri = $this->domain . '/bill/validate';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function getCartCreate()
    {
        $this->uri = $this->domain . '/cart/create';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function getCartInfo()
    {
        $this->uri = $this->domain . '/cart/info';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function getCartSetUser()
    {
        $this->uri = $this->domain . '/cart/user';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function getCartAdd()
    {
        $this->uri = $this->domain . '/cart/add';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function getCartPay()
    {
        $this->uri = $this->domain . '/cart/pay';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function getCartCancel()
    {
        $this->uri = $this->domain . '/cart/cancel';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function getCartVerificationPay()
    {
        $this->uri = $this->domain . '/cart/pay/verification';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function getCartOperations()
    {
        $this->uri = $this->domain . '/cart/operations';

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    private function sendRequest()
    {
        $this->validateBeforeSend();

        $auth_params = [
            'app_id' => $this->app_id,
            'sig' => $this->sig,
            'time' => $this->time,
        ];

        $params = $auth_params + $this->request;

        $hash = md5( Json::encode([
            'name' => 'ShinaApi',
            'uri' => $this->uri,
            'request' => $this->request,
        ]));

        $client = new Client();

        $response = $client->post($this->uri, [
            'form_params' => [
                $params
            ]
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @return string
     * вычисляет подпись
     */
    public function getSig()
    {
        return md5( $this->app_id . $this->app_key . $this->time );
    }

    /**
     * Validate data before send request
     */
    private function validateBeforeSend()
    {
        if (empty($this->app_id)) {
            die('Empty app_id');
        }
        if (empty($this->app_key)) {
            die('Empty app_key');
        }
        if (empty($this->uri)) {
            die('Empty uri');
        }
    }
}
