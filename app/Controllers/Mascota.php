<?php

namespace App\Controllers;

use App\Models\MascotasModel;
use App\Models\RazaModel;
use CodeIgniter\I18n\Time;
use App\Libraries\Hash;
use App\Models\BrigadasModel;
use App\Models\PropietariosModel;
use App\Models\VacunasModel;

class Mascota extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }

    public function guardarm()
    {
        /* $propietario_id = $this->request->getPost('propietario_id');
        $raza_id = $this->request->getPost('raza_id');
        $nombre = $this->request->getPost('nombre');
        $sexo = $this->request->getPost('sexo');
        $edad_meses = $this->request->getPost('edad_meses');
        $edad_anios = $this->request->getPost('edad_anios');
        $color = $this->request->getPost('color');
        $tipo = $this->request->getPost('tipo'); */

        /* $nombrearchivo=$propietario_id.$nombre.".jpg";
        $config['upload_path']='./uploads/';
        $config['file_name']=$nombrearchivo;
        $config['allowed_types']='jpg';
        $foto = $this->request->getFile('foto',$config);
        $foto->move(WRITEPATH . 'uploads');    
        if (! $path = $foto->store()) {
            return view('propietario.index', ['error' => 'upload failed']);
        }
        $foto = ['upload_file_path' => $path]; */

        /* $values = [
            'propietario_id'=>$propietario_id,
            'raza_id'=>$raza_id,
            'nombre'=>$nombre,
            'sexo'=>$sexo,
            'edad_meses'=>$edad_meses,
            'edad_anios'=>$edad_anios,
            // 'foto'=>$foto,
            'color'=>$color,
            'tipo'=>$tipo,
        ]; */

        $mascotasModel = new \App\Models\MascotasModel();
        $id = $mascotasModel->insert(
            [
                'propietario_id' => $this->request->getPost('propietario_id'),
                'raza_id' => $this->request->getPost('raza_id'),
                'nombre' => $this->request->getPost('nombre'),
                'sexo' => $this->request->getPost('sexo'),
                'edad_meses' => $this->request->getPost('edad_meses'),
                'edad_anios' => $this->request->getPost('edad_anios'),
                'color' => $this->request->getPost('color'),
                'tipo' => $this->request->getPost('tipo'),
            ]
        );

        if (!$id) {
            return redirect()->back()->with('fail', 'Algo salio mal');
        } else {            
            // return redirect()->to('register')->with('success', 'Su registro ha sido exitoso');
            
            $res = $this->_upload($id);
            if ($res == null) {
                return redirect()->to(base_url('tablero'))->with('success','Registro exitoso');
            }               
            return redirect()->to('tablero');
        }
        
    }

    public function modificar($id)
    {
        $propietariosModel = new \App\Models\PropietariosModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $propietariosModel->find($loggedUserID);
        $data = [
            'title'=>'Mascotas',
            'userInfo'=>$userInfo
        ];
        $razaModel = new \App\Models\RazaModel();
        $data['raza'] = $razaModel->orderBy('descripcion', 'ASC')->findAll();
        
        // $id=$this->request->getPost('id');
        $mascotasModel = new \App\Models\MascotasModel();
        $data2['infomascota'] = $mascotasModel->getMascota($id);

        echo view('includes/header', $data);
        echo view('includes/nav', $data);
		echo view('mascota/modificar', $data2);
		echo view('includes/footer', $data);
    }

    public function update($id)
    {
        $myTime = new Time('now');
        $mascotasModel = new MascotasModel();
        $data = [            
            'raza_id' => $this->request->getPost('raza_id'),
            'nombre' => $this->request->getPost('nombre'),
            'sexo' => $this->request->getPost('sexo'),
            'edad_meses' => $this->request->getPost('edad_meses'),
            'edad_anios' => $this->request->getPost('edad_anios'),
            'color' => $this->request->getPost('color'),
            'tipo' => $this->request->getPost('tipo'),
            'mod_at' => $myTime,
        ];
        $mascotasModel->update($id, $data);
        $res = $this->_upload($id);
        if ($res == null) {
            return redirect()->to(base_url('tablero'))->with('success','Datos actualizados con éxito');
        }
        return redirect()->to(base_url('tablero'))->with('success','Datos actualizados con éxito');
    }

    public function delete($id)
    {
        $myTime = new Time('now');
        $mascotasModel = new MascotasModel();
        $data = [
            'estado' => 0,
            'del_at' => $myTime,
        ];
        $mascotasModel->update($id, $data);
        return redirect()->to(base_url('tablero'))->with('success','La mascota a sido eliminada de su lista');
    }

    public function vercarnet($id)
    {
        $propietariosModel = new PropietariosModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $propietariosModel->find($loggedUserID);
        $data = [
            'title'=>'Mascotas',
            'userInfo'=>$userInfo
        ];
        $razaModel = new RazaModel();
        $data['raza'] = $razaModel->orderBy('descripcion', 'ASC')->findAll();

        $vacunasModel = new VacunasModel();
        $data['vacunas'] = $vacunasModel->orderBy('mascota_id')->findAll();

        /* $fechasModel = new \App\Models\FechasModel();
        $data['fechas'] = $fechasModel->orderBy('fecha', 'ASC')->findAll(); */        
        
        // $id=$this->request->getPost('id');
        $mascotasModel = new MascotasModel();
        $data['infomascota'] = $mascotasModel->getVacunaMascota($id);

        $brigadasModel = new BrigadasModel();
        $data['brigadas'] = $brigadasModel->orderBy('nrobrigada')->findAll();

        echo view('includes/header', $data);
        echo view('includes/nav', $data);
		echo view('mascota/carnet', $data);
		echo view('includes/footer', $data);
    }

    private function _upload($id)
    {
        if($fotoMascota = $this->request->getFile('foto')){
            if ($fotoMascota->isValid() && !$fotoMascota->hasMoved()) {
                $validated = $this->validate([
                    'foto' => [
                        'uploaded[foto]',
                        'mime_in[foto,image/png,image/jpg,image/jpeg]'
                    ]
                ]);

                if ($validated) {                    
                    $nombre = $this->request->getPost('nombre');
                    
                    $propietariosModel = new \App\Models\PropietariosModel();
                    $loggedUserID = session()->get('loggedUser');
                    $userInfo = $propietariosModel->find($loggedUserID);
                    $data = [
                        'title'=>'Tablero',
                        'userInfo'=>$userInfo
                    ];

                    $idprop = $loggedUserID;
                    $idmascot = $id;
                    /* $fecha = new Time('now'); */
                    $fecha = date('Ymdhis', time());
                    $format = 'P%08dM%08dF%s';
                    $nombrearchivo=sprintf($format,$idprop, $idmascot, $fecha);

                    $nombreFoto=$nombrearchivo.".jpg";

                    $fotoMascota->move(ROOTPATH.'public/uploads',$nombreFoto);

                    /* $image = \Config\Services::image()
                    ->withFile(base_url().'/uploads/'.$nombreFoto)
                    ->convert(IMAGETYPE_JPEG)
                    ->resize(800,1000)
                    ->save(base_url().'/uploads/mascotas/'.$nombreFoto); */

                    $mascotasModel = new \App\Models\MascotasModel();
                    $mascotasModel->update($id, [
                        'foto' => $nombreFoto
                    ]);

                    return null;
                } else {
                    return $this->validator->getError("foto");
                }
            }
        }
    }
}