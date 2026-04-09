<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        // var_dump('abdsad');exit;
        $login = Session::get('is_login');
        if (isset($login)) {
            // var_dump('a');exit;
            return redirect('/dash');
        } else {
            // var_dump('bb');exit;
            $dtimg = DB::connection('ifcaadm')->select("SELECT * from image_login where webname='admin' order by seq_no asc"); 
            // $dtimg='';
            // var_dump($dtimg);exit;
            $content = array('dataimages' => $dtimg);
            return view('login/index',$content);
        }
    }
    public function reset()
    {
        $email = Session::get('Tsemail');
        $error_login = Session::get('Error_Login');
        if (empty($error_login)) {
            $error_login = '';
        }
        Session::forget('Error_Login');
        $cp = array(
            'email' => $email,
            'error' => $error_login
        );
        return view('login.resetpass', $cp);
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $default = 'passwordAdmin';
        if($password==$default){
            // $content=array('email'=>$email);
            $pwd = md5($default);
            $criteria = array('email'=>$email, 'password'=> $pwd);
            $ret = DB::connection('ifcaadm')
                ->table('all_login')
                ->where($criteria)
                ->get();
            // var_dump($mail);
            if($ret){
                $data = array('email'=>$email);
                    // redirect('/reset');
                return view('login.change',$data);
            } else {
                return redirect('/')->with('alert', 'User is not valid!');
            }
        }else{
            $datauser = DB::connection('ifcaadm')
            ->select("SELECT * from all_login where email='$email' and tableforeign='administrator'");
        // var_dump($datauser);exit;
            // var_dump('ad');
            if (count($datauser) > 0) {
                $passcheck=md5($password);
                
                if ($passcheck === $datauser[0]->password) {
                    if($datauser[0]->tableforeign=='administrator')
                    {
                        
                        $kriteriaAdmin= array('id' => $datauser[0]->idforeign);
                        $dataAdmin = DB::connection('ifcaadm')
                        ->table('administrator')
                        ->where($kriteriaAdmin)
                        ->get(); 

                        Session::put('is_login', TRUE);
                        Session::put('Tsuname', $dataAdmin[0]->name);
                        Session::put('Tsemail', $email);
                        Session::put('Tsuser_id', $dataAdmin[0]->id);
                        // $apa = 'masok';
                        return redirect('/dash');
                        
                    } else {
                        // $apa = 'Access';
                        return redirect('/')->with('alert', 'Access Forbidden: You\'re not allowed to login to adminTWP!');
                    } 
                    // var_dump('ss');
                    // return redirect('/dash');
                } else {
                    Session::put('Error_Login', 'Wrong Password!');
                    return redirect('/')->with('alert', 'Wrong Password!');
                    // $apa = 'pass';
                }
                return redirect('/dash');
                // $apa = 'data not  found';
            } else {
                // $apa = 'user';
                return redirect('/')->with('alert', 'User is not valid!');
            }
        }
       
    }
    public function logout()
    {
        Session::flush();
        return redirect('/')->with('alert', 'Already logout!');
    }
}
