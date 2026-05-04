<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', [
            'projects' => Project::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.projects.form', [
            'project' => new Project(),
        ]);
    }

    public function store(Request $request)
    {
        // Set Cloudinary configuration
        Configuration::instance([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key' => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => config('cloudinary.secure', true),
            ],
        ]);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'link' => ['nullable', 'url', 'max:255'],
            'tags' => ['nullable', 'string', 'max:255'],
            'evidence_photo' => ['nullable', 'image', 'max:2048'],
            'show_on_homepage' => ['nullable', 'boolean'],
        ]);

        $data['show_on_homepage'] = $request->boolean('show_on_homepage');

        if ($request->hasFile('evidence_photo')) {
            $uploadApi = new UploadApi();
            $result = $uploadApi->upload($request->file('evidence_photo')->getRealPath(), [
                'folder' => 'portfolio/projects',
                'public_id' => 'proj_' . time() . '_' . uniqid(),
                'transformation' => [
                    ['width' => 800, 'height' => 600, 'crop' => 'limit'],
                ]
            ]);
            $data['evidence_photo'] = $result['secure_url'];
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', [
            'project' => $project,
        ]);
    }

    public function update(Request $request, Project $project)
    {
        // Set Cloudinary configuration
        Configuration::instance([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key' => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => config('cloudinary.secure', true),
            ],
        ]);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'link' => ['nullable', 'url', 'max:255'],
            'tags' => ['nullable', 'string', 'max:255'],
            'evidence_photo' => ['nullable', 'image', 'max:2048'],
            'show_on_homepage' => ['nullable', 'boolean'],
        ]);

        $data['show_on_homepage'] = $request->boolean('show_on_homepage');

        if ($request->hasFile('evidence_photo')) {
            if ($project->evidence_photo) {
                // Delete old image from Cloudinary if it's a Cloudinary URL
                if (str_contains($project->evidence_photo, 'cloudinary')) {
                    $publicId = $this->extractPublicIdFromUrl($project->evidence_photo);
                    if ($publicId) {
                        (new UploadApi())->destroy($publicId);
                    }
                }
            }
            $uploadApi = new UploadApi();
            $result = $uploadApi->upload($request->file('evidence_photo')->getRealPath(), [
                'folder' => 'portfolio/projects',
                'public_id' => 'proj_' . time() . '_' . uniqid(),
                'transformation' => [
                    ['width' => 800, 'height' => 600, 'crop' => 'limit'],
                ]
            ]);
            $data['evidence_photo'] = $result['secure_url'];
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('success', 'Project berhasil dihapus.');
    }

    private function extractPublicIdFromUrl($url)
    {
        // Extract public_id from Cloudinary URL
        $pattern = '/\/upload\/(?:v\d+\/)?(.+)\.[a-zA-Z]+$/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
