<?php

namespace App\Controllers;

use App\Models\AppUser;

class UserController extends CoreController
{

    public function add()
    {
        $this->checkAuthorization(['admin']);
        $this->show('user/add');
    }


    public function list()
    {
        $this->checkAuthorization(['admin']);
        $usersList = AppUser::findAll();
        dump($usersList);

        $this->show('user/list', [
            'users_list' => $usersList,
        ]);
    }




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
        //dump($user);
        //dump($password);
        if ($user !== false) {


            //dump($user->getPassword());
            //dump($password);
            if (password_verify($password, $user->getPassword())) {
                //ajout d'informations à la session de l'utilisateur 
                echo 'connexion ok';
                $_SESSION['userId'] = $user->getId();
                $_SESSION['userObject'] = $user;
                //dump($_SESSION);
                $this->redirect('main-home');
            } else {
                exit('email ou mot de passe incorect');
            }
            $this->show('user/login');
        }
    }


    public function logout()
    {


        //on supprime certaine informations de la session
        unset($_SESSION['userId']);
        unset($_SESSION['userObject']);


        //on redirige vers l'acceuil
        $this->redirect('main-home');


    }
















}
