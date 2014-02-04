Vero for PHP
============

Vero PHP client is using cURL on top on our Rest API. Here's how to use it:

```php
$v = new Vero\Client("YOUR_AUTH_TOKEN");
$v->identify("1234567890", "jeff@yourdomain.com", array('First name' => 'Jeff', 'Last name' => 'Kane'));
$v->track("View Product", array('identifier' => '1234567890'), array('Product name' => 'Blue shoes', 'Price' => 99));
$v->unsubscribe("1234567890");
```