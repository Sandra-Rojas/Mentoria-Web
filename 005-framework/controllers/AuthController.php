<?php

namespace app\controllers;

use app\core\Request;
use app\core\Controller;
use app\models\RegisterModel;
//use app\core\Model;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request)
    {
        /*if ($request->getmethod()== 'post'){
            return "Procesando datos del formulario":
        }*/
        $this->setLayout('auth');

        if ($request->isPost()){
            $registerModel = new RegisterModel();

            //var_dump($request->getBody());
            
            $registerModel->loadData($request->getBody());
            //var_dump($registerModel);

            if($registerModel->validate() && $registerModel->save()){
                return 'succes';
            }

            echo "<pre>";
            var_dump($registerModel);
            return "Procesando datos del formulario";
            echo "</pre>";
        }    

       return $this->render('register');
    }

    //se podria crear aca public functionsetlayout() pero no es optimo se debe crear en clase padre en el controller.php
}