<?php
// lfi protection
define('LFI_PROTECTION', TRUE);
// template class
require ('viewer.class.php');
try {
    $view = new viewer();
    $view->assign('Hello world!!', 'content');
    echo $view->render('example.tpl.php');    
}
catch (exception $error)
{
    echo $error->getMessage();
}
?>
