<?php

namespace App\Controllers;

use App\Libraries\Hash;

class Propietario extends BaseController
{

    public function __construct(){
        helper(['url','form']);
    }
    
    public function index()
    {
        echo view('includes/header');
        echo view('propietario/login');
        echo view('includes/footer');
    }

    public function register()
    {
        echo view('includes/header');
        echo view('propietario/register');
        echo view('includes/footer');
    }

    public function save()
    {
        // Validaciones
        $validation = $this->validate([
            'ci'=>[
                'rules'=>'required|min_length[5]|max_length[15]|is_unique[propietario.ci]',
                'errors'=>[
                    'required'=>'Es necesario registrar un usuario',
                    'min_length'=>'Su nombre de usuario debe tener 5 caracteres como mínimo',
                    'max_length'=>'Su nombre de usuario debe tener 15 caracteres como máximo',
                    'is_unique'=>'El CI ingresado ya ha sido registrado'
                ]
                ],
            'nombre'=>[
                'rules'=>'required|min_length[8]',
                'errors'=>[
                    'required'=>'Debe colocar su nombre completo',
                    'min_length'=>'Por favor ingrese su nombre y apellidos'
                ]
                ],
            'direccion'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Debe colocar su dirección actual'
                ]
                ],
            'telefono'=>[
                'rules'=>'required|min_length[6]',
                'errors'=>[
                    'required'=>'Debe colocar su nombre completo',
                    'min_length'=>'Coloque un número de teléfono correcto'
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
            echo view('includes/header');
            echo view('propietario/register',['validation'=>$this->validator]);
            echo view('includes/footer');
        } else {
            $ci = $this->request->getPost('ci');
            $nombre = $this->request->getPost('nombre');
            $direccion = $this->request->getPost('direccion');
            $telefono = $this->request->getPost('telefono');
            $password = $this->request->getPost('password');

            $values = [
                'ci'=>$ci,
                'nombre'=>$nombre,
                'direccion'=>$direccion,
                'telefono'=>$telefono,
                'password'=>Hash::make($password),
            ];

            $propietariosModel = new \App\Models\PropietariosModel();
            $query = $propietariosModel->insert($values);
            if (!$query) {
                return redirect()->back()->with('fail', 'Algo salio mal');
                // return redirect()->to('register')->with('fail', 'Algo salio mal');
            } else {
                // return redirect()->to('register')->with('success', 'Su registro ha sido exitoso');
                $last_id = $propietariosModel->insertID();
                session()->set('loggedUser',$last_id);
                return redirect()->to('tablero');
            }
        }
    }

    function check(){
        // echo 'Verficación de ingreso en proceso............';
        $validation = $this->validate([
            'ci'=>[
                'rules'=>'required|min_length[5]|max_length[15]|is_not_unique[propietario.ci]',
                'errors'=>[
                    'required'=>'Es necesario registrar un usuario',
                    'min_length'=>'Su nombre de usuario debe tener 5 caracteres como mínimo',
                    'max_length'=>'Su nombre de usuario debe tener 15 caracteres como máximo',
                    'is_not_unique'=>'El usuario ingresado no está registrado en nuestro sistema'
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
            echo view('includes/header');
            echo view('propietario/login',['validation'=>$this->validator]);
            echo view('includes/footer');
            return;
        } else {
            // echo 'Inicio de sesión exitoso';
            $ci = $this->request->getPost('ci');
            $password = $this->request->getPost('password');
            $propietariosModel = new \App\Models\PropietariosModel();
            $user_info = $propietariosModel->where('ci', $ci)->first();
            $check_password = Hash::check($password, $user_info['password']);

            if (!$check_password) {
                session()->setFlashdata('fail', 'Contraseña Incorrecta');
                return redirect()->to('/')->withInput();
            } else {                
                $user_id = $user_info['id'];
                session()->set('loggedUser', $user_id);                
                return redirect('tablero');
            }
        }
    }

    function logout() {
        if (session()->has('loggedUser')) {
            session()->remove('loggedUser');
            return redirect()->to('/')->with('fail','Cerraste la sesión');
        }
    }

    
}