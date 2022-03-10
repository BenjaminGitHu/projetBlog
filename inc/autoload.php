<?php 
    spl_autoload_register(function ($class_name) {
    (file_exists('models'.'/'.$class_name.'.class.php'))?	
    require_once 'models'.'/'.$class_name.'.class.php' : '';
});
?>