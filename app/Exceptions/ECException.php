<?php

namespace App\Exceptions;

use Exception;

class ECException extends Exception
{
    protected $code;

    /**
     * @param string $message
     * @param string|int $code
     */
    public function __construct($message, $code = self::ERROR_CODE_UNKNOWN)
    {
        $this->message = $message;
        $this->code = is_string($code) ? hexdec($code) : $code;
    }

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | General Error Codes
    |-------------------------------------------------------------------------------------------------------------------
     */
    const ERROR_CODE_SHOW_ERROR_MESSAGE = 0xFFFFFFFF;
    const ERROR_CODE_UNKNOWN = 0x00000001;
    const ERROR_CODE_VALIDATION_EXCEPTION = 0x00000002;
    const ERROR_CODE_FAILED_TO_CONNECT_TO_CORE = 0x00000003;
    const ERROR_CODE_INVALID_AUTH_TOKEN = 0x00000004;
    const ERROR_CODE_AUTH_TOKEN_EXPIRED = 0x00000005;
    const ERROR_CODE_AUTH_INCORRECT_USERNAME_OR_PASSWORD = 0x00000006;
    const ERROR_CODE_AUTH_INCORRECT_PERMISSION = 0x00000007;
    const ERROR_CODE_AUTH_NOT_LOGIN = 0x00000008;
    const ERROR_CODE_IP_ERROR = 0x00000009;
    const ERROR_CODE_ENCRYPT_FAIL = 0x0000000A;
    const ERROR_CODE_DECRYPT_FAIL = 0x0000000B;
    const ERROR_CODE_SIGNATURE_IS_INVALID = 0x0000000C;
    const ERROR_CODE_TEST_FUNCTION_DOES_NOT_ENABLE = 0x0000000D;
    const ERROR_CODE_THIRD_PARTY_ERROR = 0x0000000E;
    const ERROR_FOREIGN_KEY_CONSTRAINT_VIOLATION = 0x0000000F;

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | File Storage Module Error Codes
    |-------------------------------------------------------------------------------------------------------------------
     */

     const ERROR_CODE_FILE_SIZE_EXCEEDED_WHEN_STORING_IMAGE_FROM_BASE64 = 0x00110000;

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Permission Module Error Codes
    |-------------------------------------------------------------------------------------------------------------------
     */
    const ERROR_CODE_USER_PASSWORD_IS_WRONG = 0x001A0000;
}
