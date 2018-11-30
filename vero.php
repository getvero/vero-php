<?php

  if (!function_exists('json_encode')) {
    throw new Exception('Vero needs the JSON PHP extension.');
  }

  require(dirname(__FILE__) . '/vero/client.php');

  class Vero {

    private $client;

    public function __construct($auth_token) {
      if (!$auth_token)
        throw new Exception("VeroClient auth_token parameter is required");

      $this->client = new Vero\Client($auth_token);
    }

    public function identify($user_id, $email = null, $data = array()) {
      if (!$user_id)
        throw new Exception("Vero::Identify requires a user id");

      return $this->client->identify($user_id, $email, $data);
    }

    public function reidentify($user_id, $new_user_id) {
      if (!$user_id || !$new_user_id)
        throw new Exception("Vero::Reidentify requires a user id AND a new user id");

      return $this->client->reidentify($user_id, $new_user_id);
    }

    public function update($user_id, $changes = array()) {
      if (!$user_id)
        throw new Exception("Vero::Update requires a user id");

      if ($changes == array())
        throw new Exception("Vero::Update requires changes param");

      return $this->client->update($user_id, $changes);
    }

    public function tags($user_id, $add = array(), $remove = array()) {
      if (!$user_id)
        throw new Exception("Vero::Tags requires a user id");

      if ($add == array() && $remove == array())
        throw new Exception("Vero::Update requires either add or remove param");

      return $this->client->tags($user_id, $add, $remove);
    }

    public function unsubscribe($user_id, $email) {
      if ($user_id && $email)
        throw new Exception("Vero::Unsubscribe requires either user id or email param");

      if (!$user_id && !$email)
        throw new Exception("Vero::Unsubscribe requires a user id or email");

      return $this->client->unsubscribe($user_id, $email);
    }

    public function resubscribe($user_id, $email) {
      if ($user_id && $email)
        throw new Exception("Vero::Resubscribe requires either user id or email param");

      if (!$user_id && !$email)
        throw new Exception("Vero::Resubscribe requires a user id or email");

      return $this->client->resubscribe($user_id, $email);
    }

    public function track($event_name, $identity = array(), $data = array(), $extras = array()) {
      if (!$event_name)
        throw new Exception("Vero::Track requires an event name");
      if (($identity == array()) || ((gettype($identity) == 'array') && (!$identity['id'])))
        throw new Exception("Vero::Update requires an identity profile with at least an id property");

      return $this->client->track($event_name, $identity, $data, $extras);
    }

    public function heartbeat() {
        return $this->client->heartbeat();
    }

  }

?>
