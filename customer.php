<?php
  // ---- Edit these attributes
  $auth_token = 'AUTH_TOKEN'; // Get from https://www.getvero.com/account
  $user_id    = '12345';
  $user_email = 'user@domain.com';
  $user_data  = array('first_name' => 'Chris', 'last_name'  => 'Hexton');

  // ---- Example of making a REST call to Vero
  $request_data = array(
    'auth_token'        => $auth_token,
    'id'                => $user_id,
    'email'             => $user_email,
    'data'              => $user_data,
    'development_mode'  => 'false'
  );
  $request_data = json_encode($request_data);

  $endpoint = 'http://localhost:3000/api/v2/users/track.json';
  $headers  = array('Accept: application/json', 'Content-Type: application/json');

  $handle = curl_init();
  curl_setopt($handle, CURLOPT_URL, $endpoint);
  curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, $request_data);

  $result = curl_exec($handle);
  $code   = curl_getinfo($handle, CURLINFO_HTTP_CODE);
  curl_close($handle);

  return $code;
?>
