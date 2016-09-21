<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

    <!--Include Head-->
    <?php include_once 'head.php' ?>
    <body>
        <?php include_once 'header.php'?>

        <div class="row">
            <div class="large-12 columns">
                <h4>Bibliography</h4>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns">
                <div id="pagination-container"></div>
            </div>
        </div>
        <div class="row">
            <?php print $papers->PrintBibliography(); ?>
        </div>

        <?php include_once 'footer.php'?>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>vendor/js/vendor/paging.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.bibtex-biblio').paging({
                    limit:50
                });
            });
        </script>

    </body>
</html>