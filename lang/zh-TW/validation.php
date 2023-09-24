<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'integer'              => '$(:attribute)必須為整數',
    'string'               => '$(:attribute)必須為字串',
    'boolean'              => '$(:attribute)必須為布林值.',
    'array'                => '$(:attribute)必須為陣列',
    'image'                => '$(:attribute)必須為圖片.',
    'date_format'          => '$(:attribute)必須為指定日期格式 [:format].',
    'required'             => '$(:attribute)為必填.',
    'required_if'          => '$(:attribute)為必填.',
    'size'                 => [
        'numeric' => '$(:attribute)必須是長度:size的數字',
        'file'    => '$(:attribute)必須是大小:size kb的檔案',
        'string'  => '$(:attribute)必須是長度:size的字串',
        'array'   => '$(:attribute)必須是包含:size個項目的陣列',
    ],
    'min'                  => [
        'numeric' => '$(:attribute)必須是大小大於等於:min的數字',
        'file'    => '$(:attribute)必須是大小大於等於:min kb的檔案',
        'string'  => '$(:attribute)必須是長度大於等於:min的字串',
        'array'   => '$(:attribute)必須是大於等於:min個項目的陣列',
    ],
    'max'                  => [
        'numeric' => '$(:attribute)必須是大小小於等於:max的數字',
        'file'    => '$(:attribute)必須是大小小於等於:max kb的檔案',
        'string'  => '$(:attribute)必須是長度小於等於:max的字串',
        'array'   => '$(:attribute)必須是小於等於:max個項目的陣列',
    ],
    'gt'                   => [
        'numeric' => '$(:attribute)必須是大小大於:value的數字',
        'file'    => '$(:attribute)必須是大小大於:value kb的檔案',
        'string'  => '$(:attribute)必須是長度大於:value的字串',
        'array'   => '$(:attribute)必須是大於:value個項目的陣列',
    ],
    'gte'                  => [
        'numeric' => '$(:attribute)必須是大小大於等於:value的數字',
        'file'    => '$(:attribute)必須是大小大於等於:value kb的檔案',
        'string'  => '$(:attribute)必須是長度大於等於:value的字串',
        'array'   => '$(:attribute)必須是大於等於:value個項目的陣列',
    ],
    'lt'                   => [
        'numeric' => '$(:attribute)必須是大小小於:value的數字',
        'file'    => '$(:attribute)必須是大小小於:value kb的檔案',
        'string'  => '$(:attribute)必須是長度小於:value的字串',
        'array'   => '$(:attribute)必須是小於:value個項目的陣列',
    ],
    'lte'                  => [
        'numeric' => '$(:attribute)必須是大小小於等於:value的數字',
        'file'    => '$(:attribute)必須是大小小於等於:value kb的檔案',
        'string'  => '$(:attribute)必須是長度小於等於:value的字串',
        'array'   => '$(:attribute)必須是小於等於:value個項目的陣列',
    ],
    'between'              => [
        'numeric' => '$(:attribute)必須是大小介於:min ~ :max的數字',
        'file'    => '$(:attribute)必須是大小介於:min ~ :max kb的檔案',
        'string'  => '$(:attribute)必須是長度介於:min ~ :max的字串',
        'array'   => '$(:attribute)必須是介於:min ~ :max個項目的陣列',
    ],



    'accepted'             => 'The $(:attribute) must be accepted.',
    'active_url'           => 'The $(:attribute) is not a valid URL.',
    'after'                => 'The $(:attribute) must be a date after :date.',
    'after_or_equal'       => 'The $(:attribute) must be a date after or equal to :date.',
    'alpha'                => 'The $(:attribute) may only contain letters.',
    'alpha_dash'           => 'The $(:attribute) may only contain letters, numbers, dashes and underscores.',
    'alpha_num'            => 'The $(:attribute) may only contain letters and numbers.',
    'before'               => 'The $(:attribute) must be a date before :date.',
    'before_or_equal'      => 'The $(:attribute) must be a date before or equal to :date.',
    
    'confirmed'            => 'The $(:attribute) confirmation does not match.',
    'date'                 => 'The $(:attribute) is not a valid date.',
    'different'            => 'The $(:attribute) and :other must be different.',
    'digits'               => 'The $(:attribute) must be :digits digits.',
    'digits_between'       => 'The $(:attribute) must be between :min and :max digits.',
    'dimensions'           => 'The $(:attribute) has invalid image dimensions.',
    'distinct'             => 'The $(:attribute) field has a duplicate value.',
    'email'                => 'The $(:attribute) must be a valid email address.',
    'exists'               => 'The selected $(:attribute) is invalid.',
    'filled'               => 'The $(:attribute) field must have a value.',
    'in'                   => 'The selected $(:attribute) is invalid.',
    'in_array'             => 'The $(:attribute) field does not exist in :other.',
    'ip'                   => 'The $(:attribute) must be a valid IP address.',
    'ipv4'                 => 'The $(:attribute) must be a valid IPv4 address.',
    'ipv6'                 => 'The $(:attribute) must be a valid IPv6 address.',
    'json'                 => 'The $(:attribute) must be a valid JSON string.',
    'mimes'                => 'The $(:attribute) must be a file of type: :values.',
    'mimetypes'            => 'The $(:attribute) must be a file of type: :values.',
    'not_in'               => 'The selected $(:attribute) is invalid.',
    'not_regex'            => 'The :attribute format is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required_unless'      => 'The $(:attribute) field is required unless :other is in :values.',
    'required_with'        => 'The $(:attribute) field is required when :values is present.',
    'required_with_all'    => 'The $(:attribute) field is required when :values is present.',
    'required_without'     => 'The $(:attribute) field is required when :values is not present.',
    'required_without_all' => 'The $(:attribute) field is required when none of :values are present.',
    'same'                 => 'The $(:attribute) and :other must match.',
    'timezone'             => 'The $(:attribute) must be a valid zone.',
    'unique'               => 'The $(:attribute) has already been taken.',
    'uploaded'             => 'The $(:attribute) failed to upload.',
    'url'                  => 'The $(:attribute) format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
