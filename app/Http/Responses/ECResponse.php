<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Log;

class ECResponse implements Responsable
{
    const STATUS_CODE_SUCCESS = 0x00000000;

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
            array_key_exists('draw', $this->payload) &&
            array_key_exists('recordsTotal', $this->payload) &&
            array_key_exists('recordsFiltered', $this->payload);
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
