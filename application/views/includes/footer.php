

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b><?php echo PROJECT_NAME; ?></b> Admin System | Version 1.0
        </div>
        <strong>Copyright &copy; 2017-2018 <a href="<?php echo base_url(); ?>"><?php echo PROJECT_NAME; ?></a>.</strong> All rights reserved.
    </footer>
     <?php
            $jsExt = $this->config->item('js_gz_extension');
            $cssExt = $this->config->item('css_gz_extension');  
            if (isset($assets['cssBottomArray']) && is_array($assets['cssBottomArray'])) {
                foreach ($assets['cssBottomArray'] as $cssFile) {
                    echo '<link rel="stylesheet" type="text/css" href="' . $cssFile . $cssExt . '">';
                    echo "\n";
                }
            }
    ?>

    <!-- jQuery UI 1.11.2 -->
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <?php 
     if (isset($assets['jsBottomArray']) && is_array($assets['jsBottomArray'])) {
                foreach ($assets['jsBottomArray'] as $js) {
                    echo '<script src="' . $js . $jsExt . '"></script>';
                    echo "\n";
                }
     }
    ?>
    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');
    </script>
  </body>
</html>