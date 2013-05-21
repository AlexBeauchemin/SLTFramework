SLTFramework
==================

Easy and lightweight MVC framework to kickstart quick projects

## Create a new page
To create a page: Add a php file in the view directory with the name of the page you want to create. For example : add contest.php in /views/ (this is the only thing needed to create a new page). The page can be accessed via http://mysite.com/newpage/

## Create a controller
- If you want to add some php manipulation to your view, create a file with the same name in /includes/controllers/
- Copy/Paste the code from /includes/controllers/example.php into your new file.
- Change the name of the class "HomeController" with the name of your page with a capital letter and followed by "Controller" , so if you created contest.php , name your class ContestController
- Do not use _ (underscores) in your names, use - (dashes) instead. So contest_end.php should be contest-end.php , in the class name , the dashes should be replaced by a capital letter, so if you want to create a page for yoursite.com/contest-end/ , create the view contest-end.php , the controller contest-end.php (optional) with the class name ContestEndController

## Create a model
Use the same process as for the controller, put the file in /includes/models

## Create/Include a new class/plugin/helper
Create a new file in /includes/classes/ named myplugin.class.php , the file will be included automatically when needed with the autoloader, so you can use it anywhere you want by adding
```php
$myplugin = new Myplugin();
```

## Include a library

- Put the library in /includes/lib/libraryname/ , the library should contain a file named libraryname.php.
- For example, to create a new facebook object ($facebook = new Facebook();) , the autoloader will try to load /includes/lib/facebook/facebook.php
- If you want to add more execptions to the autoloader, you can add them in /includes/autoloader.php

## URL / Get params
- The url is splitted in 3: /lang/controller/action/ , they are all optional. If you got directly to the base url without any parameters, a redirection will be made to the default lang and default controller (home), so mysite.com will redirect to mysite.com/fr/home/ or mysite.com/en/home/ and the function init() will be called in the controller. The action parameter can be used to call another function right after the init(), so if you go to /en/home/delete , it will call the actionDelete() function automatically in the controller (all action's functions need to start with the word 'action' followed by a capital letter). You can use the word 'init' or 'default' to call the default init function, so /fr/home/ will execute the same code as /fr/home/init/ or /fr/home/default/.
- Url parameters can be passed normally , so /fr/home?test=a will works, /fr/home/delete?test=a will works too but we suggest using a better way : every url sections after the action will be converted to url parameters, so /fr/home/default/test/a/ would be a better way to use the url parameters. Url parameters can be user via the array $this->urlParams

## Lang / Copy / Translate
Add your text to /includes/dicts/dict.php , then use ```php $this->_('key');``` in your view.

Use ```php echo $this->switchLangLink();``` to output the link to switch language.

Use ```php $this->getCopy('key');``` to retrieve a value without output to the screen.

Use ```php $this->getUrl('newpage');``` for the links on your page to keep the language, or it will fallback to the default language in the config file.

## Add Javascript files
To add a global javascript file that need to be accessed from every pages, include it in the footer view. To add page specific javascript , use the addJs function in the init function of your controller like this
```php
$this->addJs(array(
  'src/test.js',
  'lib/newfile.js'
));
```

## Override views
By default, the framework load these views :

 header | currentPage | footer

 You can change the default views in the config file. If you want to change that only for a specific page, let say you don't want the header, you can add the setViews function to your controller like this :
```php
function setViews()
{
  $this->views = array('myview','elements/footer');
}
```
In this case, the page will only load myview.php and elements/footer.php

## Require.js
You can use require.js by default only by changing the config value "use_require" to true. The addJs function will not work with require because you need to add your javascript files via require instead. Use app.js if you are **not** using require , if you are using require, use app-require.js instead

## Tracking
Use Tracker.js (already included): [https://github.com/AlexBeauchemin/ga-simple-tracking](https://github.com/AlexBeauchemin/ga-simple-tracking)

## Javascript config/global variables
Use window.config defined in views/elements/header.php

## Configs
In includes/configs/
Use the environement variables 'APPLICATION_ENV' to define your environments
For example, if the environment variable is set to DEV , the file config-dev.php will be loaded instead , config-staging.php if the variable is set to STAGING
If there is no file match, config.php will be loaded, ideally, use this file for prod environment only.
You can use the url as an alternative to set the correct config values (commented example in config.php)

## Useful functions/variables
- To access controller's functions/vars, use $this-> in your views
- To access application's functions/vars, use $this->app-> in your views
- **$this->__('copy key')** : output translated copy from the dictionnary
- **$this->getCopy('copy key')** : retrieve translated copy from the dictionnary (no output)
- **$this->lang** : get the current language
- **$this->page** : get the current page
- **$this->action** : get the current action
- **$this->base_url** : get the base url of the application (http://www.example.com)
- **$this->addJs()** : add javascript files to a page (need the config "use_require" to be false)
- **$this->getUrl()** : use this function to link to other pages of your application, it will keep the current language in the url. For example if you want to link to the page contest , use $this->getUrl('contest') instead of /contest in your link
- **$this->output()** : secure output of information. Use this for everything that can be modified by the user (post data, get data , database data etc...)
- **$this->switchLangLink()** : use this for the link of your language switcher element


