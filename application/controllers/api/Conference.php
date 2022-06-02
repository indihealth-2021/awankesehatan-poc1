<?php

/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 7/19/2017
 * Time: 4:51 PM
 */
class Conference extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function calling($id_caller, $id_receiver){
        header('Content-type: application/json');
        $caller = $this->db->get_where('master_user', ['id' => $id_caller])->row();
        $receiver = $this->db->get_where('master_user', ['id' => $id_receiver])->row();
        $chat_room = base64_encode('chat-' . $caller->username . '-' . $receiver->username . '-' . date('Y-m-d h:i:s'));
        $video_room = base64_encode('video-' . $caller->username . '-' . $receiver->username . '-' . date('Y-m-d h:i:s'));

        // save to session

        $this->session->set_userdata(array(
           'room' => array(
               'room_id' => uniqid(),
               'caller' => $caller,
               'receiver' => $receiver,
               'chat_room' => $chat_room,
               'video_room' => $video_room
           )
        ));

        echo json_encode($_SESSION['room']);

    }
}