<?php
define('LOGO','logo/');
define('SERVICE_ICON','service-icon/');
define('PRODUCT','product/');
define('PAGE','page/');
define('SLIDER','slider/');
define('SERVICE','service/');

define('TEXT_STATUS',['1' => 'Active','2'=>'In Active']);
define('BUTTON_STATUS',[
    '1' => '<span class="kt-badge kt-badge--success kt-badge--inline">Active</span>',
    '2'=>'<span class="kt-badge kt-badge--danger kt-badge--inline">In Active</span>'
]);
define('CHECKBOX_STATUS',['1'=>'checked','2'=>'']);

define('EDIT_ICON','<i class="kt-nav__link-icon flaticon2-contract text-info"></i> <span class="kt-nav__link-text">Edit</span>');
define('VIEW_ICON','<i class="kt-nav__link-icon flaticon2-expand text-success"></i> <span class="kt-nav__link-text">View</span>');
define('DELETE_ICON','<i class="kt-nav__link-icon flaticon2-trash text-danger"></i> <span class="kt-nav__link-text">Delete</span>');

define('MAIL_DRIVER',(['smtp','sendmail','mail']));
define('MAIL_PORT',(['25','465','587']));
define('MAIL_ENCRYPTION',(['tls','ssl']));

define('DATETIME', date('Y-m-d H:i:s'));
