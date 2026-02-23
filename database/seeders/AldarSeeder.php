<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Brand;
use App\Models\Hero;
use App\Models\Menu;
use App\Models\SiteService;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Country;
use App\Models\Job;
use App\Models\Sponsor;
use App\Models\Notice;
use App\Models\Form;
use App\Models\Submission;
use App\Models\CmsPage;
use App\Models\Media;
use App\Models\Theme;
use App\Models\Translation;
use App\Models\ChatbotData;
use App\Models\Application;
use App\Models\Ticket;
use App\Models\OrganizationStructure;
use App\Models\RecruitmentProcess;
use App\Models\Category;
use App\Models\LegalDocument;
use App\Models\EmployerRequirement;

class AldarSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $tables = ['roles','users','brand','hero','menus','services','jobs','job_categories','applications','countries','sponsors','gallery','success_stories','testimonials','notices','forms','form_submissions','cms_pages','media','themes','translations','chatbot_data','tickets','organization_structure','recruitment_process','categories','legal_documents','employer_requirements'];
        foreach ($tables as $t) { DB::table($t)->truncate(); }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $superAdmin = Role::create(['name' => 'super_admin', 'description' => 'Full system access']);
        $admin      = Role::create(['name' => 'admin', 'description' => 'Administrative control']);
        $staff      = Role::create(['name' => 'staff', 'description' => 'Operations staff']);
        $recruiter  = Role::create(['name' => 'recruiter', 'description' => 'Recruitment management']);

        $pw = Hash::make('Admin@12345');

        $adminUser = User::create(['full_name'=>'ALDAR Super Admin','email'=>'admin@aldargroup.com','phone'=>'+977-9800000001','password_hash'=>$pw,'role_id'=>$superAdmin->id,'is_active'=>true]);
        $recruiterUser = User::create(['full_name'=>'ALDAR Recruiter','email'=>'recruiter@aldargroup.com','phone'=>'+977-9800000002','password_hash'=>$pw,'role_id'=>$recruiter->id,'is_active'=>true]);
        $staffUser = User::create(['full_name'=>'ALDAR Staff','email'=>'staff@aldargroup.com','phone'=>'+977-9800000003','password_hash'=>$pw,'role_id'=>$staff->id,'is_active'=>true]);

        Brand::create(['company_name'=>'ALDAR GROUP PVT. LTD.','tagline'=>'Creating opportunities for professional growth','industry'=>'Overseas Recruitment & Corporate Services','logo_url'=>'/uploads/images/logo/aldar-logo.png','favicon_url'=>'/uploads/images/logo/aldar-logo.png','office_address'=>'Sukedhara-4, Kathmandu, Nepal','phone_numbers'=>['+977-9841450009','+977-9803851465','+977-1-5925942'],'emails'=>['sahkapil13@gmail.com','aldaroffice.025@gmail.com'],'social_links'=>[['platform'=>'facebook','url'=>'https://facebook.com/aldargroup'],['platform'=>'linkedin','url'=>'https://linkedin.com/company/aldargroup']],'whatsapp_number'=>'9779841450009','whatsapp_message'=>'Hello ALDAR GROUP, I want to apply for overseas jobs.','whatsapp_enabled'=>true,'chatbot_greeting'=>'Welcome to ALDAR GROUP. How can we help you today?','chairman_name'=>'Kapleshwar Shah','chairman_photo_url'=>'https://picsum.photos/seed/aldar-chairman/300/320','chairman_message_en'=>'Dear Esteemed Clients, Valued Candidates, and Respected Partners, It is with great pleasure and a profound sense of responsibility that I address you today as the Chairman of Aldar Group Pvt. Ltd. Our journey as an organization dedicated to ethical recruitment has been both inspiring and transformative.','chairman_message_ne'=>'आदरणीय ग्राहकहरू, बहुमूल्य उम्मेदवारहरू र सम्मानित साझेदारहरू, अल्दार ग्रुप प्रा. लि.को अध्यक्षको रूपमा म आज तपाईंहरूलाई सम्बोधन गर्दा अत्यन्त खुसी र गहिरो जिम्मेवारीको भावना महसुस गर्दछु।','signature_url'=>'https://picsum.photos/seed/aldar-sign/180/80','registration_info_en'=>'Government approved recruitment agency registered in Ministry of Labor, Nepal.','registration_info_ne'=>'नेपालको श्रम मन्त्रालयमा दर्ता भएको सरकार स्वीकृत भर्ती एजेन्सी।','footer_summary_en'=>'Trusted overseas recruitment partner connecting Nepalese talent to global opportunities.','footer_summary_ne'=>'नेपाली प्रतिभालाई विश्वव्यापी अवसरसँग जोड्ने विश्वसनीय वैदेशिक रोजगार साझेदार।','license_number'=>'1795/082/083','registration_number'=>'371666/082/083','pan_number'=>'622409832','capital_amount'=>'NPR 20,000,000','bank_name'=>'Prime Commercial Bank Ltd.','google_map_embed'=>'','about_us_en'=>'At Aldar Group Pvt. Ltd., we take pride in being a bridge between talent and opportunity. Aldar Group Pvt. Ltd. is the government approved recruitment agency registered in Ministry of Labor in Nepal.','about_us_ne'=>'अल्दार ग्रुप प्रा. लि. मा हामी प्रतिभा र अवसरबीचको पुल भएकोमा गर्व गर्दछौं।','vision_en'=>'To be the leading recruitment partner, connecting top talent with dream jobs and driving business success through innovative solutions and exceptional service.','vision_ne'=>'अग्रणी भर्ती साझेदार बन्ने, शीर्ष प्रतिभालाई सपनाका रोजगारीसँग जोड्ने।','mission_en'=>'Our mission is to meet the growing demand for Nepalese workforce abroad to ease growing unemployment within the country.','mission_ne'=>'हाम्रो लक्ष्य विदेशमा नेपाली जनशक्तिको बढ्दो मागलाई पूरा गर्ने।','objectives_en'=>['Meet the growing demand for Nepalese workforce abroad','Ease growing unemployment through overseas placements','Export capable manpower from semi-skilled to highly skilled professionals','Uphold integrity, transparency, and fairness','Deliver professional and innovative recruitment solutions','Foster collaboration and teamwork','Provide complete recruitment solutions tailored to each company\'s needs'],'objectives_ne'=>['विदेशमा नेपाली जनशक्तिको बढ्दो मागलाई पूरा गर्ने','वैदेशिक रोजगारी मार्फत देशभित्रको बेरोजगारी कम गर्ने','अर्ध-कुशलदेखि उच्च कुशल पेशेवरहरूसम्म सक्षम जनशक्ति निर्यात गर्ने','प्रत्येक कार्यमा इमानदारिता, पारदर्शिता र निष्पक्षता कायम राख्ने','व्यावसायिक र नवीन भर्ती समाधानहरू प्रदान गर्ने','दीर्घकालीन प्रभावका लागि सहकार्य र टोलीकार्यलाई बढावा दिने','प्रत्येक कम्पनीको आवश्यकता अनुसार पूर्ण भर्ती समाधानहरू प्रदान गर्ने'],'primary_color'=>'#038441','secondary_color'=>'#026B34','accent_color'=>'#D4AF37','light_bg_color'=>'#F0F7F2','dark_footer_color'=>'#012A15','registered_with_en'=>'1) Office of Company Register, 2) Department of Foreign Employment, 3) Department of Internal Revenue','registered_with_ne'=>'१) कम्पनी रजिस्ट्रार कार्यालय, २) वैदेशिक रोजगार विभाग, ३) आन्तरिक राजस्व विभाग','for_employers_intro_en'=>'It is my privilege to introduce Aldar Group Pvt. Ltd., a trusted provider of comprehensive manpower solutions.','for_employers_intro_ne'=>'अल्दार ग्रुप प्रा. लि. को परिचय दिन पाउँदा मलाई गर्व लाग्छ।']);

        Hero::create(['headline_en'=>'Build your global career with ALDAR GROUP','headline_ne'=>'ALDAR GROUP सँग तपाईंको विश्वव्यापी करियर निर्माण गर्नुहोस्','subheadline_en'=>'Premium recruitment support for jobs, documentation, visas, and deployment.','subheadline_ne'=>'जागिर, कागजात, भिसा र प्रस्थानका लागि प्रिमियम भर्ती सहयोग।','background_type'=>'image','background_url'=>'https://picsum.photos/seed/aldar-hero/1600/900','cta_primary_label_en'=>'Explore Jobs','cta_primary_label_ne'=>'जागिर हेर्नुहोस्','cta_primary_link'=>'/jobs','cta_secondary_label_en'=>'Contact Team','cta_secondary_label_ne'=>'सम्पर्क गर्नुहोस्','cta_secondary_link'=>'/contact','show_counters'=>true,'counters'=>[['key'=>'candidates_deployed','label_en'=>'Candidates Deployed','label_ne'=>'नियुक्त उम्मेदवार','value'=>1200,'suffix'=>'+'],['key'=>'hiring_countries','label_en'=>'Hiring Countries','label_ne'=>'रोजगारी देशहरू','value'=>12,'suffix'=>'+'],['key'=>'employer_partners','label_en'=>'Employer Partners','label_ne'=>'नियोक्ता साझेदार','value'=>180,'suffix'=>'+']]]);

        // Menus
        Menu::create(['label_en'=>'Home','label_ne'=>'होम','url'=>'/','order_index'=>1,'is_enabled'=>true,'location'=>'navbar']);
        Menu::create(['label_en'=>'About Us','label_ne'=>'हाम्रो बारेमा','url'=>'/about','order_index'=>2,'is_enabled'=>true,'location'=>'navbar']);
        Menu::create(['label_en'=>'Categories','label_ne'=>'श्रेणीहरू','url'=>'/categories','order_index'=>3,'is_enabled'=>true,'location'=>'navbar']);
        Menu::create(['label_en'=>'Jobs','label_ne'=>'जागिरहरू','url'=>'/jobs','order_index'=>4,'is_enabled'=>true,'location'=>'navbar']);
        $res = Menu::create(['label_en'=>'Resources','label_ne'=>'स्रोतहरू','url'=>'#','order_index'=>5,'is_enabled'=>true,'location'=>'navbar']);
        Menu::create(['label_en'=>'Contact','label_ne'=>'सम्पर्क','url'=>'/contact','order_index'=>6,'is_enabled'=>true,'location'=>'navbar']);
        Menu::create(['label_en'=>'Legal & Compliance','label_ne'=>'कानुनी र अनुपालन','url'=>'/legal','order_index'=>1,'is_enabled'=>true,'location'=>'footer']);
        Menu::create(['label_en'=>'For Employers','label_ne'=>'नियोक्ताहरूका लागि','url'=>'/employers','order_index'=>2,'is_enabled'=>true,'location'=>'footer']);
        Menu::create(['label_en'=>'Countries','label_ne'=>'देशहरू','url'=>'/countries','order_index'=>1,'is_enabled'=>true,'location'=>'navbar','parent_id'=>$res->id]);
        Menu::create(['label_en'=>'Recruitment Process','label_ne'=>'भर्ती प्रक्रिया','url'=>'/recruitment-process','order_index'=>2,'is_enabled'=>true,'location'=>'navbar','parent_id'=>$res->id]);
        Menu::create(['label_en'=>'For Employers','label_ne'=>'नियोक्ताहरूका लागि','url'=>'/employers','order_index'=>3,'is_enabled'=>true,'location'=>'navbar','parent_id'=>$res->id]);
        Menu::create(['label_en'=>'Notices','label_ne'=>'सूचनाहरू','url'=>'/notices','order_index'=>4,'is_enabled'=>true,'location'=>'navbar','parent_id'=>$res->id]);

        // Services
        SiteService::create(['icon'=>'solar:global-bold','title_en'=>'Complete Recruitment Solutions','title_ne'=>'पूर्ण भर्ती समाधान','description_en'=>'Aldar Group Pvt. Ltd. is a complete recruitment agency, providing complete recruitment solutions, sourcing and supplying quality staff throughout the world.','description_ne'=>'अल्दार ग्रुप प्रा. लि. एक पूर्ण भर्ती एजेन्सी हो।','order_index'=>1,'is_active'=>true]);
        SiteService::create(['icon'=>'solar:users-group-rounded-bold','title_en'=>'Experienced Management Team','title_ne'=>'अनुभवी व्यवस्थापन टोली','description_en'=>'Our experienced, responsible and dedicated management team can be trusted upon to complete any designated assignment on time.','description_ne'=>'हाम्रो अनुभवी व्यवस्थापन टोली।','order_index'=>2,'is_active'=>true]);
        SiteService::create(['icon'=>'solar:file-text-bold','title_en'=>'Client-Focused Selection','title_ne'=>'ग्राहक-केन्द्रित छनोट','description_en'=>'We place great emphasis on the specifications given by our clients.','description_ne'=>'हामी हाम्रा ग्राहकहरूले दिएको विशिष्टतामा ठूलो जोड दिन्छौं।','order_index'=>3,'is_active'=>true]);
        SiteService::create(['icon'=>'solar:passport-bold','title_en'=>'Legal & Cost Effective','title_ne'=>'कानुनी र लागत प्रभावकारी','description_en'=>'We operate in an efficient and cost effective manner.','description_ne'=>'हामी दक्ष र लागत प्रभावकारी तरिकाले सञ्चालन गर्दछौं।','order_index'=>4,'is_active'=>true]);
        SiteService::create(['icon'=>'solar:chat-round-call-bold','title_en'=>'Quality Orientation & Training','title_ne'=>'गुणस्तरीय अभिमुखीकरण र तालिम','description_en'=>'Through stringent selection criteria, we select the workforce and provide them intensive orientation.','description_ne'=>'कडा छनोट मापदण्ड मार्फत हामी जनशक्ति छान्छौं।','order_index'=>5,'is_active'=>true]);

        // Gallery
        Gallery::create(['title_en'=>'Deployment Success - Qatar','title_ne'=>'कतार प्रस्थान सफलता','caption_en'=>'Candidates ready for deployment.','caption_ne'=>'प्रस्थानका लागि तयार उम्मेदवार।','media_url'=>'https://picsum.photos/seed/aldar-gallery-1/1000/700','media_type'=>'image','category'=>'deployment','order_index'=>1,'is_active'=>true]);
        Gallery::create(['title_en'=>'Visa Approval Batch','title_ne'=>'भिसा स्वीकृति ब्याच','caption_en'=>'Multiple approvals processed.','caption_ne'=>'बहु भिसा स्वीकृति प्रक्रिया सम्पन्न।','media_url'=>'https://picsum.photos/seed/aldar-gallery-2/1000/700','media_type'=>'image','category'=>'visa','order_index'=>2,'is_active'=>true]);
        Gallery::create(['title_en'=>'Office Candidate Support','title_ne'=>'कार्यालय उम्मेदवार सहयोग','caption_en'=>'In-person support for documentation.','caption_ne'=>'कागजातका लागि प्रत्यक्ष सहयोग।','media_url'=>'https://picsum.photos/seed/aldar-gallery-3/1000/700','media_type'=>'image','category'=>'office','order_index'=>3,'is_active'=>true]);

        // Testimonials
        Testimonial::create(['candidate_name'=>'Suman Thapa','photo_url'=>'https://picsum.photos/seed/aldar-testimonial-1/240/240','country_deployed'=>'Qatar','review_en'=>'ALDAR guided me from documents to deployment with complete transparency.','review_ne'=>'ALDAR ले कागजातदेखि प्रस्थानसम्म पूर्ण पारदर्शितासहित मार्गदर्शन गर्‍यो।','rating'=>5,'order_index'=>1,'is_active'=>true]);
        Testimonial::create(['candidate_name'=>'Rina Gurung','photo_url'=>'https://picsum.photos/seed/aldar-testimonial-2/240/240','country_deployed'=>'Saudi Arabia','review_en'=>'The interview and visa process was smooth and professionally managed.','review_ne'=>'अन्तर्वार्ता र भिसा प्रक्रिया सहज र पेशेवर।','rating'=>5,'order_index'=>2,'is_active'=>true]);

        // Countries
        $sa = Country::create(['slug'=>'saudi-arabia','name_en'=>'Saudi Arabia','name_ne'=>'साउदी अरेबिया','visa_info_en'=>'Employment visa processing available.','visa_info_ne'=>'रोजगार भिसा प्रक्रिया उपलब्ध छ।','demand_sectors_en'=>['Construction','Logistics','Hospitality'],'demand_sectors_ne'=>['निर्माण','लोजिस्टिक्स','आतिथ्य'],'salary_range_en'=>'NPR 45,000 - 120,000','salary_range_ne'=>'रु ४५,००० - १,२०,०००','requirements_en'=>'Passport, medical report, relevant experience.','requirements_ne'=>'राहदानी, मेडिकल रिपोर्ट, सम्बन्धित अनुभव।','is_active'=>true]);
        $qa = Country::create(['slug'=>'qatar','name_en'=>'Qatar','name_ne'=>'कतार','visa_info_en'=>'Fast visa guidance through partner sponsors.','visa_info_ne'=>'साझेदार स्पोन्सरमार्फत छिटो भिसा मार्गदर्शन।','demand_sectors_en'=>['Security','Facility Management'],'demand_sectors_ne'=>['सुरक्षा','फेसिलिटी व्यवस्थापन'],'salary_range_en'=>'NPR 40,000 - 95,000','salary_range_ne'=>'रु ४०,००० - ९५,०००','requirements_en'=>'Passport, police clearance, interview pass.','requirements_ne'=>'राहदानी, प्रहरी क्लियरेन्स, अन्तर्वार्ता पास।','is_active'=>true]);
        $ue = Country::create(['slug'=>'uae','name_en'=>'UAE','name_ne'=>'यूएई','visa_info_en'=>'Employer-linked visa processing support.','visa_info_ne'=>'नियोक्ता-सम्बद्ध भिसा प्रक्रिया सहयोग।','demand_sectors_en'=>['Retail','Driving','Cleaning'],'demand_sectors_ne'=>['रिटेल','ड्राइभिङ','क्लिनिङ'],'salary_range_en'=>'NPR 38,000 - 88,000','salary_range_ne'=>'रु ३८,००० - ८८,०००','requirements_en'=>'Passport, age 21+, basic communication.','requirements_ne'=>'राहदानी, उमेर २१+।','is_active'=>true]);

        // Jobs
        $j1 = Job::create(['slug'=>'warehouse-assistant-saudi','title_en'=>'Warehouse Assistant','title_ne'=>'वेयरहाउस सहायक','description_en'=>'Urgent opening for warehouse operations in Saudi Arabia.','description_ne'=>'साउदी अरेबियामा वेयरहाउस अपरेसनका लागि तत्काल अवसर।','category'=>'Logistics','country'=>'Saudi Arabia','salary_min'=>50000,'salary_max'=>85000,'currency'=>'NPR','requirements_en'=>'Valid passport and basic English.','requirements_ne'=>'मान्य राहदानी र आधारभूत अंग्रेजी।','is_featured'=>true,'status'=>'open']);
        $j2 = Job::create(['slug'=>'security-guard-qatar','title_en'=>'Security Guard','title_ne'=>'सुरक्षा गार्ड','description_en'=>'Security deployment for a reputed Qatar sponsor.','description_ne'=>'कतारको प्रतिष्ठित स्पोन्सरका लागि सुरक्षा नियुक्ति।','category'=>'Security','country'=>'Qatar','salary_min'=>45000,'salary_max'=>70000,'currency'=>'NPR','requirements_en'=>'Prior security experience preferred.','requirements_ne'=>'पूर्व सुरक्षा अनुभवलाई प्राथमिकता।','is_featured'=>true,'status'=>'open']);
        $j3 = Job::create(['slug'=>'delivery-driver-uae','title_en'=>'Delivery Driver','title_ne'=>'डेलिभरी चालक','description_en'=>'Courier and logistics delivery role in UAE.','description_ne'=>'यूएईमा कूरियर तथा लोजिस्टिक्स डेलिभरी भूमिका।','category'=>'Driving','country'=>'UAE','salary_min'=>42000,'salary_max'=>78000,'currency'=>'NPR','requirements_en'=>'Driving license and route familiarity.','requirements_ne'=>'ड्राइभिङ लाइसेन्स र मार्ग जानकारी।','is_featured'=>false,'status'=>'open']);

        // Sponsors
        Sponsor::create(['name'=>'Al Noor Facilities','country'=>'Saudi Arabia','description_en'=>'Long-term partner employer for facilities workforce.','description_ne'=>'फेसिलिटी जनशक्तिका लागि दीर्घकालीन साझेदार नियोक्ता।','is_active'=>true]);
        Sponsor::create(['name'=>'Doha Safe Security LLC','country'=>'Qatar','description_en'=>'Recruiting trained security workers.','description_ne'=>'तालिमप्राप्त सुरक्षा जनशक्ति भर्ती गर्दै।','is_active'=>true]);
        Sponsor::create(['name'=>'Emirates Fast Logistics','country'=>'UAE','description_en'=>'Hiring drivers and warehouse helpers.','description_ne'=>'ड्राइभर र वेयरहाउस सहायक भर्ती।','is_active'=>true]);

        // Notices
        Notice::create(['type'=>'interview','title_en'=>'Interview Notice - Security Guard Qatar','title_ne'=>'अन्तर्वार्ता सूचना - कतार सुरक्षा गार्ड','description_en'=>'Interview starts Sunday 10:00 AM.','description_ne'=>'अन्तर्वार्ता आइतबार बिहान १० बजे सुरु हुन्छ।','is_published'=>true]);
        Notice::create(['type'=>'result','title_en'=>'Result Notice - Warehouse Assistant','title_ne'=>'नतिजा सूचना - वेयरहाउस सहायक','description_en'=>'Selected candidates list is published.','description_ne'=>'छनोट भएका उम्मेदवारको सूची प्रकाशित।','is_published'=>true]);
        Notice::create(['type'=>'documentation','title_en'=>'Documentation Call','title_ne'=>'कागजात बुझाउने सूचना','description_en'=>'Submit original documents within 3 days.','description_ne'=>'३ दिनभित्र सक्कल कागजात बुझाउनुहोस्।','is_published'=>true]);
        Notice::create(['type'=>'interview','title_en'=>'Urgent Interview Schedule','title_ne'=>'तत्काल अन्तर्वार्ता तालिका','description_en'=>'Security interview on Friday at 10 AM.','description_ne'=>'सुरक्षा अन्तर्वार्ता शुक्रबार बिहान १० बजे।','is_published'=>true,'is_popup'=>true,'schedule_date'=>now(),'target_pages'=>['home','jobs']]);
        Notice::create(['type'=>'general','title_en'=>'Office Closure Notice','title_ne'=>'कार्यालय बन्द सूचना','description_en'=>'Office closed this Saturday for maintenance.','description_ne'=>'यो शनिबार मर्मतका लागि कार्यालय बन्द रहनेछ।','is_published'=>true,'is_popup'=>true,'schedule_date'=>now(),'target_pages'=>['all']]);

        // Forms
        $f1 = Form::create(['name'=>'Job Pre-Registration','slug'=>'job-pre-registration','description_en'=>'Pre-register for upcoming overseas jobs.','description_ne'=>'आगामी वैदेशिक रोजगारीका लागि पूर्व-दर्ता।','is_active'=>true,'fields'=>[['name'=>'fullName','type'=>'text','label_en'=>'Full Name','label_ne'=>'पुरा नाम','required'=>true],['name'=>'phone','type'=>'phone','label_en'=>'Phone','label_ne'=>'फोन','required'=>true],['name'=>'country','type'=>'select','label_en'=>'Preferred Country','label_ne'=>'मनपर्ने देश','options'=>['Saudi Arabia','Qatar','UAE']]]]);
        $f2 = Form::create(['name'=>'Complaints','slug'=>'complaints','description_en'=>'Raise complaints and support requests.','description_ne'=>'गुनासो तथा सहयोग अनुरोध पेश गर्नुहोस्।','is_active'=>true,'fields'=>[['name'=>'subject','type'=>'text','label_en'=>'Subject','label_ne'=>'विषय','required'=>true],['name'=>'message','type'=>'text','label_en'=>'Message','label_ne'=>'सन्देश','required'=>true]]]);

        // Submissions
        Submission::create(['form_id'=>$f1->id,'data'=>['fullName'=>'Rabin Karki','phone'=>'+977-9811111111','country'=>'Qatar'],'files'=>[],'status'=>'new']);
        Submission::create(['form_id'=>$f2->id,'data'=>['subject'=>'Delayed update','message'=>'Please update interview result status.'],'files'=>[],'status'=>'in_review']);

        // CMS Pages
        CmsPage::create(['slug'=>'about-us','title_en'=>'About Us','title_ne'=>'हाम्रो बारेमा','content_en'=>'ALDAR GROUP PVT. LTD. company profile content managed from CMS.','content_ne'=>'ALDAR GROUP PVT. LTD. को कम्पनी प्रोफाइल सामग्री CMS बाट व्यवस्थापन गरिन्छ।','seo_title_en'=>'About ALDAR GROUP','seo_title_ne'=>'ALDAR GROUP को बारेमा','seo_description_en'=>'Official profile of ALDAR GROUP PVT. LTD.','seo_description_ne'=>'ALDAR GROUP PVT. LTD. को आधिकारिक प्रोफाइल।']);
        CmsPage::create(['slug'=>'services','title_en'=>'Services','title_ne'=>'सेवाहरू','content_en'=>'Official ALDAR services content managed from CMS.','content_ne'=>'ALDAR सेवाहरूको आधिकारिक सामग्री।','seo_title_en'=>'ALDAR Services','seo_title_ne'=>'ALDAR सेवाहरू','seo_description_en'=>'Recruitment and corporate services by ALDAR GROUP.','seo_description_ne'=>'ALDAR GROUP द्वारा भर्ती तथा कर्पोरेट सेवाहरू।']);

        // Media
        Media::create(['file_name'=>'sponsor-banner.jpg','url'=>'https://picsum.photos/seed/aldar-media-1/1200/600','mime_type'=>'image/jpeg','size'=>345678,'uploaded_by'=>$adminUser->id]);
        Media::create(['file_name'=>'interview-notice.pdf','url'=>'https://example.com/aldar/interview-notice.pdf','mime_type'=>'application/pdf','size'=>99876,'uploaded_by'=>$recruiterUser->id]);

        // Themes
        Theme::create(['name'=>'Light','mode'=>'light','primary_color'=>'#0B2C6B','secondary_color'=>'#E2B93B','is_default'=>true]);
        Theme::create(['name'=>'Dark','mode'=>'dark','primary_color'=>'#102042','secondary_color'=>'#F1C95A','is_default'=>false]);
        Theme::create(['name'=>'Corporate Gold','mode'=>'corporate_gold','primary_color'=>'#0B2C6B','secondary_color'=>'#D4A62A','is_default'=>false]);

        // Translations
        Translation::create(['namespace'=>'common','key'=>'tagline','en'=>'Creating opportunities for professional growth','ne'=>'व्यावसायिक विकासका अवसरहरू सिर्जना गर्दै']);
        Translation::create(['namespace'=>'home','key'=>'hero_title','en'=>'Overseas Recruitment Portal','ne'=>'वैदेशिक रोजगार पोर्टल']);
        Translation::create(['namespace'=>'chatbot','key'=>'greeting','en'=>'Welcome to ALDAR GROUP. How can we help you today?','ne'=>'ALDAR GROUP मा स्वागत छ। आज हामी कसरी सहयोग गर्न सक्छौं?']);

        // Chatbot Data
        ChatbotData::create(['category'=>'jobs','question_en'=>'How can I apply for jobs?','question_ne'=>'म जागिरमा कसरी आवेदन दिन सक्छु?','answer_en'=>'Open the Jobs page and submit the online form.','answer_ne'=>'जागिर पृष्ठ खोलेर अनलाइन फाराम भर्नुहोस्।','is_active'=>true]);
        ChatbotData::create(['category'=>'visa_faqs','question_en'=>'What documents are required for visa?','question_ne'=>'भिसाका लागि के कागजात चाहिन्छ?','answer_en'=>'Passport, medical report, police clearance and contract documents.','answer_ne'=>'राहदानी, मेडिकल रिपोर्ट, प्रहरी क्लियरेन्स र सम्झौता कागजात।','is_active'=>true]);
        ChatbotData::create(['category'=>'office','question_en'=>'Where is your office?','question_ne'=>'तपाईंको कार्यालय कहाँ छ?','answer_en'=>'Sukedhara-4, Kathmandu, Nepal','answer_ne'=>'सुकेधारा-४, काठमाडौं, नेपाल','is_active'=>true]);

        // Applications
        Application::create(['user_id'=>$recruiterUser->id,'job_id'=>$j1->id,'full_name'=>'Rabin Karki','email'=>'rabin.karki@example.com','phone'=>'+977-9811111111','cv_url'=>'https://example.com/demo/rabin-cv.pdf','passport_url'=>'https://example.com/aldar/rabin-passport.pdf','notes'=>'Interested in immediate deployment.','status'=>'screening']);
        Application::create(['user_id'=>$staffUser->id,'job_id'=>$j2->id,'full_name'=>'Sita Sharma','email'=>'sita.sharma@example.com','phone'=>'+977-9822222222','cv_url'=>'https://example.com/aldar/sita-cv.pdf','passport_url'=>'https://example.com/aldar/sita-passport.pdf','notes'=>'Ready for interview scheduling.','status'=>'interview']);

        // Tickets
        Ticket::create(['full_name'=>'Amit Rai','email'=>'amit.rai@example.com','subject'=>'Application status update needed','description'=>'Please share my latest application status.','priority'=>'medium','status'=>'open','assigned_to'=>$staffUser->id]);
        Ticket::create(['full_name'=>'Puja Magar','email'=>'puja.magar@example.com','subject'=>'Document upload issue','description'=>'Unable to upload passport PDF from mobile browser.','priority'=>'high','status'=>'in_progress','assigned_to'=>$recruiterUser->id]);

        // Organization Structure
        foreach ([
            ['name'=>'Mr. Kapleshwar Shah','designation_en'=>'Chairman','designation_ne'=>'अध्यक्ष','department'=>'Board','display_order'=>1],
            ['name'=>'Mr. Devendra Luitel','designation_en'=>'Managing Director','designation_ne'=>'प्रबन्ध निर्देशक','department'=>'Board','display_order'=>2],
            ['name'=>'Mr. Bir Bahadur Tamang','designation_en'=>'Director','designation_ne'=>'निर्देशक','department'=>'Board','display_order'=>3],
            ['name'=>'Mr. Lok Bahadur Katuwal','designation_en'=>'Executive Director','designation_ne'=>'कार्यकारी निर्देशक','department'=>'Executive','display_order'=>4],
            ['name'=>'Anil Mandal','designation_en'=>'Int. Marketing Manager','designation_ne'=>'अन्तर्राष्ट्रिय मार्केटिङ प्रबन्धक','department'=>'Marketing','display_order'=>5],
        ] as $org) {
            OrganizationStructure::create(array_merge($org, ['is_active'=>true]));
        }

        // Recruitment Process
        $steps = [
            ['step_number'=>1,'title_en'=>'Job Offer Letter','title_ne'=>'जागिर प्रस्ताव पत्र','icon'=>'document-text','display_order'=>1],
            ['step_number'=>2,'title_en'=>'Pre-approval from Labor Office','title_ne'=>'श्रम कार्यालयबाट पूर्व-स्वीकृति','icon'=>'clipboard-check','display_order'=>2],
            ['step_number'=>3,'title_en'=>'Quota Approval (KDN/KSM)','title_ne'=>'कोटा स्वीकृति (KDN/KSM)','icon'=>'users','display_order'=>3],
            ['step_number'=>4,'title_en'=>'Bio Medical (BSM)','title_ne'=>'बायो मेडिकल (BSM)','icon'=>'identification','display_order'=>4],
            ['step_number'=>5,'title_en'=>'Visa with Reference (VDR)','title_ne'=>'सन्दर्भसहित भिसा (VDR)','icon'=>'document','display_order'=>5],
            ['step_number'=>6,'title_en'=>'Attestation at Nepal Embassy','title_ne'=>'नेपाली दूतावासमा प्रमाणीकरण','icon'=>'globe-alt','display_order'=>6],
            ['step_number'=>7,'title_en'=>'Entry at Embassy','title_ne'=>'दूतावासमा प्रवेश','icon'=>'building','display_order'=>7],
            ['step_number'=>8,'title_en'=>'Final Approval & Deployment','title_ne'=>'अन्तिम स्वीकृति र प्रस्थान','icon'=>'plane','display_order'=>8],
        ];
        foreach ($steps as $s) { RecruitmentProcess::create(array_merge($s, ['is_active'=>true])); }

        // Categories
        $cats = [
            ['name_en'=>'Factory Workers & General Labor','name_ne'=>'कारखाना कामदार र सामान्य श्रमिक','slug'=>'factory-workers','icon'=>'cog','sector_type'=>'blue-collar','positions'=>[['title_en'=>'Factory Worker','title_ne'=>'कारखाना कामदार'],['title_en'=>'General Worker','title_ne'=>'सामान्य कामदार']],'display_order'=>1],
            ['name_en'=>'Cleaning & Helper Services','name_ne'=>'सफाइ र सहायक सेवा','slug'=>'cleaning-helper','icon'=>'sparkles','sector_type'=>'service','positions'=>[['title_en'=>'Cleaner','title_ne'=>'सफाइकर्मी'],['title_en'=>'Helper','title_ne'=>'सहायक']],'display_order'=>2],
            ['name_en'=>'Management & Sales','name_ne'=>'व्यवस्थापन र बिक्री','slug'=>'management-sales','icon'=>'briefcase','sector_type'=>'professional','positions'=>[['title_en'=>'Manager','title_ne'=>'प्रबन्धक'],['title_en'=>'Supervisor','title_ne'=>'सुपरभाइजर']],'display_order'=>3],
            ['name_en'=>'Construction','name_ne'=>'निर्माण','slug'=>'construction','icon'=>'hard-hat','sector_type'=>'blue-collar','positions'=>[['title_en'=>'Civil Engineer','title_ne'=>'सिभिल इन्जिनियर'],['title_en'=>'Mason','title_ne'=>'डकर्मी'],['title_en'=>'Carpenter','title_ne'=>'सिकर्मी']],'display_order'=>4],
            ['name_en'=>'Security','name_ne'=>'सुरक्षा','slug'=>'security','icon'=>'shield-check','sector_type'=>'service','positions'=>[['title_en'=>'Security Guard','title_ne'=>'सुरक्षा गार्ड'],['title_en'=>'Security Supervisor','title_ne'=>'सुरक्षा सुपरभाइजर']],'display_order'=>5],
            ['name_en'=>'Hotel / Resort / Restaurant','name_ne'=>'होटल / रिसोर्ट / रेस्टुरेन्ट','slug'=>'hotel-resort','icon'=>'building-storefront','sector_type'=>'service','positions'=>[['title_en'=>'Hotel Manager','title_ne'=>'होटल प्रबन्धक'],['title_en'=>'Chef / Cook','title_ne'=>'शेफ / कुक']],'display_order'=>6],
        ];
        foreach ($cats as $c) { Category::create(array_merge($c, ['is_active'=>true])); }

        // Legal Documents
        LegalDocument::create(['title_en'=>'Certificate of Incorporation','title_ne'=>'निगमन प्रमाणपत्र','document_type'=>'registration','issue_authority_en'=>'Office of Company Registrar','issue_authority_ne'=>'कम्पनी रजिस्ट्रार कार्यालय','reference_number'=>'371666/082/083','issue_date'=>'2025-08-10','display_order'=>1,'is_active'=>true]);
        LegalDocument::create(['title_en'=>'Foreign Employment License','title_ne'=>'वैदेशिक रोजगार इजाजतपत्र','document_type'=>'license','issue_authority_en'=>'Department of Foreign Employment, Government of Nepal','issue_authority_ne'=>'वैदेशिक रोजगार विभाग, नेपाल सरकार','reference_number'=>'1795/082/083','display_order'=>2,'is_active'=>true]);
        LegalDocument::create(['title_en'=>'PAN Registration','title_ne'=>'स्थायी लेखा नम्बर दर्ता','document_type'=>'registration','issue_authority_en'=>'Department of Internal Revenue','issue_authority_ne'=>'आन्तरिक राजस्व विभाग','reference_number'=>'622409832','display_order'=>3,'is_active'=>true]);

        // Employer Requirements
        EmployerRequirement::create(['document_name_en'=>'Demand Letter','document_name_ne'=>'माग पत्र','description_en'=>'Addressed to authorize Aldar Group Pvt. Ltd. Kathmandu, Nepal.','description_ne'=>'अल्दार ग्रुप प्रा. लि. काठमाडौं, नेपाललाई अधिकृत गर्न सम्बोधित।','is_required'=>true,'category'=>'employer','display_order'=>1,'is_active'=>true]);
        EmployerRequirement::create(['document_name_en'=>'Power of Attorney','document_name_ne'=>'अख्तियारनामा','description_en'=>'Addressed to authorize Aldar Group Pvt. Ltd. as the lawful attorney in Nepal.','description_ne'=>'अल्दार ग्रुप प्रा. लि. लाई नेपालमा कानुनी वकिलको रूपमा अधिकृत।','is_required'=>true,'category'=>'employer','display_order'=>2,'is_active'=>true]);
        EmployerRequirement::create(['document_name_en'=>'Service Agreement','document_name_ne'=>'सेवा सम्झौता','description_en'=>'Service agreement between the company and the recruitment agency.','description_ne'=>'कम्पनी र भर्ती एजेन्सी बीच सेवा सम्झौता।','is_required'=>true,'category'=>'contract','display_order'=>3,'is_active'=>true]);
        EmployerRequirement::create(['document_name_en'=>'Employment Contract','document_name_ne'=>'रोजगार सम्झौता','description_en'=>'One copy of the employment contract, signed and sealed.','description_ne'=>'हस्ताक्षर र सिलबन्दी गरेको रोजगार सम्झौताको एक प्रति।','is_required'=>true,'category'=>'contract','display_order'=>4,'is_active'=>true]);
        EmployerRequirement::create(['document_name_en'=>'Guarantee Letter','document_name_ne'=>'ग्यारेन्टी पत्र','description_en'=>'A signed and stamped copy from the employing company.','description_ne'=>'रोजगारदाता कम्पनीबाट हस्ताक्षर र छाप लगाइएको प्रति।','is_required'=>true,'category'=>'employer','display_order'=>5,'is_active'=>true]);

        echo "\n✅ Seed completed. ALDAR baseline data inserted.\n";
        echo "Admin login: admin@aldargroup.com / Admin@12345\n";
    }
}
