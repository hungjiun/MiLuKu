<?php

namespace App\Http\Responses;

use App\Exceptions\ECException;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Log;

class ECExtensionResponse implements Responsable
{
    const STATUS_CODE_SUCCESS = 0x00000000;
    const STATUS_CODE_UNKNOWN_ERROR = ECException::ERROR_CODE_UNKNOWN;
    const STATUS_CODE_LOGIN_ERROR = ECException::ERROR_CODE_UNKNOWN;
    const STATUS_CODE_PERMISSION_ERROR = ECException::ERROR_CODE_AUTH_INCORRECT_PERMISSION;

    private $payload;
    private $statusCode;
    private $message;

    public function __construct($payload, $statusCode = self::STATUS_CODE_SUCCESS, $message = null)
    {
        $this->payload = $payload;
        $this->statusCode = $statusCode;
        $this->message = $message;
    }

    private function isDataPaginated() : bool
    {
        return is_array($this->payload) &&
            array_key_exists('total', $this->payload) &&
            array_key_exists('current_page', $this->payload) &&
            array_key_exists('number_per_page', $this->payload);
    }

    public function toResponse($request)
    {
        //Log::info(__METHOD__ . '(' . __LINE__ . ')');
        $response = [
            'status' => sprintf('0x%08X', $this->statusCode),
            'data' => $this->payload,
            'message' => $this->message,
        ];

        if ($this->isDataPaginated()) {
            $response['data'] = $this->payload['data'];
            $response = array_merge($this->payload, $response);
        }
        //Log::info(__METHOD__ . '(' . __LINE__ . ') - ' . json_encode($response));

        return $response;
    }
}
