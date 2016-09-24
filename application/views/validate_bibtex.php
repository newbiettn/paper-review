<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

    <!--Include Head-->
    <?php include_once 'head.php' ?>
    <body>
        <?php include_once 'header.php'?>

<!--        <div class="row">-->
<!--            <div class="large-12 columns">-->
<!--                <h4>Bibliography</h4>-->
<!--            </div>-->
<!--        </div>-->

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
                <p>At the moment, there are <span id="paper-count"><?php print $papers["count"]; ?></span> papers in total</p>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns" id="papers-container">
                <?php print $papers["html"]; ?>
            </div>

        </div>

        <?php include_once 'footer.php'?>
    </body>
</html>