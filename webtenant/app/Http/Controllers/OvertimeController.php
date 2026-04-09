<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use DateTime;
use DateInterval;

class OvertimeController extends Controller
{
    public function index()
    {
        $buss_id = Session::get('business_no');
        $tenant_no = Session::get('tenant_df');
        $crit = array(
            'business_no' => $buss_id,
            'tenant_no'   => $tenant_no
        );

        $sql = "SELECT DISTINCT b.level_no, c.descs, c.picture
            FROM mgr.pm_lot_meter_new a INNER JOIN mgr.pm_lot b 
            ON a.lot_no = b.lot_no AND a.entity_cd=b.entity_cd AND a.project_no=b.project_no
            INNER JOIN mgr.pm_level c ON b.level_no=c.level_no and a.entity_cd=c.entity_cd AND a.project_no=c.project_no
            WHERE a.debtor_acct='$tenant_no' AND a.status='Y' AND a.meter_type='E'";
        $dtLay = DB::connection('WINDASLIVE')->select($sql);

        $lpic = '';

        $combo_tenant = $this->get_combo($buss_id, $tenant_no);
        $content = array(
            'combo_tenant' => $combo_tenant,
        );
        return view('overtime/index', $content);
    }

    function get_combo($business_no = "", $selected_id = "")
    {
        $sql = "SELECT a.tenant_no,a.entity_cd,a.project_no, c.descs as VALUE 
                FROM mgr.pm_tenancy a 
                INNER JOIN mgr.cf_entity b ON a.entity_cd=b.entity_cd
                INNER JOIN mgr.pl_project c ON a.entity_cd=c.entity_cd AND a.project_no=c.project_no
                WHERE a.business_id='$business_no' 
                AND a.project_no='0002'";
        
        $query = DB::connection('WINDASLIVE')->select($sql);

        if (!empty($query)) {
            $list = '';

            foreach ($query as $key => $result) {
                $selected = '';

                // Jika ada tenant default dari session → pilih itu
                if ($selected_id != "" && $selected_id == $result->tenant_no) {
                    $selected = 'selected';
                }
                // Jika tidak ada tenant default → otomatis pilih baris pertama
                elseif ($selected_id == "" && $key == 0) {
                    $selected = 'selected';
                }

                $list .= '<option value="' . $result->tenant_no . '" 
                            data-entity="' . $result->entity_cd . '" 
                            data-project="' . $result->project_no . '" 
                            ' . $selected . '>'
                            . $result->tenant_no . 
                            '</option>';
            }
        }

        return $list;
    }

    public function getLotNo(Request $request)
    {
        if($_POST)
        {
            $id_tenancy = $request->id_tenancy;
            // var_dump($id_tenancy);exit;
            if(empty($id_tenancy)) {
                echo('<option data-level="">-- Select One --</option>');
            } else {
                $buss_id = Session::get('business_no');
                $tenant = Session::get('tenant_df');

                if(!empty($buss_id))
                {
                    $crit = $id_tenancy;
                    $tenant_lot = $this->getComboAC_lottenant($crit);
                    //var_dump($tenant_lot);
                    if(!empty($tenant_lot))
                    {
                        echo($tenant_lot);
                    } 
                }
            }
        }
    }

    public function getComboAC_lottenant($tenant = '', $selected_id = '', $where = '')
    {
        
        $sql = "SELECT DISTINCT a.entity_cd, a.project_no, a.tenant_no as debtor_acct, a.lot_no, b.descs FROM mgr.pm_tenant_lot (NOLOCK) a INNER JOIN mgr.pm_lot (NOLOCK) b ON a.entity_cd=b.entity_cd AND a.project_no=b.project_no AND a.lot_no=b.lot_no where a.entity_cd='0001' and a.project_no='0002'";
        if(!empty($where))
        {
            $sql .=" AND a.lot_no IN ( $where ) ";
        }
        if(!empty($tenant) and $tenant!=='BM')
        {
            $sql .=" AND a.tenant_no='$tenant'";
        } 

        $rst = DB::connection('WINDASLIVE')->select($sql);
        $combo[] = '<option></option>';
        foreach ($rst as $result) {
            $combo[] = '<option value="'.$result->lot_no.'" '.'>'.$result->descs.'</option>';
        }
        return implode("", $combo);
    }


