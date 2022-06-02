<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Send_email{
    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->library('email');
    }

    public function send($to, $subject, $data = null, $template = null){
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "smtp.titan.email";
        $config['smtp_port'] = 465;
        $config['smtp_user'] = "idok@telemedical.id"; 
        $config['smtp_pass'] = "indosat123";
        $config['smtp_crypto'] = 'ssl';
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $this->CI->email->initialize($config);

        $this->CI->email->set_newline("\r\n");
        $this->CI->email->from($config['smtp_user'], 'iDok');
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        
        if($template != null){
            $body = $this->CI->load->view($template, $data, TRUE);
        }else{
            $body = 'Tidak ada pesan!';
        }
        $this->CI->email->message($body);
        echo $this->CI->email->send();
    }
}