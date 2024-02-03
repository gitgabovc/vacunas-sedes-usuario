<?php

namespace App\Controllers;

use App\Libraries\Hash;

class Auth extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }
    
    public function index()
    {
        echo view('includes/header');
        echo view('auth/login');
        echo view('includes/footer');
    }

    public function register()
    {
        echo view('includes/header');
        echo view('auth/register');
        echo view('includes/footer');
    }

    public function save()
    {
        // Validaciones
        $validation = $this->validate([
            'nombre'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debe colocar su nombre completo'
                ]
                ],
            'usuario'=>[
                'rules'=>'required|min_length[6]|max_length[20]|is_unique[usuario.usuario]',
                'errors'=>[
                    'required'=>'Su nombre de usuario es requerido',
                    'min_length'=>'Su nombre de usuario debe tener 6 caracteres como mínimo',
                    'max_length'=>'Su nombre de usuario debe tener 20 caracteres como máximo',
                    'is_unique'=>'usuario ya ha sido registrado'
                ]
                ],            
            'password'=>[
                'rules'=>'required|min_length[5]|max_length[12]',
                'errors'=>[
                    'required'=>'Debe ingresar una contraseña',
                    'min_length'=>'Su contraseña debe tener 5 caracteres como mínimo',
                    'max_length'=>'Su contraseña debe tener 12 caracteres como máximo'
                ]                
                ],
            'cpassword'=>[
                'rules'=>'required|min_length[5]|max_length[12]|matches[password]',
                'errors'=>[
                    'required'=>'Debe ingresar la confirmación de su contraseña',
                    'min_length'=>'Su contraseña debe tener 5 caracteres como mínimo',
                    'max_length'=>'Su contraseña debe tener 12 caracteres como máximo',
                    'matches'=>'Debe ingresar la misma contraseña'
                ]
            ]
        ]);

        if (!$validation) {
            return view('auth/register',['validation'=>$this->validator]);
        } else {
            $nombre = $this->request->getPost('nombre');
            $usuario = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');

            $values = [
                'nombre'=>$nombre,
                'usuario'=>$usuario,
                'password'=>Hash::make($password),
            ];

            $usersModel = new \App\Models\UsersModel();
            $query = $usersModel->insert($values);
            if (!$query) {
                return redirect()->back()->with('fail', 'Algo salio mal');
                // return redirect()->to('register')->with('fail', 'Algo salio mal');
            } else {
                return redirect()->to('register')->with('success', 'Su registro ha sido exitoso');
            }
        }
    }

    function check(){
        // echo 'Verficación de ingreso en proceso............';
        $validation = $this->validate([
            'usuario'=>[
                'rules'=>'required|min_length[6]|max_length[20]|is_not_unique[usuario.usuario]',
                'errors'=>[
                    'required'=>'Es necesario registrar un usuario',
                    'min_length'=>'Su nombre de usuario debe tener 6 caracteres como mínimo',
                    'max_length'=>'Su nombre de usuario debe tener 20 caracteres como máximo',
                    'is_not_unique'=>'El usuario ingresado no etá registrado en nuestro sistema'
                ]
                ],
            'password'=>[
                'rules'=>'required|min_length[5]|max_length[12]',
                'errors'=>[
                    'required'=>'Necesita ingresar su contraseña',
                    'min_length'=>'Contraseña de 5 caracteres como mínimo',
                    'max_length'=>'Contraseña de 12 caracteres como máximo'
                ]
            ]                
        ]);

        if (!$validation) {
            return view('auth/login',['validation'=>$this->validator]);
        } else {
            // echo 'Inicio de sesión exitoso';
            $usuario = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');
            $usersModel = new \App\Models\UsersModel();
            $user_info = $usersModel->where('usuario', $usuario)->first();
            $check_password = Hash::check($password, $user_info['password']);

            if (!$check_password) {
                session()->setFlashdata('fail', 'Contraseña Incorrecta');
                return redirect()->to('/')->withInput();
            } else {
                $user_id = $user_info['id'];
                session()->set('loggedUser', $user_id);
                return redirect()->to('dashboard');
            }
        }
    }
}