<?php

/**
 * Array key => url
 * Array value => folder/controller-class/method (index method if none specified)
 */

return [
    "/" => "user/user/login",
    "/trang-chu" => "employee/employee/index",
    "/cap-nhat-thong-tin" => "employee/employee/createOrUpdateEmployee",
    "/logout" => "user/user/logout",
];
