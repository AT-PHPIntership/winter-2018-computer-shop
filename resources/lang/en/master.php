<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Define Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'title' => 'Computer Shop Admin',
    'header' => [
        'title' => 'Computer Shop',
        'admin' => 'Admin',
        'logout' => 'Logout',
    ],
    'sidebar' => [
        'home' => 'Home',
        'user' => 'Users Management',
        'role' => 'Roles Management',
        'category' => 'Categories Management',
        'product' => 'Products Management',
        'image' => 'Images Management',
        'img_category' => 'Categories',
        'img_product' => 'Products',
        'comment' => 'Comments Management',
        'order' => 'Orders Management',
        'promotion' => 'Promotions Management',
        'code' => 'Codes Management',
    ],
    'content' => [
        'action' => [
            'add' => 'Add New :attribute',
            'detail' => 'View Details',
            'edit' => 'Edit :attribute',
            'delete' => 'Delete :attribute',
            'show' => 'Details about :attribute',
            'import' => 'Import :attribute',
        ],
        'table' => [
            'email' => 'Email',
            'action' => 'Actions',
            'role' => 'Role',
            'id' => '#',
            'product' => 'Product',
            'active' => 'Actived',
            'percent' => 'Percent',
            'start_at' => 'Start At',
            'end_at' => 'End At',
            'amount' => 'Amount',
            'ram' => 'RAM',
            'cpu' => 'CPU',
            'hdd' => 'HDD',
            'monitor' => 'Monitor',
            'gpu' => 'GPU',
        ],
        'form' => [
            'password' => 'Password',
            'confirm_pw' => 'Confirm Password',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'avatar' => 'Avatar',
            'image' => 'Image',
            'parent' => 'Parent Category',
            'category' => 'Category',
            'description' => 'Description',
            'price' => 'Price(đ)',
            'quantity' => 'Quantity',
            'file' => 'File',
        ],
        'message' => [
            'create' => 'Created a :attribute successfully',
            'update' => 'Updated the :attribute successfully',
            'delete' => 'Deleted the :attribute successfully',
            'import' => 'Imported the file successfully',
            'error' => 'The :attribute happens',
            'img' => 'does not have avatar',
        ],
        'attribute' => [
             'user' => 'user',
             'role' => 'role',
             'User' => 'User',
             'category' => 'category',
             'Category' => 'Category',
             'avatar' => 'avatar',
             'code' => 'code',
             'product' => 'product',
             'Product' => 'Product',
        ],
        'select' => [
            'choose' => 'Choose here',
            'parent' => 'Become parent category',
        ],
        'button' => [
            'create' => 'Create',
            'update' => 'Update',
            'cancel' => 'Cancel',
            'upload' => 'Upload',
        ],
    ],
    'footer' => [
        'design' => 'Design by',
        'year' => '2017-2019',
        'author' => 'Bootstrapious',
    ]
];
