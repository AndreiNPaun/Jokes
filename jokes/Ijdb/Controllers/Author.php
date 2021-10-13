<?php
namespace Ijdb\Controllers;
class Author {
    private $authorsTable;

    public function __construct($authorsTable){
        $this->authorsTable = $authorsTable;
    }

    public function registerSubmit(){

        if ($_POST['author']['username'] !== '' && $_POST['author']['password'] !== ''){
            $hash = password_hash($_POST['author']['password'], PASSWORD_DEFAULT);

            $_POST['author']['password'] = $hash;

            $author = $this->authorsTable->save($_POST['author']);

            header('location: /author/login');
        }

        else{
            header('location: /author/register');
        }
    }

    public function registerForm(){
        return [
            'template' => 'register.html.php',
            'title' => 'Register',
            'variables' => []
        ];
    }

    public function loginSubmit(){
        if(isset($_POST['submit'])){
            $login = $_POST['author'];
            $author = $this->authorsTable->find('username', $login['username'])[0];
            if ($author->username === $login['username']) {

                if (password_verify($login['password'], $author->password)){
                    $_SESSION['loggedin'] = $author->id;
                    header('location: /');
                }
                else{
                    header('location: /author/login');
                }
            }
            else{
                header('location: /author/login');
            }
        }
    }

    public function loginForm(){
        return [
            'template' => 'register.html.php',
            'title' => 'Login',
            'variables' => []
        ];
    }

    public function logout(){
        unset($_SESSION['loggedin']);
        header('location: /author/login');
    }
}