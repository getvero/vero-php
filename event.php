<?php
  // ---- Edit these attributes
  $auth_token = 'AUTH_TOKEN'; // Get from https://www.getvero.com/account
  $customer_id = '12345';
  $event_name = 'Purchased product'



  // ---- Example of making a REST call to Vero
  $required_keys = array(
    'auth_token' => $auth_token,
    'identity' => {
      'id' => $customer_id
    },
    'event_name' => $event_name,
    'development_mode' => 'false'
  );

  $json_data    = json_encode($required_keys);
  $endpoint = 'https://www.getvero.com/api/v2/events/track';
  $headers = array('Accept: application/json', 'Content-Type: application/json');
  $handle  = curl_init();
  curl_setopt($handle, CURLOPT_URL, $endpoint);
  curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, $json_data);

  $result = curl_exec($handle);
  $code   = curl_getinfo($handle, CURLINFO_HTTP_CODE);
  curl_close($handle);

  return $code;
?>