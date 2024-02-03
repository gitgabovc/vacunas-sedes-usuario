<?php

namespace App\Controllers;

use App\Models\VacunasModel;
use CodeIgniter\I18n\Time;

class Vacuna extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }

    public function vacunado()
    {                
        $idmascota = $this->request->getPost('idmascota');
        $idfechas = $this->request->getPost('idfechas');
        $vacunado = $this->request->getPost('vacunado');
        $idbrigada = $this->request->getPost('idbrigada');
        
        $vacunasModel = new VacunasModel();
        $vacunas_info = $vacunasModel->getVacunaPorMascota($idfechas, $idmascota);
        /* $out['msg2'] = $idmascota;
        $out['msg3'] = $idfechas;
        $out['msg4'] = $vacunas_info;
        echo json_encode($out);
        die(); */
        if (is_array($vacunas_info) && count($vacunas_info) > 0) {
            
            //UPDATE
            $idv = $vacunas_info['id'];

            $myTime = new Time('now');
            $data = [
                /* 'vacunado' => ($vacunas_info['vacunado']=='N'?"S":"N"), */
                'vacunado' => $vacunado,
                'brigadas_id' => $idbrigada,
                'fecha_vacuna' => $myTime,
                'mod_at' => $myTime,
            ];
            $res = $vacunasModel->update($idv, $data);
            
            if (!$res) {
                $out['status'] = '';
                $out['msg'] = 'No se registro la vacuna';
            } else {
                $out['status'] = 'ok';
                $out['msg'] = 'Actualización de vacuna exitoso';
            }
            
        } else {            
            
            // INSERT
            $myTime = new Time('now');
            $id = $vacunasModel->insert(
                [
                    'fechas_id' => $idfechas,
                    'mascota_id' => $idmascota,
                    'vacunado' => $vacunado,
                    'brigadas_id' => $idbrigada,
                    'fecha_vacuna' => $myTime,
                    'add_at' => $myTime,
                ]
            );
            if (!$id) {
                $out['status'] = '';
                $out['msg'] = 'No se registro la vacuna';
            } else {
                $out['status'] = 'ok';
                $out['msg'] = 'Registro de vacuna exitoso';
            }
        }

        echo json_encode($out);
    }    
}