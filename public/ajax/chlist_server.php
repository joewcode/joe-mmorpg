<?php
const AJAX = true;
require '_init.php';
if ( !$user or !$user->check() ) exit('1');
###
require '../../app/Modules/User_list.php';
$jch = new jUserlist($user);

echo json_encode( $jch->getList() );

?>
