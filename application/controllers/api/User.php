<?php

/**
 * Created by PhpStorm.
 * User: agungrizkyana
 * Date: 6/4/17
 * Time: 10:43
 */
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function peer_to_peer($id_caller, $id_receiver){
        header("Content-type: application/json");
        $caller = $this->db->get_where('master_user', ['id' => $id_caller])->row();
        $receiver = $this->db->get_where('master_user', ['id' => $id_receiver])->row();
        $chat_room = base64_encode('chat-' . $caller->username . '-' . $receiver->username . '-' . date('Y-m-d h:i:s'));
        $video_room = base64_encode('video-' . $caller->username . '-' . $receiver->username . '-' . date('Y-m-d h:i:s'));



        echo json_encode([
            'caller' => $caller,
            'receiver' => $receiver,
            'chat_room' => $chat_room,
            'video_room' => $video_room
        ]);
    }

    public function view($id_user){
        header('Content-type: application/json');
        $user = $this->db->get_where('master_user', ['id' => $id_user])->row();
        echo json_encode($user);
    }
}