<?php
const AJAX = true;
require '_init.php';

if ( !$user or !$user->check() ) exit('1');
// if ( $user->check_aura('nochat') ) exit('2');

require '../../app/Modules/Chat.php';

$chat = new Chat($user);
$chat->view_mess();


?>