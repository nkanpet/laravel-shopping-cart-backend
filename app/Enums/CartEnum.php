<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CartEnum extends Enum
{
    const STATUS_CREATE = 0;
    const STATUS_CHECKOUT = 1;
}
