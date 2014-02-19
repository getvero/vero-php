Vero for PHP
============

Vero PHP client is using cURL on top on our Rest API. Here's how to use it:

```php
$v = new Vero("YOUR_AUTH_TOKEN");

$v->identify("1234567890", "jeff@yourdomain.com", array('First name' => 'Jeff', 'Last name' => 'Kane'));
$v->update("1234567890", array('First name' => 'Jack', 'Last name' => 'Wollo', 'job_title' => 'Developer'));
$v->tags('1234567890', array('Blog reader'), array());

$v->track("Subscribe to service", array('id' => '1234567890'), array('Plan name' => 'XL Plan', 'Price' => 149));

$v->unsubscribe("1234567890");
```