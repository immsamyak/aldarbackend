<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use App\Models\Application;
use App\Models\Country;
use App\Models\Sponsor;
use App\Models\Notice;
use App\Models\Form;
use App\Models\Submission;
use App\Models\CmsPage;
use App\Models\Media;
use App\Models\Translation;
use App\Models\Theme;
use App\Models\ChatbotData;
use App\Models\Ticket;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function overview(): JsonResponse
    {
        $totals = [
            'users' => User::count(),
            'jobs' => Job::count(),
            'applications' => Application::count(),
            'countries' => Country::count(),
            'sponsors' => Sponsor::count(),
            'notices' => Notice::count(),
            'popupNotices' => Notice::where('is_popup', true)->count(),
            'forms' => Form::count(),
            'submissions' => Submission::count(),
            'cmsPages' => CmsPage::count(),
            'media' => Media::count(),
            'translations' => Translation::count(),
            'themes' => Theme::count(),
            'chatbotData' => ChatbotData::count(),
            'tickets' => Ticket::count(),
        ];

        $latestJobs = Job::orderBy('created_at', 'desc')->limit(5)->get();
        $latestNotices = Notice::orderBy('created_at', 'desc')->limit(5)->get();

        $latestApplications = Application::with(['job:id,title_en,country,status', 'user:id,full_name,email'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $latestTickets = Ticket::with('assignee:id,full_name,email')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($t) {
                $data = CrudController::formatItem($t);
                if ($t->assignee) {
                    $data['assignedTo'] = CrudController::formatItem($t->assignee);
                }
                unset($data['assignee']); // remove eager-loaded relation key
                return $data;
            });

        return response()->json([
            'totals' => $totals,
            'latestJobs' => CrudController::formatList($latestJobs),
            'latestNotices' => CrudController::formatList($latestNotices),
            'latestApplications' => CrudController::formatList($latestApplications),
            'latestTickets' => $latestTickets->values()->toArray(),
        ]);
    }
}
