<!doctype html>
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

    <!--Include Head-->
    <?php include_once 'head.php' ?>

    <body>
        <?php include_once 'header.php'?>

        <div class="row page-title">
            <div class="large-8 columns">
                <h4>View Paper</h4>
            </div>
            <div class="large-4 columns">
                <a href="<?php echo base_url("index.php/paper_controller/open_edit_review/" . $paper[0]["p_id"])?>"
                   class="small button">
                    Edit Review
                </a>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns">
                <table class="display-paper">
                    <thead>
                        <tr>
                            <th colspan="2">
                                <span>
                                    <?php echo $paper[0]["p_title"] ?>
                                </span>
                                <small><?php echo $paper[0]["p_author"]?></small>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2" class="abstract-paper">
                                <strong>Abstract:</strong> <?php echo $paper[0]["p_abstract"]?>
                            </td>
                        </tr>
                        <tr>
                            <th width="250" class="abstract-paper">
                                <strong>Questions</strong>
                            </th>
                            <th>Paper Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="question-paper">What is the major idea of the paper?</td>
                            <td><?php echo $paper[0]["p_major_idea"]?></td>
                        </tr>
                        <tr>
                            <td class="question-paper">What is the algorithm?</td>
                            <td><?php echo $paper[0]["p_algorithm"]?></td>
                        </tr>
                        <tr>
                            <td class="question-paper">How is the dataset?</td>
                            <td><?php echo $paper[0]["p_dataset"]?></td>
                        </tr>
                        <tr>
                            <td class="question-paper">How is the preprocessing step carried out?</td>
                            <td><?php echo $paper[0]["p_preprocessing"]?></td>
                        </tr>
                        <tr>
                            <td class="question-paper">How is the modelling step carried out?</td>
                            <td><?php echo $paper[0]["p_modelling"]?></td>
                        </tr>
                        <tr>
                            <td class="question-paper">How is the evaluation step carried out?</td>
                            <td><?php echo $paper[0]["p_evaluation"]?></td>
                        </tr>
                        <tr>
                            <td class="question-paper">What is my overall opinion?</td>
                            <td><?php echo $paper[0]["p_opinion"]?></td>
                        </tr>
                        <tr>
                            <td class="question-paper">If I read the paper again in the future, can I answer the following questions?</td>
                            <td><?php echo $paper[0]["p_other_questions"]?></td>
                        </tr>
                        <tr>
                            <td class="question-paper">Prediction Criteria</td>
                            <td>
                                <div class="row">
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
                            </td>
                        </tr>
                        <tr>
                            <td class="question-paper">Model Building Criteria</td>
                            <td>
                                <div class="row">
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
                            </td>
                        </tr>
                        <tr>
                            <td class="question-paper">Data Criteria</td>
                            <td>
                                <div class="row">
                                    <fieldset class="large-6 columns">
                                        <legend>Is the data acquisition process described?</legend>
                                        <input type="radio" name="p_data_criteria_1" value="1" <?php if ($paper[0]["p_data_criteria_1"]==1){ echo 'checked';} ?>><label>Yes</label>
                                        <input type="radio" name="p_data_criteria_1" value="0" <?php if ($paper[0]["p_data_criteria_1"]==0){ echo 'checked';} ?>><label>No</label>
                                    </fieldset>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <?php include_once 'footer.php'?>
    </body>
</html>