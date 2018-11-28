<?php

    return [
        'custom' => [
            'email' => [
                'required'  => '邮件地址不能为空',
                'unique'    => '邮件地址已被占用',
                'email'     => '无效的邮件地址'
            ],
            'name' => [
                'required' => '姓名不能为空',
            ],
        ],
        'attributes'=> [
            'email' => '电子邮件',
            'name'  => '姓名'
        ]
    ];
