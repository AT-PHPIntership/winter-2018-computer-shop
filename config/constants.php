<?php
return [
    'role' => [
        'number_paginate' => '5'
    ],
    'promotion' => [
        'number_paginate' => '5'
    ],
    'category' => [
        'paginate' => 10,
    ],
    'code' => [
        'number_paginate' => '5'
    ],
    'comment' => [
        'number_paginate' => '5'
    ],
    'product' => [
        'saleOff' => '2',
        'feature' => '5',
        'bestSeller' => '4',
        'newArrival' => '4',
    ],
    'category' => [
        'all' => '8'
    ],
    'banner' => [
        'quantity' => '2'
    ],
    'search' => [
        'quantity' => '5'
    ],
    'filter' => [
        'Price' => [
            '3' => 'Over 30 million',
            '2' => '20- 30 million',
            '1' => '10-20 million',
            '0' => 'Below 10 million'
        ],
        'Sort by' => [
            'latest' => 'Newest items',
            'asc' => 'Price: low to high',
            'desc' => 'Price: high to low',
        ],
    ],
    'accessory' => [
        'number_paginate' => '5'
    ],
    'price' => [
        '3' => 30000000,
        '2' => 20000000,
        '1' => 10000000,
        '0' => 0
    ],
    'order' => [
        'status' => [
            'pending' => 2,
            'approve' => 1,
            'cancel' => 0,
            'shipping' => 3,
            'delivered' => 4
        ],
        'number_paginate' => '10'
    ],
    'unit_price' => [
        'min' => 1000000,
        'max' => 500000000,
    ],
    'permission-actions' => [
        0 => 'add',
        1 => 'view',
        2 => 'edit',
        3 => 'delete',
    ],
    'permissions' => [
        '1' => 'users_manage',
        '2' => 'roles_manage',
        '3' => 'permissions_manage',
        '4' => 'categories_manage',
        '5' => 'products_manage',
        '6' => 'slides_manage',
        '7' => 'comments_manage',
        '8' => 'orders_manage',
        '9' => 'promotions_manage',
        '10' => 'codes_manage',
        '11' => 'accessories_manage',
    ],
];
