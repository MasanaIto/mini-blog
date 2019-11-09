<?php

/*
    MiniBlogApplication
*/
class MiniBlogApplicaiton extends Application
{
    protected $login_action = array('account', 'signup');

    // ルートディレクトリのパスを返す
    public function getRootDir()
    {
        return dirname(__FILE__);
    }

    protected function registerRoutes()
    {
        return array(

        );
    }

    protected function configure()
    {
        $this->db_manager->connect('master', array(
            'dsn'   => 'mysql:dbname=mini_blog;host=localhost',
            'user'  => 'root',
            'password' => 'root',
        ));
    }
}