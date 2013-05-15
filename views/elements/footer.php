<?php
/**
 * @var Controller $this
 */
?>



    <div id="fb-root"></div>

    <!-- Javascript Mechanic , using require.js or not -->
    <?php if($this->app->getConfig('use_require')): ?>
        <script data-main="/assets/js/boot" src="/assets/js/lib/require.js"></script>
    <?php else: ?>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript">
        if (typeof jQuery == 'undefined') {
            document.write("<script src='<?php echo $this->base_url;?>/assets/js/lib/jquery-1.9.1.min.js' type='text/javascript'>\x3C/script>");
        }
        </script>

         <script src="<?php echo $this->base_url; ?>/assets/js/lib/mootools-class.js"></script>
         <script src="<?php echo $this->base_url; ?>/assets/js/lib/pluginMutator.js"></script>
        <?php foreach($this->js_files as $file): ?>
            <script src="<?php echo $file; ?> "></script>
        <?php endforeach; ?>
        <script src="<?php echo $this->base_url; ?>/assets/js/src/tracking.js"></script>
        <script src="<?php echo $this->base_url; ?>/assets/js/src/app.js"></script>
    <?php endif; ?>

</body>
</html>
