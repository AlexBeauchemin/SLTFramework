<?php
//TODO: Namespacing
//TODO: Better autoloader : https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md

class AutoLoader {
    private $include_path,
            $namespace;

    public function __construct()
    {
        $this->include_path = DOCROOT . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
        $this->namespace = 'SLT\SLTFramework';
    }

    public function register(){
        spl_autoload_register(array($this,'autoload'));
    }

    private function autoload($className){
        $className = strtolower($className);
        if(substr($className,-5,5) === "model" && strlen($className)!=5)
            $className = substr($className,0,strlen($className)-5);

        $files = array(
            $this->include_path . 'classes' . DIRECTORY_SEPARATOR . $className. '.class.php',
            $this->include_path . 'models' . DIRECTORY_SEPARATOR . $className. '.php',
            $this->include_path . 'lib' . DIRECTORY_SEPARATOR . $className . DIRECTORY_SEPARATOR . $className. '.php'
        );

        foreach ($files as $file) {
            if (file_exists($file))
            {
                require($file);
                break;
            }
        }
    }
}

