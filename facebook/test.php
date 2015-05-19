<?php
define('FACEBOOK_SDK_V4_SRC_DIR', 'src/Facebook/');
require __DIR__ . '/autoload.php';

// Make sure to load the Facebook SDK for PHP via composer or manually

use Facebook\FacebookSession;
// add other classes you plan to use, e.g.:
// use Facebook\FacebookRequest;
// use Facebook\GraphUser;
// use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication('407777559347483', 'b6e6b829b1520b962d208a4fa4e1b754');


// Make sure to load the Facebook SDK for PHP via composer or manually
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;


// Make a new request and execute it.
try {
  $response = (new FacebookRequest($session, 'GET', '/me'))->execute();
  $object = $response->getGraphObject();
  echo $object->getProperty('name');
} catch (FacebookRequestException $ex) {
  echo $ex->getMessage();
} catch (\Exception $ex) {
  echo $ex->getMessage();
}

// You can chain methods together and get a strongly typed GraphUser
$me = (new FacebookRequest(
  $session, 'GET', '/me'
))->execute()->getGraphObject(GraphUser::className);
echo $me->getName();



?>