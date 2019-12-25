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
        'admin/edit/[0-9+]'=>[
            'controller'=>'admin',
            'action'=>'edit'
        ],
        'admin/posts/[0-9+]'=>[
            'controller'=>'admin',
            'action'=>'posts'
        ],
        'admin/delete/[0-9+]'=>[
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
        'post/[0-9+]'=>[
            'controller'=>'main',
            'action'=>'post'
        ],
        'main/index/[0-9+]|'=>[
            'controller'=>'main',
            'action'=>'index'
        ],


    ];
