<?php

declare(strict_types=1);

namespace App\Support;

class Database
{
    public static function driver(): string
    {
        return \db_driver();
    }

    public static function driverLabel(): string
    {
        return \db_driver_label();
    }
}
