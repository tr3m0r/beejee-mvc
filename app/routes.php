<?php
    /*const routes = array(
        '/'             => array('TodoController', 'index'),
    );*/

    const routes = [
        '/'                             => ['TodoController', 'index'],
        '/page'                         => ['TodoController', 'index'],
        '/page/{page}'                  => ['TodoController', 'index'],
        '/user'                         => ['UserController', 'login'],
        '/user/login'                   => ['UserController', 'login'],
        '/user/logout'                  => ['UserController', 'logout'],
    ];

    /*
    const routes = array(
        '/'             => array('HomeController', 'index'),
        '/home'         => array('HomeController', 'index'),
        '/users'        => array('UserController', 'index'),
        '/users/load'   => array('UserController', 'load'),
        '/users/show'   => array('UserController', 'getDetail'),
        '/users/add'    => array('UserController', 'add'),
        '/users/edit'   => array('UserController', 'edit'),
        '/users/delete' => array('UserController', 'delete'),
    );
    */