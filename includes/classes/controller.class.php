<?php

class Controller
{
    /** @var App */
    public $js_files = array();
    protected $dict;

    public $action,
        $app,
        $base_url,
        $lang,
        $page,
        $urlParams,
        $views;

    function __construct(App $app)
    {
        $this->app  = $app;
        $this->lang = $app->lang;
        $this->page = $app->page;
        $this->action = $app->action;
        $this->urlParams = $app->urlParams;
        $this->base_url = $this->app->base_url;

        $this->loadDicts();

        //TODO: Create database object
        $this->loadModels();

        if($this->isClosed())
            $this->setClosedState();

        $this->init();
        if($this->action && $this->action != 'default' && $this->action != 'init') {
            $action = 'action' . ucfirst($this->action);
            $action();
        }
        $this->render();

        //TODO: Add hooks for different events
    }

    function __($key)
    {
        if(isset($this->dict[$this->lang][$key]))
            echo $this->dict[$this->lang][$key];
        else
            echo '[Key "' . $key . '" not found in ' . $this->lang . ']';
    }

    function init() {

    }

    private function render() {
        $this->setDefaultViews();
        $this->setViews();
        $this->injectViews();
    }




    // ------------------------------------------------------------
    // Functions
    // -------------------------------------------------------------

    protected function addJs($files) {
        if($this->app->getConfig('use_require'))
            throw new Exception('You are using require.js, define your javascript files via require, not within your controller.');
        if(is_array($files)){
            foreach($files as $file){
                array_push($this->js_files,$this->base_url . '/assets/js/' . $file);
            }
        }
        else {
            array_push($this->js_files,$this->base_url . '/assets/js/' . $files);
        }
    }

    public function getData($key){
        if (isset($this->$key))
            return $this->$key;
        elseif(isset($_REQUEST[$key]))
            return $_REQUEST[$key];
        return null;
    }

    public function getCopy($key) {
        if(isset($this->dict[$this->lang][$key]))
            return $this->dict[$this->lang][$key];
       else
          return '[Key "' . $key . '" not found in ' . $this->lang . ']';
    }

    public function getUrl($page = null) {
        if($page) {
            return $this->base_url . '/' . $this->lang . '/' . $page . '/';
        }
        return $this->base_url . '/' . $this->lang . '/';
    }

    private function injectViews()
    {
        foreach ($this->views as $view) {
            if($view == "currentPage")
                $view = $this->page;
            if($this->app->getDevice()=='tablet') {
                if(file_exists(DOCROOT . '/views/tablet/' . $view . '.php')) {
                    include(DOCROOT . '/views/tablet/' . $view . '.php');
                    continue;
                }
            }
            if($this->app->getDevice()=='mobile') {
                if(file_exists(DOCROOT . '/views/mobile/' . $view . '.php')) {
                    include(DOCROOT . '/views/mobile/' . $view . '.php');
                    continue;
                }
            }
            if(file_exists(DOCROOT . '/views/' . $view . '.php')) {
                include(DOCROOT . '/views/' . $view . '.php');
            }
        }
    }

    public function isClosed()
    {
        if (new DateTime('now') >= $this->app->getConfig('end_date'))
            return true;
        return false;
    }

    private function loadDicts()
    {
        //TODO: Load multiple dicts
        //TODO: allow more than 2 language
        $files = glob(DOCROOT . '/includes/dicts/*.{php}', GLOB_BRACE);
        foreach ($files as $file) {
            include $file;
        }
        if (isset($dict)) {
            $this->dict = $dict;
        }
    }

    private function loadModels()
    {
        $files = glob(DOCROOT . '/models/*.{php}', GLOB_BRACE);
        foreach ($files as $file) {
            include $file;
        }
    }

    public function output($var) {
        return htmlentities($var, ENT_QUOTES, 'UTF-8');
    }

    protected function setClosedState(){
        $this->views = array(
            $this->app->getConfig('end_view')
        );

        $this->injectViews();
        die();
    }

    public function switchLangLink()
    {
        $lang = 'fr';
        if ($this->lang == 'fr') {
            $lang = 'en';
        }
        return $this->base_url . '/' . $lang . '/' . $this->page ."/";
    }

    private function setDefaultViews()
    {
        $this->views = $this->app->getConfig('default_views');
    }

    protected function setViews(){

    }

}