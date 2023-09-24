<?php

return [
    'ERROR_CODE' => [
        //General
        'C01'									=> '成功',
        'APP_ID_INVALID' 						=> '認證檢核發生錯誤',
        'APP_ID_INVALID_DETAIL'					=> 'App_id 不存在',
        'SIGN_INVALID'							=> '認證檢核發生錯誤',
        'SIGN_INVALID_DETAIL'					=> 'sign 校驗錯誤',
        'REQUEST_PARAMETER_IS_MISSING' 			=> 'request_parameter 缺漏',
        'REQUEST_PARAMETER_IS_MISSING_DETAIL'	=> 'request 要傳入的 request_parameter 沒傳',
        'REQUEST_KEY_IS_MISSING' 			    => 'request_key 缺漏',
        'REQUEST_KEY_IS_MISSING_DETAIL'	        => 'request 要傳入的 request_key 沒傳',
        'REQUIRED_PARAMETER_IS_MISSING'			=> 'request 必傳欄位缺漏',
        'REQUIRED_PARAMETER_IS_MISSING_DETAIL'	=> 'request 必傳欄位缺漏',
        'VALUE_TYPE_ERROR' 						=> '資料型態錯誤',
        'VALUE_TYPE_ERROR_DETAIL' 				=> '資料型態錯誤',
        'DATETIME_FORMAT_ERROR'					=> '時間格式錯誤',
        'DATETIME_FORMAT_ERROR_DETAIL'			=> '時間格式錯誤',
        'QUERY_RANGE_ERROR'						=> '值域錯誤',
        'QUERY_RANGE_ERROR_DETAIL'				=> '查詢範圍錯誤',
        'QUERY_DATE_ERROR'						=> '值域錯誤',
        'QUERY_DATE_ERROR_DETAIL'				=> '查詢結束時間小於開始時間',
        'SERVER_BUSY'							=> '伺服器忙碌',
        'SERVER_BUSY_DETAIL'					=> 'API流量鎖定',
        'API_ERROR'								=> 'API執行錯誤',
        'API_ERROR_DETAIL'						=> 'API執行發生錯誤',
        'API_VERIFICATION_ERROR'				=> 'API驗證錯誤',
        'API_VERIFICATION_ERROR_DETAIL'			=> 'API驗證發生錯誤',
        'API_HEADER_ERROR'						=> 'API Header Error',
        'API_HEADER_ERROR_DETAIL'				=> 'API Header Error',
        'CURL_ERROR'				            => 'CURL錯誤',
        'CURL_ERROR_DETAIL'                     => 'CURL 發生無法預期之錯誤',
        'API_IP_ERROR'				            => 'API Ip 錯誤',
        'API_IP_ERROR_DETAIL'                   => 'API綁定ip錯誤',
        'TEST_FUNCTION_DOES_NOT_ENABLE'         => '測試功能未開啟',

        //Redis
        'REDIS_ERROR'                           => 'Redis 錯誤',
        'REDIS_ERROR_DETAIL'                    => 'Redis 發生無法預期之錯誤',
        'REDIS_KEY_IS_NOT_EXIST'                => 'Redis 錯誤',
        'REDIS_KEY_IS_NOT_EXIST_DETAIL'         => 'Redis Key不存在',

        'AUTH_LOGIN_SUCCESS'                    => '登入成功',
        'AUTH_INCORRECT_USERNAME_OR_PASSWORD'   => '帳號或密碼錯誤',
        /* 'AUTH_INCORRECT_TRY_AGAIN'              => '為確保帳號安全，錯誤 3 次會限制登入 30 分鐘。若您忘記密碼，請聯繫管理人員為您重設密碼。',
        'AUTH_INCORRECT_EXCEED_MAX'             => '帳號或密碼輸入錯誤已達 3 次。為確保帳號安全， 30 分鐘內無法進行登入。', */
        'AUTH_INCORRECT_TRY_AGAIN'              => '為確保帳號安全，錯誤 :number 次會限制登入 :minutes 分鐘。若您忘記密碼，請聯繫管理人員為您重設密碼。',
        'AUTH_INCORRECT_EXCEED_MAX'             => '帳號或密碼輸入錯誤已達 :number 次。為確保帳號安全， :minutes 分鐘內無法進行登入。',
    ],
];
