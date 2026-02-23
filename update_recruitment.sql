DELETE FROM recruitment_process;

INSERT INTO recruitment_process (step_number, title_en, title_ne, description_en, description_ne, icon, display_order, is_active, created_at, updated_at) VALUES
(1, 'Marketing', 'मार्केटिङ', 'Identifying potential employers and job opportunities in destination countries.', 'गन्तव्य देशहरूमा सम्भावित रोजगारदाताहरू र रोजगारीका अवसरहरू पहिचान गर्ने।', 'megaphone', 1, 1, NOW(), NOW()),
(2, 'Demand Letter Review & Confirmation', 'माग पत्र समीक्षा र पुष्टि', 'Reviewing and confirming the demand letter from the employer.', 'रोजगारदाताबाट माग पत्र समीक्षा र पुष्टि गर्ने।', 'document-text', 2, 1, NOW(), NOW()),
(3, 'Demand Letter Online Approved by Embassy of Nepal', 'नेपाली दूतावासबाट अनलाइन माग पत्र स्वीकृत', 'Getting the demand letter approved online by the Embassy of Nepal.', 'नेपाली दूतावासबाट माग पत्र अनलाइन स्वीकृत गर्ने।', 'globe-alt', 3, 1, NOW(), NOW()),
(4, 'Pre-approval (DoFE)', 'पूर्व-स्वीकृति (DoFE)', 'Obtaining pre-approval from the Department of Foreign Employment.', 'वैदेशिक रोजगार विभागबाट पूर्व-स्वीकृति प्राप्त गर्ने।', 'clipboard-check', 4, 1, NOW(), NOW()),
(5, 'Demand Letter Advertisement', 'माग पत्र विज्ञापन', 'Publishing the demand letter advertisement in national newspapers.', 'राष्ट्रिय पत्रिकाहरूमा माग पत्र विज्ञापन प्रकाशित गर्ने।', 'newspaper', 5, 1, NOW(), NOW()),
(6, 'Pre-recruitment Orientation', 'पूर्व-भर्ती अभिमुखीकरण', 'Conducting orientation sessions for potential candidates.', 'सम्भावित उम्मेदवारहरूको लागि अभिमुखीकरण सत्रहरू सञ्चालन गर्ने।', 'academic-cap', 6, 1, NOW(), NOW()),
(7, 'Application Form Registration', 'आवेदन फारम दर्ता', 'Collecting and registering application forms from candidates.', 'उम्मेदवारहरूबाट आवेदन फारमहरू सङ्कलन र दर्ता गर्ने।', 'document', 7, 1, NOW(), NOW()),
(8, 'Interview & Selection', 'अन्तर्वार्ता र छनौट', 'Conducting interviews and selecting qualified candidates.', 'अन्तर्वार्ता सञ्चालन र योग्य उम्मेदवारहरू छनौट गर्ने।', 'users', 8, 1, NOW(), NOW()),
(9, 'Employment Contract Briefing & Handover', 'रोजगार सम्झौता ब्रिफिङ र हस्तान्तरण', 'Briefing candidates on employment contracts and completing handover.', 'रोजगार सम्झौतामा उम्मेदवारहरूलाई जानकारी दिने र हस्तान्तरण पूरा गर्ने।', 'briefcase', 9, 1, NOW(), NOW()),
(10, 'Medical Screening', 'मेडिकल जाँच', 'Conducting medical examinations for selected candidates.', 'छनौट भएका उम्मेदवारहरूको मेडिकल जाँच गर्ने।', 'heart', 10, 1, NOW(), NOW()),
(11, 'E-Visa Process', 'ई-भिसा प्रक्रिया', 'Processing electronic visa applications for selected candidates.', 'छनौट भएका उम्मेदवारहरूको इलेक्ट्रोनिक भिसा आवेदन प्रशोधन गर्ने।', 'identification', 11, 1, NOW(), NOW()),
(12, 'Orientation (as per government policy)', 'अभिमुखीकरण (सरकारी नीति अनुसार)', 'Mandatory pre-departure orientation as per government regulations.', 'सरकारी नियमानुसार अनिवार्य प्रस्थान पूर्व अभिमुखीकरण।', 'academic-cap', 12, 1, NOW(), NOW()),
(13, 'Insurance', 'बीमा', 'Arranging mandatory insurance coverage for workers.', 'कामदारहरूको लागि अनिवार्य बीमा कभरेज व्यवस्था गर्ने।', 'shield-check', 13, 1, NOW(), NOW()),
(14, 'Final Approval (DoFE)', 'अन्तिम स्वीकृति (DoFE)', 'Obtaining final approval from the Department of Foreign Employment.', 'वैदेशिक रोजगार विभागबाट अन्तिम स्वीकृति प्राप्त गर्ने।', 'check-circle', 14, 1, NOW(), NOW()),
(15, 'Air Ticket', 'हवाई टिकट', 'Arranging air tickets for deployment.', 'प्रस्थानको लागि हवाई टिकट व्यवस्था गर्ने।', 'plane', 15, 1, NOW(), NOW()),
(16, 'Airport Assistance', 'विमानस्थल सहायता', 'Providing assistance at the airport during departure.', 'प्रस्थानको समयमा विमानस्थलमा सहायता प्रदान गर्ने।', 'map-pin', 16, 1, NOW(), NOW()),
(17, 'Departure', 'प्रस्थान', 'Workers depart for the destination country.', 'कामदारहरू गन्तव्य देशमा प्रस्थान गर्ने।', 'plane', 17, 1, NOW(), NOW()),
(18, 'Airport Reception', 'विमानस्थल स्वागत', 'Receiving workers at the destination airport.', 'गन्तव्य विमानस्थलमा कामदारहरूलाई स्वागत गर्ने।', 'hand-raised', 18, 1, NOW(), NOW()),
(19, 'Feedback & Management', 'प्रतिक्रिया र व्यवस्थापन', 'Ongoing feedback collection and worker welfare management.', 'निरन्तर प्रतिक्रिया सङ्कलन र कामदार कल्याण व्यवस्थापन।', 'chat-bubble', 19, 1, NOW(), NOW());
