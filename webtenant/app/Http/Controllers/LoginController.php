<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Validator;

class LoginController extends Controller
{
    public function index()
    {
        $sql = "SELECT * FROM image_login where webname='tenant' ORDER BY seq_no ASC";
        $dtimg = DB::select($sql);
        $content = array('dataimages' => $dtimg);
        return view('login/index', $content);
    }

    function ip_address()
    {
        return getenv('HTTP_X_FORWARDED_FOR') ?: getenv('REMOTE_ADDR');
    }

    public function based(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
        ]);

        $email = $request->email;

        $kriteria = array('email' => $email);
        
        $query = DB::table('tenant')
            ->where($kriteria)
            ->get();
        //var_dump($query);
        

        if(count($query)>0)
        {
            $cbBus = $this->get_combo(null, $kriteria);
            $sql = "SELECT * FROM image_login where webname='tenant' ORDER BY seq_no ASC";
            $dtimg = DB::select($sql);
            $content = array(
                'combo' => $cbBus,
                'dataimages' => $dtimg
            );
            
            return view('login/step', $content);
        } else {
            return redirect('/')->with('alert', 'User not found');
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'bsn' => 'required',
            'password' => 'required',
        ]);

        $bsn = $request->bsn;
        $password = md5(trim($request->password));

        $datas = DB::table('all_login')
            ->where('tableforeign', 'tenant')
            ->where('idforeign', $bsn)
            ->where('password', $password)
            ->get();
        //var_dump($datas);

        if(count($datas)>0)
        {
            $default = 'theenergy';
            if($password==$default){
                $this->verify($bsn, null);
                return;
            }

            if($datas[0]->tableforeign=='tenant')
            {
                $kriteriaTenant= array('id' => $datas[0]->idforeign);
                $dataTenant = DB::table('tenant')
                    ->where($kriteriaTenant)
                    ->get();
                //var_dump($dataTenant);
                Session::put('is_Tenant_logged', true);
                Session::put('Tuname', $dataTenant[0]->contact_name);
                Session::put('TCompany', $dataTenant[0]->name);
                Session::put('Tuser_id', $dataTenant[0]->id);
                Session::put('business_no', $dataTenant[0]->business_no);
                Session::put('tenant_df', $dataTenant[0]->tenant_no_df);
                Session::put('Tenemail', $dataTenant[0]->email);

                $ipA = $this->ip_address();
                $dtL = array(
                    'idforeign' => $datas[0]->idforeign,
                    'logintime' => date('Y-m-d H:i:s'),
                    'ipaddress' => $ipA);
                DB::table('log_login')->insert($dtL);
                return redirect('/dash');
            } else {
                return redirect('/');
            }
        } else {
            return redirect ('/')->with('alert', 'User not found');
        }
    }

    public function verify($mail=null, $err=null)
    {
        $pwd = md5("theenergy");
        // $criteria = array('email'=>$mail, 'password'=> $pwd);
        if ($mail != null ) {
            $criteria = array(
                'tableforeign' => 'tenant',
                'idforeign'    => $mail,
                'password'     => $pwd
            );
            $ret = DB::table('tenant')
                ->where($criteria)
                ->get();

            if ($ret)
            {
                $email = $ret[0]->email;
                $data = array(
                    'email' => $email,
                    'error' => $err,
                    'tid'   => $mail
                );
                return view('login/change', $data);
            } else {
                redirect('/');
            }
        }
    }

    function get_combo($selected_id = "", $crit=null)
    {
        if(!empty($crit)) {
            $query = DB::table('tenant')->where($crit)->get();
        }else{
            $query = DB::table('tenant')->get();
        }
        
        $wherein="";//ambil businessno by email
        foreach ($query as $result) {
            
            $wherein .= "'".$result->business_no."',";
        }

        $wherein=substr($wherein,0,-1);
        
        $sql = "SELECT * FROM pm_tenancy WHERE business_no in (".$wherein.") and status = 'A' and expiry_date >= now()";
        $query = DB::select($sql);

        if(!empty($query)){
            $wherein2="";
            foreach ($query as $result) {
                $wherein2 .= "'".$result->business_no."',";
            }
            $wherein2=substr($wherein2,0,-1);
        }else{
            $wherein2="''";
        }
        
        //select ulang berdasarkan business id
        $query2 = "SELECT * FROM tenant WHERE business_no in (".$wherein2.")";
        $results2 = DB::select($query2);
        //start making combo
        $combo[] = '<option value=0>-- Choose --</option>';
        $combo[] = "\n";
        foreach ($results2 as $result) {
            if ($result->id == $selected_id) {
                $selected = ' selected="1"';
            } else {
                $selected = '';
            }
            $combo[] = '<option value="' . $result->id . '"' . $selected . '>' . $result->name . '</option>';
            $combo[] = "\n";
        }
        return implode("", $combo);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
