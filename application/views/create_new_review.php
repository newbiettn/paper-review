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
                <h4>Paper Review Form</h4>
            </div>
        </div>

        <?php echo form_open('paper_controller/submit_review'); ?>
        <div class="row">
            <div class="small-12 columns">
                <label>Paper Title</label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <p><?php echo $p["title"]?></p>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>Paper Author</label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <p><?php echo $p["author"]?></p>
            </div>
        </div>
        <div class="row">
            <div class="small-12 columns">
                <label>Paper Abstract</label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <p><?php echo $p["abstract"]?></p>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>What is the major idea?</label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <textarea id="pr_major_idea" name="pr_major_idea"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>Which algorithm to be used?</label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <input name="pr_algorithm" type="text">
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>How is the dataset?</label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <textarea id="pr_dataset" name="pr_dataset"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>How is the preprocessing step carried out?</label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <textarea id="pr_preprocessing" name="pr_preprocessing"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>How is the modelling step carried out?</label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <textarea id="pr_modelling" name="pr_modelling"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>How is the evaluation step carried out?</label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <textarea id="pr_evaluation" name="pr_evaluation"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>What is my overall opinion?</label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <textarea id="pr_opinion" name="pr_opinion"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <label>If I read the paper again in the future, can I answer the following questions?</label>
            </div>
        </div>
        <div class="row">
            <div class="large-12 columns">
                <textarea id="pr_other_questions" name="pr_other_questions"></textarea>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="large-12 columns">
                <label>Prediction Criteria</label>
            </div>
        </div>
        <div class="row questionnaire-container">
            <fieldset class="large-4 columns">
                <legend>Is a prediction model reported?</legend>
                <input type="radio" name="pr_prediction_criteria_1" value="1"><label>Yes</label>
                <input type="radio" name="pr_prediction_criteria_1" value="0"><label>No</label>
            </fieldset>
            <fieldset class="large-4 columns">
                <legend>Is the prediction model tested on unseen data?</legend>
                <input type="radio" name="pr_prediction_criteria_2" value="1"><label>Yes</label>
                <input type="radio" name="pr_prediction_criteria_2" value="0"><label>No</label>
            </fieldset>
            <fieldset class="large-4 columns">
                <legend>Is the source of data reported?</legend>
                <input type="radio" name="pr_prediction_criteria_3" value="1"><label>Yes</label>
                <input type="radio" name="pr_prediction_criteria_3" value="0"><label>No</label>
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
                <input type="radio" name="pr_model_building_criteria_1" value="1"><label>Yes</label>
                <input type="radio" name="pr_model_building_criteria_1" value="0"><label>No</label>
            </fieldset>
            <fieldset class="large-4 columns">
                <legend>Is the response/output reported? </legend>
                <input type="radio" name="pr_model_building_criteria_2" value="1"><label>Yes</label>
                <input type="radio" name="pr_model_building_criteria_2" value="0"><label>No</label>
            </fieldset>
            <fieldset class="large-4 columns">
                <legend>Is the modelling technique reported?</legend>
                <input type="radio" name="pr_model_building_criteria_3" value="1"><label>Yes</label>
                <input type="radio" name="pr_model_building_criteria_3" value="0"><label>No</label>
            </fieldset>
        </div>

        <div class="row">
            <div class="large-12 columns">
                <label>Data Criteria</label>
            </div>
        </div>
        <div class="row questionnaire-container">
            <fieldset class="large-6 columns">
                <legend>Is the data acquisition process described?</legend>
                <input type="radio" name="pr_data_criteria_1" value="1"><label>Yes</label>
                <input type="radio" name="pr_data_criteria_1" value="0"><label>No</label>
            </fieldset>
        </div>
        <br>
        <div class="row">
            <div class="large-12 columns">
                <input type="submit" value="Submit" class="expanded button">
            </div>
        </div>
        </form>

        <?php include_once 'footer.php'?>
        <script>
            $(document).ready(function(){
                var areas = Array('pr_major_idea', 'pr_abstract', 'pr_dataset', 'pr_preprocessing',
                    'pr_evaluation', 'pr_opinion', 'pr_modelling',
                    'pr_other_questions');
                $.each(areas, function (i, area) {
                    CKEDITOR.replace(area);
                });
            });
        </script>
    </body>
</html>