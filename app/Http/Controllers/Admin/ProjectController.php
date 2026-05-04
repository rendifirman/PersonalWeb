<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

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
            $file = $request->file('evidence_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/projects'), $filename);
            $data['evidence_photo'] = 'images/projects/' . $filename;
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
                $oldPath = public_path($project->evidence_photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $file = $request->file('evidence_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/projects'), $filename);
            $data['evidence_photo'] = 'images/projects/' . $filename;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('success', 'Project berhasil dihapus.');
    }
}
