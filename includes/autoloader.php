<?php

//Autoload classes so we don't need to include them

function autoload_class($class_name)
{
    $class_name = strtolower($class_name);
    if(substr($class_name,-5,5) === "model" && strlen($class_name)!=5)
        $class_name = substr($class_name,0,strlen($class_name)-5);

    $files = array(
        DOCROOT .'/includes/classes/' . $class_name. '.class.php',
        DOCROOT .'/includes/models/' . $class_name. '.php',
        DOCROOT .'/includes/lib/' . $class_name . '/' . $class_name. '.php'
    );

    foreach ($files as $file) {
        if (file_exists($file))
        {
            require($file);
            break;
        }
    }
}

spl_autoload_register('autoload_class');