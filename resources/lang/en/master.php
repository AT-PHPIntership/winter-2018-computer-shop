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
        'rolePermission' => 'Roles & Permissions',
        'role' => 'Roles',
        'permission' => 'Permissions',
        'category' => 'Categories Management',
        'product' => 'Products Management',
        'image' => 'Images Management',
        'img_category' => 'Categories',
        'img_product' => 'Products',
        'comment' => 'Comments Management',
        'order' => 'Orders Management',
        'order_details' => 'Orders Details Management',
        'promotion' => 'Promotions Management',
        'code' => 'Codes Management',
        'slide' => 'Slides Management',
        'accessory' => 'Accessories Management',
        'slide' => 'Slides Management',
        'comment_details' => 'Comment Detail Management',
    ],
    'content' => [
        'dashboard' => [
            'title' => 'Dashboard',
            'totals' => 'Total',
            'user' => 'User',
            'order' => 'Order',
            'product' => 'Product',
            'statistic_order' => 'Statistic Order',
            'cancel' => 'Cancel',
            'pending' => 'Pending',
            'approve' => 'Approve',
            'export' => 'Export to Excel',
        ],
        'action' => [
            'add' => 'Add New :attribute',
            'detail' => 'View Details',
            'edit' => 'Edit :attribute',
            'delete' => 'Delete :attribute',
            'show' => 'Details about :attribute',
            'import' => 'Import :attribute',
            'back' => 'Back',
            'product' => [
                'details' => 'Details',
                'edit' => 'Edit',
                'delete' => 'Delete',
            ]
        ],
        'table' => [
            'email' => 'Email',
            'action' => 'Actions',
            'role' => 'Role',
            'id' => '#',
            'display' => 'Display',
            'product' => 'Product',
            'productName' => 'Product Name',
            'order_date' => 'Order Date',
            'status' => 'Status',
            'note' => 'Note',
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
            'parent_id' => 'Parent name',
            'total_sold' => 'Sold Quantity (<)',
            'parent_id' => 'Parent name',
            'details' => 'Details',
            'date_order' => 'Date order',
            'user' => 'User',
            'address' => 'Adress',
            'phone' => 'Phone',
            'accessory' => 'Accessories',
            'note' => 'Note',
            'status' => 'Status',
            'product_name' => 'Product Name',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'order_month' => 'Order in month',
            'all_user' => 'All user',
            'user_name' => 'User Name',
            'content' => 'Content',
            'save' => 'Save Permission'
        ],
        'form' => [
            'password' => 'Password',
            'current_pw' => 'Current Password',
            'hint' => 'Hint: You do not input the current password field',
            'new_pw' => 'New Password',
            'confirm_pw' => 'Confirm Password',
            'name' => 'Name',
            'sold' => 'Total Sold',
            'address' => 'Address',
            'phone' => 'Phone',
            'avatar' => 'Avatar',
            'image' => 'Image',
            'parent' => 'Parent Category',
            'category' => 'Category',
            'description' => 'Description',
            'display' => 'Display Name',
            'price' => 'Price(đ)',
            'discount' => 'Discount(đ)',
            'quantity' => 'Quantity',
            'file' => 'File',
            'status' => 'Status',
            'image' => 'Image',
        ],
        'message' => [
            'create' => 'Created a :attribute successfully',
            'update' => 'Updated the :attribute successfully',
            'delete' => 'Deleted the :attribute successfully',
            'import' => 'Imported :attribute product(s) successfully',
            'noProductImport' => 'All products in this file are duplicated',
            'error' => 'The :attribute happens',
            'warning' => 'You can not delete the category because it is has sub-category',
            'img' => 'does not have :attribute',
            'order' => 'You can not delete the user because the user has order!',
            'role' => 'You can not delete the role because it used by the user!',
            'admin' => 'You can not delete the user because he(she) was admin',
            'comment' => 'You can not delete the user because the user has comment at some product!',
            'role' => 'One of the roles of permission number :attribute is invalid',
            'user' => 'You can not delete the role because it used by the users!',
            'product' => 'You can not delete the category because it used by the products!',
            'orderDetail' => 'You can not delete the product because it has some orders use the product!',
            'commentProduct' => 'You can not delete the product because it has some comments!',
        ],
        'attribute' => [
            'user' => 'user',
            'name' => 'name',
            'email' => 'email',
            'password' => 'password',
            'current' => 'current_password',
            'address' => 'address',
            'phone' => 'phone',
            'role' => 'role',
            'User' => 'User',
            'permission' => 'permission', 
            'Permission' => 'Permission', 
            'category' => 'category',
            'Category' => 'Category',
            'avatar' => 'avatar',
            'code' => 'code',
            'product' => 'product',
            'Product' => 'Product',
            'Slide' => 'Slide',
            'slide' => 'slide',
            'accessory' => 'accessory',
            'product' => 'product',
            'Product' => 'Product',
            'Slide' => 'Slide',
            'slide' => 'slide',
            'image' => 'image',
            'desc' => 'description',
            'comment' => 'comment',
        ],
        'select' => [
            'choose' => 'Choose here',
            'parent' => 'Become parent category',
            'no' => 'No',
            'yes' => 'Yes'
        ],
        'button' => [
            'create' => 'Create',
            'update' => 'Update',
            'cancel' => 'Cancel',
            'upload' => 'Upload',
        ],
        'permissions' => [
            'add' => 'Add',
            'view' => 'View',
            'edit' => 'Edit',
            'delete' => 'Delete',
        ],
    ],
    'footer' => [
        'design' => 'Design by',
        'year' => '2017-2019',
        'author' => 'Bootstrapious',
    ]
];
