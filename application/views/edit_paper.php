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
                <h4>Edit Review</h4>
            </div>
        </div>
        <?php echo form_open('paper_controller/submit_edit_review'); ?>
            <input name="p_id" value="<?php echo $paper[0]["p_id"]?>" type="hidden">
            <div class="row">
                <div class="small-12 columns">
                    <label>Paper Title</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <input type="text" name="p_title" value="<?php echo $paper[0]["p_title"]?>">
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Paper Author</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <input type="text" name="p_author" value="<?php echo $paper[0]["p_author"]?>">
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <label>Paper Abstract</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="p_abstract" name="p_abstract"><?php echo $paper[0]["p_abstract"]?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>What is the major idea?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="p_major_idea" name="p_major_idea"><?php echo $paper[0]["p_major_idea"]?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>Which algorithm to be used?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <input name="p_algorithm" type="text" value="<?php echo $paper[0]["p_algorithm"]?>">
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>How is the dataset?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="p_dataset" name="p_dataset"><?php echo $paper[0]["p_dataset"]?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>How is preprocessing step carried out?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="p_preprocessing" name="p_preprocessing"><?php echo $paper[0]["p_preprocessing"]?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>How is the modelling step carried out?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="p_modelling" name="p_modelling"><?php echo $paper[0]["p_modelling"]?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>How is the evaluation step carried out?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="p_evaluation" name="p_evaluation"><?php echo $paper[0]["p_evaluation"]?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>What is my overall opinion?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="p_opinion" name="p_opinion"><?php echo $paper[0]["p_opinion"]?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label>If I read the paper again in the future, can I answer the following questions?</label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <textarea id="p_other_questions" name="p_other_questions"><?php echo $paper[0]["p_other_questions"]?></textarea>
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
                    <input type="radio" name="p_prediction_criteria_1" value="1" <?php if ($paper[0]["p_prediction_criteria_1"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="p_prediction_criteria_1" value="0" <?php if ($paper[0]["p_prediction_criteria_1"]==0){ echo 'checked';} ?>><label>No</label>
                </fieldset>
                <fieldset class="large-4 columns">
                    <legend>Is the prediction model tested on unseen data?</legend>
                    <input type="radio" name="p_prediction_criteria_2" value="1" <?php if ($paper[0]["p_prediction_criteria_2"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="p_prediction_criteria_2" value="0" <?php if ($paper[0]["p_prediction_criteria_2"]==0){ echo 'checked';} ?>><label>No</label>
                </fieldset>
                <fieldset class="large-4 columns">
                    <legend>Is the source of data reported?</legend>
                    <input type="radio" name="p_prediction_criteria_3" value="1" <?php if ($paper[0]["p_prediction_criteria_3"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="p_prediction_criteria_3" value="0" <?php if ($paper[0]["p_prediction_criteria_3"]==0){ echo 'checked';} ?>><label>No</label>
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
                    <input type="radio" name="p_model_building_criteria_1" value="1" <?php if ($paper[0]["p_model_building_criteria_1"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="p_model_building_criteria_1" value="0" <?php if ($paper[0]["p_model_building_criteria_1"]==0){ echo 'checked';} ?>><label>No</label>
                </fieldset>
                <fieldset class="large-4 columns">
                    <legend>Is the response/output reported? </legend>
                    <input type="radio" name="p_model_building_criteria_2" value="1" <?php if ($paper[0]["p_model_building_criteria_2"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="p_model_building_criteria_2" value="0" <?php if ($paper[0]["p_model_building_criteria_2"]==0){ echo 'checked';} ?>><label>No</label>
                </fieldset>
                <fieldset class="large-4 columns">
                    <legend>Is the modelling technique reported?</legend>
                    <input type="radio" name="p_model_building_criteria_3" value="1" <?php if ($paper[0]["p_model_building_criteria_3"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="p_model_building_criteria_3" value="0" <?php if ($paper[0]["p_model_building_criteria_3"]==0){ echo 'checked';} ?>><label>No</label>
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
                    <input type="radio" name="p_data_criteria_1" value="1" <?php if ($paper[0]["p_data_criteria_1"]==1){ echo 'checked';} ?>><label>Yes</label>
                    <input type="radio" name="p_data_criteria_1" value="0" <?php if ($paper[0]["p_data_criteria_1"]==0){ echo 'checked';} ?>><label>No</label>
                </fieldset>
            </div>
            <br>
            <div class="row">
                <div class="large-12 columns">
                    <input type="submit" value="Submit" class="button">
                </div>
            </div>
        </form>

        <?php include_once 'footer.php'?>
        <script>
            $(document).ready(function(){
                var areas = Array('p_major_idea', 'p_abstract', 'p_dataset', 'p_preprocessing',
                    'p_evaluation', 'p_opinion', 'p_modelling',
                    'p_other_questions');
                $.each(areas, function (i, area) {
                    CKEDITOR.replace(area);
                });
            });
        </script>
    </body>
</html>