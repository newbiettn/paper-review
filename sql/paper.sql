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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `review_fk` int(11) DEFAULT NULL,
  `type` mediumtext,
  `citation_key` mediumtext,
  `abstract` longtext,
  `author` mediumtext,
  `title` mediumtext,
  `journal` mediumtext,
  `year` tinytext,
  `volume` tinytext,
  `number` tinytext,
  `pages` tinytext,
  `month` tinytext,
  `note` longtext,
  `editor` tinytext,
  `publisher` tinytext,
  `publisher_address` varchar(45) DEFAULT NULL,
  `series` tinytext,
  `conference_location` tinytext,
  `booktitle` mediumtext,
  `edition` tinytext,
  `tags` mediumtext,
  `doi` mediumtext,
  `file` mediumtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `p_id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3529 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_paper`
--

LOCK TABLES `tbl_paper` WRITE;
/*!40000 ALTER TABLE `tbl_paper` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_paper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_paper_review`
--

DROP TABLE IF EXISTS `tbl_paper_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_paper_review` (
  `pr_id` int(11) NOT NULL AUTO_INCREMENT,
  `pr_paper_fk` int(11) DEFAULT NULL,
  `pr_major_idea` mediumtext,
  `pr_dataset` mediumtext,
  `pr_preprocessing` mediumtext,
  `pr_evaluation` longtext,
  `pr_opinion` mediumtext,
  `pr_rating` float DEFAULT NULL,
  `pr_other_questions` mediumtext,
  `pr_added_date` datetime DEFAULT NULL,
  `pr_edited_date` datetime DEFAULT NULL,
  `pr_algorithm` varchar(200) DEFAULT NULL,
  `pr_modelling` mediumtext,
  `pr_prediction_criteria_1` tinyint(1) DEFAULT NULL,
  `pr_prediction_criteria_2` tinyint(1) DEFAULT NULL,
  `pr_prediction_criteria_3` tinyint(1) DEFAULT NULL,
  `pr_model_building_criteria_1` tinyint(1) DEFAULT NULL,
  `pr_model_building_criteria_2` tinyint(1) DEFAULT NULL,
  `pr_model_building_criteria_3` tinyint(1) DEFAULT NULL,
  `pr_data_criteria_1` tinyint(1) DEFAULT NULL,
  `pr_data_criteria_2` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pr_id`),
  UNIQUE KEY `id_UNIQUE` (`pr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_paper_review`
--

LOCK TABLES `tbl_paper_review` WRITE;
/*!40000 ALTER TABLE `tbl_paper_review` DISABLE KEYS */;
INSERT INTO `tbl_paper_review` VALUES (14,317,'<p>Construct models using RapidMiner to predict diabetes</p>\n','<p>Pima Indians Diabetes dataset:</p>\n\n<ul>\n	<li>8 predictors, 1 response</li>\n	<li>No other contextual information</li>\n</ul>\n','<p>Poorly conducted:</p>\n\n<ul>\n	<li>Remove outliers using the density plot.</li>\n	<li>Feature selection is shallow, simply relying on measuring correlation between features and remove one that has many missing values.</li>\n	<li>Data normalization is performed automatically.</li>\n	<li>Data discretization is carelessly performed without concerning domain knowledge (i.e., divide the continuous value of Plasma-Glucose into distinct bins without any explanation).</li>\n</ul>\n','<p>No assessment at all.</p>\n','<p>The paper is shallow. There is no statistical and clinical evidence with regards to methods performed on the dataset as well as assessment upon the completion of modeling technique. I will remove on phase 1.</p>\n',NULL,NULL,'2016-08-29 12:36:24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(15,NULL,'<p>Using Artificial Neuromolecular Network to explore the relationship between the blood sugar levels and administrated insulin dosage. The aim is to assist physicians in deciding proper insulin dosage for patient.</p>\n','<p>Dataset contains the continuous values of blood sugar levels and insulin dosage of 4 patients.</p>\n','<p>N/A</p>\n','<p>Simply compare the accuracy of ANM model to the SVM and Decision Tree models</p>\n','<p>The idea is interesting but the paper does not provide a clear methodology to support the modeling preferences. I will let the paper pass Phase 1 but clearly it will be likely removed on Phase 2.</p>\n',NULL,NULL,'2016-08-29 12:38:31',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(16,NULL,'<p>Predict diabetes using two additional predictors including smoke and alcohol consumption.</p>\n','<p>Hospital dataset of 2000 observations.</p>\n','<ul>\n	<li>Discrete continuous data using existing literature reviews (??)</li>\n</ul>\n','<p>Using k-fold cross validation where k=5</p>\n','<p>The methodology of the paper is not satisfied when consider:</p>\n\n<ul>\n	<li>If discrete continous values is not a good idea because we destroy the originality of the data at the moment we change it from continous to categorial. I remember that there is one saying that dividing data into bins is a bad practice.</li>\n	<li>If RMSE is a good metric to measure the goodness of fit and to select/remove the features</li>\n</ul>\n',NULL,NULL,'2016-08-29 14:22:13',NULL,NULL,'<p>Divided in 2 parts:</p>\n\n<ul>\n	<li>Evaluate smoke and alcohol consumption features</li>\n	<li>Tuning parameters\n	<ul>\n		<li>Add feature one-by-one</li>\n		<li>Remove features that increase RMSE (??)</li>\n	</ul>\n	</li>\n</ul>\n\n<p>Both steps using <strong>Root Mean Square Error </strong>to evaluate the goodness of fit of the features.</p>\n',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(17,NULL,'<p>Predict diabetes and cancer</p>\n','<p>PIMA Indian dataset</p>\n','<p>The preprocessing step isn&#39;t explained at all.</p>\n','<p>N/A</p>\n','<p>I am keen on the proposed algorthm. It is new to me. However, the proposed approach is not validated clearly so the effect of the algorithm is clueless.</p>\n',NULL,'<p>What is ANFIS algorithm?</p>\n','2016-08-29 14:55:22',NULL,'Adaptive Neuro Fuzzy Inference System (ANFIS) with Adaptive KNN','<p>N/A</p>\n',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(19,NULL,'<p>Predict diabetes using decision tree algorithm</p>\n','<p>Pima Indian Diabetes Dataset</p>\n','<p>Imput missing values:</p>\n\n<ul>\n	<li>keep 0-value in Pregnant;</li>\n	<li>remove observations having 0-value in Plasma-Glucose, Diastolic, BMI;</li>\n	<li>discard the whole attributes with too many missing values (e.g., Triceps SFT and Serum-Insulin).</li>\n</ul>\n\n<p>Discrete data based on recommendation of sources.</p>\n\n<p>&nbsp;</p>\n','<p>Using k-fold cross validation where k=10.</p>\n\n<p>Using confusion matrix (with the same concept as Area Under The Curve (AUC) to report the model quality. It is 64%.</p>\n','<p>The author applies the famous Decision Tree algorithm automatically using Weka without any further examination of the dataset. The method is plain and simple. I expect more rigour imputation strategy and parameter tuning.</p>\n',NULL,'','2016-08-29 16:20:52',NULL,'Decision Tree (C4.5)','<p>Using Weka to construct the model. No further parameter tuning.</p>\n\n<p>&nbsp;</p>\n',1,1,1,1,1,1,1,1),(23,3055,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(24,3056,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(25,3057,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(26,3058,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(27,3059,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,3060,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(29,3061,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,3062,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,3063,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,3066,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,3076,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,3452,'<p>sdfdfdsf</p>\n','','','','',NULL,'','2016-09-21 17:18:46',NULL,'sdfdsfd sf','',0,0,0,0,0,0,0,NULL),(35,3453,'<p>sfdsfds dsfd sfdsf</p>\n','','','','',NULL,'<p>sdfdsfdf</p>\n','2016-09-21 17:21:26',NULL,'sdfsd fdsfd sf','',0,0,0,0,0,0,0,NULL);
/*!40000 ALTER TABLE `tbl_paper_review` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-21 17:39:48
