<?php

namespace app\services;

use GuzzleHttp\Client;
use yii\helpers\Json;

/**
 * Class ShinaApi
 * @package app\services
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
    private $request = [];

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
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function getPartnerInfo($request = [])
    {

        $this->uri = $this->domain . '/connect';
        $this->request = $request;

        return $this->sendRequest();
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function getCategories( $request = [] )
    {

        $this->uri = $this->domain . '/category/list';
        $this->request= $request;

        return $this->sendRequest();
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function getRegions( $request = [] )
    {

        $this->uri = $this->domain . '/region/list';
        $this->request= $request;

        return $this->sendRequest();
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function getBillList( $request = [] )
    {
        $hash = md5( Json::encode( array_merge( [ 'name' => 'ShinaApi_getBillList' ], $request ) ) );
        
        $respons = false;
        
        if( empty($respons) ){
        
            $this->uri = $this->domain . '/bill/list';
            $this->request= $request;

            $respons = $this->sendRequest();
        }
        
        return $respons;
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function getBillInfo( $request = [] )
    {

        $hash = md5( Json::encode( array_merge( [ 'name' => 'ShinaApi_getBillInfo' ], $request ) ) );
        
        $response =  false;
        
        if( empty($response) ){
        
            $this->uri = $this->domain . '/bill/info';
            $this->request= $request;

            $response = $this->sendRequest();
        }
        
        return $response;
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function getBillFields( $request = [] )
    {

        $this->uri = $this->domain . '/bill/fields';
        $this->request = $request;

        return $this->sendRequest();
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function getBillValidate( $request = [] )
    {

        $this->uri = $this->domain . '/bill/validate';
        $this->request = $request;

        return $this->sendRequest();
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function createCart( $request = [] )
    {

        $this->uri = $this->domain . '/cart/create';
        $this->request = $request;

        return $this->sendRequest();
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function getCartInfo($request = [])
    {

        $this->uri = $this->domain . '/cart/info';
        $this->request = $request;

        return $this->sendRequest();
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function setCartUser($request = [])
    {

        $this->uri = $this->domain . '/cart/user';
        $this->request = $request;

        return $this->sendRequest();
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function addCart( $request = [] )
    {

        $this->uri = $this->domain . '/cart/add';
        $this->request = $request;

        return $this->sendRequest();
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function payCart( $request = [] )
    {

        $this->uri = $this->domain . '/cart/pay';
        $this->request = $request;

        return $this->sendRequest();
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function cancelCart( $request = [] )
    {

        $this->uri = $this->domain . '/cart/cancel';
        $this->request = $request;

        return $this->sendRequest();
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function verificationPayCart( $request = [] )
    {

        $this->uri = $this->domain . '/cart/pay/verification';
        $this->request = $request;

        return $this->sendRequest();
    }

    /**
     * @param array $request
     * @return bool|mixed
     */
    public function getCartOperations( $request = [] )
    {
        $this->uri = $this->domain . '/cart/operations';
        $this->request = $request;

        return $this->sendRequest();
    }

    /**
     * @return bool|mixed
     */
    public function sendRequest()
    {
        $time = date('Y:m:d H:i:s');

        $this->validateBeforeSend();

        $auth_params = [
            'app_id' => $this->app_id,
            'sig' => $this->getSig($time),
            'time' => $time,
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
     * @param string $time
     * @return string
     * вычисляет подпись
     */
    public function getSig( $time = '' )
    {
        return md5( $this->app_id . $this->app_key . $time );
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
