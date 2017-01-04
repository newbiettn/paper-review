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
                    <label>Which algorithm to be used?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <input name="algorithm" type="text" value="<?php echo $review["algorithm"]?>">
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>How is the dataset?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="dataset" name="dataset"><?php echo $review["dataset"]?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>How is preprocessing step carried out?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="preprocessing" name="preprocessing"><?php echo $review["preprocessing"]?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>How is the modelling step carried out?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="modelling" name="modelling"><?php echo $review["modelling"]?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>How is the evaluation step carried out?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="evaluation" name="evaluation"><?php echo $review["evaluation"]?></textarea>
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
            <div class="row">
                <div class="large-12 columns">
                    <label>Prediction Criteria</label>
                </div>
            </div>
            <div class="row questionnaire-container">
                <fieldset class="large-4 columns">
                    <legend>Is a prediction model reported?</legend>
                    <input type="radio" name="prediction_criteria_1" value="1" <?php if ($review["prediction_criteria_1"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="prediction_criteria_1" value="0" <?php if ($review["prediction_criteria_1"]==0){ echo 'checked';} ?>><label>No</label>
                </fieldset>
                <fieldset class="large-4 columns">
                    <legend>Is the prediction model tested on unseen data?</legend>
                    <input type="radio" name="prediction_criteria_2" value="1" <?php if ($review["prediction_criteria_2"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="prediction_criteria_2" value="0" <?php if ($review["prediction_criteria_2"]==0){ echo 'checked';} ?>><label>No</label>
                </fieldset>
                <fieldset class="large-4 columns">
                    <legend>Is the source of data reported?</legend>
                    <input type="radio" name="prediction_criteria_3" value="1" <?php if ($review["prediction_criteria_3"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="prediction_criteria_3" value="0" <?php if ($review["prediction_criteria_3"]==0){ echo 'checked';} ?>><label>No</label>
                </fieldset>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>Model Building Criteria</label>
                </div>
            </div>
            <div class="row questionnaire-container">
                <fieldset class="large-4 columns">
                    <legend>Are the features/inputs reported?</legend>
                    <input type="radio" name="model_building_criteria_1" value="1" <?php if ($review["model_building_criteria_1"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="model_building_criteria_1" value="0" <?php if ($review["model_building_criteria_1"]==0){ echo 'checked';} ?>><label>No</label>
                </fieldset>
                <fieldset class="large-4 columns">
                    <legend>Is the response/output reported? </legend>
                    <input type="radio" name="model_building_criteria_2" value="1" <?php if ($review["model_building_criteria_2"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="model_building_criteria_2" value="0" <?php if ($review["model_building_criteria_2"]==0){ echo 'checked';} ?>><label>No</label>
                </fieldset>
                <fieldset class="large-4 columns">
                    <legend>Is the modelling technique reported?</legend>
                    <input type="radio" name="model_building_criteria_3" value="1" <?php if ($review["model_building_criteria_3"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="model_building_criteria_3" value="0" <?php if ($review["model_building_criteria_3"]==0){ echo 'checked';} ?>><label>No</label>
                </fieldset>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>Data Criteria</label>
                </div>
            </div>
            <div class="row questionnaire-container">
                <fieldset class="large-6 columns">
                    <legend>Is the data accquisition process described?</legend>
                    <input type="radio" name="data_criteria_1" value="1" <?php if ($review["data_criteria_1"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="data_criteria_1" value="0" <?php if ($review["data_criteria_1"]==0){ echo 'checked';} ?>><label>No</label>
                </fieldset>
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
                var areas = Array('major_idea', 'dataset', 'preprocessing',
                    'evaluation', 'opinion', 'modelling',
                    'other_questions');
                $.each(areas, function (i, area) {
                    CKEDITOR.replace(area);
                });

                $('#save_notification').delay(3000).slideUp('slow');
            });
        </script>
    </body>
</html>