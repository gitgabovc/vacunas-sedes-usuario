<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\BrigadasModel;
use App\Models\CampanasModel;
use App\Models\FechasModel;
use Zxing\QrReader;
use App\Models\ResponsablesModel;
use App\Models\VacunasModel;
use CodeIgniter\I18n\Time;

class Responsable extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }
    
    public function loginresp()
    {
        echo view('includes/header');
        echo view('responsable/loginresp');
        echo view('includes/footer');
    }

    public function registerresp()
    {
        echo view('includes/header');
        echo view('responsable/registerresp');
        echo view('includes/footer');
    }

    public function saveresp()
    {
        // Validaciones
        // AQUI COLOCAR VALIDACION DEL CODIGO ESTABLECIMIENTO
        /* $codigo = $this->request->getPost('codigo');
        $establecimientosModel = new \App\Models\EstablecimientosModel();
        $data['establecimiento'] = $establecimientosModel->orderBy('codigo', 'ASC')->findAll();
        
        if ($codigo==) {
            # code...
        } */

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
                ],
            'codigo'=>[
                'rules'=>'required|is_not_unique[establecimiento.codigo]',
                'errors'=>[
                    'required'=>'Debe ingresar el código del establecimiento',
                    'is_not_unique'=>'El codigo ingresado no es correcto'
                ]
                ]
        ]);

        if (!$validation) {
            echo view('includes/header');
            echo view('responsable/registerresp',['validation'=>$this->validator]);
            echo view('includes/footer');
        } else {
            $ci = $this->request->getPost('ci');
            $nombre = $this->request->getPost('nombre');
            $password = $this->request->getPost('password');
            
            // Búsqueda del Establecimiento por código respectivo
            $codigo = $this->request->getPost('codigo');
            $establecimientosModel = new \App\Models\EstablecimientosModel();
            $data = $establecimientosModel->getEstablecimientocodigo($codigo);
            $establecimiento_id = $data['id'];

            $values = [
                'ci'=>$ci,
                'nombre'=>$nombre,
                'password'=>Hash::make($password),
                'establecimiento_id'=>$establecimiento_id,
            ];

            $responsablesModel = new \App\Models\ResponsablesModel();
            $query = $responsablesModel->insert($values);
            if (!$query) {
                return redirect()->back()->with('fail', 'Algo salio mal');
                // return redirect()->to('register')->with('fail', 'Algo salio mal');
            } else {
                // return redirect()->to('register')->with('success', 'Su registro ha sido exitoso');
                $last_id = $responsablesModel->insertID();
                session()->set('loggedUser',$last_id);
                return redirect()->to('indexresp');
            }
        }
    }

    function checkresp(){
        // echo 'Verficación de ingreso en proceso............';
        $validation = $this->validate([
            'ci'=>[
                'rules'=>'required|min_length[5]|max_length[15]|is_not_unique[responsable.ci]',
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
            echo view('responsable/loginresp',['validation'=>$this->validator]);
            echo view('includes/footer');
            return;
        } else {
            // echo 'Inicio de sesión exitoso';
            $ci = $this->request->getPost('ci');
            $password = $this->request->getPost('password');
            $responsablesModel = new ResponsablesModel();
            $responsable_info = $responsablesModel->where('ci', $ci)->first();
            $check_password = Hash::check($password, $responsable_info['password']);

            if (!$check_password) {
                session()->setFlashdata('fail', 'Contraseña Incorrecta');
                return redirect()->to('loginresp')->withInput();
            } else {
                //bucar el idresp en tabla brigada
                //si no existe:
                    //busar con el codigo de estab si tiene alguna campaña habilitada
                    //si tiene campaña habilitada:
                        // pedir datos de nro de brigada, lugar dosis y guardar en tabla brigadas
                    //no tiene camapala no hace nada
                //si si existe pasae al qr
                $responsable_id = $responsable_info['id'];
                $responsable_establecimiento = $responsable_info['establecimiento_id'];
                $fechasModel = new FechasModel();
                /* $fechas_info = $fechasModel->where('establecimiento_id', $responsable_establecimiento)->first(); */
                
                /* $db = \Config\Database::connect();
                $builder = $db->query("SELECT *
                                        FROM fechas F
                                        INNER JOIN campana C ON C.id = F.campana_id
                                        WHERE F.establecimiento_id = $responsable_establecimiento
                                        AND C.vigente = 'S'
                                        AND C.fechafin >= $myTime");
                
                $data['campana'] = $builder->getResult(); */
                
                $fechas_info = $fechasModel->getFechaCampanaPorEstablecimiento($responsable_establecimiento);

                if (is_array($fechas_info) && count($fechas_info) > 0) {
                    $brigadasModel = new BrigadasModel();
                    $brigada_info = $brigadasModel->where('responsable_id', $responsable_id)->first();

                    if (isset($brigada_info['responsable_id'])) {
                        session()->set('loggedUser', $responsable_id);
                        return redirect('indexresp');
                    } else {
                        session()->set('loggedUser', $responsable_id);
                        return redirect('registrobrigada');
                    }

                } else {
                    session()->set('loggedUser', $responsable_id);
                    return redirect('indexrespsincampana');
                }                
            }
        }
    }

    function logout() {
        if (session()->has('loggedUser')) {
            session()->remove('loggedUser');
            return redirect()->to('/')->with('fail','Cerraste la sesión');
        }
    }

    function registrobrigada()
    {
        $responsablesModel = new ResponsablesModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $responsablesModel->find($loggedUserID);
        $data = [
            'title'=>'Tablero',
            'userInfo'=>$userInfo
        ];
        
        $responsable_establecimiento = $userInfo['establecimiento_id'];
        $fechasModel = new FechasModel();
        $data['fechas_info'] = $fechasModel->where('establecimiento_id', $responsable_establecimiento)->first();

        echo view('includes/header');
        echo view('includes/nav', $data);
        echo view('responsable/registrobrigada', $data);
        echo view('includes/footer');
    }

    public function savebrigada()
    {    
        $date = new Time('now');
        
        $idresponsable = $this->request->getPost('idresponsable');
        $nrobrigada = $this->request->getPost('nrobrigada');
        $lugar = $this->request->getPost('lugar');
        $idfecha = $this->request->getPost('idfecha');
        $dosis = $this->request->getPost('dosis');
        
        $values = [
            'responsable_id' => $idresponsable,
            'nrobrigada' => $nrobrigada,
            'lugar' => $lugar,
            'fechas_id' => $idfecha,
            'dosis' => $dosis,
            'add_at' => $date,
        ];
        
        $brigadasModel = new BrigadasModel();
        $query = $brigadasModel->insert($values);

        if (!$query) {
            return redirect()->back()->with('fail', 'Algo salio mal');
        } else {
            return redirect('indexresp');
        }        
    }
}