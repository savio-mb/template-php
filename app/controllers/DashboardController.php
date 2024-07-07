<?php

namespace app\controllers;

use app\framework\classes\Cache;
use app\framework\database\Connection;

class DashboardController
{
    public function index()
    {

        $users = Cache::get('users', function () {
            $connection = Connection::getConnection();
            $query = $connection->query("SELECT * FROM users");
            return $query->fetchAll();
        }, 5);


        view('dashboard_home', ['title' => 'Dashboard - Home', 'users' => $users]);
    }
}