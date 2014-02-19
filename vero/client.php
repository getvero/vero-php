<?php

  namespace Vero;

  class Client {

    private static $auth_token;
    private static $development_mode;

    public function __construct($auth_token, $development_mode = false) {
      $this->auth_token = $auth_token;
      $this->development_mode = $development_mode;
    }

    public function identify($user_id, $email, $data) {
      $endpoint = "https://api.getvero.com/api/v2/users/track.json";
      $request_data = array(
        'auth_token'        => $this->auth_token,
        'id'                => $user_id,
        'data'              => $data,
        'development_mode'  => $this->development_mode
      );

      if ($email)
        $request_data['email'] = $email;

      return $this->_send($endpoint, $request_data);
    }

    public function update($user_id, $changes) {
      $endpoint = "https://api.getvero.com/api/v2/users/edit.json";
      $request_data = array(
        'auth_token'        => $this->auth_token,
        'id'                => $user_id,
        'changes'           => $changes,
        'development_mode'  => $this->development_mode
      );

      return $this->_send($endpoint, $request_data, 'put');
    }

    public function tags($user_id, $add, $remove) {
      $endpoint = "https://api.getvero.com/api/v2/users/tags/edit.json";
      $request_data = array(
        'auth_token'        => $this->auth_token,
        'id'                => $user_id,
        'add'               => $add,
        'remove'            => $remove,
        'development_mode'  => $this->development_mode
      );

      return $this->_send($endpoint, $request_data, 'put');
    }

    public function unsubscribe($user_id) {
      $endpoint = "https://api.getvero.com/api/v2/users/unsubscribe.json";
      $request_data = array(
        'auth_token'        => $this->auth_token,
        'id'                => $user_id
      );

      return $this->_send($endpoint, $request_data);
    }

    public function track($event_name, $identity, $data) {
      $endpoint = "https://api.getvero.com/api/v2/events/track.json";
      $request_data = array(
        'auth_token'        => $this->auth_token,
        'identity'          => $identity,
        'event_name'        => $event_name,
        'data'              => $data,
        'development_mode'  => $this->development_mode
      );

      return $this->_send($endpoint, $request_data);
    }

    private function _send($endpoint, $request_data, $request_type = 'post') {
      $request_data = json_encode($request_data);

      $headers  = array('Accept: application/json', 'Content-Type: application/json');

      $handle = curl_init();
      curl_setopt($handle, CURLOPT_URL, $endpoint);
      curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
      if ($request_type == 'post') {
        curl_setopt($handle, CURLOPT_POST, true);
      } elseif ($request_type == 'put') {
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "PUT");
      }
      curl_setopt($handle, CURLOPT_POSTFIELDS, $request_data);

      $result = curl_exec($handle);
      $code   = curl_getinfo($handle, CURLINFO_HTTP_CODE);
      curl_close($handle);

      return $result;
    }

  }

?>