<?php
namespace app\controllers;

use app\framework\database\Connection;

class LoginController
{
    public function index()
    {
        var_dump('index do login');
    }

    public function store()
    {
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        if(empty($email) || empty($password)){
            var_dump("Usuário ou senha inválidos");
            die();
        }

        $connect = Connection::getConnection();
        $prepare = $connect->prepare("SELECT id, firstName,lastName, email, password FROM users WHERE email = :email");
        $prepare->bindValue(':email', $email);
        $prepare->execute();

        $userFound = $prepare->fetchObject();

        if(!$userFound){
            var_dump("Usuário ou senha inválidos");
            die();
        }

        if(!password_verify($password, $userFound->password)){
            var_dump("Usuário ou senha inválidos. Senha invalida");
            die();
        };

        $_SESSION['logged'] = true;
        unset($userFound->password);
        $_SESSION['user'] = $userFound;

        return redirect('/dashboard');

    }
}