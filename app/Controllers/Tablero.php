<?php

namespace App\Controllers;

use App\Models\BrigadasModel;
use App\Models\FechasModel;
use App\Models\MascotasModel;
use App\Models\RazaModel;
use App\Models\ResponsablesModel;
use App\Models\VacunasModel;
use Zxing\QrReader;


class Tablero extends BaseController
{
    public function index()
    {
        $propietariosModel = new \App\Models\PropietariosModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $propietariosModel->find($loggedUserID);
        $data = [
            'title'=>'Tablero',
            'userInfo'=>$userInfo
        ];
        $razaModel = new \App\Models\RazaModel();
        $data['raza'] = $razaModel->orderBy('descripcion', 'ASC')->findAll();
        $mascotaModel = new \App\Models\MascotasModel();
        //$data['mascota'] = $mascotaModel->listamascotas($loggedUserID);
        $db = \Config\Database::connect();
        //$builder = $db->table('mascota as m');
        //$builder->select('r.descripcion, m.nombre, m.sexo, m.edad, m.color, m.tipo');
        //$builder->join('raza as r','r.id','m.raza_id');
        //$builder->join('propietario as p','p.id','m.propietario_id');	
        $builder = $db->query("SELECT M.id, R.descripcion, M.nombre, M.sexo, M.edad_meses, M.edad_anios, M.foto, M.color, M.tipo
                                FROM mascota M
                                INNER JOIN raza R ON R.id=M.raza_id
                                INNER JOIN propietario P ON P.id=M.propietario_id
                                WHERE M.estado=1 AND P.id=$loggedUserID
                                ORDER BY nombre ASC");
        $data['mascota'] = $builder->getResultArray();
        
        echo view('includes/header');
        echo view('includes/nav', $data);
        echo view('propietario/index', $data);
        echo view('includes/footer');
    }

    public function indexresp()
    {
        $responsablesModel = new ResponsablesModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $responsablesModel->find($loggedUserID);
        $data = [
            'title'=>'Tablero',
            'userInfo'=>$userInfo
        ];

        $razaModel = new RazaModel();
        $data['raza'] = $razaModel->orderBy('descripcion', 'ASC')->findAll();
             
        // ESCANER QR CON TODOS SUS ELEMENTOS
        require ROOTPATH . "/vendor/autoload.php";
        $data['msg'] = '';
        $data['infopropietario'] = '';
        if (isset($_POST['upload'])) {
            /* echo "<pre>"; // PRUEBA DE LECTURA DE ARCHIVO
            print_r($_FILES);
            die(); */
            if ($_FILES["qrCode"]["type"] !== '') {
                $filename = $_FILES["qrCode"]["name"];
                $filetype = $_FILES["qrCode"]["type"];
                $filetemp = $_FILES["qrCode"]["tmp_name"];
                $filesize = $_FILES["qrCode"]["size"];
                
                $filetype = explode("/",$filetype);
                
                if ($filetype[0] !== "image") {
                    $data['msg'] = "Tipo de archivo inválido: " . $filetype[1] . "<br>Ingrese un archivo de imagen PNG";
                } elseif ($filesize > 1048576) {
                    $data['msg'] = "Archivo muy grande. Tamaño máximo debe ser de 1 MB.";
                } else {
                    $newfilename = date('Ymdhis', time()) . ".png";
                    move_uploaded_file($filetemp, "uploads/vacunados/" . $newfilename);
                    $qrScan = new QrReader("uploads/vacunados/" . $newfilename);
                    $data['msg'] = "QR escaneado correctamente: " . $qrScan->text();

                    // Buscamos id de propietario para igualar con el escaneado en QR y buscar las mascotas
                    $propietariosModel = new \App\Models\PropietariosModel();
                    $id = "";
                    $id = $qrScan->text();
                    
                    $data['infopropietario'] = $propietariosModel->getpropietario($id);

                    if (!$data['infopropietario']) {
                        $data['msg'] = "El QR escaneado no corresponde a un propietario registrado: " . $qrScan->text();
                    } else {
                        $mascotaModel = new MascotasModel();
                        $db = \Config\Database::connect();
                        /* $builder = $db->query("SELECT M.id, R.descripcion, M.nombre, M.sexo, M.edad_meses, M.edad_anios, M.foto, M.color, M.tipo
                                                FROM mascota M
                                                INNER JOIN raza R ON R.id = M.raza_id
                                                INNER JOIN propietario P ON P.id = M.propietario_id                                                
                                                WHERE M.estado=1 AND P.id=$id");
                        $data['mascota'] = $builder->getResultArray(); */
                        $builder = $db->query("SELECT M.id AS idmascota, M.nombre, M.sexo, M.edad_meses, M.edad_anios, M.foto, M.color, M.tipo, V.mascota_id, V.id, V.vacunado
                                                FROM mascota M
                                                LEFT JOIN vacunas V ON V.mascota_id = M.id
                                                LEFT JOIN fechas F ON F.id = V.fechas_id
                                                INNER JOIN propietario P ON P.id = M.propietario_id
                                                WHERE M.estado=1 AND P.id=$id
                                                ORDER BY nombre ASC");
                        $data['mascota'] = $builder->getResultArray();
                    }
                }
            } else {
                $data['msg'] = "Primero debe escanear el QR y luego dar click en Ver Lista";
            }
        }

        /* $fechasModel = new FechasModel();
        $data['fechas'] = $fechasModel->where('responsable_id', $loggedUserID)->first(); */

        $brigadasModel = new BrigadasModel();
        $data['brigadas'] = $brigadasModel->where('responsable_id', $loggedUserID)->first();

        echo view('includes/header');
        echo view('includes/nav', $data);
        echo view('responsable/index', $data);
        echo view('includes/footer');
    }

    public function respsincampana()
    {
        $responsablesModel = new \App\Models\ResponsablesModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $responsablesModel->find($loggedUserID);
        $data = [
            'title'=>'Tablero',
            'userInfo'=>$userInfo
        ];

        echo view('includes/header');
        echo view('includes/nav', $data);
        echo view('responsable/respsincampana', $data);
        echo view('includes/footer');
    }
}