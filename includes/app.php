<?php

class App
{
    private $device,
        $configs;

    public $action,
        $base_url,
        $lang,
        $page,
        $urlParams;

    function __construct()
    {
        global $config;
        $this->configs =& $config;

        $this->setReporting();

        $autoLoader = new AutoLoader();
        $autoLoader->register();

        $this->base_url = $this->retrieveBaseUrl();
        $this->hook();

        if (!$this->page || substr($this->page, 0, 1) == "?") {
            $this->page = "home";
        }

        if (!session_id()) {
            session_start();
        }

        $this->loadController();
    }

    private function detectDeviceType()
    {
        if (isset($_SESSION) && !isset($_SESSION['device'])) {
            $detect   = new Mobile_Detect;
            $isMobile = $detect->isMobile();
            $isTablet = $detect->isTablet();
            $device   = 'desktop';

            if ($isMobile && !$isTablet) {
                $device = 'mobile';
            } elseif ($isTablet) {
                $device = 'tablet';
            }

            $this->device       = $device;
            $_SESSION['device'] = $device;
        }
    }

    private function formatControllerName($name)
    {
        $name = ucfirst($name);

        $name = str_replace('-', ' ', $name);
        $name = ucwords(strtolower($name));
        $name = str_replace(' ', '', $name);
        $name .= 'Controller';
        return $name;
    }

    private function loadController()
    {
        if (file_exists(DOCROOT . '/includes/controllers/' . $this->page . '.php')) {
            include 'controllers/' . $this->page . '.php';
            $controller_name = $this->formatControllerName($this->page);
            $controller      = new $controller_name($this);
        } else {
            $controller = new Controller($this);
        }
    }

    private function retrieveBaseUrl()
    {
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        } else {
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST']; //. $_SERVER['REQUEST_URI'];
    }

    private function hook()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = trim($url, '/'); //remove forward slash from beginning and end of $url

        $urlArray = explode('/', $url);
        array_map('strtolower', $urlArray);

        if ($this->getConfig('multi_lang')) {
            //TODO: Allow more languages
            if ($urlArray[0] != 'fr' && $urlArray[0] != 'en') {
                header('Location: ' . $this->base_url . '/' . $this->getConfig('multi_lang_default') . '/' . $url);
                die();
            }

            $urlArray = array_pad($urlArray, 3, null);
            list($lang, $page, $action) = $urlArray;
        } else {
            $urlArray = array_pad($urlArray, 2, null);
            list($page, $action) = $urlArray;
            $lang = false;
        }

        $page   = $this->getUrlParams($page);
        $action = $this->getUrlParams($action);

        $this->getUrlParamsBetter($urlArray);

        $this->lang   = $lang;
        $this->page   = $page;
        $this->action = $action;

    }

    public function error_log($error)
    {
        $file = DOCROOT . "/log/errors.log";
        if (!file_exists($file)) {
            file_put_contents($file, '');
        }
        error_log($error, 3, $file);
    }


    public function getConfig($var)
    {
        return $this->configs[$var];
    }

    public function getDevice()
    {
        if ($this->device) {
            return $this->device;
        }

        if (isset($_SESSION['device'])) {
            $this->device = $_SESSION['device'];
            return $this->device;
        }

        $this->detectDeviceType();
        return $this->device;
    }

    public function getUrl()
    {
        return $this->base_url . '/' . $this->lang . '/' . $this->page . '/' . $this->action . '/';
    }

    private function getUrlParams($object)
    {
        $param = strpos($object, '?');
        if ($param) {
            $urlParams = substr($object, $param + 1);
            if ($urlParams) {
                $paramsArray = explode('&', $urlParams);
                foreach ($paramsArray as $item) {
                    $item = explode('=', $item);
                    if (count($item) == 2) {
                        $this->urlParams[$item[0]] = $item[1];
                    } else {
                        $this->urlParams[$item[0]] = '';
                    }
                }
            }
            $object = substr($object, 0, $param);
        }
        return $object;
    }

    private function getUrlParamsBetter($url)
    {
        $max = 3;
        if (!$this->getConfig('multi_lang')) {
            $max = 2;
        }
        if (count($url) > $max) {
            $i = $max;
            while (isset($url[$i])) {
                if (isset($url[$i + 1])) {
                    $this->urlParams[$url[$i]] = $url[$i + 1];
                } else {
                    $this->urlParams[$url[$i]] = '';
                }
                $i += 2;
            }
        }
    }

    private function setReporting()
    {
        ini_set('log_errors', 'On');
    }

}


//TODO: Templating : Way to include views ( add twig? ) with a config to use it or not
//TODO: Add composer ?
//TODO: Handle case when the entire site is in a subfolder (www.mysite.com/contest/en/home/)
//TODO: Retrieve GET , POST and SESSION , combine data and use filter_input_array() , Validation class , protect from xss
//TODO: Add flash messages
//TODO: Add share module (facebook, twitter, g+...)
