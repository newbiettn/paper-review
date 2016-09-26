<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

    <!--Include Head-->
    <?php include_once 'head.php' ?>
    <body>
        <?php include_once 'header.php' ?>

        <div class="row">
            <div class="large-12 columns">
                <h4>List of Reviewed Papers</h4>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns">
                <table class="list-papers">
                    <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th>Paper Title</th>
                            <th width="150">Added</th>
                            <th width="150"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0 ?>
                    <?php foreach ($papers as $p) { $i = $i +1; ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td>
                            <span><?php echo $p["pr_title"] ?></span>
                            <small><?php echo $p["pr_author"] ?></small>
                        </td>
                        <td><?php echo date("d-m-Y", strtotime($p["pr_added_date"]))?></td>
                        <td><a href="<?php echo base_url("index.php/paper_controller/view_paper/" . $p["pr_id"])?>" class="button">View Review</a></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php include_once 'footer.php'?>
    </body>
</html>