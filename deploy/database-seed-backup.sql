-- MySQL dump 10.13  Distrib 9.6.0, for macos26.2 (arm64)
--
-- Host: localhost    Database: aldar
-- ------------------------------------------------------
-- Server version	9.6.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `job_id` bigint unsigned NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `passport_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `status` enum('received','screening','interview','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'received',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applications_user_id_foreign` (`user_id`),
  KEY `applications_job_id_foreign` (`job_id`),
  CONSTRAINT `applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,2,1,'Rabin Karki','rabin.karki@example.com','+977-9811111111','https://example.com/demo/rabin-cv.pdf','https://example.com/aldar/rabin-passport.pdf','Interested in immediate deployment.','screening','2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,3,2,'Sita Sharma','sita.sharma@example.com','+977-9822222222','https://example.com/aldar/sita-cv.pdf','https://example.com/aldar/sita-passport.pdf','Ready for interview scheduling.','interview','2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,NULL,1,'Samyak Chaudhary','samyakchy1@gmail.com','9845569189','uploads/applications/1771589675_cv_1742386115bscit (3).pdf','uploads/applications/1771589675_passport_CamScanner 16-01-2026 13.53.pdf','','received','2026-02-20 06:29:35','2026-02-20 06:29:35'),(4,NULL,1,'Samyak Chaudhary','samyakchy1@gmail.com','9845569189','uploads/applications/1771591629_cv_1742386115bscit (4).pdf','uploads/applications/1771591629_passport_CamScanner 16-01-2026 13.53.pdf','','received','2026-02-20 07:02:09','2026-02-20 07:02:09'),(5,NULL,2,'Samyak Chaudhary','samyakchy1@gmail.com','9845569189','uploads/applications/1771838604_cv_CamScanner 16-01-2026 13.53.pdf','uploads/applications/1771838604_passport_CamScanner 16-01-2026 13.53.pdf','','received','2026-02-23 03:38:24','2026-02-23 03:38:24');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brand` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `industry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `favicon_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `office_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `phone_numbers` json DEFAULT NULL,
  `emails` json DEFAULT NULL,
  `social_links` json DEFAULT NULL,
  `whatsapp_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `whatsapp_message` text COLLATE utf8mb4_unicode_ci,
  `whatsapp_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `chatbot_greeting` text COLLATE utf8mb4_unicode_ci,
  `chairman_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `chairman_photo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `chairman_message_en` text COLLATE utf8mb4_unicode_ci,
  `chairman_message_ne` text COLLATE utf8mb4_unicode_ci,
  `signature_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `registration_info_en` text COLLATE utf8mb4_unicode_ci,
  `registration_info_ne` text COLLATE utf8mb4_unicode_ci,
  `footer_summary_en` text COLLATE utf8mb4_unicode_ci,
  `footer_summary_ne` text COLLATE utf8mb4_unicode_ci,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pan_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `capital_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `google_map_embed` text COLLATE utf8mb4_unicode_ci,
  `about_us_en` text COLLATE utf8mb4_unicode_ci,
  `about_us_ne` text COLLATE utf8mb4_unicode_ci,
  `vision_en` text COLLATE utf8mb4_unicode_ci,
  `vision_ne` text COLLATE utf8mb4_unicode_ci,
  `mission_en` text COLLATE utf8mb4_unicode_ci,
  `mission_ne` text COLLATE utf8mb4_unicode_ci,
  `objectives_en` json DEFAULT NULL,
  `objectives_ne` json DEFAULT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#038441',
  `secondary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#026B34',
  `accent_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#D4AF37',
  `light_bg_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#F0F7F2',
  `dark_footer_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#012A15',
  `registered_with_en` text COLLATE utf8mb4_unicode_ci,
  `registered_with_ne` text COLLATE utf8mb4_unicode_ci,
  `for_employers_intro_en` text COLLATE utf8mb4_unicode_ci,
  `for_employers_intro_ne` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (1,'ALDAR GROUP PVT. LTD.','Creating opportunities for professional growth','Overseas Recruitment & Corporate Services','/uploads/images/logo/aldar-logo.png','/uploads/images/logo/aldar-logo.png','Sukedhara-4, Kathmandu, Nepal','[\"+977-9841450009\", \"+977-9803851465\", \"+977-1-5925942\"]','[\"sahkapil13@gmail.com\", \"aldaroffice.025@gmail.com\"]','[{\"url\": \"https://facebook.com/aldargroup\", \"platform\": \"facebook\"}, {\"url\": \"https://linkedin.com/company/aldargroup\", \"platform\": \"linkedin\"}]','9779841450009','Hello ALDAR GROUP, I want to apply for overseas jobs.',1,'Welcome to ALDAR GROUP. How can we help you today?','Kapleshwar Shah','https://picsum.photos/seed/aldar-chairman/300/320','Dear Esteemed Clients, Valued Candidates, and Respected Partners, It is with great pleasure and a profound sense of responsibility that I address you today as the Chairman of Aldar Group Pvt. Ltd. Our journey as an organization dedicated to ethical recruitment has been both inspiring and transformative.','आदरणीय ग्राहकहरू, बहुमूल्य उम्मेदवारहरू र सम्मानित साझेदारहरू, अल्दार ग्रुप प्रा. लि.को अध्यक्षको रूपमा म आज तपाईंहरूलाई सम्बोधन गर्दा अत्यन्त खुसी र गहिरो जिम्मेवारीको भावना महसुस गर्दछु।','https://picsum.photos/seed/aldar-sign/180/80','Government approved recruitment agency registered in Ministry of Labor, Nepal.','नेपालको श्रम मन्त्रालयमा दर्ता भएको सरकार स्वीकृत भर्ती एजेन्सी।','Trusted overseas recruitment partner connecting Nepalese talent to global opportunities.','नेपाली प्रतिभालाई विश्वव्यापी अवसरसँग जोड्ने विश्वसनीय वैदेशिक रोजगार साझेदार।','1795/082/083','371666/082/083','622409832','NPR 20,000,000','Prime Commercial Bank Ltd.',NULL,'At Aldar Group Pvt. Ltd., we take pride in being a bridge between talent and opportunity. Aldar Group Pvt. Ltd. is the government approved recruitment agency registered in Ministry of Labor in Nepal.','अल्दार ग्रुप प्रा. लि. मा हामी प्रतिभा र अवसरबीचको पुल भएकोमा गर्व गर्दछौं।','To be the leading recruitment partner, connecting top talent with dream jobs and driving business success through innovative solutions and exceptional service.','अग्रणी भर्ती साझेदार बन्ने, शीर्ष प्रतिभालाई सपनाका रोजगारीसँग जोड्ने।','Our mission is to meet the growing demand for Nepalese workforce abroad to ease growing unemployment within the country.','हाम्रो लक्ष्य विदेशमा नेपाली जनशक्तिको बढ्दो मागलाई पूरा गर्ने।','[\"Meet the growing demand for Nepalese workforce abroad\", \"Ease growing unemployment through overseas placements\", \"Export capable manpower from semi-skilled to highly skilled professionals\", \"Uphold integrity\", \"transparency\", \"and fairness\", \"Deliver professional and innovative recruitment solutions\", \"Foster collaboration and teamwork\", \"Provide complete recruitment solutions tailored to each company\'s needs\"]','[\"विदेशमा नेपाली जनशक्तिको बढ्दो मागलाई पूरा गर्ने\", \"वैदेशिक रोजगारी मार्फत देशभित्रको बेरोजगारी कम गर्ने\", \"अर्ध-कुशलदेखि उच्च कुशल पेशेवरहरूसम्म सक्षम जनशक्ति निर्यात गर्ने\", \"प्रत्येक कार्यमा इमानदारिता\", \"पारदर्शिता र निष्पक्षता कायम राख्ने\", \"व्यावसायिक र नवीन भर्ती समाधानहरू प्रदान गर्ने\", \"दीर्घकालीन प्रभावका लागि सहकार्य र टोलीकार्यलाई बढावा दिने\", \"प्रत्येक कम्पनीको आवश्यकता अनुसार पूर्ण भर्ती समाधानहरू प्रदान गर्ने\"]','#038441','#026B34','#D4AF37','#F0F7F2','#012A15','1) Office of Company Register, 2) Department of Foreign Employment, 3) Department of Internal Revenue','१) कम्पनी रजिस्ट्रार कार्यालय, २) वैदेशिक रोजगार विभाग, ३) आन्तरिक राजस्व विभाग','It is my privilege to introduce Aldar Group Pvt. Ltd., a trusted provider of comprehensive manpower solutions.','अल्दार ग्रुप प्रा. लि. को परिचय दिन पाउँदा मलाई गर्व लाग्छ।','2026-02-20 03:42:28','2026-02-23 01:12:56');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ne` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sector_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `positions` json DEFAULT NULL,
  `display_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Factory Workers & General Labor','कारखाना कामदार र सामान्य श्रमिक','factory-workers',NULL,NULL,'cog','','blue-collar','[{\"title_en\": \"Factory Worker\", \"title_ne\": \"कारखाना कामदार\"}, {\"title_en\": \"General Worker\", \"title_ne\": \"सामान्य कामदार\"}]',1,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'Cleaning & Helper Services','सफाइ र सहायक सेवा','cleaning-helper',NULL,NULL,'sparkles','','service','[{\"title_en\": \"Cleaner\", \"title_ne\": \"सफाइकर्मी\"}, {\"title_en\": \"Helper\", \"title_ne\": \"सहायक\"}]',2,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'Management & Sales','व्यवस्थापन र बिक्री','management-sales',NULL,NULL,'briefcase','','professional','[{\"title_en\": \"Manager\", \"title_ne\": \"प्रबन्धक\"}, {\"title_en\": \"Supervisor\", \"title_ne\": \"सुपरभाइजर\"}]',3,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(4,'Construction','निर्माण','construction',NULL,NULL,'hard-hat','','blue-collar','[{\"title_en\": \"Civil Engineer\", \"title_ne\": \"सिभिल इन्जिनियर\"}, {\"title_en\": \"Mason\", \"title_ne\": \"डकर्मी\"}, {\"title_en\": \"Carpenter\", \"title_ne\": \"सिकर्मी\"}]',4,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(5,'Security','सुरक्षा','security',NULL,NULL,'shield-check','','service','[{\"title_en\": \"Security Guard\", \"title_ne\": \"सुरक्षा गार्ड\"}, {\"title_en\": \"Security Supervisor\", \"title_ne\": \"सुरक्षा सुपरभाइजर\"}]',5,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(6,'Hotel / Resort / Restaurant','होटल / रिसोर्ट / रेस्टुरेन्ट','hotel-resort',NULL,NULL,'building-storefront','','service','[{\"title_en\": \"Hotel Manager\", \"title_ne\": \"होटल प्रबन्धक\"}, {\"title_en\": \"Chef / Cook\", \"title_ne\": \"शेफ / कुक\"}]',6,1,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chatbot_data`
