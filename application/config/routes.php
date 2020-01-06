<?php

    return [
        //Admin controller
        'admin/login'=>[
            'controller'=>'admin',
            'action'=>'login'
        ],
        'admin/logout'=>[
            'controller'=>'admin',
            'action'=>'logout'
        ],
        'admin/add'=>[
            'controller'=>'admin',
            'action'=>'add'
        ],
        'admin/edit/\d+'=>[
            'controller'=>'admin',
            'action'=>'edit'
        ],
        'admin/posts/\d+'=>[
            'controller'=>'admin',
            'action'=>'posts'
        ],
        'admin/delete/\d+'=>[
            'controller'=>'admin',
            'action'=>'delete',

        ],
        //Main controller
        'about'=>[
            'controller'=>'main',
            'action'=>'about'
        ],
        'contact'=>[
            'controller'=>'main',
            'action'=>'contact'
        ],
        'post/\d+'=>[
            'controller'=>'main',
            'action'=>'post'
        ],
        'main/index/\d+|'=>[
            'controller'=>'main',
            'action'=>'index'
        ],


    ];
