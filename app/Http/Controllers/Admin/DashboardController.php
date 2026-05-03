<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\HomepageSetting;
use App\Models\Project;
use App\Models\Review;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'settings' => HomepageSetting::first(),
            'experiences' => Experience::count(),
            'educations' => Education::count(),
            'projects' => Project::count(),
            'reviews' => Review::count(),
            'services' => Service::count(),
        ]);
    }
}
