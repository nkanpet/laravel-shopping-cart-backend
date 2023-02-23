<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CategoryEnum extends Enum
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
}
