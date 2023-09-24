<?php


namespace App\Modules\Product\Constants;

class ProductStatus
{
    const NONE = 0;
    const DISABLE = 1;
    const ENABLE = 2;

    const STATUS = [
        self::NONE,
        self::DISABLE,
        self::ENABLE,
    ];

    const STATUS_TEXT = [
        self::NONE => '未知',
        self::DISABLE => '下架',
        self::ENABLE => '上架',
    ];

    public static function validate(int $status = 0)
    {
        return in_array($status, self::STATUS);
    }

    public static function getText(int $status = 0)
    {
        throw_unless(
            self::validate($status),
            'Status error!'
        );
        return self::STATUS_TEXT[$status];
    }
}
