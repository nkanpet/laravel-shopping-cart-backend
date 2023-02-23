<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ProductEnum extends Enum
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 10;
}
