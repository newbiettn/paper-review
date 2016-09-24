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
            <div class="large-12 columns input-group">
                <input class="input-group-field" type="text" id="search_val">
                <div class="input-group-button">
                    <input type="submit" class="button" id="search_btn" value="Search">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns" id="paper-search-description">
                <p>There are <span id="paper-count"><?php print $papers["count"]; ?></span> papers in the list</p>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns" id="papers-container">
                <?php print $papers["html"]; ?>
            </div>

        </div>

        <?php include_once 'footer.php'?>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>vendor/js/vendor/jquery.highlight.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>vendor/js/vendor/paging.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.bibtex-biblio').paging({
                    limit:50
                });

                $('#search_btn').click(function() {
                    search_val = $('#search_val').val();
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url("index.php/paper/search")?>',
                        dataType: 'json',
                        beforeSend: function(){
                            html = '<img src="<?php echo base_url(); ?>vendor/img/preloader.gif" class="preloader_img" height="64" width="64">';
                            $('#papers-container').html(html);
                        },
                        data: {
                            search_val: search_val
                        },
                        success: function (data) {
                            $('#papers-container').html(data["html"]);
                            $('#paper-count').html(data["count"]);
                            $('#papers-container').highlight(search_val);
                            $('.bibtex-biblio').paging({
                                limit:50
                            });
                        }
                    });
                });

                $('#search_val').keypress(function(e){
                    if(e.which == 13){//Enter key pressed
                        $('#search_btn').click();//Trigger search button click event
                    }
                });
            });
        </script>

    </body>
</html>