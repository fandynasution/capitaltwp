<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Validator;

class OnlineSurveyController extends Controller
{
	public function index()
	{    
        $dataPub = DB::table('pm_survey_publish')
        	->where('publishdate', '<=', date("Y-m-d"))
        	->where('expireddate', '>=', date("Y-m-d"))
        	->where('flag_publish', 1)
        	->get();
        // var_dump($dataPub);
        $lsP = '';
		$cnR = 0;     
        if(!empty($dataPub)) {
            foreach ($dataPub as $publish) 
            {
            	$business_no = Session::get('business_no');
            	$id = $publish->id;
            	$sql = "SELECT count(1) as cnt FROM pm_survey_respon WHERE user_id='$business_no' AND publish_id='$id'";
            	$dtC = DB::select($sql);
                // $cnR = $dtC->cnt;
                // if($cnR==0)
                // {
                    $lsP.='<label class="control-label">'.$publish->title.'</label>';
                    $crit = array('publish_id' => $publish->id);

                    $dataSur = DB::table('pm_survey_hd')
                    	->where($crit)
                    	->get();
                    //var_dump($dataSur);
                    if(!empty($dataSur))
                    {
                        $lsP.='<form role="form" method="post" name="f'.$publish->id.'" action="" id="frm'.$publish->id.'">';
                        // var_dump($lsP);
                        foreach ($dataSur as $k=>$survey) {
                            $lsP.='<div class="form-group col-sm-10">'.$survey->content;
                            $lsP.='<input type="hidden" name="s[]" value="'.$survey->id.'">';
                            // var_dump($lsP);
                            $crit = array('survey_id' => $survey->id);

                            $dataOpt = DB::table('pm_survey_dt')
                            	->where($crit)
                            	->get();
                            // var_dump($dataOpt);
                            if(!empty($dataOpt))
                            {
                                foreach ($dataOpt as $option) {
                                    $lsP.='<div class="radio col-sm-10"><label>';
                                    $lsP.='<input type="radio" name="oR['.$k.']" data-ada="true" value="'.$option->line_no.'"/> ';
                                    $lsP.=' '.$option->options.'</label>';
                                    if($option->flag_remark==1){
                                        $lsP.='<textarea class="form-control col-sm-10" rows="3" id="remarks" name="remarks" ></textarea>';
                                    }
                                    $lsP.='</div>';
                                    // var_dump($lsP);
                                }
                                $lsP.='</div>';
                            }                          
                        }
                        $lsP.='<input name="id" type="hidden" value="'.$publish->id.'"/><input name="q" type="hidden" value="'.$k.'"/>';
                        // var_dump($lsP);
                    }
                    $lsP.='<div style="text-align:right;margin-right: 50px;margin-top: 20px">';
                    $lsP.='<button type="button" id="btnSave'.$publish->id.'" data-p="'.$publish->id.'" data-q="'.$k.'" class="btn btn-primary">Submit</button>';
                    $lsP.='</div></form>';

                // }
            }
        }
        // var_dump($lsP);

        $content = array(
        	//'link_cal' => $link_cal,
        	'dP' => $lsP,
        	'cS' => $cnR,
        	//'error' => $data
        );
        // var_dump($content);
        return view('online_survey/index', $content);
	}

    public function save(Request $request)
    {
        $msg = "";
        $business_no = Session::get('business_no');
        $email = Session::get('Tenemail');
        // $s = $request->s;
        // var_dump($s);
        $idP = $request->id;
        $q = $request->q;

        for ($i=0; $i <= $q; $i++)
        {
            $data = array(
                'publish_id' => $idP,
                'survey_id' => $request->s[$i],
                'respon' => $request->oR[$i],
                'user_id' => $business_no,
                'email_addr' => $email,
                'remark' => null,
                'date_created' => date('Y-m-d H:i:s'),
                'audit_user' => '',
                'audit_date' => date('Y-m-d H:i:s')
            );
            // var_dump($data);

            $query = DB::table('pm_survey_respon')
                ->insert($data);
            if ($query != "OK") {
                $msg = $query;
                $st = 'Fail';
            } else {
                $msg = "Data has been saved successfully";
                $st = 'OK';
            }
        }

        $callback = array(
            "pesan" => $msg,
            "status" => $st
        );
        echo json_encode($callback);
    }
}