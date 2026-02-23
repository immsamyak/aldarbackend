<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SiteServiceController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SuccessStoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\CmsPageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\ChatbotDataController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrganizationStructureController;
use App\Http\Controllers\RecruitmentProcessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LegalDocumentController;
use App\Http\Controllers\EmployerRequirementController;
use App\Http\Controllers\PageSectionController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\DashboardController;
use App\Helpers\PublicMapper;
use App\Models\Brand;
use App\Models\Application as ApplicationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes — exact 1:1 match with Express.js server-api
|--------------------------------------------------------------------------
| Prefix: /api/v1
| Express pattern: ALL GET list & getById routes are PUBLIC.
| Auth middleware only on POST/PUT/DELETE.
*/

// ── Health ──
Route::get('/health', function () {
    try {
        DB::connection()->getPdo();
        $dbState = 1; // Express returns mongoose.connection.readyState (1 = connected)
    } catch (\Exception $e) {
        $dbState = 0;
    }
    return response()->json([
        'status' => 'ok',
        'service' => 'ALDAR GROUP API',
        'dbState' => $dbState,
    ]);
});

// ── File Upload ──
Route::post('/upload', [UploadController::class, 'upload'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::post('/upload/delete', [UploadController::class, 'delete'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Company (merges Brand with companyDefaults — exact Express match) ──
Route::get('/company', function () {
    $defaults = [
        'name' => 'ALDAR GROUP PVT. LTD.',
        'chairman' => 'Kapleshwar Shah',
        'tagline' => 'Creating opportunities for professional growth',
        'industry' => 'Overseas Recruitment & Corporate Services',
        'address' => 'Sukedhara-4, Kathmandu, Nepal',
        'phones' => ['+977-9841450009', '+977-9803851465', '+977-1-5925942'],
        'emails' => ['sahkapil13@gmail.com', 'aldaroffice.025@gmail.com'],
        'whatsappMessage' => 'Hello ALDAR GROUP, I want to apply for overseas jobs.',
        'chatbotGreeting' => 'Welcome to ALDAR GROUP. How can we help you today?',
        'registrationInfo' => [
            'en' => 'Registered overseas recruitment and corporate services provider in Nepal.',
            'ne' => 'नेपालमा दर्ता गरिएको वैदेशिक रोजगार तथा कर्पोरेट सेवा प्रदायक।',
        ],
    ];

    $brand = Brand::first();
    if (!$brand) {
        return response()->json($defaults);
    }

    $mapped = PublicMapper::mapBrand($brand);

    $phones = is_array($brand->phone_numbers) && count($brand->phone_numbers) ? $brand->phone_numbers : $defaults['phones'];
    $emails = is_array($brand->emails) && count($brand->emails) ? $brand->emails : $defaults['emails'];

    $result = array_merge($defaults, $mapped, [
        'name' => $brand->company_name ?: $defaults['name'],
        'chairman' => $brand->chairman_name ?: $defaults['chairman'],
        'tagline' => $brand->tagline ?: $defaults['tagline'],
        'address' => $brand->office_address ?: $defaults['address'],
        'phones' => $phones,
        'emails' => $emails,
        'whatsappMessage' => $brand->whatsapp_message ?: $defaults['whatsappMessage'],
        'chatbotGreeting' => $brand->chatbot_greeting ?: $defaults['chatbotGreeting'],
        'registrationInfo' => [
            'en' => $brand->registration_info_en ?: $defaults['registrationInfo']['en'],
            'ne' => $brand->registration_info_ne ?: $defaults['registrationInfo']['ne'],
        ],
    ]);

    return response()->json($result);
});

// ── Popup Notices (inline) ──
Route::get('/popup-notices/active', [NoticeController::class, 'listActivePopups']);

// ── Job Apply (file upload + public) — exact Express response ──
Route::post('/jobs/{jobId}/apply', function (Request $request, string $jobId) {
    $data = [
        'job_id' => $jobId,
        'full_name' => $request->input('fullName', ''),
        'email' => $request->input('email', ''),
        'phone' => $request->input('phone', ''),
        'notes' => $request->input('notes', ''),
        'status' => 'received',
    ];

    if ($request->hasFile('cv')) {
        $cv = $request->file('cv');
        $cvName = time() . '_cv_' . $cv->getClientOriginalName();
        $cv->move(public_path('uploads/applications'), $cvName);
        $data['cv_url'] = 'uploads/applications/' . $cvName;
    }
    if ($request->hasFile('passport')) {
        $passport = $request->file('passport');
        $passName = time() . '_passport_' . $passport->getClientOriginalName();
        $passport->move(public_path('uploads/applications'), $passName);
        $data['passport_url'] = 'uploads/applications/' . $passName;
    }

    $application = ApplicationModel::create($data);

    return response()->json([
        'message' => 'Application received',
        '_id' => (string) $application->id,
        'jobId' => $jobId,
    ], 201);
});

// ── Auth ──
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me'])->middleware('jwt.auth');
});

// ── Dashboard ──
Route::get('/dashboard/overview', [DashboardController::class, 'overview'])
    ->middleware(['jwt.auth', 'role:super_admin,admin,staff,recruiter']);

// ── Brand (singleton) ──
Route::get('/brand', [BrandController::class, 'getPublic']);
Route::get('/brand/admin', [BrandController::class, 'list'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::get('/brand/{id}', [BrandController::class, 'getById'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::post('/brand', [BrandController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/brand', [BrandController::class, 'updatePublic'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/brand/{id}', [BrandController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/brand/{id}', [BrandController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Hero (singleton) ──
Route::get('/hero', [HeroController::class, 'getPublic']);
Route::get('/hero/admin', [HeroController::class, 'list'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::get('/hero/{id}', [HeroController::class, 'getById'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::post('/hero', [HeroController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/hero', [HeroController::class, 'updatePublic'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/hero/{id}', [HeroController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/hero/{id}', [HeroController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Menus ──
Route::get('/menus/public', [MenuController::class, 'listPublic']);
Route::get('/menus', [MenuController::class, 'listAll']);
Route::get('/menus/{id}', [MenuController::class, 'getById']);
Route::post('/menus', [MenuController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/menus/{id}', [MenuController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/menus/{id}', [MenuController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Services (Express: /public and / both use same handler with ?all=true) ──
Route::get('/services/public', [SiteServiceController::class, 'listPublicOrAll']);
Route::get('/services', [SiteServiceController::class, 'listPublicOrAll']);
Route::get('/services/{id}', [SiteServiceController::class, 'getById']);
Route::post('/services', [SiteServiceController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::put('/services/{id}', [SiteServiceController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::delete('/services/{id}', [SiteServiceController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Jobs ──
Route::get('/jobs/public', [JobController::class, 'listPublic']);
Route::get('/jobs/slug/{slug}', [JobController::class, 'getBySlug']);
Route::get('/jobs', [JobController::class, 'list']);
Route::get('/jobs/{id}', [JobController::class, 'getById']);
Route::post('/jobs', [JobController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin,recruiter']);
Route::put('/jobs/{id}', [JobController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin,recruiter']);
Route::delete('/jobs/{id}', [JobController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Job Categories ──
Route::get('/job-categories/public', [JobCategoryController::class, 'listPublic']);
Route::get('/job-categories', [JobCategoryController::class, 'list']);
Route::get('/job-categories/{id}', [JobCategoryController::class, 'getById']);
Route::post('/job-categories', [JobCategoryController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/job-categories/{id}', [JobCategoryController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/job-categories/{id}', [JobCategoryController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Applications ──
Route::get('/applications', [ApplicationController::class, 'list']);
Route::get('/applications/{id}', [ApplicationController::class, 'getById']);
Route::post('/applications', [ApplicationController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/applications/{id}', [ApplicationController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/applications/{id}', [ApplicationController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Countries ──
Route::get('/countries/public', [CountryController::class, 'listPublic']);
Route::get('/countries/public/slug/{slug}', [CountryController::class, 'getBySlugPublic']);
Route::get('/countries/slug/{slug}', [CountryController::class, 'getBySlug']);
Route::get('/countries', [CountryController::class, 'list']);
Route::get('/countries/{id}', [CountryController::class, 'getById']);
Route::post('/countries', [CountryController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::put('/countries/{id}', [CountryController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::delete('/countries/{id}', [CountryController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Sponsors ──
Route::get('/sponsors/public', [SponsorController::class, 'listPublic']);
Route::get('/sponsors', [SponsorController::class, 'list']);
Route::get('/sponsors/{id}', [SponsorController::class, 'getById']);
Route::post('/sponsors', [SponsorController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/sponsors/{id}', [SponsorController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/sponsors/{id}', [SponsorController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Gallery (Express: /public and / both use same handler with ?all=true) ──
Route::get('/gallery/public', [GalleryController::class, 'listPublicOrAll']);
Route::get('/gallery', [GalleryController::class, 'listPublicOrAll']);
Route::get('/gallery/{id}', [GalleryController::class, 'getById']);
Route::post('/gallery', [GalleryController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::put('/gallery/{id}', [GalleryController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::delete('/gallery/{id}', [GalleryController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Success Stories (Express: /public and / both use same handler with ?all=true) ──
Route::get('/success-stories/public', [SuccessStoryController::class, 'listPublicOrAll']);
Route::get('/success-stories', [SuccessStoryController::class, 'listPublicOrAll']);
Route::get('/success-stories/{id}', [SuccessStoryController::class, 'getById']);
Route::post('/success-stories', [SuccessStoryController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::put('/success-stories/{id}', [SuccessStoryController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::delete('/success-stories/{id}', [SuccessStoryController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Testimonials (Express: /public and / both use same handler with ?all=true) ──
Route::get('/testimonials/public', [TestimonialController::class, 'listPublicOrAll']);
Route::get('/testimonials', [TestimonialController::class, 'listPublicOrAll']);
Route::get('/testimonials/{id}', [TestimonialController::class, 'getById']);
Route::post('/testimonials', [TestimonialController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::put('/testimonials/{id}', [TestimonialController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::delete('/testimonials/{id}', [TestimonialController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Notices ──
Route::get('/notices/public', [NoticeController::class, 'listPublished']);
Route::get('/notices/public-popups', [NoticeController::class, 'listActivePopups']);
Route::get('/notices', [NoticeController::class, 'list']);
Route::get('/notices/{id}', [NoticeController::class, 'getById']);
Route::post('/notices', [NoticeController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::put('/notices/{id}', [NoticeController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::delete('/notices/{id}', [NoticeController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Forms ──
Route::get('/forms/public/slug/{slug}', [FormController::class, 'getPublicBySlug']);
Route::get('/forms/slug/{slug}', [FormController::class, 'getBySlug']);
Route::get('/forms', [FormController::class, 'list']);
Route::get('/forms/{id}', [FormController::class, 'getById']);
Route::post('/forms', [FormController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::put('/forms/{id}', [FormController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::delete('/forms/{id}', [FormController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Submissions ──
Route::post('/submissions', [SubmissionController::class, 'create']); // public
Route::get('/submissions', [SubmissionController::class, 'list'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::get('/submissions/{id}', [SubmissionController::class, 'getById'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::put('/submissions/{id}', [SubmissionController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin,staff']);
Route::delete('/submissions/{id}', [SubmissionController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── CMS Pages ──
Route::get('/cms-pages/slug/{slug}', [CmsPageController::class, 'getBySlug']);
Route::get('/cms-pages', [CmsPageController::class, 'list']);
Route::get('/cms-pages/{id}', [CmsPageController::class, 'getById']);
Route::post('/cms-pages', [CmsPageController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/cms-pages/{id}', [CmsPageController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/cms-pages/{id}', [CmsPageController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);
// Aliases
Route::get('/pages/slug/{slug}', [CmsPageController::class, 'getBySlug']);
Route::get('/pages', [CmsPageController::class, 'list']);
Route::get('/pages/{id}', [CmsPageController::class, 'getById']);

// ── Media ──
Route::get('/media', [MediaController::class, 'list']);
Route::get('/media/{id}', [MediaController::class, 'getById']);
Route::post('/media', [MediaController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/media/{id}', [MediaController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/media/{id}', [MediaController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Themes ──
Route::get('/themes/public', [ThemeController::class, 'getPublic']);
Route::get('/themes', [ThemeController::class, 'list']);
Route::get('/themes/{id}', [ThemeController::class, 'getById']);
Route::post('/themes', [ThemeController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/themes/{id}', [ThemeController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/themes/{id}', [ThemeController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Translations ──
Route::get('/translations/public', [TranslationController::class, 'listPublic']);
Route::get('/translations', [TranslationController::class, 'list']);
Route::get('/translations/{id}', [TranslationController::class, 'getById']);
Route::post('/translations', [TranslationController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/translations/{id}', [TranslationController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/translations/{id}', [TranslationController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Chatbot Data ──
Route::get('/chatbot-data/public', [ChatbotDataController::class, 'listPublic']);
Route::get('/chatbot-data/category/{category}', [ChatbotDataController::class, 'listByCategory']);
Route::get('/chatbot-data', [ChatbotDataController::class, 'list']);
Route::get('/chatbot-data/{id}', [ChatbotDataController::class, 'getById']);
Route::post('/chatbot-data', [ChatbotDataController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/chatbot-data/{id}', [ChatbotDataController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/chatbot-data/{id}', [ChatbotDataController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Tickets ──
Route::get('/tickets', [TicketController::class, 'list']);
Route::get('/tickets/{id}', [TicketController::class, 'getById']);
Route::post('/tickets/public', [TicketController::class, 'create']); // public endpoint
Route::post('/tickets', [TicketController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/tickets/{id}', [TicketController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/tickets/{id}', [TicketController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Users ──
Route::get('/users', [UserController::class, 'list']);
Route::get('/users/{id}', [UserController::class, 'getById']);
Route::post('/users', [UserController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/users/{id}', [UserController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/users/{id}', [UserController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Roles ──
Route::get('/roles', [RoleController::class, 'list']);
Route::get('/roles/{id}', [RoleController::class, 'getById']);
Route::post('/roles', [RoleController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/roles/{id}', [RoleController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/roles/{id}', [RoleController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Organization Structure ──
Route::get('/organization-structure/public', [OrganizationStructureController::class, 'listPublic']);
Route::get('/organization-structure', [OrganizationStructureController::class, 'list']);
Route::get('/organization-structure/{id}', [OrganizationStructureController::class, 'getById']);
Route::post('/organization-structure', [OrganizationStructureController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/organization-structure/{id}', [OrganizationStructureController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/organization-structure/{id}', [OrganizationStructureController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Recruitment Process ──
Route::get('/recruitment-process/public', [RecruitmentProcessController::class, 'listPublic']);
Route::get('/recruitment-process', [RecruitmentProcessController::class, 'list']);
Route::get('/recruitment-process/{id}', [RecruitmentProcessController::class, 'getById']);
Route::post('/recruitment-process', [RecruitmentProcessController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/recruitment-process/{id}', [RecruitmentProcessController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/recruitment-process/{id}', [RecruitmentProcessController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Categories ──
Route::get('/categories/public', [CategoryController::class, 'listPublic']);
Route::get('/categories', [CategoryController::class, 'list']);
Route::get('/categories/{id}', [CategoryController::class, 'getById']);
Route::post('/categories', [CategoryController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/categories/{id}', [CategoryController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/categories/{id}', [CategoryController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Legal Documents ──
Route::get('/legal-documents/public', [LegalDocumentController::class, 'listPublic']);
Route::get('/legal-documents', [LegalDocumentController::class, 'list']);
Route::get('/legal-documents/{id}', [LegalDocumentController::class, 'getById']);
Route::post('/legal-documents', [LegalDocumentController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/legal-documents/{id}', [LegalDocumentController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/legal-documents/{id}', [LegalDocumentController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Employer Requirements ──
Route::get('/employer-requirements/public', [EmployerRequirementController::class, 'listPublic']);
Route::get('/employer-requirements', [EmployerRequirementController::class, 'list']);
Route::get('/employer-requirements/{id}', [EmployerRequirementController::class, 'getById']);
Route::post('/employer-requirements', [EmployerRequirementController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/employer-requirements/{id}', [EmployerRequirementController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/employer-requirements/{id}', [EmployerRequirementController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);

// ── Page Sections (CMS content blocks) ──
Route::get('/page-sections/page/{slug}', [PageSectionController::class, 'listByPageSlug']);
Route::get('/page-sections', [PageSectionController::class, 'list']);
Route::get('/page-sections/{id}', [PageSectionController::class, 'getById']);
Route::post('/page-sections', [PageSectionController::class, 'create'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::put('/page-sections/{id}', [PageSectionController::class, 'update'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::delete('/page-sections/{id}', [PageSectionController::class, 'remove'])->middleware(['jwt.auth', 'role:super_admin,admin']);
Route::post('/page-sections/reorder', [PageSectionController::class, 'reorder'])->middleware(['jwt.auth', 'role:super_admin,admin']);
