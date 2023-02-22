<?php

namespace App\Controllers;

use App\Models\AppUser;

class UserController extends CoreController
{

    public function add()
    {
       $token = bin2hex(random_bytes(32));
       $_SESSION['token'] = $token;

       //dump($token);
        $this->show('user/add', [
            'token' => $token,
        ]);
    }


    public function create()
    {
       
        
        //dump($_POST);
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);



        $errorsList = [];
        if ($lastname === '') {
            // Ajout du message d'erreur dans le tableau des erreurs
            $errorsList[] = 'Le nom doit être renseigné';
        }
        if ($firstname === '') {
            $errorsList[] = 'Le prénom doit être renseigné';
        }
        if ($email === false) {
            $errorsList[] = 'L\'email n\'a pas un format valide';
        }
        if (strlen($password) < 8) {
            $errorsList[] = 'Le mot de passe doit comporter au moins 8 caractères';
        }
        if ($role === '') {
            $errorsList[] = 'Le role doit être renseigné';
        }
        if ($status === '') {
            $errorsList[] = 'Le statut doit être renseigné';
        }


        //dump($firstname);
        //on créer un objet user on lui assigne nos valeurs
        $userToInsert = new AppUser();
        $userToInsert->setFirstname($firstname);
        $userToInsert->setLastname($lastname);
        $userToInsert->setEmail($email);
        $userToInsert->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $userToInsert->setRole($role);
        $userToInsert->setStatus($status);


        if (!empty($errorsList)) {

            $this->show('user/add', [
                'errors_list' => $errorsList,
                'user' => $userToInsert
            ]);
        } else {




            //dump($userToInsert);
            //on insert les données en bdd
            if ($userToInsert->save()) {
                //si l'ajout en bdd est ok , on redirige vers la liste des users
                $this->redirect('user-list');
            };
        }
    }





    public function list()
    {
        $this->checkAuthorization(['admin']);
        $usersList = AppUser::findAll();
        //dump($usersList);

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
                exit('email ou mot de passe incorrect');
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



    public function delete($id)
    {

        $userDelete = AppUser::find($id);

        if ($userDelete->delete()) {
            $this->redirect('user-list');
        } else {
            exit("Echec lors de la suppression");
        }
    }
















}
