<?php

namespace App\Controllers;

use App\Models\AppUser;

class UserController extends CoreController
{


    public function login()
    {

        $this->show('user/login');
    }

    public function loginPost()
    {

        //je récupère et filtre les données
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password',);

        //dump($_POST);
        $user = AppUser::findByEmail($email);
        dump($user);
dump($password);
        if ($user !== false) {


            dump($user->getPassword());
            dump($password);
            if (password_verify($password, $user->getPassword())) {
                exit('connexion ok');
            } else {
                exit('email ou mot de passe incorect');
            }
            $this->show('user/login');
        }
    }
}
