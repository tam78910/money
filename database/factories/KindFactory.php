<?php

use Faker\Generator as Faker;

$factory->define(\App\Kind::class, function (Faker $faker) {
    return [
        'code' => $faker->unique()->randomElement( array('P001', 'P002', 'P003', 'P004')),
        'name' => $faker->unique()->randomElement( array(
            'ค่าใช้จ่ายประจำเดือน',
            'ใช้จ่ายทั่วไป',
            'อาหารและเครื่องดื่ม',
            'ของใช้ส่วนตัว'
        ))
    ];
});
