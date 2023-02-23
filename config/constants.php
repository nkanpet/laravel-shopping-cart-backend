<?php

use App\Enums\ProductEnum;

return [
    'product_status_options' => [
        ProductEnum::STATUS_ACTIVE => 'ใช้งาน',
        ProductEnum::STATUS_INACTIVE => 'ไม่ใช้งาน'
    ],
    'category_status_options' => [
        ProductEnum::STATUS_ACTIVE => 'ใช้งาน',
        ProductEnum::STATUS_INACTIVE => 'ไม่ใช้งาน'
    ],
    'client_status_options' => [
        ProductEnum::STATUS_ACTIVE => 'ใช้งาน',
        ProductEnum::STATUS_INACTIVE => 'ไม่ใช้งาน'
    ]
];