    public function save(Request $request)
    {
        $msg = "";
        $id = $request->id;
        $id_tenancy = $request->tenant_no;
        $lot_no = $request->lot_no;
        $overtime_date = $request->f_overtime_date;
        $start = $request->start;
        $end = $request->end;
        $description = htmlspecialchars($request->input('description'));
        $entity = $request->entity;
        $project = $request->project;
        $lotno_email=[];
        $dt_timestart = date('Y-m-d', strtotime($overtime_date)); //reza
        $dt_start = date('H:i:s', strtotime($start));        
        $dt_end = date('H:i:s', strtotime($end));
        if ($end=="00:00" || $end=="23:59")
        {
            $dt_timeend = date('Y-m-d', strtotime($overtime_date. ' +1 day'));
            $dt_end="00:00";
            $end="00:00";
            $start_o = new DateTime($dt_timestart." ".$dt_start); //reza
            $end_o = new DateTime($dt_timeend." ".$dt_end);
            
            $s = $overtime_date." ".$start; //reza
            $e = $dt_timeend." ".$end;
        } else {
            $start_o = new DateTime($dt_timestart." ".$dt_start); //reza
            $end_o = new DateTime($dt_timestart." ".$dt_end);

            $s = $overtime_date." ".$start; //reza
            $e = $overtime_date." ".$end;
        }
        // end if $end

        // Solution 1, merge objects to new object:        
        $start_overtime = $start_o->format('Y-m-d H:i:s');
        $end_overtime = $end_o->format('Y-m-d H:i:s');
        $dt_timestart = date_create($s);
        $dt_timeend = date_create($e);
        
        $crit = array('tenant_no' => $id_tenancy,'entity_cd'=>$entity,'project_no'=>$project);
        $datatenancy = DB::table('pm_tenancy')
            ->where($crit)
            ->get();
        $crit = array('business_no'=>$datatenancy[0]->business_no);
        $datatenant = DB::table('tenant')
            ->where($crit)
            ->get();
        // var_dump($datatenant);exit();
        $id_tenancy =$datatenancy[0]->id;
        $id_tenant = $datatenant[0]->id;
        // test
        foreach ($lot_no as $lotno)
        {
            # code...
            $sql = "SELECT * FROM ot_trx WHERE lot_no='$lotno' AND status IN ('N','A','Z') AND start_overtime = '$start_overtime'  and end_overtime = '$end_overtime'";
            $check_ot = DB::select($sql);
            // var_dump($check_ot);
            if (count($check_ot) < 1 )
            {
                $today = date('Y-m-d H:i:s');
                $data = array(
                    'entity_cd'      => $entity,
                    'project_no'     => $project,
                    'id_tenant'      => $id_tenant,
                    'id_tenancy'     => $id_tenancy,
                    'lot_no'         => $lotno,
                    'status'         => 'N',
                    'status_email'   => 'N',
                    'approved'       => 'N',
                    'date_created'   => $today,
                    'start_overtime' => $start_overtime, //reza
                    'end_overtime'   => $end_overtime,
                    'description'    => $description
                );
                // var_dump($data);

                // twp ot saved
                if (empty($id))
                {
                    $query = DB::table('ot_trx')
                        ->insert($data);

                    if ($query != "OK") {
                        $msg = $query;
                        $st = 'Fail';
                    } else {
                        $msg = "Data has been saved successfully";
                        $st = 'OK';
                    }
                } else {
                    $query = DB::table('ot_trx')
                        ->where($critedit)
                        ->update($data);

                    if ($query != "1") {
                        $msg = $query;
                        $st = 'Fail';
                    } else {
                        $critotdt = array('id_overtime'=>$id);
                        DB::table('ot_trxdt')
                            ->delete($critotdt);
                        $msg = "Data has been updated successfully";
                        $st = 'OK';
                    }
                }
                // exit();
                $data_overtime = DB::table('ot_trx')
                    ->where($data)
                    ->get();
                $id_ot = $data_overtime[0]->id;

                $dt_factor = date_create($s);
                $factor = $start_overtime;
                $diff1Day = new DateInterval('P1D');
                $diff1Sec = new DateInterval('PT1S');

                $data_otspec = DB::connection('WINDASLIVE')
                    ->table('mgr.ot_spec')
                    ->get();

                //test workhour
                $data_wh = DB::connection('WINDASLIVE')
                    ->table('mgr.cf_workhour')
                    ->get();

                foreach ($data_wh as $value)
                {
                    $btime = substr($value->begin_time, strpos($value->begin_time,' ')+1);
                    $etime = substr($value->end_time, strpos($value->end_time,' ')+1);
                    $mt1 = date('Y-m-d H:i:s', strtotime(date('Y-m-d '.$btime)));
                    $mt2 = date('Y-m-d H:i:s', strtotime(date('Y-m-d '.$etime)));

                    if($value->day_cd=='NR')
                    {
                        $dt1_wt1 = date('H:i:s', strtotime(substr ($value->begin_time,11)));
                        $dt1_wt2 = date('H:i:s', strtotime(substr ($value->end_time,11)));//setelahnya -deska
                    } else {
                        $dt2_wt1 = date('H:i:s', strtotime(substr ($value->begin_time,11)));
                        $dt2_wt2 = date('H:i:s', strtotime(substr ($value->end_time,11)));
                    }
                }
                // end foreach

                while ($dt_factor < $dt_timeend)
                {
                    $checkday = date_format($dt_factor,'N');
                    $work1 = null;
                    $work2 = null;

                    $holidaydt = array('holiday' => date('Ymd H:i:s',strtotime($dt_factor->format('Y-m-d'))));
                    // var_dump($holidaydt);
                    $data_holiday = DB::connection('WINDASLIVE')
                        ->table('mgr.cf_holiday')
                        ->where($holidaydt)
                        ->get();

                    if ($data_holiday)
                    {
                        $checkday='7';
                    }

                    switch ($checkday) {
                        case '1':
                        case '2':
                        case '3':
                        case '4':
                        case '5':
                            $work1 = date('Y-m-d H:i:s', strtotime($dt_factor->format('Y-m-d ').$dt1_wt1));
                            $dt_worktime1 = date_create($work1);
                            $work2 = date('Y-m-d H:i:s', strtotime($dt_factor->format('Y-m-d ').$dt1_wt2));
                            $dt_worktime2 = date_create($work2);
                            break;
                        case '6':
                            $work1 = date('Y-m-d H:i:s', strtotime($dt_factor->format('Y-m-d').$dt2_wt1));
                            $dt_worktime1 = date_create($work1);
                            $work2 = date('Y-m-d H:i:s', strtotime($dt_factor->format('Y-m-d').$dt2_wt2));
                            $dt_worktime2 = date_create($work2);
                            break;
                        case '7':
                            $work2 = date('Y-m-d H:i:s', strtotime($dt_factor->format('Y-m-d')));
                            $dt_worktime2 = date_create($work2);
                            break;
                    }
                    // end switch
                
                    //kalo hari libur (minggu sm tgl merah)
                    if ($checkday=='7')
                    {
                        $dt_endday = $dt_worktime2;
                        $dt_endday->setTime(23,59,59);
                        if ($dt_endday > $dt_timeend)
                        {
                            if ($end=="00:00"){
                                $dataDet = array(
                                    'id_overtime'=>$id_ot,
                                    'date_created'=>$today,
                                    'dt_starttime'=>$factor,
                                    'dt_endtime'=>$end_overtime
                                );
                            } else {
                                $dataDet = array(
                                    'id_overtime'=>$id_ot,
                                    'date_created'=>$today,
                                    'dt_starttime'=>$factor,
                                    'dt_endtime'=>$dt_timeend->format('Y-m-d H:i:s')
                                );
                            }
                            $dt_factor = $dt_timeend;
                            $dt_factor->add($diff1Sec);
                        } else {
                            if ($end=="00:00"){
                                $dataDet = array(
                                    'id_overtime'=>$id_ot,
                                    'date_created'=>$today,
                                    'dt_starttime'=>$factor,
                                    'dt_endtime'=>$end_overtime
                                );
                            } else {
                                $dataDet = array(
                                    'id_overtime'=>$id_ot,
                                    'date_created'=>$today,
                                    'dt_starttime'=>$factor,
                                    'dt_endtime'=>$dt_endday->format('Y-m-d H:i:s')
                                );
                            }
                            $dt_factor = $dt_endday;
                            $dt_factor->add($diff1Sec);
                        }
                        $factor = $dt_factor->format('Y-m-d H:i:s');
                        DB::table('ot_trxdt')
                            ->insert($dataDet);
                    } else {
                        //kalo hari normal + sabtu
                        // otdt twp saved
                        if ($dt_worktime1->format('Y-m-d H:i:s') > $dt_factor->format('Y-m-d H:i:s'))
                        {
                            var_dump('AA1');

                            if ($dt_worktime1->format('Y-m-d H:i:s') > $dt_timeend->format('Y-m-d H:i:s'))
                            {
                                // var_dump('lembur kelar sebelum jam kantor');
                                $dataDet = array(
                                    'id_overtime'=>$id_ot,
                                    'date_created'=>$today,
                                    'dt_starttime'=>$factor,
                                    'dt_endtime'=>$dt_timeend->format('Y-m-d H:i:s')
                                );
                                // var_dump('oaoa');
                                DB::table('ot_trxdt')
                                    ->insert($dataDet);
                                $factor = date('Y-m-d H:i:s', strtotime($dt_timeend->format('Y-m-d H:i:s'))+60);
                                $dt_factor = date_create($factor);
                                var_dump('A1');
                            } else {
                                $dataDet = array(
                                    'id_overtime'=>$id_ot,
                                    'date_created'=>$today,
                                    'dt_starttime'=>$factor,
                                    'dt_endtime'=>date('Y-m-d H:i:s', strtotime($work1)-60)
                                );
                                DB::table('ot_trxdt')
                                    ->insert($dataDet);
                                var_dump('A12');echo "A12";

                                if($dt_worktime2->format('Y-m-d H:i:s') > $dt_timeend->format('Y-m-d H:i:s'))
                                {
                                    $factor = date('Y-m-d H:i:s', strtotime($dt_timeend->format('Y-m-d H:i:s'))+60);
                                    $dt_factor = date_create($factor);
                                    var_dump('Aa2');echo "Aa2";
                                } else {
                                    $factor = date('Y-m-d H:i:s', strtotime($work2));
                                    $dt_factor = date_create($factor);
                                    var_dump('Aa4');echo "Aa4";

                                    $dt_endday = date_create($dt_worktime2->format('Y-m-d').' 23:59:59');
                                    if ($dt_endday->format('Y-m-d H:i:s') > $dt_timeend->format('Y-m-d H:i:s'))
                                    {
                                        $dataDet = array(
                                            'id_overtime'=>$id_ot,
                                            'date_created'=>$today,
                                            'dt_starttime'=>$factor,
                                            'dt_endtime'=>$dt_timeend->format('Y-m-d H:i:s')
                                        );

                                        DB::table('ot_trxdt')
                                            ->insert($dataDet);
                                        var_dump('Aa41');echo "Aa41";
                                        $factor = date('Y-m-d H:i:s', strtotime($dt_timeend->format('Y-m-d H:i:s'))+60);
                                        $dt_factor = date_create($factor);
                                        // var_dump('A41');
                                    } else {
                                        if ($end=="00:00")
                                        {
                                            $dataDet = array(
                                                'id_overtime'=>$id_ot,
                                                'date_created'=>$today,
                                                'dt_starttime'=>$factor,
                                                'dt_endtime'=>$end_overtime
                                            );
                                            DB::table('ot_trxdt')
                                                ->insert($dataDet);
                                            var_dump('A51');echo "A51";
                                            $factor = date('Y-m-d H:i:s', strtotime($dt_endday->format('Y-m-d H:i:s'))+1);
                                            $dt_factor = date_create($factor);
                                        } else {
                                            $dataDet = array(
                                                'id_overtime'=>$id_ot,
                                                'date_created'=>$today,
                                                'dt_starttime'=>$factor,
                                                'dt_endtime'=>$dt_endday->format('Y-m-d H:i:s')
                                            );
                                            DB::table('ot_trxdt')
                                                ->insert($dataDet);
                                            $factor = date('Y-m-d H:i:s', strtotime($dt_endday->format('Y-m-d H:i:s'))+1);
                                            $dt_factor = date_create($factor);
                                        }
                                    }
                                }
                            }
                            // end $dt_worktime1
                        } else {
                            $dt_endday = date_create($dt_worktime2->format('Y-m-d').' 23:59:59');
                            if ($dt_worktime2->format('Y-m-d H:i:s') > $dt_factor->format('Y-m-d H:i:s'))
                            {
                                //kalo jam pulang kerja lebih dari 
                                if ($dt_worktime2->format('Y-m-d H:i:s') < $dt_timeend->format('Y-m-d H:i:s'))
                                {
                                    $dt_factor = date_create($work2);
                                    // $dt_factor->add($diff1Sec);
                                    $factor = $dt_factor->format('Y-m-d H:i:s');
                                    var_dump('B2');echo "b2";
                                    if ($dt_endday->format('Y-m-d H:i:s') > $dt_timeend->format('Y-m-d H:i:s'))
                                    {
                                        $dataDet = array(
                                            'id_overtime'=>$id_ot,
                                            'date_created'=>$today,
                                            'dt_starttime'=>$factor,
                                            'dt_endtime'=>$dt_timeend->format('Y-m-d H:i:s')
                                        );
                                        DB::table('ot_trxdt')
                                            ->insert($dataDet);
                                        $factor = date('Y-m-d H:i:s', strtotime($dt_timeend->format('Y-m-d H:i:s'))+60);
                                        $dt_factor = date_create($factor);
                                        var_dump('B1');echo "B1";
                                    } else {
                                        if ($end=="00:00")
                                        {
                                            $dataDet = array(
                                                'id_overtime'=>$id_ot,
                                                'date_created'=>$today,
                                                'dt_starttime'=>$factor,
                                                'dt_endtime'=>$end_overtime
                                            );
                                            DB::table('ot_trxdt')
                                                ->insert($dataDet);
                                            $factor = date('Y-m-d H:i:s', strtotime($dt_endday->format('Y-m-d H:i:s'))+1);
                                            $dt_factor = date_create($factor);
                                            var_dump('B31');echo "B31";
                                        } else {
                                            $dataDet = array(
                                                'id_overtime'=>$id_ot,
                                                'date_created'=>$today,
                                                'dt_starttime'=>$factor,
                                                'dt_endtime'=>date_format($dt_endday, 'Y-m-d H:i:s')
                                            );
                                            DB::table('ot_trxdt')
                                                ->insert($dataDet);
                                            $factor = date('Y-m-d H:i:s', strtotime($dt_endday->format('Y-m-d H:i:s'))+1);
                                            $dt_factor = date_create($factor);
                                            var_dump('B32');echo "B32";
                                        }
                                    }
                                }
                            } else {
                                if ($dt_worktime2->format('Y-m-d H:i:s') < $dt_timeend->format('Y-m-d H:i:s'))
                                {
                                    var_dump('B22');echo "B22";
                                    if ($dt_endday->format('Y-m-d H:i:s') > $dt_timeend->format('Y-m-d H:i:s'))
                                    {
                                        $dataDet = array(
                                            'id_overtime'=>$id_ot,
                                            'date_created'=>$today,
                                            'dt_starttime'=>$factor,
                                            'dt_endtime'=>date_format($dt_timeend, 'Y-m-d H:i:s')
                                        );
                                        DB::table('ot_trxdt')
                                            ->insert($dataDet);
                                        $factor = date('Y-m-d H:i:s', strtotime($dt_timeend->format('Y-m-d H:i:s'))+60);
                                        $dt_factor = date_create($factor);
                                        var_dump('B4');echo "B4";
                                    } else {
                                        if ($end=="00:00")
                                        {
                                            $dataDet = array(
                                                'id_overtime'=>$id_ot,
                                                'date_created'=>$today,
                                                'dt_starttime'=>$factor,
                                                'dt_endtime'=>$end_overtime
                                            );
                                            DB::table('ot_trxdt')
                                                ->insert($dataDet);
                                            $factor = date('Y-m-d H:i:s', strtotime($dt_endday->format('Y-m-d H:i:s'))+1);
                                            $dt_factor = date_create($factor);
                                            var_dump('B51');echo "B51";
                                        } else {
                                            $dataDet = array(
                                                'id_overtime'=>$id_ot,
                                                'date_created'=>$today,
                                                'dt_starttime'=>$factor,
                                                'dt_endtime'=>date_format($dt_endday, 'Y-m-d H:i:s')
                                            );
                                            DB::table('ot_trxdt')
                                                ->insert($dataDet);          
                                            $factor = date('Y-m-d H:i:s', strtotime($dt_endday->format('Y-m-d H:i:s'))+1);
                                            $dt_factor = date_create($factor);
                                            var_dump('B52');echo "B52";
                                        }
                                    }
                                }
                                // end $dt_worktime2
                            }
                            // end $dt_worktime2
                        }
                    }
                    //end checkday
                }
                // end while
                # endcode
                $lotno_email[] = $lotno;
            } else {
                $msg = 'Request Overtime failed, data already exists';
                $st = 'Fail';
            }
            // end $checkout
        }
        // end foreach
    
        $crit_spec = array(
            'entity_cd'=>$entity,
            'project_no'=>$project
        );

        $dataspec = DB::connection('WINDASLIVE')
            ->table('mgr.sv_spec')
            ->where($crit_spec)
            ->get();
        if(!empty($dataspec)){
            $email = $dataspec[0]->email_overtime;
        } else {
            $email = 'abdul.kahfi@ifca.co.id;deska.priyanti@ifca.co.id';
        }
        // var_dump($otMail);exit();
        $lotno_email = implode(", ",$lotno_email);
        if(!empty($lotno_email)){

            $subj = 'Create New Overtime for '.$datatenancy[0]->tenant_no;
            $body = '';
            $body.= '<h3>Dear All, </h3>'."<br>";
            $body.= 'Please follow up this overtime : '."<br>";
            $body.= '<table>';
            $body.= '<tr>';
                $body.= '<td>Lot No. </td>';
                $body.= '<td>:</td>';
                $body.= '<td>' .$lotno_email. '</td>';
            $body.= '</tr>';
            $body.= '<tr>';
                $body.= '<td>Tenant </td>';
                $body.= '<td>:</td>';
                $body.= '<td>' .$datatenancy[0]->tenant_no.' </td>';
            $body.= '</tr>';
            $body.= '<tr>';
                $body.= '<td>Start Overtime</td>';
                $body.= '<td>:</td>';
                $body.= '<td>' .$s. '</td>';
            $body.= '</tr>';
            $body.= '<tr>';
                $body.= '<td>End Overtime</td>';
                $body.= '<td>:</td>';
                $body.= '<td>' .$e. ' </td>';
            $body.= '</tr>';
            $body.= '<tr>';
                $body.= '<td>Status </td>';
                $body.= '<td>:</td>';
                $body.= '<td>Waiting to be approved</td>';
            $body.= '</tr>';
            $body.= '<tr>';
                $body.= '<td>Description </td>';
                $body.= '<td>:</td>';
                $body.= '<td>' .$description.' </td>';
            $body.= '</tr>';
            $body.= '</table>';
            DB::connection('WINDASLIVE')->statement("exec mgr.x_send_mail_twp '$email','$subj','$body'");
        }
    

        $callback = array(
            'pesan' => $msg,
            'status' => $st
        );

        echo json_encode($callback);
    }

