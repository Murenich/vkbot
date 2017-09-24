<?php

class vk {
	const API_VERSION = '5.24';
	const METHOD_URL = 'https://api.vk.com/method/';

	public function get(){
		return json_decode(file_get_contents('php://input'));
	}
  
	public function usersGet($uid){	
		return file_get_contents(self::METHOD_URL."users.get?user_ids={$uid}&v=".self::API_VERSION);
	}
  
    public function msgSend($msg, $uid, $token, $attachment){	
    $request_params = array(
      'message' => $msg,
      'attachment' => $attachment,
      'user_id' => $uid,
      'access_token' => $token,
      'v' => self::API_VERSION
    );
    $get_params = http_build_query($request_params);
    file_get_contents(self::METHOD_URL."messages.send?".$get_params);
  }
	

}

?>
