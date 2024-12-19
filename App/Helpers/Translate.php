<?php

function translate_key($input){

    $translate_arrays = [
        "name" => "نام",
        "phone_number" => "شماره تلفن",
        "username" => "نام کاربری",
        "password" => "رمز عبور",
        "mobile_number" => "شماره موبایل",
        "display_name" => "نام مستعار",
        "role" => "نقش کاربر",
        "title" => "عنوان",
        "host_id" => "آیدی میزبان",
        "capacity" => "ظرفیت",
        "weather_id"=> "آب و هوا"
    ];

    $isFind = false;

    foreach ($translate_arrays as $key => $value)
        if($input == $key) {
            $isFind = true;
            return $value;
        }


    if(!$isFind) return $input;
}