--

DROP TABLE IF EXISTS `chatbot_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chatbot_data` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category` enum('jobs','notices','office','visa_faqs') COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_ne` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_ne` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chatbot_data`
--

LOCK TABLES `chatbot_data` WRITE;
/*!40000 ALTER TABLE `chatbot_data` DISABLE KEYS */;
INSERT INTO `chatbot_data` VALUES (1,'jobs','How can I apply for jobs?','म जागिरमा कसरी आवेदन दिन सक्छु?','Open the Jobs page and submit the online form.','जागिर पृष्ठ खोलेर अनलाइन फाराम भर्नुहोस्।',1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'visa_faqs','What documents are required for visa?','भिसाका लागि के कागजात चाहिन्छ?','Passport, medical report, police clearance and contract documents.','राहदानी, मेडिकल रिपोर्ट, प्रहरी क्लियरेन्स र सम्झौता कागजात।',1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'office','Where is your office?','तपाईंको कार्यालय कहाँ छ?','Sukedhara-4, Kathmandu, Nepal','सुकेधारा-४, काठमाडौं, नेपाल',1,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `chatbot_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cms_pages`
--

DROP TABLE IF EXISTS `cms_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cms_pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `content_ne` longtext COLLATE utf8mb4_unicode_ci,
  `seo_title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `seo_title_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `seo_description_en` text COLLATE utf8mb4_unicode_ci,
  `seo_description_ne` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cms_pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_pages`
--

LOCK TABLES `cms_pages` WRITE;
/*!40000 ALTER TABLE `cms_pages` DISABLE KEYS */;
INSERT INTO `cms_pages` VALUES (1,'about-us','About Us','हाम्रो बारेमा','ALDAR GROUP PVT. LTD. company profile content managed from CMS.','ALDAR GROUP PVT. LTD. को कम्पनी प्रोफाइल सामग्री CMS बाट व्यवस्थापन गरिन्छ।','About ALDAR GROUP','ALDAR GROUP को बारेमा','Official profile of ALDAR GROUP PVT. LTD.','ALDAR GROUP PVT. LTD. को आधिकारिक प्रोफाइल।','2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'services','Services','सेवाहरू','Official ALDAR services content managed from CMS.','ALDAR सेवाहरूको आधिकारिक सामग्री।','ALDAR Services','ALDAR सेवाहरू','Recruitment and corporate services by ALDAR GROUP.','ALDAR GROUP द्वारा भर्ती तथा कर्पोरेट सेवाहरू।','2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `cms_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `flag_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visa_info_en` text COLLATE utf8mb4_unicode_ci,
  `visa_info_ne` text COLLATE utf8mb4_unicode_ci,
  `demand_sectors_en` json DEFAULT NULL,
  `demand_sectors_ne` json DEFAULT NULL,
  `salary_range_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `salary_range_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `requirements_en` text COLLATE utf8mb4_unicode_ci,
  `requirements_ne` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `countries_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'saudi-arabia','','','Saudi Arabia','साउदी अरेबिया','Employment visa processing available.','रोजगार भिसा प्रक्रिया उपलब्ध छ।','[\"Construction\", \"Logistics\", \"Hospitality\"]','[\"निर्माण\", \"लोजिस्टिक्स\", \"आतिथ्य\"]','NPR 45,000 - 120,000','रु ४५,००० - १,२०,०००','Passport, medical report, relevant experience.','राहदानी, मेडिकल रिपोर्ट, सम्बन्धित अनुभव।',1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'qatar','','','Qatar','कतार','Fast visa guidance through partner sponsors.','साझेदार स्पोन्सरमार्फत छिटो भिसा मार्गदर्शन।','[\"Security\", \"Facility Management\"]','[\"सुरक्षा\", \"फेसिलिटी व्यवस्थापन\"]','NPR 40,000 - 95,000','रु ४०,००० - ९५,०००','Passport, police clearance, interview pass.','राहदानी, प्रहरी क्लियरेन्स, अन्तर्वार्ता पास।',1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'uae','','','UAE','यूएई','Employer-linked visa processing support.','नियोक्ता-सम्बद्ध भिसा प्रक्रिया सहयोग।','[\"Retail\", \"Driving\", \"Cleaning\"]','[\"रिटेल\", \"ड्राइभिङ\", \"क्लिनिङ\"]','NPR 38,000 - 88,000','रु ३८,००० - ८८,०००','Passport, age 21+, basic communication.','राहदानी, उमेर २१+।',1,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employer_requirements`
--

DROP TABLE IF EXISTS `employer_requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employer_requirements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `document_name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_name_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ne` text COLLATE utf8mb4_unicode_ci,
  `is_required` tinyint(1) NOT NULL DEFAULT '1',
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `display_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employer_requirements`
--

LOCK TABLES `employer_requirements` WRITE;
/*!40000 ALTER TABLE `employer_requirements` DISABLE KEYS */;
INSERT INTO `employer_requirements` VALUES (1,'Demand Letter','माग पत्र','Addressed to authorize Aldar Group Pvt. Ltd. Kathmandu, Nepal.','अल्दार ग्रुप प्रा. लि. काठमाडौं, नेपाललाई अधिकृत गर्न सम्बोधित।',1,'employer',1,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'Power of Attorney','अख्तियारनामा','Addressed to authorize Aldar Group Pvt. Ltd. as the lawful attorney in Nepal.','अल्दार ग्रुप प्रा. लि. लाई नेपालमा कानुनी वकिलको रूपमा अधिकृत।',1,'employer',2,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'Service Agreement','सेवा सम्झौता','Service agreement between the company and the recruitment agency.','कम्पनी र भर्ती एजेन्सी बीच सेवा सम्झौता।',1,'contract',3,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(4,'Employment Contract','रोजगार सम्झौता','One copy of the employment contract, signed and sealed.','हस्ताक्षर र सिलबन्दी गरेको रोजगार सम्झौताको एक प्रति।',1,'contract',4,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(5,'Guarantee Letter','ग्यारेन्टी पत्र','A signed and stamped copy from the employing company.','रोजगारदाता कम्पनीबाट हस्ताक्षर र छाप लगाइएको प्रति।',1,'employer',5,1,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `employer_requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_submissions`
--

DROP TABLE IF EXISTS `form_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `form_submissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `form_id` bigint unsigned DEFAULT NULL,
  `data` json NOT NULL,
  `files` json DEFAULT NULL,
  `status` enum('new','in_review','resolved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_submissions_form_id_foreign` (`form_id`),
  CONSTRAINT `form_submissions_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_submissions`
--

LOCK TABLES `form_submissions` WRITE;
/*!40000 ALTER TABLE `form_submissions` DISABLE KEYS */;
INSERT INTO `form_submissions` VALUES (1,1,'{\"phone\": \"+977-9811111111\", \"country\": \"Qatar\", \"fullName\": \"Rabin Karki\"}','[]','new','2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,2,'{\"message\": \"Please update interview result status.\", \"subject\": \"Delayed update\"}','[]','in_review','2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,NULL,'{\"name\": \"Samyak Chaudhary\", \"email\": \"samyakchy1@gmail.com\", \"phone\": \"9845569189\", \"_source\": \"contact-page\", \"message\": \"test\", \"subject\": \"Complete School Management System\"}',NULL,'new','2026-02-20 06:28:05','2026-02-20 06:28:05'),(4,NULL,'{\"name\": \"Samyak Chaudhary\", \"email\": \"samyakchy1@gmail.com\", \"phone\": \"9845569189\", \"_source\": \"contact-page\", \"message\": \"test\", \"subject\": \"Complete School Management System\"}',NULL,'new','2026-02-20 06:28:37','2026-02-20 06:28:37'),(5,NULL,'{\"name\": \"Samyak Chaudhary\", \"email\": \"chysamyak@gmail.com\", \"phone\": \"4356345345\", \"_source\": \"contact-page\", \"message\": \"tttt\", \"subject\": \"test\"}',NULL,'new','2026-02-20 06:51:35','2026-02-20 06:51:35'),(9,3,'{\"\": null}',NULL,'new','2026-02-20 07:02:19','2026-02-20 07:02:19'),(10,3,'{\"name\": \"Samyak Chaudhary\", \"email\": \"samyakchy1@gmail.com\", \"phone\": \"9845569189\", \"message\": \"dsdfsdf\", \"subject\": \"tetr\"}',NULL,'new','2026-02-20 07:02:48','2026-02-20 07:02:48'),(11,3,'{\"name\": \"Samyak Chaudhary\", \"email\": \"samyakchy1@gmail.com\", \"phone\": \"9845569189\", \"message\": \"tet\", \"subject\": \"Complete School Management System\"}',NULL,'new','2026-02-23 01:08:11','2026-02-23 01:08:11');
/*!40000 ALTER TABLE `form_submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ne` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `fields` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` VALUES (1,'Job Pre-Registration','job-pre-registration','Pre-register for upcoming overseas jobs.','आगामी वैदेशिक रोजगारीका लागि पूर्व-दर्ता।',1,'[{\"name\": \"fullName\", \"type\": \"text\", \"label_en\": \"Full Name\", \"label_ne\": \"पुरा नाम\", \"required\": true}, {\"name\": \"phone\", \"type\": \"phone\", \"label_en\": \"Phone\", \"label_ne\": \"फोन\", \"required\": true}, {\"name\": \"country\", \"type\": \"select\", \"options\": [\"Saudi Arabia\", \"Qatar\", \"UAE\"], \"label_en\": \"Preferred Country\", \"label_ne\": \"मनपर्ने देश\"}]','2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'Complaints','complaints','Raise complaints and support requests.','गुनासो तथा सहयोग अनुरोध पेश गर्नुहोस्।',1,'[{\"name\": \"subject\", \"type\": \"text\", \"label_en\": \"Subject\", \"label_ne\": \"विषय\", \"required\": true}, {\"name\": \"message\", \"type\": \"text\", \"label_en\": \"Message\", \"label_ne\": \"सन्देश\", \"required\": true}]','2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'Contact Us','contact','Contact form for general inquiries','Contact form',1,'[{\"key\": \"name\", \"type\": \"text\", \"order\": 1, \"label_en\": \"Full Name\", \"label_ne\": \"Name\", \"required\": true}, {\"key\": \"email\", \"type\": \"email\", \"order\": 2, \"label_en\": \"Email\", \"label_ne\": \"Email\", \"required\": true}, {\"key\": \"phone\", \"type\": \"text\", \"order\": 3, \"label_en\": \"Phone\", \"label_ne\": \"Phone\", \"required\": false}, {\"key\": \"subject\", \"type\": \"text\", \"order\": 4, \"label_en\": \"Subject\", \"label_ne\": \"Subject\", \"required\": true}, {\"key\": \"message\", \"type\": \"textarea\", \"order\": 5, \"label_en\": \"Message\", \"label_ne\": \"Message\", \"required\": true}]','2026-02-20 12:46:49','2026-02-20 12:46:49');
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `caption_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `media_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_type` enum('image','video') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `order_index` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` VALUES (1,'Deployment Success - Qatar','कतार प्रस्थान सफलता','Candidates ready for deployment.','प्रस्थानका लागि तयार उम्मेदवार।','https://picsum.photos/seed/aldar-gallery-1/1000/700','image','deployment',1,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'Visa Approval Batch','भिसा स्वीकृति ब्याच','Multiple approvals processed.','बहु भिसा स्वीकृति प्रक्रिया सम्पन्न।','https://picsum.photos/seed/aldar-gallery-2/1000/700','image','visa',2,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'Office Candidate Support','कार्यालय उम्मेदवार सहयोग','In-person support for documentation.','कागजातका लागि प्रत्यक्ष सहयोग।','https://picsum.photos/seed/aldar-gallery-3/1000/700','image','office',3,1,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hero`
--

DROP TABLE IF EXISTS `hero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hero` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `headline_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `headline_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subheadline_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `subheadline_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `background_type` enum('image','video') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `background_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `cta_primary_label_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `cta_primary_label_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `cta_primary_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `cta_secondary_label_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `cta_secondary_label_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `cta_secondary_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `show_counters` tinyint(1) NOT NULL DEFAULT '1',
  `counters` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hero`
--

LOCK TABLES `hero` WRITE;
/*!40000 ALTER TABLE `hero` DISABLE KEYS */;
INSERT INTO `hero` VALUES (1,'Build your global career with ALDAR GROUP','ALDAR GROUP सँग तपाईंको विश्वव्यापी करियर निर्माण गर्नुहोस्','Premium recruitment support for jobs, documentation, visas, and deployment.','जागिर, कागजात, भिसा र प्रस्थानका लागि प्रिमियम भर्ती सहयोग।','image','https://picsum.photos/seed/aldar-hero/1600/900','Explore Jobs','जागिर हेर्नुहोस्','/jobs','Contact Team','सम्पर्क गर्नुहोस्','/contact',1,'[{\"key\": \"candidates_deployed\", \"value\": 1200, \"suffix\": \"+\", \"label_en\": \"Candidates Deployed\", \"label_ne\": \"नियुक्त उम्मेदवार\"}, {\"key\": \"hiring_countries\", \"value\": 12, \"suffix\": \"+\", \"label_en\": \"Hiring Countries\", \"label_ne\": \"रोजगारी देशहरू\"}, {\"key\": \"employer_partners\", \"value\": 180, \"suffix\": \"+\", \"label_en\": \"Employer Partners\", \"label_ne\": \"नियोक्ता साझेदार\"}]','2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `hero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_categories`
--

DROP TABLE IF EXISTS `job_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `order_index` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_categories`
--

LOCK TABLES `job_categories` WRITE;
/*!40000 ALTER TABLE `job_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ne` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_min` int NOT NULL DEFAULT '0',
  `salary_max` int NOT NULL DEFAULT '0',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
  `requirements_en` text COLLATE utf8mb4_unicode_ci,
  `requirements_ne` text COLLATE utf8mb4_unicode_ci,
  `deadline` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('open','closed','draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jobs_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'warehouse-assistant-saudi','Warehouse Assistant','वेयरहाउस सहायक','Urgent opening for warehouse operations in Saudi Arabia.','साउदी अरेबियामा वेयरहाउस अपरेसनका लागि तत्काल अवसर।','Logistics','Saudi Arabia',50000,85000,'NPR','Valid passport and basic English.','मान्य राहदानी र आधारभूत अंग्रेजी।',NULL,1,'open','2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'security-guard-qatar','Security Guard','सुरक्षा गार्ड','Security deployment for a reputed Qatar sponsor.','कतारको प्रतिष्ठित स्पोन्सरका लागि सुरक्षा नियुक्ति।','Security','Qatar',45000,70000,'NPR','Prior security experience preferred.','पूर्व सुरक्षा अनुभवलाई प्राथमिकता।',NULL,1,'open','2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'delivery-driver-uae','Delivery Driver','डेलिभरी चालक','Courier and logistics delivery role in UAE.','यूएईमा कूरियर तथा लोजिस्टिक्स डेलिभरी भूमिका।','Driving','UAE',42000,78000,'NPR','Driving license and route familiarity.','ड्राइभिङ लाइसेन्स र मार्ग जानकारी।',NULL,0,'open','2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `legal_documents`
--

DROP TABLE IF EXISTS `legal_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `legal_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ne` text COLLATE utf8mb4_unicode_ci,
  `document_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'license',
  `issue_authority_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `issue_authority_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `issue_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `display_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `legal_documents`
--

LOCK TABLES `legal_documents` WRITE;
/*!40000 ALTER TABLE `legal_documents` DISABLE KEYS */;
INSERT INTO `legal_documents` VALUES (1,'Certificate of Incorporation','निगमन प्रमाणपत्र',NULL,NULL,'','registration','Office of Company Registrar','कम्पनी रजिस्ट्रार कार्यालय','2025-08-10',NULL,'371666/082/083',1,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'Foreign Employment License','वैदेशिक रोजगार इजाजतपत्र',NULL,NULL,'','license','Department of Foreign Employment, Government of Nepal','वैदेशिक रोजगार विभाग, नेपाल सरकार',NULL,NULL,'1795/082/083',2,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'PAN Registration','स्थायी लेखा नम्बर दर्ता',NULL,NULL,'','registration','Department of Internal Revenue','आन्तरिक राजस्व विभाग',NULL,NULL,'622409832',3,1,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `legal_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint NOT NULL,
  `uploaded_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_uploaded_by_foreign` (`uploaded_by`),
  CONSTRAINT `media_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'sponsor-banner.jpg','https://picsum.photos/seed/aldar-media-1/1200/600','image/jpeg',345678,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'interview-notice.pdf','https://example.com/aldar/interview-notice.pdf','application/pdf',99876,2,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `order_index` int NOT NULL DEFAULT '0',
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `is_external` tinyint(1) NOT NULL DEFAULT '0',
  `target` enum('_self','_blank') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `location` enum('navbar','footer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'navbar',
  `parent_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Home','होम','/',1,1,0,'_self','navbar',NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'About Us','हाम्रो बारेमा','/about',2,1,0,'_self','navbar',NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'Categories','श्रेणीहरू','/categories',3,1,0,'_self','navbar',NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(4,'Jobs','जागिरहरू','/jobs',4,1,0,'_self','navbar',NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(5,'Resources','स्रोतहरू','#',5,1,0,'_self','navbar',NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(6,'Contact','सम्पर्क','/contact',6,1,0,'_self','navbar',NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(7,'Legal & Compliance','कानुनी र अनुपालन','/legal',1,1,0,'_self','footer',NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(8,'For Employers','नियोक्ताहरूका लागि','/employers',2,1,0,'_self','footer',NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(9,'Countries','देशहरू','/countries',1,1,0,'_self','navbar',5,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(10,'Recruitment Process','भर्ती प्रक्रिया','/recruitment-process',2,1,0,'_self','navbar',5,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(11,'For Employers','नियोक्ताहरूका लागि','/employers',3,1,0,'_self','navbar',5,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(12,'Notices','सूचनाहरू','/notices',4,1,0,'_self','navbar',5,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2024_01_01_000001_create_roles_table',1),(2,'2024_01_01_000002_create_users_table',1),(3,'2024_01_01_000003_create_brand_table',1),(4,'2024_01_01_000004_create_hero_table',1),(5,'2024_01_01_000005_create_menus_table',1),(6,'2024_01_01_000006_create_services_table',1),(7,'2024_01_01_000007_create_jobs_table',1),(8,'2024_01_01_000008_create_job_categories_table',1),(9,'2024_01_01_000009_create_applications_table',1),(10,'2024_01_01_000010_create_countries_table',1),(11,'2024_01_01_000011_create_sponsors_table',1),(12,'2024_01_01_000012_create_gallery_table',1),(13,'2024_01_01_000013_create_success_stories_table',1),(14,'2024_01_01_000014_create_testimonials_table',1),(15,'2024_01_01_000015_create_notices_table',1),(16,'2024_01_01_000016_create_forms_table',1),(17,'2024_01_01_000017_create_form_submissions_table',1),(18,'2024_01_01_000018_create_cms_pages_table',1),(19,'2024_01_01_000019_create_media_table',1),(20,'2024_01_01_000020_create_themes_table',1),(21,'2024_01_01_000021_create_translations_table',1),(22,'2024_01_01_000022_create_chatbot_data_table',1),(23,'2024_01_01_000023_create_tickets_table',1),(24,'2024_01_01_000024_create_organization_structure_table',1),(25,'2024_01_01_000025_create_recruitment_process_table',1),(26,'2024_01_01_000026_create_categories_table',1),(27,'2024_01_01_000027_create_legal_documents_table',1),(28,'2024_01_01_000028_create_employer_requirements_table',1),(29,'2026_02_20_102055_create_cache_table',2),(30,'2026_02_20_105408_create_sessions_table',3),(31,'2024_01_01_000029_create_page_sections_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notices`
--

DROP TABLE IF EXISTS `notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('interview','result','documentation','general') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ne` text COLLATE utf8mb4_unicode_ci,
  `attachment_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `pdf_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `is_popup` tinyint(1) NOT NULL DEFAULT '0',
  `schedule_date` timestamp NULL DEFAULT NULL,
  `target_pages` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notices`
--

LOCK TABLES `notices` WRITE;
/*!40000 ALTER TABLE `notices` DISABLE KEYS */;
INSERT INTO `notices` VALUES (1,'interview','Interview Notice - Security Guard Qatar','अन्तर्वार्ता सूचना - कतार सुरक्षा गार्ड','Interview starts Sunday 10:00 AM.','अन्तर्वार्ता आइतबार बिहान १० बजे सुरु हुन्छ।','','','','2026-02-20 09:27:28',1,0,NULL,NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'result','Result Notice - Warehouse Assistant','नतिजा सूचना - वेयरहाउस सहायक','Selected candidates list is published.','छनोट भएका उम्मेदवारको सूची प्रकाशित।','','','','2026-02-20 09:27:28',1,0,NULL,NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'documentation','Documentation Call','कागजात बुझाउने सूचना','Submit original documents within 3 days.','३ दिनभित्र सक्कल कागजात बुझाउनुहोस्।','','','','2026-02-20 09:27:28',1,0,NULL,NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(4,'interview','Urgent Interview Schedule','तत्काल अन्तर्वार्ता तालिका','Security interview on Friday at 10 AM.','सुरक्षा अन्तर्वार्ता शुक्रबार बिहान १० बजे।','','','','2026-02-20 09:27:28',1,1,'2026-02-20 03:42:28','[\"home\", \"jobs\"]','2026-02-20 03:42:28','2026-02-20 03:42:28'),(5,'general','Office Closure Notice','कार्यालय बन्द सूचना','Office closed this Saturday for maintenance.','यो शनिबार मर्मतका लागि कार्यालय बन्द रहनेछ।','','','','2026-02-20 09:27:28',1,1,'2026-02-20 03:42:28','[\"all\"]','2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `notices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization_structure`
--

DROP TABLE IF EXISTS `organization_structure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organization_structure` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `bio_en` text COLLATE utf8mb4_unicode_ci,
  `bio_ne` text COLLATE utf8mb4_unicode_ci,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `display_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization_structure`
--

LOCK TABLES `organization_structure` WRITE;
/*!40000 ALTER TABLE `organization_structure` DISABLE KEYS */;
INSERT INTO `organization_structure` VALUES (1,'Mr. Kapleshwar Shah','Chairman','अध्यक्ष','',NULL,NULL,'Board',1,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'Mr. Devendra Luitel','Managing Director','प्रबन्ध निर्देशक','',NULL,NULL,'Board',2,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'Mr. Bir Bahadur Tamang','Director','निर्देशक','',NULL,NULL,'Board',3,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(4,'Mr. Lok Bahadur Katuwal','Executive Director','कार्यकारी निर्देशक','',NULL,NULL,'Executive',4,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(5,'Anil Mandal','Int. Marketing Manager','अन्तर्राष्ट्रिय मार्केटिङ प्रबन्धक','',NULL,NULL,'Marketing',5,1,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `organization_structure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_sections`
--

DROP TABLE IF EXISTS `page_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ne` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_ne` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_en` longtext COLLATE utf8mb4_unicode_ci,
  `content_ne` longtext COLLATE utf8mb4_unicode_ci,
  `items` json DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_sections_page_slug_section_key_unique` (`page_slug`,`section_key`),
  KEY `page_sections_page_slug_index` (`page_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_sections`
--

LOCK TABLES `page_sections` WRITE;
/*!40000 ALTER TABLE `page_sections` DISABLE KEYS */;
INSERT INTO `page_sections` VALUES (1,'who-we-are','hero','text','Who We Are','हामी को हौं','A bridge between talent and opportunity','प्रतिभा र अवसरबीचको पुल',NULL,NULL,NULL,1,1,'2026-02-20 08:17:05','2026-02-20 08:45:27'),(2,'who-we-are','introduction','text','Company Introduction','कम्पनी परिचय',NULL,NULL,'At Aldar Group Pvt. Ltd., we take pride in being a bridge between talent and opportunity. Our dedication to excellence, professionalism, and client satisfaction has positioned us as a trusted partner in the recruitment industry. We are committed to delivering reliable workforce solutions that meet the unique need of every business while empowering individuals to achieve their career goals.\n\nAldar Group Pvt. Ltd. is the government approved recruitment agency registered in Ministry of Labor in Nepal that aims to provide the varieties of Manpower including Non-skilled Labour to semiskilled Trade persons to skilled & highly qualified professionals like engineers, chartered accountants, managers etc to Malaysia, Gulf countries as UAE, Saudi, Qatar, Oman, Bahrain.','अल्दार ग्रुप प्रा.लि. मा, हामी प्रतिभा र अवसरबीचको पुल बन्नमा गर्व गर्छौं। उत्कृष्टता, व्यावसायिकता र ग्राहक सन्तुष्टिप्रतिको हाम्रो समर्पणले हामीलाई भर्ती उद्योगमा विश्वसनीय साझेदारको रूपमा स्थापित गरेको छ।\n\nअल्दार ग्रुप प्रा.लि. नेपालको श्रम मन्त्रालयमा दर्ता भएको सरकार स्वीकृत भर्ती एजेन्सी हो जसले मलेसिया, खाडी मुलुकहरू जस्तै UAE, साउदी, कतार, ओमान, बहराइनमा अकुशल श्रमिकदेखि अर्ध-कुशल व्यापारी व्यक्तिहरूदेखि कुशल र उच्च योग्य पेशेवरहरूसम्म विभिन्न जनशक्ति उपलब्ध गराउने लक्ष्य राख्छ।',NULL,2,1,'2026-02-20 08:17:05','2026-02-20 08:45:27'),(3,'who-we-are','company_details','details','Company Details','कम्पनी विवरण',NULL,NULL,NULL,NULL,'[{\"value\": \"1795/082/083\", \"label_en\": \"Govt. License No.\", \"label_ne\": \"इजाजतपत्र नं.\"}, {\"value\": \"371666/082/083\", \"label_en\": \"Registration No.\", \"label_ne\": \"दर्ता नं.\"}, {\"value\": \"622409832\", \"label_en\": \"PAN No.\", \"label_ne\": \"प्यान नं.\"}, {\"value\": \"20 Million NPR\", \"label_en\": \"Capital\", \"label_ne\": \"पूँजी\"}, {\"value\": \"Prime Commercial Bank Ltd.\", \"label_en\": \"Official Bank\", \"label_ne\": \"बैंक\"}, {\"label_en\": \"Service Type\", \"label_ne\": \"सेवा प्रकार\", \"value_en\": \"Human Resource Recruitment\", \"value_ne\": \"मानव संसाधन भर्ती\"}]',3,1,'2026-02-20 08:17:05','2026-02-20 08:39:27'),(4,'who-we-are','objective','text','Our Objective','हाम्रो उद्देश्य',NULL,NULL,'Our mission is to meet the growing demand for Nepalese workforce abroad to ease growing unemployment within the country and export a variety of capable manpower — from semi-skilled to highly skilled professionals as per the demands of our esteemed clients and thus help the nation by contributing in the inflow of foreign currency.','हाम्रो मिशन विदेशमा नेपाली जनशक्तिको बढ्दो माग पूरा गर्ने र देशभित्रको बढ्दो बेरोजगारी कम गर्ने हो। हाम्रो सम्मानित ग्राहकहरूको मागअनुसार अर्ध-कुशलदेखि उच्च कुशल पेशेवरहरूसम्म विभिन्न सक्षम जनशक्ति निर्यात गर्ने र विदेशी मुद्राको प्रवाहमा योगदान पुर्‍याउने।',NULL,4,1,'2026-02-20 08:17:05','2026-02-20 08:17:05'),(5,'who-we-are','values','cards','Our Values','हाम्रा मूल्यहरू',NULL,NULL,NULL,NULL,'[{\"icon\": \"shield-check\", \"title_en\": \"Integrity\", \"title_ne\": \"इमानदारिता\", \"description_en\": \"Ensures transparency and fairness in every interaction.\", \"description_ne\": \"पारदर्शिता र निष्पक्षता सुनिश्चित गर्दछ।\"}, {\"icon\": \"briefcase\", \"title_en\": \"Professionalism\", \"title_ne\": \"व्यावसायिकता\", \"description_en\": \"Drives exceptional service delivery.\", \"description_ne\": \"उत्कृष्ट सेवा प्रदान गर्दछ।\"}, {\"icon\": \"lightbulb\", \"title_en\": \"Innovation\", \"title_ne\": \"नवप्रवर्तन\", \"description_en\": \"Adapts us to change and new challenges.\", \"description_ne\": \"परिवर्तनसँग अनुकूलन गर्दछ।\"}, {\"icon\": \"users\", \"title_en\": \"Collaboration\", \"title_ne\": \"सहकार्य\", \"description_en\": \"Fuels teamwork and partnerships.\", \"description_ne\": \"टिमवर्कलाई बढावा दिन्छ।\"}, {\"icon\": \"zap\", \"title_en\": \"Dedication\", \"title_ne\": \"समर्पण\", \"description_en\": \"Propels us for lasting impact.\", \"description_ne\": \"दिगो प्रभावका लागि प्रेरित गर्दछ।\"}]',5,1,'2026-02-20 08:17:05','2026-02-20 08:18:16'),(6,'who-we-are','vision','text','Our Vision','हाम्रो दृष्टि',NULL,NULL,'To be the leading recruitment partner, connecting top talent with dream jobs and driving business success through innovative solutions and exceptional service.','अग्रणी भर्ती साझेदार बन्नु, शीर्ष प्रतिभालाई सपनाको रोजगारीसँग जोड्नु र नवीन समाधान र असाधारण सेवाको माध्यमबाट व्यावसायिक सफलता प्राप्त गर्नु।',NULL,6,1,'2026-02-20 08:17:05','2026-02-20 08:17:05'),(7,'who-we-are','mission','text','Our Mission','हाम्रो मिशन',NULL,NULL,'To meet the growing demand for Nepalese workforce abroad to ease growing unemployment within the country and export capable manpower as per client demands, contributing to foreign currency inflow.','नेपाली कामदारको विदेशमा बढ्दो मागलाई पूरा गर्न र देशभित्रको बेरोजगारी कम गर्न विभिन्न सक्षम जनशक्ति निर्यात गर्ने।',NULL,7,1,'2026-02-20 08:17:05','2026-02-20 08:17:05'),(8,'why-choose-us','hero','text','Why Choose Us?','हामीलाई किन छान्ने?','Your trusted partner in the recruitment industry','भर्ती उद्योगमा विश्वसनीय साझेदार',NULL,NULL,NULL,1,1,'2026-02-20 08:17:05','2026-02-20 08:17:05'),(9,'why-choose-us','reasons','cards','Why Choose Us','हामीलाई किन छान्ने',NULL,NULL,NULL,NULL,'[{\"icon\": \"shield-check\", \"title_en\": \"Government Approved Agency\", \"title_ne\": \"सरकार स्वीकृत एजेन्सी\", \"description_en\": \"Registered with the Ministry of Labor, Nepal (License No. 1795/082/083). Fully compliant with all government regulations.\", \"description_ne\": \"नेपालको श्रम मन्त्रालयमा दर्ता भएको (इजाजतपत्र नं. 1795/082/083) विश्वसनीय एजेन्सी।\"}, {\"icon\": \"users\", \"title_en\": \"Experienced Management\", \"title_ne\": \"अनुभवी व्यवस्थापन\", \"description_en\": \"Our experienced, responsible and dedicated management team can be trusted upon to complete any designated assignment on time.\", \"description_ne\": \"हाम्रो अनुभवी, जिम्मेवार र समर्पित व्यवस्थापन टोली कुनै पनि निर्दिष्ट कार्य समयमा पूरा गर्न विश्वसनीय छ।\"}, {\"icon\": \"globe\", \"title_en\": \"Vast Network\", \"title_ne\": \"विशाल नेटवर्क\", \"description_en\": \"Our ultra designed human resource accessibility network is spread all over Nepal enabling us to select quality manpower from a vast pool of human resources.\", \"description_ne\": \"हाम्रो मानव संसाधन पहुँचयोग्यता नेटवर्क सम्पूर्ण नेपालमा फैलिएको छ जसले विशाल मानव संसाधनबाट गुणस्तरीय जनशक्ति छनौट गर्न सक्षम बनाउँछ।\"}, {\"icon\": \"currency\", \"title_en\": \"Cost-Effective Operations\", \"title_ne\": \"लागत प्रभावकारी\", \"description_en\": \"We operate in an efficient and cost effective manner. We legally provide employment opportunities and arrange for workers\' insurance during the employment period.\", \"description_ne\": \"हामी कुशल र लागत प्रभावकारी तरिकाले सञ्चालन गर्छौं। हामी कानूनी रूपमा रोजगारीका अवसरहरू प्रदान गर्छौं र रोजगारी अवधिमा कामदारहरूको बिमा व्यवस्था गर्छौं।\"}, {\"icon\": \"clock\", \"title_en\": \"On-Time Quality Service\", \"title_ne\": \"समयमा गुणस्तरीय सेवा\", \"description_en\": \"We possess a prompt and calibrated design of working style and offer on-time quality service. Through stringent selection criteria, we select the workforce and provide them intensive orientation.\", \"description_ne\": \"हामीसँग कामको शैलीको शीघ्र र क्यालिब्रेटेड डिजाइन छ र समयमा गुणस्तरीय सेवा प्रदान गर्छौं। कडा छनौट मापदण्डमार्फत हामी जनशक्ति छनौट गर्छौं।\"}, {\"icon\": \"clipboard\", \"title_en\": \"Client-Focused Specifications\", \"title_ne\": \"ग्राहक-केन्द्रित विशिष्टता\", \"description_en\": \"We place great emphasis on the specifications given by our clients to fulfill their exact human resource requirements with precision and care.\", \"description_ne\": \"हामी ग्राहकहरूले दिएका विशिष्टताहरूमा ठूलो जोड दिन्छौं र तिनीहरूको सटीक मानव संसाधन आवश्यकता पूरा गर्न प्रतिबद्ध छौं।\"}]',2,1,'2026-02-20 08:17:05','2026-02-20 08:18:16'),(10,'why-choose-us','ethical_recruitment','text','Commitment to Ethical Recruitment','नैतिक भर्तीप्रतिको प्रतिबद्धता',NULL,NULL,'At Aldar Group Pvt. Ltd., ethical recruitment is not just a buzzword; it\'s the cornerstone of our identity. We firmly believe that the recruitment industry should not merely be about filling positions; it should be a catalyst for meaningful change. Ethical recruitment, to us, means adhering to the highest standards of integrity, fairness, and transparency in every interaction we have.','अल्दार ग्रुप प्रा.लि. मा, नैतिक भर्ती केवल शब्द मात्र होइन; यो हाम्रो पहिचानको आधारशिला हो। हामी दृढ रूपमा विश्वास गर्छौं कि भर्ती उद्योग केवल पदहरू भर्ने बारेमा हुनुपर्दैन; यो सार्थक परिवर्तनको उत्प्रेरक हुनुपर्छ। हाम्रा लागि नैतिक भर्तीको अर्थ हाम्रो हरेक अन्तरक्रियामा इमानदारिता, निष्पक्षता र पारदर्शिताको उच्चतम मापदण्डमा प्रतिबद्ध रहनु हो।',NULL,3,1,'2026-02-20 08:17:05','2026-02-20 08:17:05'),(11,'why-choose-us','grievance_policy','text','Commitment to a Positive Workplace','सकारात्मक कार्यस्थलप्रतिको प्रतिबद्धता',NULL,NULL,'We stand firm in our dedication to nurturing a workplace that is not only positive but also fair. Our Grievance Policy serves as a beacon of our commitment to creating an environment where every voice matters. We empower our employees to freely voice their concerns, knowing that their feedback will be treated with the utmost respect and confidentiality.','हामी एउटा कार्यस्थललाई पोषण गर्न समर्पित छौं जुन सकारात्मक मात्र होइन निष्पक्ष पनि हो। हाम्रो गुनासो नीति हाम्रो विश्वासको प्रमाण हो। यसले हरेक आवाज महत्त्वपूर्ण हुने वातावरण सिर्जना गर्ने प्रतिबद्धताको रूपमा काम गर्छ।',NULL,4,1,'2026-02-20 08:17:05','2026-02-20 08:17:05'),(12,'meet-our-team','hero','text','Meet Our Team','हाम्रो टोलीलाई भेट्नुहोस्','Experienced and dedicated leadership driving our mission forward','अनुभवी र समर्पित नेतृत्व',NULL,NULL,NULL,1,1,'2026-02-20 08:17:05','2026-02-20 08:17:05'),(13,'meet-our-team','team_messages','team_quotes','Our Leadership','हाम्रो नेतृत्व',NULL,NULL,NULL,NULL,'[{\"quote_en\": \"It is with great pleasure and a profound sense of responsibility that I address you today as the Chairman of Aldar Group Pvt. Ltd. Our journey as an organization dedicated to ethical recruitment has been both inspiring and transformative. We have witnessed countless lives transformed, careers advanced, and organizations elevated. At Aldar Group Pvt. Ltd., ethical recruitment is not just a buzzword; it\'s the cornerstone of our identity.\", \"quote_ne\": \"अल्दार ग्रुप प्रा.लि. को अध्यक्षको रूपमा तपाईंहरूलाई सम्बोधन गर्न पाउँदा मलाई अत्यन्त हर्ष र गहन जिम्मेवारीको अनुभूति भएको छ। नैतिक भर्तीप्रति समर्पित संस्थाको रूपमा हाम्रो यात्रा प्रेरणादायी र परिवर्तनकारी दुवै रहेको छ।\", \"designation\": \"Chairman\"}, {\"quote_en\": \"It is my privilege to introduce Aldar Group Pvt. Ltd., a trusted provider of comprehensive manpower solutions. Our commitment lies in bridging the gap between businesses and exceptional talent, ensuring seamless workforce integration and mutual success. With a focus on professionalism, quality, and reliability, we tailor our services to meet the diverse needs of our clients across industries.\", \"quote_ne\": \"अल्दार ग्रुप प्रा.लि. को परिचय दिन पाउँदा मलाई गर्व लागेको छ। व्यापक जनशक्ति समाधानको विश्वसनीय प्रदायकको रूपमा, व्यवसाय र असाधारण प्रतिभाबीचको खाडल पुर्ने हाम्रो प्रतिबद्धता रहेको छ।\", \"designation\": \"Managing Director\"}, {\"quote_en\": \"At Aldar Group Pvt. Ltd., we take pride in being a bridge between talent and opportunity. Our dedication to excellence, professionalism, and client satisfaction has positioned us as a trusted partner in the recruitment industry. We are committed to delivering reliable workforce solutions that meet the unique need of every business while empowering individuals to achieve their career goals.\", \"quote_ne\": \"अल्दार ग्रुप प्रा.लि. मा, हामी प्रतिभा र अवसरबीचको पुल बन्नमा गर्व गर्छौं। उत्कृष्टता, व्यावसायिकता र ग्राहक सन्तुष्टिप्रतिको हाम्रो समर्पणले हामीलाई भर्ती उद्योगमा विश्वसनीय साझेदारको रूपमा स्थापित गरेको छ।\", \"designation\": \"Director\"}, {\"quote_en\": \"Warm greetings from Aldar Group Pvt. Ltd. As a trusted and government-licensed manpower agency, we are committed to providing reliable and skilled human resources to meet the demands of various industries across the globe. We would be honored to have the opportunity to support your workforce needs and assure you of our highest level of professionalism, transparency, and efficiency in the recruitment process.\", \"quote_ne\": \"अल्दार ग्रुप प्रा.लि. बाट हार्दिक शुभकामना। विश्वसनीय र सरकार अनुमतिप्राप्त जनशक्ति एजेन्सीको रूपमा, हामी विश्वभरका विभिन्न उद्योगहरूको माग पूरा गर्न विश्वसनीय र कुशल मानव संसाधन प्रदान गर्न प्रतिबद्ध छौं।\", \"designation\": \"Executive Director\"}]',2,1,'2026-02-20 08:17:05','2026-02-20 08:39:27'),(14,'meet-our-team','org_structure','details','Organization Structure','संगठनात्मक संरचना',NULL,NULL,NULL,NULL,'[{\"name\": \"Mr. Kapleshwar Shah\", \"role\": \"Chairman\"}, {\"name\": \"Mr. Devendra Luitel\", \"role\": \"Managing Director\"}, {\"name\": \"Mr. Bir Bahadur Tamang\", \"role\": \"Director\"}, {\"name\": \"Mr. Lok Bahadur Katuwal\", \"role\": \"Executive Director\"}, {\"name\": \"Mr. Anil Mandal\", \"role\": \"Int. Marketing Manager\"}]',3,1,'2026-02-20 08:17:05','2026-02-20 08:39:27'),(15,'why-work-with-us','hero','text','Why Work With Us?','हामीसँग किन काम गर्ने?','Your reliable recruitment partner for quality manpower solutions','तपाईंको विश्वसनीय भर्ती साझेदार',NULL,NULL,NULL,1,1,'2026-02-20 08:17:05','2026-02-20 08:17:05'),(16,'why-work-with-us','benefits','cards','Benefits of Partnering With Us','हामीसँग साझेदारी गर्ने फाइदाहरू',NULL,NULL,NULL,NULL,'[{\"icon\": \"shield-check\", \"title_en\": \"Experienced & Trustworthy Management\", \"title_ne\": \"अनुभवी र विश्वसनीय व्यवस्थापन\", \"description_en\": \"Our experienced, responsible and dedicated management team can be trusted upon to complete any designated assignment on time.\", \"description_ne\": \"हाम्रो अनुभवी, जिम्मेवार र समर्पित व्यवस्थापन टोली कुनै पनि निर्दिष्ट कार्य समयमा पूरा गर्न विश्वसनीय छ।\"}, {\"icon\": \"users\", \"title_en\": \"Client-Focused Specifications\", \"title_ne\": \"ग्राहक-केन्द्रित विशिष्टता\", \"description_en\": \"We place great emphasis on the specifications given by our clients. Our ultra designed human resource accessibility network is spread all over Nepal enabling us to select quality manpower from a vast pool of human resources to fulfill the exact requirements.\", \"description_ne\": \"हामी ग्राहकहरूले दिएका विशिष्टताहरूमा ठूलो जोड दिन्छौं। हाम्रो अल्ट्रा डिजाइन गरिएको मानव संसाधन पहुँचयोग्यता नेटवर्क सम्पूर्ण नेपालमा फैलिएको छ।\"}, {\"icon\": \"currency\", \"title_en\": \"Cost-Effective Operations\", \"title_ne\": \"लागत प्रभावकारी सञ्चालन\", \"description_en\": \"We operate in an efficient and cost effective manner. We legally provide employment opportunities to various categories of workers and arrange for the workers\' insurance during the employment period.\", \"description_ne\": \"हामी कुशल र लागत प्रभावकारी तरिकाले सञ्चालन गर्छौं। हामी कानूनी रूपमा रोजगारीका अवसरहरू प्रदान गर्छौं र रोजगारी अवधिमा कामदारहरूको बिमा व्यवस्था गर्छौं।\"}, {\"icon\": \"clock\", \"title_en\": \"On-Time Quality Service\", \"title_ne\": \"समयमा गुणस्तरीय सेवा\", \"description_en\": \"We possess a prompt and calibrated design of working style and offer on-time quality service. Through stringent selection criteria, we select the workforce and provide them intensive orientation as per the requirement of our esteemed clients.\", \"description_ne\": \"हामीसँग कामको शैलीको शीघ्र र क्यालिब्रेटेड डिजाइन छ र समयमा गुणस्तरीय सेवा प्रदान गर्छौं। कडा छनौट मापदण्डमार्फत हामी जनशक्ति छनौट गर्छौं र तिनीहरूलाई गहन अभिमुखीकरण प्रदान गर्छौं।\"}]',2,1,'2026-02-20 08:17:05','2026-02-20 08:18:16'),(17,'why-work-with-us','process_steps','steps','How We Work','हामी कसरी काम गर्छौं',NULL,NULL,NULL,NULL,'[{\"num\": 1, \"title_en\": \"Pre-approval from Labor Office\", \"title_ne\": \"श्रम कार्यालयबाट पूर्व-स्वीकृति\", \"description_en\": \"Quota application → Quota approval → Levy payment\", \"description_ne\": \"कोटा आवेदन → कोटा स्वीकृति → लेभी भुक्तानी\"}, {\"num\": 2, \"title_en\": \"Job Offer Letter\", \"title_ne\": \"रोजगार प्रस्ताव पत्र\", \"description_en\": \"Demand letter → Power of attorney → Employment contract\", \"description_ne\": \"माग पत्र → मुख्तियारनामा → रोजगार सम्झौता\"}, {\"num\": 3, \"title_en\": \"Quota Approval\", \"title_ne\": \"कोटा स्वीकृति\", \"description_en\": \"Job advertisement → Application collection → Pre-screening → Final interview & selection\", \"description_ne\": \"जागिर/माग विज्ञापन → आवेदन सङ्कलन → पूर्व छनौट → अन्तिम अन्तर्वार्ता र छनौट\"}, {\"num\": 4, \"title_en\": \"Bio Medical\", \"title_ne\": \"स्वास्थ्य परीक्षण\", \"description_en\": \"Signing employment contract → Passport collection → Medical examination → Certificate issuance\", \"description_ne\": \"रोजगार सम्झौतामा हस्ताक्षर → पासपोर्ट सङ्कलन → स्वास्थ्य परीक्षण → प्रमाणपत्र जारी\"}, {\"num\": 5, \"title_en\": \"Visa Process\", \"title_ne\": \"भिसा प्रक्रिया\", \"description_en\": \"VDR application → Submit with quota approval → Levy payment receipt → Online insurance\", \"description_ne\": \"VDR आवेदन फारम → कोटा स्वीकृतिसहित पेश → लेभी भुक्तानी रसिद → अनलाइन बिमा\"}, {\"num\": 6, \"title_en\": \"Embassy Entry\", \"title_ne\": \"दूतावास प्रवेश\", \"description_en\": \"Visa application → Submit passport & VDR → Entry visa issuance\", \"description_ne\": \"भिसा आवेदन → पासपोर्ट र VDR पेश → प्रवेश भिसा जारी\"}, {\"num\": 7, \"title_en\": \"Final Approval & Deployment\", \"title_ne\": \"अन्तिम स्वीकृति र प्रस्थान\", \"description_en\": \"Ticketing → Documentation → Pre-departure orientation → Confirmation of arrival & Feedback\", \"description_ne\": \"टिकटिङ → कागजात → पूर्व-प्रस्थान अभिमुखीकरण → आगमन पुष्टि र प्रतिक्रिया\"}]',3,1,'2026-02-20 08:17:05','2026-02-20 08:18:16'),(18,'why-work-with-us','partnership_cta','text','A Newer Horizon Together','सँगै नयाँ क्षितिज',NULL,NULL,'Always keeping you in top priority and contributing to each other\'s business orientation, we should be the perfect partner to work with. Of course, with our name together we see a newer horizon and visualize us doing businesses for many years to come.','तपाईंलाई सधैं सर्वोच्च प्राथमिकतामा राख्दै र एक अर्काको व्यापार अभिमुखीकरणमा योगदान गर्दै, हामी सँगै काम गर्ने उत्तम साझेदार हुनुपर्छ। हाम्रो नामसँगै हामी नयाँ क्षितिज देख्छौं र आउँदा वर्षहरूमा व्यापार गर्ने कल्पना गर्छौं।',NULL,4,1,'2026-02-20 08:17:05','2026-02-20 08:17:05'),(19,'our-network','hero','text','Our Network','हाम्रो नेटवर्क','Our global presence across multiple countries and regions','विश्वभरी फैलिएको हाम्रो उपस्थिति',NULL,NULL,NULL,1,1,'2026-02-20 08:17:05','2026-02-20 08:17:05'),(20,'our-network','network_overview','text','Our Global Presence','हाम्रो विश्वव्यापी उपस्थिति',NULL,NULL,'With one of the largest networks both for sourcing of human resources, clients and business affiliates across the globe, Aldar Group Pvt. Ltd.\'s presence in the international human resource scene is significantly important. Always keeping you in top priority and contributing to each other\'s business orientation, we should be the perfect partner to work with.','मानव संसाधन, ग्राहक र विश्वभरीका व्यापारिक सहयोगीहरूको सबैभन्दा ठूलो नेटवर्कमध्ये एकको साथ, अन्तर्राष्ट्रिय मानव संसाधन क्षेत्रमा अल्दार ग्रुप प्रा.लि. को उपस्थिति महत्त्वपूर्ण छ। तपाईंलाई सधैं सर्वोच्च प्राथमिकतामा राख्दै र एक अर्काको व्यापार अभिमुखीकरणमा योगदान गर्दै, हामी सँगै काम गर्ने उत्तम साझेदार हुनुपर्छ।',NULL,2,1,'2026-02-20 08:17:05','2026-02-20 08:17:05'),(21,'our-network','projecting_countries','cards','Projecting to Work In','भविष्यमा कार्यरत हुने देशहरू','Countries where we plan to expand our services','यी देशहरूमा हाम्रो सेवा विस्तार गर्ने योजना छ',NULL,NULL,'[{\"flag\": \"🇯🇵\", \"name_en\": \"Japan\", \"name_ne\": \"जापान\"}, {\"flag\": \"🇰🇷\", \"name_en\": \"Korea\", \"name_ne\": \"कोरिया\"}, {\"flag\": \"🇲🇻\", \"name_en\": \"Maldives\", \"name_ne\": \"माल्दिभ्स\"}, {\"flag\": \"🇨🇾\", \"name_en\": \"Cyprus\", \"name_ne\": \"साइप्रस\"}, {\"flag\": \"🇧🇳\", \"name_en\": \"Brunei\", \"name_ne\": \"ब्रुनाई\"}]',3,1,'2026-02-20 08:17:05','2026-02-20 08:39:27'),(22,'our-network','stats','cards','Network Statistics','नेटवर्क तथ्याङ्क',NULL,NULL,NULL,NULL,'[{\"value\": \"8+\", \"label_en\": \"Active Countries\", \"label_ne\": \"कार्यरत देशहरू\"}, {\"value\": \"5+\", \"label_en\": \"Expanding To\", \"label_ne\": \"विस्तार योजना\"}, {\"value\": \"20+\", \"label_en\": \"Job Categories\", \"label_ne\": \"रोजगारी श्रेणीहरू\"}, {\"value\": \"NPR 20M\", \"label_en\": \"Company Capital\", \"label_ne\": \"कम्पनी पूँजी\"}]',4,1,'2026-02-20 08:17:05','2026-02-20 08:18:16'),(23,'recruitment-process','hero','text','Recruitment Process Flow','भर्ती प्रक्रिया प्रवाह','All the cost of recruitment along with agency service charge shall be borne by the Employer. Hence we request not to use any agent/middleman.','भर्तीको सम्पूर्ण खर्च एजेन्सी सेवा शुल्कसहित रोजगारदाताले वहन गर्नुपर्छ। त्यसैले कुनै पनि दलाल वा बिचौलिया प्रयोग नगर्न अनुरोध छ।',NULL,NULL,NULL,1,1,'2026-02-20 08:39:27','2026-02-20 08:39:27');
/*!40000 ALTER TABLE `page_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recruitment_process`
--

DROP TABLE IF EXISTS `recruitment_process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recruitment_process` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `step_number` int NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ne` text COLLATE utf8mb4_unicode_ci,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `display_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recruitment_process`
--

LOCK TABLES `recruitment_process` WRITE;
/*!40000 ALTER TABLE `recruitment_process` DISABLE KEYS */;
INSERT INTO `recruitment_process` VALUES (9,1,'Marketing','मार्केटिङ','Identifying potential employers and job opportunities in destination countries.','गन्तव्य देशहरूमा सम्भावित रोजगारदाताहरू र रोजगारीका अवसरहरू पहिचान गर्ने।','megaphone',1,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(10,2,'Demand Letter Review & Confirmation','माग पत्र समीक्षा र पुष्टि','Reviewing and confirming the demand letter from the employer.','रोजगारदाताबाट माग पत्र समीक्षा र पुष्टि गर्ने।','document-text',2,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(11,3,'Demand Letter Online Approved by Embassy of Nepal','नेपाली दूतावासबाट अनलाइन माग पत्र स्वीकृत','Getting the demand letter approved online by the Embassy of Nepal.','नेपाली दूतावासबाट माग पत्र अनलाइन स्वीकृत गर्ने।','globe-alt',3,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(12,4,'Pre-approval (DoFE)','पूर्व-स्वीकृति (DoFE)','Obtaining pre-approval from the Department of Foreign Employment.','वैदेशिक रोजगार विभागबाट पूर्व-स्वीकृति प्राप्त गर्ने।','clipboard-check',4,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(13,5,'Demand Letter Advertisement','माग पत्र विज्ञापन','Publishing the demand letter advertisement in national newspapers.','राष्ट्रिय पत्रिकाहरूमा माग पत्र विज्ञापन प्रकाशित गर्ने।','newspaper',5,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(14,6,'Pre-recruitment Orientation','पूर्व-भर्ती अभिमुखीकरण','Conducting orientation sessions for potential candidates.','सम्भावित उम्मेदवारहरूको लागि अभिमुखीकरण सत्रहरू सञ्चालन गर्ने।','academic-cap',6,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(15,7,'Application Form Registration','आवेदन फारम दर्ता','Collecting and registering application forms from candidates.','उम्मेदवारहरूबाट आवेदन फारमहरू सङ्कलन र दर्ता गर्ने।','document',7,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(16,8,'Interview & Selection','अन्तर्वार्ता र छनौट','Conducting interviews and selecting qualified candidates.','अन्तर्वार्ता सञ्चालन र योग्य उम्मेदवारहरू छनौट गर्ने।','users',8,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(17,9,'Employment Contract Briefing & Handover','रोजगार सम्झौता ब्रिफिङ र हस्तान्तरण','Briefing candidates on employment contracts and completing handover.','रोजगार सम्झौतामा उम्मेदवारहरूलाई जानकारी दिने र हस्तान्तरण पूरा गर्ने।','briefcase',9,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(18,10,'Medical Screening','मेडिकल जाँच','Conducting medical examinations for selected candidates.','छनौट भएका उम्मेदवारहरूको मेडिकल जाँच गर्ने।','heart',10,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(19,11,'E-Visa Process','ई-भिसा प्रक्रिया','Processing electronic visa applications for selected candidates.','छनौट भएका उम्मेदवारहरूको इलेक्ट्रोनिक भिसा आवेदन प्रशोधन गर्ने।','identification',11,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(20,12,'Orientation (as per government policy)','अभिमुखीकरण (सरकारी नीति अनुसार)','Mandatory pre-departure orientation as per government regulations.','सरकारी नियमानुसार अनिवार्य प्रस्थान पूर्व अभिमुखीकरण।','academic-cap',12,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(21,13,'Insurance','बीमा','Arranging mandatory insurance coverage for workers.','कामदारहरूको लागि अनिवार्य बीमा कभरेज व्यवस्था गर्ने।','shield-check',13,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(22,14,'Final Approval (DoFE)','अन्तिम स्वीकृति (DoFE)','Obtaining final approval from the Department of Foreign Employment.','वैदेशिक रोजगार विभागबाट अन्तिम स्वीकृति प्राप्त गर्ने।','check-circle',14,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(23,15,'Air Ticket','हवाई टिकट','Arranging air tickets for deployment.','प्रस्थानको लागि हवाई टिकट व्यवस्था गर्ने।','plane',15,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(24,16,'Airport Assistance','विमानस्थल सहायता','Providing assistance at the airport during departure.','प्रस्थानको समयमा विमानस्थलमा सहायता प्रदान गर्ने।','map-pin',16,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(25,17,'Departure','प्रस्थान','Workers depart for the destination country.','कामदारहरू गन्तव्य देशमा प्रस्थान गर्ने।','plane',17,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(26,18,'Airport Reception','विमानस्थल स्वागत','Receiving workers at the destination airport.','गन्तव्य विमानस्थलमा कामदारहरूलाई स्वागत गर्ने।','hand-raised',18,1,'2026-02-20 12:51:58','2026-02-20 12:51:58'),(27,19,'Feedback & Management','प्रतिक्रिया र व्यवस्थापन','Ongoing feedback collection and worker welfare management.','निरन्तर प्रतिक्रिया सङ्कलन र कामदार कल्याण व्यवस्थापन।','chat-bubble',19,1,'2026-02-20 12:51:58','2026-02-20 12:51:58');
/*!40000 ALTER TABLE `recruitment_process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` enum('super_admin','admin','staff','recruiter') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super_admin','Full system access','2026-02-20 03:42:27','2026-02-20 03:42:27'),(2,'admin','Administrative control','2026-02-20 03:42:27','2026-02-20 03:42:27'),(3,'staff','Operations staff','2026-02-20 03:42:27','2026-02-20 03:42:27'),(4,'recruiter','Recruitment management','2026-02-20 03:42:27','2026-02-20 03:42:27');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ne` text COLLATE utf8mb4_unicode_ci,
  `order_index` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'solar:global-bold','Complete Recruitment Solutions','पूर्ण भर्ती समाधान','Aldar Group Pvt. Ltd. is a complete recruitment agency, providing complete recruitment solutions, sourcing and supplying quality staff throughout the world.','अल्दार ग्रुप प्रा. लि. एक पूर्ण भर्ती एजेन्सी हो।',1,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'solar:users-group-rounded-bold','Experienced Management Team','अनुभवी व्यवस्थापन टोली','Our experienced, responsible and dedicated management team can be trusted upon to complete any designated assignment on time.','हाम्रो अनुभवी व्यवस्थापन टोली।',2,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'solar:file-text-bold','Client-Focused Selection','ग्राहक-केन्द्रित छनोट','We place great emphasis on the specifications given by our clients.','हामी हाम्रा ग्राहकहरूले दिएको विशिष्टतामा ठूलो जोड दिन्छौं।',3,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(4,'solar:passport-bold','Legal & Cost Effective','कानुनी र लागत प्रभावकारी','We operate in an efficient and cost effective manner.','हामी दक्ष र लागत प्रभावकारी तरिकाले सञ्चालन गर्दछौं।',4,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(5,'solar:chat-round-call-bold','Quality Orientation & Training','गुणस्तरीय अभिमुखीकरण र तालिम','Through stringent selection criteria, we select the workforce and provide them intensive orientation.','कडा छनोट मापदण्ड मार्फत हामी जनशक्ति छान्छौं।',5,1,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('LaGcVxlatWDIibkgHQ9uFCHCRWZ5MDCCEnOXa1pT',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR3I4akU5eDZrWU5GT1doS1Q3NGN5YUhMWWV5eVF5M0ZGd2F3d2JQTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6NDAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1771589445),('NRoFWgNZtAeXsSrG0fEZyqaLrXr9hCo7BpMFIEcu',NULL,'127.0.0.1','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUWJ2TDVWcXhFZG5sME93bTJaRnI2cHNXSHZUcW96akw5em9MdE9QUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6NDAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1771592582);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sponsors`
--

DROP TABLE IF EXISTS `sponsors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sponsors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `description_ne` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sponsors`
--

LOCK TABLES `sponsors` WRITE;
/*!40000 ALTER TABLE `sponsors` DISABLE KEYS */;
INSERT INTO `sponsors` VALUES (1,'Al Noor Facilities','','Saudi Arabia','Long-term partner employer for facilities workforce.','फेसिलिटी जनशक्तिका लागि दीर्घकालीन साझेदार नियोक्ता।',1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'Doha Safe Security LLC','','Qatar','Recruiting trained security workers.','तालिमप्राप्त सुरक्षा जनशक्ति भर्ती गर्दै।',1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'Emirates Fast Logistics','','UAE','Hiring drivers and warehouse helpers.','ड्राइभर र वेयरहाउस सहायक भर्ती।',1,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `sponsors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `success_stories`
--

DROP TABLE IF EXISTS `success_stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `success_stories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `candidate_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `country_deployed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `job_title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `job_title_ne` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `story_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `story_ne` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deployed_date` date DEFAULT NULL,
  `order_index` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `success_stories`
--

LOCK TABLES `success_stories` WRITE;
/*!40000 ALTER TABLE `success_stories` DISABLE KEYS */;
/*!40000 ALTER TABLE `success_stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `candidate_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `country_deployed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `review_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `review_ne` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint NOT NULL DEFAULT '5',
  `order_index` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Suman Thapa','https://picsum.photos/seed/aldar-testimonial-1/240/240','Qatar','ALDAR guided me from documents to deployment with complete transparency.','ALDAR ले कागजातदेखि प्रस्थानसम्म पूर्ण पारदर्शितासहित मार्गदर्शन गर्‍यो।',5,1,1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'Rina Gurung','https://picsum.photos/seed/aldar-testimonial-2/240/240','Saudi Arabia','The interview and visa process was smooth and professionally managed.','अन्तर्वार्ता र भिसा प्रक्रिया सहज र पेशेवर।',5,2,1,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `themes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode` enum('light','dark','corporate_gold') COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `favicon_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes`
--

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` VALUES (1,'Light','light','#0B2C6B','#E2B93B','','',1,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'Dark','dark','#102042','#F1C95A','','',0,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'Corporate Gold','corporate_gold','#0B2C6B','#D4A62A','','',0,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `status` enum('open','in_progress','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `assigned_to` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tickets_assigned_to_foreign` (`assigned_to`),
  CONSTRAINT `tickets_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,'Amit Rai','amit.rai@example.com','Application status update needed','Please share my latest application status.','medium','open',3,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'Puja Magar','puja.magar@example.com','Document upload issue','Unable to upload passport PDF from mobile browser.','high','in_progress',2,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'test','samyakchy1@gmail.com','test','test','low','open',NULL,'2026-02-20 06:29:08','2026-02-20 06:29:08'),(5,'Website Visitor','','Form Submission','','medium','open',NULL,'2026-02-20 07:02:19','2026-02-20 07:02:19'),(6,'Samyak Chaudhary','samyakchy1@gmail.com','tetr','dsdfsdf','medium','open',NULL,'2026-02-20 07:02:48','2026-02-20 07:02:48'),(7,'Samyak Chaudhary','samyakchy1@gmail.com','Complete School Management System','tet','medium','open',NULL,'2026-02-23 01:08:11','2026-02-23 01:08:11');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `namespace` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en` text COLLATE utf8mb4_unicode_ci,
  `ne` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_namespace_key_unique` (`namespace`,`key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (1,'common','tagline','Creating opportunities for professional growth','व्यावसायिक विकासका अवसरहरू सिर्जना गर्दै','2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'home','hero_title','Overseas Recruitment Portal','वैदेशिक रोजगार पोर्टल','2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'chatbot','greeting','Welcome to ALDAR GROUP. How can we help you today?','ALDAR GROUP मा स्वागत छ। आज हामी कसरी सहयोग गर्न सक्छौं?','2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ALDAR Super Admin','admin@aldargroup.com','+977-9800000001','$2y$12$nDTU8KAbqVVaW02DMw7hBem81EtDIUcuGEX7QhFIhje7n.2YBdZqC',1,1,NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(2,'ALDAR Recruiter','recruiter@aldargroup.com','+977-9800000002','$2y$12$nDTU8KAbqVVaW02DMw7hBem81EtDIUcuGEX7QhFIhje7n.2YBdZqC',4,1,NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28'),(3,'ALDAR Staff','staff@aldargroup.com','+977-9800000003','$2y$12$nDTU8KAbqVVaW02DMw7hBem81EtDIUcuGEX7QhFIhje7n.2YBdZqC',3,1,NULL,'2026-02-20 03:42:28','2026-02-20 03:42:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-23 19:28:41
