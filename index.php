<?php

include_once('lib/confs/log_settings.php');

$installed = true;

define('ROOT_PATH', dirname(__FILE__));

if (!is_file(ROOT_PATH . '/lib/confs/Conf.php')) {
    $installed = false;
}

if (!$installed) {
    header('Location: ./install.php');
    exit();    
}

header("Location: ./symfony/web/index.php/auth/login");
exit();
