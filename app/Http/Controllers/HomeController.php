<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\HomepageSetting;
use App\Models\Project;
use App\Models\Review;
use App\Models\Skill;

class HomeController extends Controller
{
    public function index()
    {
        $settings = HomepageSetting::with(['softSkills', 'hardSkills'])->first();
        $softSkills = $settings ? $settings->softSkills : collect();
        $hardSkills = $settings ? $settings->hardSkills : collect();

        return view('home', [
            'settings' => $settings,
            'experiences' => Experience::where('show_on_homepage', true)->latest()->get(),
            'educations' => Education::where('show_on_homepage', true)->latest()->get(),
            'projects' => Project::where('show_on_homepage', true)->latest()->get(),
            'reviews' => Review::where('approved', true)->latest()->get(),
            'softSkills' => $softSkills,
            'hardSkills' => $hardSkills,
        ]);
    }

    public function experiencePage()
    {
        return view('experiences', [
            'settings' => HomepageSetting::with(['softSkills', 'hardSkills'])->first(),
            'experiences' => Experience::latest()->get(),
        ]);
    }

    public function projectsPage()
    {
        return view('projects', [
            'settings' => HomepageSetting::with(['softSkills', 'hardSkills'])->first(),
            'projects' => Project::latest()->get(),
        ]);
    }

    public function educationPage()
    {
        return view('education', [
            'settings' => HomepageSetting::with(['softSkills', 'hardSkills'])->first(),
            'educations' => Education::latest()->get(),
        ]);
    }

    public function contactPage()
    {
        return view('contact', [
            'settings' => HomepageSetting::first(),
        ]);
    }

    public function aboutPage()
    {
        $settings = HomepageSetting::with(['softSkills', 'hardSkills'])->first();
        $softSkills = $settings ? $settings->softSkills : collect();
        $hardSkills = $settings ? $settings->hardSkills : collect();

        return view('about', [
            'settings' => $settings,
            'softSkills' => $softSkills,
            'hardSkills' => $hardSkills,
        ]);
    }

    public function servicesPage()
    {
        return view('services', [
            'settings' => HomepageSetting::first(),
        ]);
    }
}
