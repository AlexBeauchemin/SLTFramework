<?php
/**
 * @var Controller $this
 */
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <title><?php $this->__('meta.title'); ?></title>
    <meta property="og:title" content="<?php $this->__('meta.title'); ?>"/>
    <meta name="description" content="<?php $this->__('meta.description'); ?>" />
    <link href="<?php echo $this->base_url; ?>/assets/css/style.css" rel="stylesheet" type="text/css" />
    <!--[if IE 8]>
        <link href="<?php echo $this->base_url; ?>/assets/css/ie8.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script>
        window.config = {
            app_id: "<?php echo $this->app->getConfig('app_id'); ?>",
            app_url: "<?php echo $this->app->getConfig('app_url'); ?>",
            base_url: "<?php echo $this->base_url; ?>",
            env: "<?php echo $this->app->getConfig('env'); ?>",
            ga_account: "<?php echo $this->app->getConfig('ga_account'); ?>",
            lang: "<?php echo $this->lang; ?>",
            page: "<?php echo $this->page; ?>"
        };
    </script>
</head>

<body class="<?php echo $this->lang . ' ' . $this->page . ' ' . $this->app->getDevice(); ?>" data-page="<?php echo $this->page; ?>">

<header>
    <div class="menu">
        <a href="<?php echo $this->getUrl('home')?>"><?php $this->__('menu.home'); ?></a>
        <a href="<?php echo $this->getUrl('contest')?>"><?php $this->__('menu.contest'); ?></a>
    </div>

    <div class="lang_switch">
        <a href="<?php echo $this->switchLangLink(); ?>"><?php $this->__('lang-switch'); ?></a>
    </div>
</header>
