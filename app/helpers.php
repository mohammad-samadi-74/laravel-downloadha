<?php


use Illuminate\Support\Facades\Route;

if(! function_exists('is_route')){
    function is_route(array $routes,$key='active'){
        return in_array(Route::currentRouteName() , $routes)? $key : '';
    }
}

if(! function_exists('is_orders_route')){
    function is_orders_route(array $routes,$key='active',$type=false){
        if(isset($type) && request('type') !== null){
            return in_array(Route::currentRouteName() , $routes) && request('type') == $type ? $key : '';
        }
        return false;
    }
}

if(! function_exists('get_post_icon')){
    function get_post_icon($type){
        $icon = '';
        switch ($type){
            case 'نرم افزار': $icon = 'fab fa-windows icon-orange';break;
            case 'مالتی مدیا': $icon = 'fab fa-youtube text-danger';break;
            case 'بازی': $icon = 'fab fa-playstation text-primary';break;
            case 'موبایل': $icon = 'fas fa-mobile-alt text-dark';
        }
        return $icon;
    }
}

function showOrderStatus($status){
    switch ($status){
        case 'all': return 'همه سفارشات';break;
        case 'unpaid': return 'پرداخت نشده';break;
        case 'paid': return 'پرداخت شده';break;
        case 'preparation': return 'در خال اماده سازی';break;
        case 'canceled': return 'لغو شده';break;
        case 'received': return 'دریافت شده';break;
        case 'posted': return 'پست شده';break;
    }
}
