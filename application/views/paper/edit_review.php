<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

<!--Include Head-->
    <?=$head?>
    <body>
        <?=$header?>
        <div class="row">
            <div class="large-12 columns">
                <h4>Paper Review Form</h4>
            </div>
        </div>
        <?php if($review_saved == TRUE) {?>
        <div class="row">
            <div class="callout success" id="save_notification">
                <h5>Your review is saved successfully!</h5>
            </div>
        </div>
        <?php }?>
        <?php echo form_open('paper/manage/submit_review'); ?>
            <input name="pr_id" value="<?php echo $review["pr_id"]?>" type="hidden">
            <input name="paper_fk" value="<?php echo $paper["id"]?>" type="hidden">
            <input name="pr_title" value="<?php echo $paper["title"]?>" type="hidden">
            <input name="pr_citation_key" value="<?php echo $paper["citation_key"]?>" type="hidden">
            <div class="row">
                <div class="small-12 columns">
                    <label>Paper Title</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <p><?php echo $paper["title"]?></p>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Paper Author</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <p><?php echo $paper["author"]?></p>
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <label>Paper Abstract</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <p><?php echo $paper["abstract"]?></p>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>What is the major idea?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="major_idea" name="major_idea"><?php echo $review["major_idea"]?></textarea>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>What is my overall opinion?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="opinion" name="opinion"><?php echo $review["opinion"]?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>If I read the paper again in the future, can I answer the following questions?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="other_questions" name="other_questions"><?php echo $review["other_questions"]?></textarea>
                </div>
            </div>

            <br>
            <div class="row">
                <div class="large-12 columns">
                    <input type="submit" value="Submit" class="button">
                </div>
            </div>
        </form>

        <?=$footer?>
        <script>
            $(document).ready(function(){
                var areas = Array('major_idea', 'opinion', 'other_questions');
                $.each(areas, function (i, area) {
                    CKEDITOR.replace(area);
                });

                $('#save_notification').delay(3000).slideUp('slow');
            });
        </script>
    </body>
</html>