<?php
  // ---- Edit these attributes
  $auth_token = 'AUTH_TOKEN'; // Get from https://www.getvero.com/account
  $user_id    = '12345';
  $event_name = 'Purchased product';

  // ---- Optional: Specify any event properties
  $event_data = array(
    "sku" => "12221",
    "unit_cost" => 42.00
  );

  // ---- Example of making a REST call to Vero
  $request_data = array(
    'auth_token'        => $auth_token,
    'identity'          => array('id' => $user_id),
    'event_name'        => $event_name,
    'data'              => $event_data,
    'development_mode'  => 'false'
  );
  $request_data    = json_encode($request_data);

  $endpoint = 'https://www.getvero.com/api/v2/events/track.json';
  $headers = array('Accept: application/json', 'Content-Type: application/json');

  $handle  = curl_init();
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
