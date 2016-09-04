-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: 127.0.0.1    Database: paper-review
-- ------------------------------------------------------
-- Server version	5.7.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_paper`
--

DROP TABLE IF EXISTS `tbl_paper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_paper` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_title` varchar(200) DEFAULT NULL,
  `p_author` varchar(200) DEFAULT NULL,
  `p_abstract` mediumtext,
  `p_major_idea` mediumtext,
  `p_dataset` mediumtext,
  `p_preprocessing` mediumtext,
  `p_evaluation` longtext,
  `p_opinion` mediumtext,
  `p_rating` float DEFAULT NULL,
  `p_other_questions` mediumtext,
  `p_added_date` datetime DEFAULT NULL,
  `p_edited_date` datetime DEFAULT NULL,
  `p_algorithm` varchar(200) DEFAULT NULL,
  `p_modelling` mediumtext,
  `p_prediction_criteria_1` tinyint(1) DEFAULT NULL,
  `p_prediction_criteria_2` tinyint(1) DEFAULT NULL,
  `p_prediction_criteria_3` tinyint(1) DEFAULT NULL,
  `p_model_building_criteria_1` tinyint(1) DEFAULT NULL,
  `p_model_building_criteria_2` tinyint(1) DEFAULT NULL,
  `p_model_building_criteria_3` tinyint(1) DEFAULT NULL,
  `p_data_criteria_1` tinyint(1) DEFAULT NULL,
  `p_data_criteria_2` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `id_UNIQUE` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_paper`
--

LOCK TABLES `tbl_paper` WRITE;
/*!40000 ALTER TABLE `tbl_paper` DISABLE KEYS */;
INSERT INTO `tbl_paper` VALUES (14,'Diabetes Data Analysis and Prediction Model Discovery Using RapidMiner','J. Han and J. C. Rodriguez and M. Beheshti','<p>Data mining techniques have been extensively applied in bioinformatics to analyze biomedical data. In this paper, we choose the RapidMiner as our tool to analyze a Pima Indians Diabetes Data Set, which collects the information of patients with and without developing diabetes. The discussion follows the data mining process. The focus will be on the data preprocessing, including attribute identification and selection, outlier removal, data normalization and numerical discretization, visual data analysis, hidden relationships discovery, and a diabetes prediction model construction.</p>\n','<p>Construct models using RapidMiner to predict diabetes</p>\n','<p>Pima Indians Diabetes dataset:</p>\n\n<ul>\n	<li>8 predictors, 1 response</li>\n	<li>No other contextual information</li>\n</ul>\n','<p>Poorly conducted:</p>\n\n<ul>\n	<li>Remove outliers using the density plot.</li>\n	<li>Feature selection is shallow, simply relying on measuring correlation between features and remove one that has many missing values.</li>\n	<li>Data normalization is performed automatically.</li>\n	<li>Data discretization is carelessly performed without concerning domain knowledge (i.e., divide the continuous value of Plasma-Glucose into distinct bins without any explanation).</li>\n</ul>\n','<p>No assessment at all.</p>\n','<p>The paper is shallow. There is no statistical and clinical evidence with regards to methods performed on the dataset as well as assessment upon the completion of modeling technique. I will remove on phase 1.</p>\n',NULL,NULL,'2016-08-29 12:36:24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,'Evaluation of Intelligent System to the Control of Diabetes','H. C. Chan and J. C. Chen and S. W. Chien and Y. F. Chen and C. T. Bau','<p>Diabetes, as the 4th death cause, has become a vital issue in the 21th century. However, blood sugar levels of most diabetic patients are not well controlled. For a patient with chronic disease, treatment efficiency could be influenced by the disease, remedy, and mental condition, in addition to his/her physiological status. Therefore, there is a great deal of difficulty in establishing a guideline to decide the reasonable dosage for a particular patient. To address this difficulty, this study, via team cooperation with the Department of Endocrinology and Metabolism, Taichung Hospital, has designed an artificial intelligence (AI) system. This AI system may provide a real-time monitoring of patient&#39;s physical condition and adjust the insulin dosage from AI system to facilitate the monitoring, caring, and management of patients. Furthermore, abnormal condition may be detected earlier and then emergency treatment may be provided in time to prevent the occurrence of any unfortunate events caused by negligence. With this system, data of 4 patients was partitioned into training data set (3/2) and test data set (1/3). Training data set was entered into ANM system for an analysis of learning stage to build a prediction model for insulin dosage. Upon the completion, the test data set was tested with this prediction model for the accuracy of dosage control by bioartificial pancreas. Results showed that ANM system may effectively predict the occurrence of problems related to insulin dosage of bioartificial pancreas, with a satisfactory accuracy.</p>\n','<p>Using Artificial Neuromolecular Network to explore the relationship between the blood sugar levels and administrated insulin dosage. The aim is to assist physicians in deciding proper insulin dosage for patient.</p>\n','<p>Dataset contains the continuous values of blood sugar levels and insulin dosage of 4 patients.</p>\n','<p>N/A</p>\n','<p>Simply compare the accuracy of ANM model to the SVM and Decision Tree models</p>\n','<p>The idea is interesting but the paper does not provide a clear methodology to support the modeling preferences. I will let the paper pass Phase 1 but clearly it will be likely removed on Phase 2.</p>\n',NULL,NULL,'2016-08-29 12:38:31',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,'Study of Type 2 diabetes risk factors using neural network for Thai people and tuning neural network parameters','W. Luangruangrong and A. Rodtook and S. Chimmanee','<p>Risk factors for Type 2 diabetes is very important for developing diabetes prediction tools instead of blood testing. Recently, many researches have studied risk factors of diabetes in order to apply them to be a tool for diabetes prediction by using Logistic Regression (LR), Radial Basis and Back-propagation Neural Network (BNN). However, the accuracy is not higher. This paper presents new factors that are smoking and alcohol consumption to improve accuracy in diabetes prediction. Some traditional factors i.e., body mass index (BMI), blood pressure (BP) and waist circumference (WC) and Family History (FMH) are also proposed to extent by adjusting and additional range. The proposed diabetes prediction method is based on BNN. Approximately 2,000 cases of Thai people at BMC hospital, Thailand during 2010 to 2012 are used to train the BNN. From experiment results, each proposed factors i.e., FMH, Alcohol consumption factor, Smoking Factors and WC gives a value of accuracy that is higher than baseline as 83.35%, 83.5%, 83.6% and 83.65%, respectively. After that, this paper focuses on tuning neural network parameter, which is divided into 3 main steps: number of hidden nodes, sequence of integrating the proposed factors, and other parameter i.e., learning rate, and Iteration. Finally, the proposed factors and tuning BNN parameters introduce a high accuracy compared with the baseline up to 1.2%.</p>\n\n<p>&nbsp;</p>\n','<p>Predict diabetes using two additional predictors including smoke and alcohol consumption.</p>\n','<p>Hospital dataset of 2000 observations.</p>\n','<ul>\n	<li>Discrete continuous data using existing literature reviews (??)</li>\n</ul>\n','<p>Using k-fold cross validation where k=5</p>\n','<p>The methodology of the paper is not satisfied when consider:</p>\n\n<ul>\n	<li>If discrete continous values is not a good idea because we destroy the originality of the data at the moment we change it from continous to categorial. I remember that there is one saying that dividing data into bins is a bad practice.</li>\n	<li>If RMSE is a good metric to measure the goodness of fit and to select/remove the features</li>\n</ul>\n',NULL,NULL,'2016-08-29 14:22:13',NULL,NULL,'<p>Divided in 2 parts:</p>\n\n<ul>\n	<li>Evaluate smoke and alcohol consumption features</li>\n	<li>Tuning parameters\n	<ul>\n		<li>Add feature one-by-one</li>\n		<li>Remove features that increase RMSE (??)</li>\n	</ul>\n	</li>\n</ul>\n\n<p>Both steps using <strong>Root Mean Square Error </strong>to evaluate the goodness of fit of the features.</p>\n',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,'A New Approach for Diagnosis of Diabetes and Prediction of Cancer using ANFIS','C. Kalaiselvi and G. M. Nasira','<p>The multi factorial, chronic, severe diseases like diabetes and cancer have complex relationship. When the glucose level of the body goes to abnormal level, it will lead to Blindness, Heart disease, Kidney failure and also Cancer. Epidemiological studies have proved that several cancer types are possible in patients having diabetes. Many researchers proposed methods to diagnose diabetes and cancer. To improve the classification accuracy and to achieve better efficiency a new approach like Adaptive Neuro Fuzzy Inference System (ANFIS) is proposed.</p>\n','<p>Predict diabetes and cancer</p>\n','<p>PIMA Indian dataset</p>\n','<p>The preprocessing step isn&#39;t explained at all.</p>\n','<p>N/A</p>\n','<p>I am keen on the proposed algorthm. It is new to me. However, the proposed approach is not validated clearly so the effect of the algorithm is clueless.</p>\n',NULL,'<p>What is ANFIS algorithm?</p>\n','2016-08-29 14:55:22',NULL,'Adaptive Neuro Fuzzy Inference System (ANFIS) with Adaptive KNN','<p>N/A</p>\n',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,'Decision Tree Discovery for the Diagnosis of Type II Diabetes','A. A. Al Jarullah','<p>The discovery of knowledge from medical databases is important in order to make effective medical diagnosis. The aim of data mining is to extract knowledge from information stored in database and generate clear and understandable description of patterns. In this study, decision tree method was used to predict patients with developing diabetes. The dataset used is the Pima Indians Diabetes Data Set, which collects the information of patients with and without developing diabetes. The study goes through two phases. The first phase is data preprocessing including attribute identification and selection, handling missing values, and numerical discretization. The second phase is a diabetes prediction model construction using the decision tree method. Weka software was used throughout all the phases of this study.</p>\n','<p>Predict diabetes using decision tree algorithm</p>\n','<p>Pima Indian Diabetes Dataset</p>\n','<p>Imput missing values:</p>\n\n<ul>\n	<li>keep 0-value in Pregnant;</li>\n	<li>remove observations having 0-value in Plasma-Glucose, Diastolic, BMI;</li>\n	<li>discard the whole attributes with too many missing values (e.g., Triceps SFT and Serum-Insulin).</li>\n</ul>\n\n<p>Discrete data based on recommendation of sources.</p>\n\n<p>&nbsp;</p>\n','<p>Using k-fold cross validation where k=10.</p>\n\n<p>Using confusion matrix (with the same concept as Area Under The Curve (AUC) to report the model quality. It is 64%.</p>\n','<p>The author applies the famous Decision Tree algorithm automatically using Weka without any further examination of the dataset. The method is plain and simple. I expect more rigour imputation strategy and parameter tuning.</p>\n',NULL,'','2016-08-29 16:20:52',NULL,'Decision Tree (C4.5)','<p>Using Weka to construct the model. No further parameter tuning.</p>\n\n<p>&nbsp;</p>\n',1,1,1,1,1,1,1,1);
/*!40000 ALTER TABLE `tbl_paper` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-29 17:14:36