    public function getLayoutView(Request $request)
    {
        $lot_no = $request->lot_no; // array multiple
        $entity = $request->entity;
        $project = $request->project;

        // Ambil level_no berdasarkan lot_no pertama (contoh)
        $level = DB::connection('WINDASLIVE')->selectOne("
            SELECT level_no 
            FROM mgr.pm_lot
            WHERE lot_no = ?
            AND entity_cd = ?
            AND project_no = ?
        ", [$lot_no[0], $entity, $project]);

        if (!$level) {
            return "<p class='text-danger'>Level not found.</p>";
        }

        $level_no = $level->level_no;

        // Ambil semua gambar pada level tersebut
        $results = DB::connection('WINDASLIVE')->select("
            SELECT picture
            FROM mgr.pm_floor_plan
            WHERE entity_cd = ?
            AND project_no = ?
            AND level_no = ?
        ", [$entity, $project, $level_no]);

        $html = "";
        if (!empty($results)) {
            $basePath = public_path('image/Res/');
            $baseUrl  = config('app.url').'/public/image/Res/';
            $allowedExt = ['jpg','jpeg','png','gif','webp','bmp'];

            foreach ($results as $row) {
                $imageFile = null;
                
                foreach ($allowedExt as $ext) {
                    if (file_exists($basePath.$row->picture.'.'.$ext)) {
                        $imageFile = $row->picture.'.'.$ext;
                        break;
                    }
                }

                // Fallback jika gambar tidak ada
                if (!$imageFile) {
                    $imageFile = 'no-image.png';
                }

                $image_url = $baseUrl.$imageFile;
                $html .= '
                    <div style="text-align:center; margin-bottom: 10px;">
                        <img src="'.$image_url.'" class="img-fluid" style="max-width:100%; border:1px solid #ccc;">
                    </div>';
            }
        } else {
            $html = "<p class='text-danger'>No layout found.</p>";
        }

        return $html;
    }

    function getWorkhournew(Request $request) {
        $end = DB::connection('WINDASLIVE')
            ->table('mgr.cf_workhour')
            ->where(DB::raw("RTRIM(day_type)"), $request->day_type)
            ->selectRaw("FORMAT(end_time, 'HH:mm') AS end_time")
            ->value('end_time');

        return ['end_time' => $end];
    }
}
