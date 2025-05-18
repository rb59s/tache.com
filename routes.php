<?php 
const ROUTES = [
    ''=>[
    'controller' => 'AuthController.php',
    'fonction' => 'home'
    ],

    "inscription"=>[
        "controller"=>"AuthController.php",
        "fonction"=>"createUser"
    ],

    "connexion"=>[
        "controller"=>"authController.php",
        "fonction"=>"login"
    ],

    "update"=>[
        "controller"=>"authController.php",
        "fonction"=>"update"
    ],

    'logout'=>[
    'controller' => 'authController.php',
    'fonction' => 'logout'
    ],

    'delete'=>[
    'controller' => 'authController.php',
    'fonction' => 'deleteAccount'
    ],

    'todo'=>[
    'controller' => 'TodoController.php',
    'fonction' => 'Todo'
    ],

    
    'createtask'=>[
        'controller' => 'TodoController.php',
        'fonction' => 'createTask'
    ],

    'tasks'=>[
    'controller' => 'TodoController.php',
    'fonction' => 'Tasks'
    ],
    
    '/taskAction'=>[
    'controller' => 'TodoController.php',
    'fonction' => 'taskAction'
    ],
];