<?php

namespace common\models\web;

use yii\base\Exception;

class Response
{

    const RESPONSE_TYPE_JSON = 'json';
    const RESPONSE_TYPE_XML = 'xml';

    public $responseType;
    public $response;

    /**
     * Response constructor.
     * @param string $responseType
     */
    function __construct($responseType = self::RESPONSE_TYPE_JSON)
    {
        $this->responseType = $responseType;
        $this->response = $this->createResponseAsArray();
    }

    /**
     * @param $model
     * @param string $message
     */
    public function mergeModelErrors($model, $message = 'validate')
    {
        if ($model) {
            if ($model->getErrors()) {
                $errorList = array();

                foreach ($model->getErrors() as $key => $value) {
                    $errorList[] = array($key, $value);
                }

                if (!isset($this->response['errors'])) {
                    $this->response['data']['errors'] = array();
                }

                $this->response['data']['errors'] = array_merge($this->response['data']['errors'], $errorList);
                $this->response['message'] = $message;
            }
        }
    }

    /**
     * @param $value
     */
    public function setSuccess($value)
    {
        $this->response['success'] = $value;
    }

    /**
     * @return mixed
     */
    public function getSuccess()
    {
        return $this->response['success'];
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->response['message'];
    }

    /**
     * @param $value
     */
    public function setMessage($value)
    {
        $this->response['message'] = $value;
    }

    /**
     * @param $value
     */
    public function setData($value)
    {
        $this->response['data'] = $value;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->response['data'];
    }

    /**
     * @param $key
     * @param null $default
     * @return null
     */
    public function getDataValue($key, $default = null)
    {
        if (is_array($this->response) && isset($this->response['data']) && isset($this->response['data'][$key])) {
            return $this->response['data'][$key];
        }

        return $default;
    }

    /**
     * @param $value
     */
    public function setDataErrors($value)
    {
        $this->response['data']['errors'] = $value;
    }

    /**
     *
     */
    public function clearData()
    {
        $this->response['data'] = array();
    }

    /**
     * @param $key
     * @param $value
     */
    public function addData($key, $value)
    {
        $this->response['data'][$key] = $value;
    }

    /**
     * @param $field
     * @param $message
     */
    public function addDataError($field, $message)
    {
        if (!isset($this->response['data']['errors'])) {
            $this->response['data']['errors'] = array();
        }

        $this->response['data']['errors'][] = array($field, $message);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function __toString()
    {
        if ($this->responseType == self::RESPONSE_TYPE_JSON) {
            return json_encode($this->response);
        }

        throw new Exception('Response type (' . $this->responseType . ') not implemented.');
    }

    /**
     * @return array
     */
    private function createResponseAsArray()
    {
        return array(
            'success' => false,
            'message' => null,
            'data' => array(
                'errors' => array(),
            ),
        );
    }

}