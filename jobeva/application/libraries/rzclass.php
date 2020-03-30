<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class RzClass{

    /*
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }
    */

    //UNTUK CHECK USER JIKA SUDAH LOGIN ATAU BELUM
    function check_isvalidated(){
        $CI =& get_instance();
        //$CI->load->library('session');  
        if(! $CI->session->userdata('logged_in')){
            redirect('welcome');
        }
    }

    function checkvalidforgetpassword(){
        $CI =& get_instance();
        //$CI->load->library('session');  
        if(! $CI->session->userdata('forgetpass')){
            //redirect('welcome');
        }
    }

    function getnip()
    {
        $CI =& get_instance();
        $usernip              = $CI->session->userdata('forgetpass');
        //$data['userlogin']        = $userLogin['username'];
        $data['id_user']        = $usernip['username'];
        //$data['id_group']       = $userLogin['id_group'];

        return $data['id_user'];
    }



    function id_user_login(){
        $CI =& get_instance();
        $userLogin              = $CI->session->userdata('logged_in');
        $data['userlogin']        = $userLogin['username'];
        //$data['id_user']        = $userLogin['id_user'];
        //$data['id_group']       = $userLogin['id_group'];

        return $data['userlogin'];
    }

    function getUserName(){
        $CI =& get_instance();
        $userLogin              = $CI->session->userdata('logged_in');
        $id_user    = $userLogin['id_user'];
        
        $CI->load->model('loginModel', '', TRUE);
        $username = $CI->loginModel->getUserName($id_user);

        return $userLogin['username'];
    }

    function getIdGroup(){
        $CI =& get_instance();
        $userLogin              = $CI->session->userdata('logged_in');
        $id_user    = $userLogin['id_user'];
        
        $CI->load->model('loginModel', '', TRUE);
        $username = $CI->loginModel->getIdGroup($id_user);

        return $userLogin['username'];
    }

    /* LEVEL UNTUK TALENT MANAGEMENT */
    function getLevelOrg(){
        $CI =& get_instance();
        $userLogin              = $CI->session->userdata('logged_in');
        $id_user    = $userLogin['id_user'];
        
        $CI->load->model('loginModel', '', TRUE);
        $level_id = $CI->loginModel->getLevelOrg($id_user);

        return $level_id['level_id'];
    }



    function menuPar(){
        $CI =& get_instance();
        $userLogin              = $CI->session->userdata('logged_in');
        $id_user    = $userLogin['id_user'];
        
        $CI->load->model('loginModel', '', TRUE);
        $menuPar = $CI->loginmodel->checkmenu($id_user);
    }

    
    function menuLeft(){
        $CI =& get_instance();
        $CI->load->library('rzclass');
        $id_user            = $CI->rzclass->id_user_login();
        
        $data2['id_group']  = $CI->loginmodel->checkgroup($id_user);
        //$id_group           = $data2['id_group']['id_group'];
        $id_group           = $data2['id_group'];
        
        $data2['menu']      = $CI->loginmodel->checkmenu($id_group);

        return $data2['menu'];
    }

    function getGroup(){
        $CI =& get_instance();
        $id_user            = $CI->rzclass->id_user_login();
        
        $data2['id_group']  = $CI->loginmodel->checkgroup($id_user);
        //$id_group           = $data2['id_group']['id_group'];
        $id_group           = $data2['id_group'];

        return $data2['id_group'];
    }

    function pageName($id_menu  ){
        $CI =& get_instance();
        $CI->load->library('rzclass');
        $id_user            = $CI->rzclass->id_user_login();

        $data2['id_group']  = $CI->login_model->checkgroup($id_user);
        $id_group           = $data2['id_group']['id_group'];
    }
    
}
?>
