<?php

namespace Database\Seeders;

use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            // ═══════════════════════════════════════════════════════
            // WHO WE ARE
            // ═══════════════════════════════════════════════════════
            [
                'page_slug' => 'who-we-are',
                'section_key' => 'hero',
                'section_type' => 'text',
                'title_en' => 'Who We Are',
                'title_ne' => 'हामी को हौं',
                'subtitle_en' => 'A bridge between talent and opportunity',
                'subtitle_ne' => 'प्रतिभा र अवसरबीचको पुल',
                'sort_order' => 1,
            ],
            [
                'page_slug' => 'who-we-are',
                'section_key' => 'introduction',
                'section_type' => 'text',
                'title_en' => 'Company Introduction',
                'title_ne' => 'कम्पनी परिचय',
                'content_en' => "At Aldar Group Pvt. Ltd., we take pride in being a bridge between talent and opportunity. Our dedication to excellence, professionalism, and client satisfaction has positioned us as a trusted partner in the recruitment industry. We are committed to delivering reliable workforce solutions that meet the unique need of every business while empowering individuals to achieve their career goals.\n\nAldar Group Pvt. Ltd. is the government approved recruitment agency registered in Ministry of Labor in Nepal that aims to provide the varieties of Manpower including Non-skilled Labour to semiskilled Trade persons to skilled & highly qualified professionals like engineers, chartered accountants, managers etc to Malaysia, Gulf countries as UAE, Saudi, Qatar, Oman, Bahrain.",
                'content_ne' => "अल्दार ग्रुप प्रा.लि. मा, हामी प्रतिभा र अवसरबीचको पुल बन्नमा गर्व गर्छौं। उत्कृष्टता, व्यावसायिकता र ग्राहक सन्तुष्टिप्रतिको हाम्रो समर्पणले हामीलाई भर्ती उद्योगमा विश्वसनीय साझेदारको रूपमा स्थापित गरेको छ।\n\nअल्दार ग्रुप प्रा.लि. नेपालको श्रम मन्त्रालयमा दर्ता भएको सरकार स्वीकृत भर्ती एजेन्सी हो जसले मलेसिया, खाडी मुलुकहरू जस्तै UAE, साउदी, कतार, ओमान, बहराइनमा अकुशल श्रमिकदेखि अर्ध-कुशल व्यापारी व्यक्तिहरूदेखि कुशल र उच्च योग्य पेशेवरहरूसम्म विभिन्न जनशक्ति उपलब्ध गराउने लक्ष्य राख्छ।",
                'sort_order' => 2,
            ],
            [
                'page_slug' => 'who-we-are',
                'section_key' => 'company_details',
                'section_type' => 'details',
                'title_en' => 'Company Details',
                'title_ne' => 'कम्पनी विवरण',
                'items' => [
                    ['label_en' => 'Govt. License No.', 'label_ne' => 'इजाजतपत्र नं.', 'value' => '1795/082/083'],
                    ['label_en' => 'Registration No.', 'label_ne' => 'दर्ता नं.', 'value' => '371666/082/083'],
                    ['label_en' => 'PAN No.', 'label_ne' => 'प्यान नं.', 'value' => '622409832'],
                    ['label_en' => 'Capital', 'label_ne' => 'पूँजी', 'value' => '20 Million NPR'],
                    ['label_en' => 'Official Bank', 'label_ne' => 'बैंक', 'value' => 'Prime Commercial Bank Ltd.'],
                    ['label_en' => 'Service Type', 'label_ne' => 'सेवा प्रकार', 'value_en' => 'Human Resource Recruitment', 'value_ne' => 'मानव संसाधन भर्ती'],
                ],
                'sort_order' => 3,
            ],
            [
                'page_slug' => 'who-we-are',
                'section_key' => 'objective',
                'section_type' => 'text',
                'title_en' => 'Our Objective',
                'title_ne' => 'हाम्रो उद्देश्य',
                'content_en' => 'Our mission is to meet the growing demand for Nepalese workforce abroad to ease growing unemployment within the country and export a variety of capable manpower — from semi-skilled to highly skilled professionals as per the demands of our esteemed clients and thus help the nation by contributing in the inflow of foreign currency.',
                'content_ne' => 'हाम्रो मिशन विदेशमा नेपाली जनशक्तिको बढ्दो माग पूरा गर्ने र देशभित्रको बढ्दो बेरोजगारी कम गर्ने हो। हाम्रो सम्मानित ग्राहकहरूको मागअनुसार अर्ध-कुशलदेखि उच्च कुशल पेशेवरहरूसम्म विभिन्न सक्षम जनशक्ति निर्यात गर्ने र विदेशी मुद्राको प्रवाहमा योगदान पुर्‍याउने।',
                'sort_order' => 4,
            ],
            [
                'page_slug' => 'who-we-are',
                'section_key' => 'values',
                'section_type' => 'cards',
                'title_en' => 'Our Values',
                'title_ne' => 'हाम्रा मूल्यहरू',
                'items' => [
                    ['icon' => 'shield-check', 'title_en' => 'Integrity', 'title_ne' => 'इमानदारिता', 'description_en' => 'Ensures transparency and fairness in every interaction.', 'description_ne' => 'पारदर्शिता र निष्पक्षता सुनिश्चित गर्दछ।'],
                    ['icon' => 'briefcase', 'title_en' => 'Professionalism', 'title_ne' => 'व्यावसायिकता', 'description_en' => 'Drives exceptional service delivery.', 'description_ne' => 'उत्कृष्ट सेवा प्रदान गर्दछ।'],
                    ['icon' => 'lightbulb', 'title_en' => 'Innovation', 'title_ne' => 'नवप्रवर्तन', 'description_en' => 'Adapts us to change and new challenges.', 'description_ne' => 'परिवर्तनसँग अनुकूलन गर्दछ।'],
                    ['icon' => 'users', 'title_en' => 'Collaboration', 'title_ne' => 'सहकार्य', 'description_en' => 'Fuels teamwork and partnerships.', 'description_ne' => 'टिमवर्कलाई बढावा दिन्छ।'],
                    ['icon' => 'zap', 'title_en' => 'Dedication', 'title_ne' => 'समर्पण', 'description_en' => 'Propels us for lasting impact.', 'description_ne' => 'दिगो प्रभावका लागि प्रेरित गर्दछ।'],
                ],
                'sort_order' => 5,
            ],
            [
                'page_slug' => 'who-we-are',
                'section_key' => 'vision',
                'section_type' => 'text',
                'title_en' => 'Our Vision',
                'title_ne' => 'हाम्रो दृष्टि',
                'content_en' => 'To be the leading recruitment partner, connecting top talent with dream jobs and driving business success through innovative solutions and exceptional service.',
                'content_ne' => 'अग्रणी भर्ती साझेदार बन्नु, शीर्ष प्रतिभालाई सपनाको रोजगारीसँग जोड्नु र नवीन समाधान र असाधारण सेवाको माध्यमबाट व्यावसायिक सफलता प्राप्त गर्नु।',
                'sort_order' => 6,
            ],
            [
                'page_slug' => 'who-we-are',
                'section_key' => 'mission',
                'section_type' => 'text',
                'title_en' => 'Our Mission',
                'title_ne' => 'हाम्रो मिशन',
                'content_en' => 'To meet the growing demand for Nepalese workforce abroad to ease growing unemployment within the country and export capable manpower as per client demands, contributing to foreign currency inflow.',
                'content_ne' => 'नेपाली कामदारको विदेशमा बढ्दो मागलाई पूरा गर्न र देशभित्रको बेरोजगारी कम गर्न विभिन्न सक्षम जनशक्ति निर्यात गर्ने।',
                'sort_order' => 7,
            ],

            // ═══════════════════════════════════════════════════════
            // WHY CHOOSE US
            // ═══════════════════════════════════════════════════════
            [
                'page_slug' => 'why-choose-us',
                'section_key' => 'hero',
                'section_type' => 'text',
                'title_en' => 'Why Choose Us?',
                'title_ne' => 'हामीलाई किन छान्ने?',
                'subtitle_en' => 'Your trusted partner in the recruitment industry',
                'subtitle_ne' => 'भर्ती उद्योगमा विश्वसनीय साझेदार',
                'sort_order' => 1,
            ],
            [
                'page_slug' => 'why-choose-us',
                'section_key' => 'reasons',
                'section_type' => 'cards',
                'title_en' => 'Why Choose Us',
                'title_ne' => 'हामीलाई किन छान्ने',
                'items' => [
                    ['icon' => 'shield-check', 'title_en' => 'Government Approved Agency', 'title_ne' => 'सरकार स्वीकृत एजेन्सी', 'description_en' => 'Registered with the Ministry of Labor, Nepal (License No. 1795/082/083). Fully compliant with all government regulations.', 'description_ne' => 'नेपालको श्रम मन्त्रालयमा दर्ता भएको (इजाजतपत्र नं. 1795/082/083) विश्वसनीय एजेन्सी।'],
                    ['icon' => 'users', 'title_en' => 'Experienced Management', 'title_ne' => 'अनुभवी व्यवस्थापन', 'description_en' => 'Our experienced, responsible and dedicated management team can be trusted upon to complete any designated assignment on time.', 'description_ne' => 'हाम्रो अनुभवी, जिम्मेवार र समर्पित व्यवस्थापन टोली कुनै पनि निर्दिष्ट कार्य समयमा पूरा गर्न विश्वसनीय छ।'],
                    ['icon' => 'globe', 'title_en' => 'Vast Network', 'title_ne' => 'विशाल नेटवर्क', 'description_en' => 'Our ultra designed human resource accessibility network is spread all over Nepal enabling us to select quality manpower from a vast pool of human resources.', 'description_ne' => 'हाम्रो मानव संसाधन पहुँचयोग्यता नेटवर्क सम्पूर्ण नेपालमा फैलिएको छ जसले विशाल मानव संसाधनबाट गुणस्तरीय जनशक्ति छनौट गर्न सक्षम बनाउँछ।'],
                    ['icon' => 'currency', 'title_en' => 'Cost-Effective Operations', 'title_ne' => 'लागत प्रभावकारी', 'description_en' => 'We operate in an efficient and cost effective manner. We legally provide employment opportunities and arrange for workers\' insurance during the employment period.', 'description_ne' => 'हामी कुशल र लागत प्रभावकारी तरिकाले सञ्चालन गर्छौं। हामी कानूनी रूपमा रोजगारीका अवसरहरू प्रदान गर्छौं र रोजगारी अवधिमा कामदारहरूको बिमा व्यवस्था गर्छौं।'],
                    ['icon' => 'clock', 'title_en' => 'On-Time Quality Service', 'title_ne' => 'समयमा गुणस्तरीय सेवा', 'description_en' => 'We possess a prompt and calibrated design of working style and offer on-time quality service. Through stringent selection criteria, we select the workforce and provide them intensive orientation.', 'description_ne' => 'हामीसँग कामको शैलीको शीघ्र र क्यालिब्रेटेड डिजाइन छ र समयमा गुणस्तरीय सेवा प्रदान गर्छौं। कडा छनौट मापदण्डमार्फत हामी जनशक्ति छनौट गर्छौं।'],
                    ['icon' => 'clipboard', 'title_en' => 'Client-Focused Specifications', 'title_ne' => 'ग्राहक-केन्द्रित विशिष्टता', 'description_en' => 'We place great emphasis on the specifications given by our clients to fulfill their exact human resource requirements with precision and care.', 'description_ne' => 'हामी ग्राहकहरूले दिएका विशिष्टताहरूमा ठूलो जोड दिन्छौं र तिनीहरूको सटीक मानव संसाधन आवश्यकता पूरा गर्न प्रतिबद्ध छौं।'],
                ],
                'sort_order' => 2,
            ],
            [
                'page_slug' => 'why-choose-us',
                'section_key' => 'ethical_recruitment',
                'section_type' => 'text',
                'title_en' => 'Commitment to Ethical Recruitment',
                'title_ne' => 'नैतिक भर्तीप्रतिको प्रतिबद्धता',
                'content_en' => 'At Aldar Group Pvt. Ltd., ethical recruitment is not just a buzzword; it\'s the cornerstone of our identity. We firmly believe that the recruitment industry should not merely be about filling positions; it should be a catalyst for meaningful change. Ethical recruitment, to us, means adhering to the highest standards of integrity, fairness, and transparency in every interaction we have.',
                'content_ne' => 'अल्दार ग्रुप प्रा.लि. मा, नैतिक भर्ती केवल शब्द मात्र होइन; यो हाम्रो पहिचानको आधारशिला हो। हामी दृढ रूपमा विश्वास गर्छौं कि भर्ती उद्योग केवल पदहरू भर्ने बारेमा हुनुपर्दैन; यो सार्थक परिवर्तनको उत्प्रेरक हुनुपर्छ। हाम्रा लागि नैतिक भर्तीको अर्थ हाम्रो हरेक अन्तरक्रियामा इमानदारिता, निष्पक्षता र पारदर्शिताको उच्चतम मापदण्डमा प्रतिबद्ध रहनु हो।',
                'sort_order' => 3,
            ],
            [
                'page_slug' => 'why-choose-us',
                'section_key' => 'grievance_policy',
                'section_type' => 'text',
                'title_en' => 'Commitment to a Positive Workplace',
                'title_ne' => 'सकारात्मक कार्यस्थलप्रतिको प्रतिबद्धता',
                'content_en' => 'We stand firm in our dedication to nurturing a workplace that is not only positive but also fair. Our Grievance Policy serves as a beacon of our commitment to creating an environment where every voice matters. We empower our employees to freely voice their concerns, knowing that their feedback will be treated with the utmost respect and confidentiality.',
                'content_ne' => 'हामी एउटा कार्यस्थललाई पोषण गर्न समर्पित छौं जुन सकारात्मक मात्र होइन निष्पक्ष पनि हो। हाम्रो गुनासो नीति हाम्रो विश्वासको प्रमाण हो। यसले हरेक आवाज महत्त्वपूर्ण हुने वातावरण सिर्जना गर्ने प्रतिबद्धताको रूपमा काम गर्छ।',
                'sort_order' => 4,
            ],

            // ═══════════════════════════════════════════════════════
            // MEET OUR TEAM
            // ═══════════════════════════════════════════════════════
            [
                'page_slug' => 'meet-our-team',
                'section_key' => 'hero',
                'section_type' => 'text',
                'title_en' => 'Meet Our Team',
                'title_ne' => 'हाम्रो टोलीलाई भेट्नुहोस्',
                'subtitle_en' => 'Experienced and dedicated leadership driving our mission forward',
                'subtitle_ne' => 'अनुभवी र समर्पित नेतृत्व',
                'sort_order' => 1,
            ],
            [
                'page_slug' => 'meet-our-team',
                'section_key' => 'team_messages',
                'section_type' => 'team_quotes',
                'title_en' => 'Our Leadership',
                'title_ne' => 'हाम्रो नेतृत्व',
                'items' => [
                    [
                        'designation' => 'Chairman',
                        'quote_en' => 'It is with great pleasure and a profound sense of responsibility that I address you today as the Chairman of Aldar Group Pvt. Ltd. Our journey as an organization dedicated to ethical recruitment has been both inspiring and transformative. We have witnessed countless lives transformed, careers advanced, and organizations elevated. At Aldar Group Pvt. Ltd., ethical recruitment is not just a buzzword; it\'s the cornerstone of our identity.',
                        'quote_ne' => 'अल्दार ग्रुप प्रा.लि. को अध्यक्षको रूपमा तपाईंहरूलाई सम्बोधन गर्न पाउँदा मलाई अत्यन्त हर्ष र गहन जिम्मेवारीको अनुभूति भएको छ। नैतिक भर्तीप्रति समर्पित संस्थाको रूपमा हाम्रो यात्रा प्रेरणादायी र परिवर्तनकारी दुवै रहेको छ।',
                    ],
                    [
                        'designation' => 'Managing Director',
                        'quote_en' => 'It is my privilege to introduce Aldar Group Pvt. Ltd., a trusted provider of comprehensive manpower solutions. Our commitment lies in bridging the gap between businesses and exceptional talent, ensuring seamless workforce integration and mutual success. With a focus on professionalism, quality, and reliability, we tailor our services to meet the diverse needs of our clients across industries.',
                        'quote_ne' => 'अल्दार ग्रुप प्रा.लि. को परिचय दिन पाउँदा मलाई गर्व लागेको छ। व्यापक जनशक्ति समाधानको विश्वसनीय प्रदायकको रूपमा, व्यवसाय र असाधारण प्रतिभाबीचको खाडल पुर्ने हाम्रो प्रतिबद्धता रहेको छ।',
                    ],
                    [
                        'designation' => 'Director',
                        'quote_en' => 'At Aldar Group Pvt. Ltd., we take pride in being a bridge between talent and opportunity. Our dedication to excellence, professionalism, and client satisfaction has positioned us as a trusted partner in the recruitment industry. We are committed to delivering reliable workforce solutions that meet the unique need of every business while empowering individuals to achieve their career goals.',
                        'quote_ne' => 'अल्दार ग्रुप प्रा.लि. मा, हामी प्रतिभा र अवसरबीचको पुल बन्नमा गर्व गर्छौं। उत्कृष्टता, व्यावसायिकता र ग्राहक सन्तुष्टिप्रतिको हाम्रो समर्पणले हामीलाई भर्ती उद्योगमा विश्वसनीय साझेदारको रूपमा स्थापित गरेको छ।',
                    ],
                    [
                        'designation' => 'Executive Director',
                        'quote_en' => 'Warm greetings from Aldar Group Pvt. Ltd. As a trusted and government-licensed manpower agency, we are committed to providing reliable and skilled human resources to meet the demands of various industries across the globe. We would be honored to have the opportunity to support your workforce needs and assure you of our highest level of professionalism, transparency, and efficiency in the recruitment process.',
                        'quote_ne' => 'अल्दार ग्रुप प्रा.लि. बाट हार्दिक शुभकामना। विश्वसनीय र सरकार अनुमतिप्राप्त जनशक्ति एजेन्सीको रूपमा, हामी विश्वभरका विभिन्न उद्योगहरूको माग पूरा गर्न विश्वसनीय र कुशल मानव संसाधन प्रदान गर्न प्रतिबद्ध छौं।',
                    ],
                ],
                'sort_order' => 2,
            ],
            [
                'page_slug' => 'meet-our-team',
                'section_key' => 'org_structure',
                'section_type' => 'details',
                'title_en' => 'Organization Structure',
                'title_ne' => 'संगठनात्मक संरचना',
                'items' => [
                    ['role' => 'Chairman', 'name' => 'Mr. Kapleshwar Shah'],
                    ['role' => 'Managing Director', 'name' => 'Mr. Devendra Luitel'],
                    ['role' => 'Director', 'name' => 'Mr. Bir Bahadur Tamang'],
                    ['role' => 'Executive Director', 'name' => 'Mr. Lok Bahadur Katuwal'],
                    ['role' => 'Int. Marketing Manager', 'name' => 'Mr. Anil Mandal'],
                ],
                'sort_order' => 3,
            ],

            // ═══════════════════════════════════════════════════════
            // WHY WORK WITH US
            // ═══════════════════════════════════════════════════════
            [
                'page_slug' => 'why-work-with-us',
                'section_key' => 'hero',
                'section_type' => 'text',
                'title_en' => 'Why Work With Us?',
                'title_ne' => 'हामीसँग किन काम गर्ने?',
                'subtitle_en' => 'Your reliable recruitment partner for quality manpower solutions',
                'subtitle_ne' => 'तपाईंको विश्वसनीय भर्ती साझेदार',
                'sort_order' => 1,
            ],
            [
                'page_slug' => 'why-work-with-us',
                'section_key' => 'benefits',
                'section_type' => 'cards',
                'title_en' => 'Benefits of Partnering With Us',
                'title_ne' => 'हामीसँग साझेदारी गर्ने फाइदाहरू',
                'items' => [
                    ['icon' => 'shield-check', 'title_en' => 'Experienced & Trustworthy Management', 'title_ne' => 'अनुभवी र विश्वसनीय व्यवस्थापन', 'description_en' => 'Our experienced, responsible and dedicated management team can be trusted upon to complete any designated assignment on time.', 'description_ne' => 'हाम्रो अनुभवी, जिम्मेवार र समर्पित व्यवस्थापन टोली कुनै पनि निर्दिष्ट कार्य समयमा पूरा गर्न विश्वसनीय छ।'],
                    ['icon' => 'users', 'title_en' => 'Client-Focused Specifications', 'title_ne' => 'ग्राहक-केन्द्रित विशिष्टता', 'description_en' => 'We place great emphasis on the specifications given by our clients. Our ultra designed human resource accessibility network is spread all over Nepal enabling us to select quality manpower from a vast pool of human resources to fulfill the exact requirements.', 'description_ne' => 'हामी ग्राहकहरूले दिएका विशिष्टताहरूमा ठूलो जोड दिन्छौं। हाम्रो अल्ट्रा डिजाइन गरिएको मानव संसाधन पहुँचयोग्यता नेटवर्क सम्पूर्ण नेपालमा फैलिएको छ।'],
                    ['icon' => 'currency', 'title_en' => 'Cost-Effective Operations', 'title_ne' => 'लागत प्रभावकारी सञ्चालन', 'description_en' => 'We operate in an efficient and cost effective manner. We legally provide employment opportunities to various categories of workers and arrange for the workers\' insurance during the employment period.', 'description_ne' => 'हामी कुशल र लागत प्रभावकारी तरिकाले सञ्चालन गर्छौं। हामी कानूनी रूपमा रोजगारीका अवसरहरू प्रदान गर्छौं र रोजगारी अवधिमा कामदारहरूको बिमा व्यवस्था गर्छौं।'],
                    ['icon' => 'clock', 'title_en' => 'On-Time Quality Service', 'title_ne' => 'समयमा गुणस्तरीय सेवा', 'description_en' => 'We possess a prompt and calibrated design of working style and offer on-time quality service. Through stringent selection criteria, we select the workforce and provide them intensive orientation as per the requirement of our esteemed clients.', 'description_ne' => 'हामीसँग कामको शैलीको शीघ्र र क्यालिब्रेटेड डिजाइन छ र समयमा गुणस्तरीय सेवा प्रदान गर्छौं। कडा छनौट मापदण्डमार्फत हामी जनशक्ति छनौट गर्छौं र तिनीहरूलाई गहन अभिमुखीकरण प्रदान गर्छौं।'],
                ],
                'sort_order' => 2,
            ],
            [
                'page_slug' => 'why-work-with-us',
                'section_key' => 'process_steps',
                'section_type' => 'steps',
                'title_en' => 'How We Work',
                'title_ne' => 'हामी कसरी काम गर्छौं',
                'items' => [
                    ['num' => 1, 'title_en' => 'Pre-approval from Labor Office', 'title_ne' => 'श्रम कार्यालयबाट पूर्व-स्वीकृति', 'description_en' => 'Quota application → Quota approval → Levy payment', 'description_ne' => 'कोटा आवेदन → कोटा स्वीकृति → लेभी भुक्तानी'],
                    ['num' => 2, 'title_en' => 'Job Offer Letter', 'title_ne' => 'रोजगार प्रस्ताव पत्र', 'description_en' => 'Demand letter → Power of attorney → Employment contract', 'description_ne' => 'माग पत्र → मुख्तियारनामा → रोजगार सम्झौता'],
                    ['num' => 3, 'title_en' => 'Quota Approval', 'title_ne' => 'कोटा स्वीकृति', 'description_en' => 'Job advertisement → Application collection → Pre-screening → Final interview & selection', 'description_ne' => 'जागिर/माग विज्ञापन → आवेदन सङ्कलन → पूर्व छनौट → अन्तिम अन्तर्वार्ता र छनौट'],
                    ['num' => 4, 'title_en' => 'Bio Medical', 'title_ne' => 'स्वास्थ्य परीक्षण', 'description_en' => 'Signing employment contract → Passport collection → Medical examination → Certificate issuance', 'description_ne' => 'रोजगार सम्झौतामा हस्ताक्षर → पासपोर्ट सङ्कलन → स्वास्थ्य परीक्षण → प्रमाणपत्र जारी'],
                    ['num' => 5, 'title_en' => 'Visa Process', 'title_ne' => 'भिसा प्रक्रिया', 'description_en' => 'VDR application → Submit with quota approval → Levy payment receipt → Online insurance', 'description_ne' => 'VDR आवेदन फारम → कोटा स्वीकृतिसहित पेश → लेभी भुक्तानी रसिद → अनलाइन बिमा'],
                    ['num' => 6, 'title_en' => 'Embassy Entry', 'title_ne' => 'दूतावास प्रवेश', 'description_en' => 'Visa application → Submit passport & VDR → Entry visa issuance', 'description_ne' => 'भिसा आवेदन → पासपोर्ट र VDR पेश → प्रवेश भिसा जारी'],
                    ['num' => 7, 'title_en' => 'Final Approval & Deployment', 'title_ne' => 'अन्तिम स्वीकृति र प्रस्थान', 'description_en' => 'Ticketing → Documentation → Pre-departure orientation → Confirmation of arrival & Feedback', 'description_ne' => 'टिकटिङ → कागजात → पूर्व-प्रस्थान अभिमुखीकरण → आगमन पुष्टि र प्रतिक्रिया'],
                ],
                'sort_order' => 3,
            ],
            [
                'page_slug' => 'why-work-with-us',
                'section_key' => 'partnership_cta',
                'section_type' => 'text',
                'title_en' => 'A Newer Horizon Together',
                'title_ne' => 'सँगै नयाँ क्षितिज',
                'content_en' => "Always keeping you in top priority and contributing to each other's business orientation, we should be the perfect partner to work with. Of course, with our name together we see a newer horizon and visualize us doing businesses for many years to come.",
                'content_ne' => 'तपाईंलाई सधैं सर्वोच्च प्राथमिकतामा राख्दै र एक अर्काको व्यापार अभिमुखीकरणमा योगदान गर्दै, हामी सँगै काम गर्ने उत्तम साझेदार हुनुपर्छ। हाम्रो नामसँगै हामी नयाँ क्षितिज देख्छौं र आउँदा वर्षहरूमा व्यापार गर्ने कल्पना गर्छौं।',
                'sort_order' => 4,
            ],

            // ═══════════════════════════════════════════════════════
            // OUR NETWORK
            // ═══════════════════════════════════════════════════════
            [
                'page_slug' => 'our-network',
                'section_key' => 'hero',
                'section_type' => 'text',
                'title_en' => 'Our Network',
                'title_ne' => 'हाम्रो नेटवर्क',
                'subtitle_en' => 'Our global presence across multiple countries and regions',
                'subtitle_ne' => 'विश्वभरी फैलिएको हाम्रो उपस्थिति',
                'sort_order' => 1,
            ],
            [
                'page_slug' => 'our-network',
                'section_key' => 'network_overview',
                'section_type' => 'text',
                'title_en' => 'Our Global Presence',
                'title_ne' => 'हाम्रो विश्वव्यापी उपस्थिति',
                'content_en' => "With one of the largest networks both for sourcing of human resources, clients and business affiliates across the globe, Aldar Group Pvt. Ltd.'s presence in the international human resource scene is significantly important. Always keeping you in top priority and contributing to each other's business orientation, we should be the perfect partner to work with.",
                'content_ne' => 'मानव संसाधन, ग्राहक र विश्वभरीका व्यापारिक सहयोगीहरूको सबैभन्दा ठूलो नेटवर्कमध्ये एकको साथ, अन्तर्राष्ट्रिय मानव संसाधन क्षेत्रमा अल्दार ग्रुप प्रा.लि. को उपस्थिति महत्त्वपूर्ण छ। तपाईंलाई सधैं सर्वोच्च प्राथमिकतामा राख्दै र एक अर्काको व्यापार अभिमुखीकरणमा योगदान गर्दै, हामी सँगै काम गर्ने उत्तम साझेदार हुनुपर्छ।',
                'sort_order' => 2,
            ],
            [
                'page_slug' => 'our-network',
                'section_key' => 'projecting_countries',
                'section_type' => 'cards',
                'title_en' => 'Projecting to Work In',
                'title_ne' => 'भविष्यमा कार्यरत हुने देशहरू',
                'subtitle_en' => 'Countries where we plan to expand our services',
                'subtitle_ne' => 'यी देशहरूमा हाम्रो सेवा विस्तार गर्ने योजना छ',
                'items' => [
                    ['name_en' => 'Japan', 'name_ne' => 'जापान', 'flag' => '🇯🇵'],
                    ['name_en' => 'Korea', 'name_ne' => 'कोरिया', 'flag' => '🇰🇷'],
                    ['name_en' => 'Maldives', 'name_ne' => 'माल्दिभ्स', 'flag' => '🇲🇻'],
                    ['name_en' => 'Cyprus', 'name_ne' => 'साइप्रस', 'flag' => '🇨🇾'],
                    ['name_en' => 'Brunei', 'name_ne' => 'ब्रुनाई', 'flag' => '🇧🇳'],
                ],
                'sort_order' => 3,
            ],
            [
                'page_slug' => 'our-network',
                'section_key' => 'stats',
                'section_type' => 'cards',
                'title_en' => 'Network Statistics',
                'title_ne' => 'नेटवर्क तथ्याङ्क',
                'items' => [
                    ['value' => '8+', 'label_en' => 'Active Countries', 'label_ne' => 'कार्यरत देशहरू'],
                    ['value' => '5+', 'label_en' => 'Expanding To', 'label_ne' => 'विस्तार योजना'],
                    ['value' => '20+', 'label_en' => 'Job Categories', 'label_ne' => 'रोजगारी श्रेणीहरू'],
                    ['value' => 'NPR 20M', 'label_en' => 'Company Capital', 'label_ne' => 'कम्पनी पूँजी'],
                ],
                'sort_order' => 4,
            ],

            // ═══════════════════════════════════════════════════════
            // RECRUITMENT PROCESS
            // ═══════════════════════════════════════════════════════
            [
                'page_slug' => 'recruitment-process',
                'section_key' => 'hero',
                'section_type' => 'text',
                'title_en' => 'Recruitment Process Flow',
                'title_ne' => 'भर्ती प्रक्रिया प्रवाह',
                'subtitle_en' => 'All the cost of recruitment along with agency service charge shall be borne by the Employer. Hence we request not to use any agent/middleman.',
                'subtitle_ne' => 'भर्तीको सम्पूर्ण खर्च एजेन्सी सेवा शुल्कसहित रोजगारदाताले वहन गर्नुपर्छ। त्यसैले कुनै पनि दलाल वा बिचौलिया प्रयोग नगर्न अनुरोध छ।',
                'sort_order' => 1,
            ],
        ];

        foreach ($sections as $section) {
            PageSection::updateOrCreate(
                ['page_slug' => $section['page_slug'], 'section_key' => $section['section_key']],
                $section
            );
        }
    }
}
