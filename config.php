<?php

class Config{
    private static $config = null;

    private function init()
    {
        self :: $config['ROUTES'] = [
            '/'          => 'HomeController@index',
            '/index.php' => 'HomeController@index',
            '/saveTask'  => 'HomeController@saveTask',
            '/auth'      => 'LoginController@index',
            '/login'     => 'LoginController@login',
            '/logout'    => 'LoginController@logout',
            '/admin'     => 'LoginController@admin',
            '/edit'      => 'LoginController@edit'
        ];

        self :: $config['DB'] = [
            'db_name'   => 'a0074901_test',
            'user_name' => 'root',
            'password'  => '12345678',
        ];
    }

    public static function get($key){
        self :: init();
        return self :: $config[$key];
    }
}
