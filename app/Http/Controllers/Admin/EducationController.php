<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    public function index()
    {
        return view('admin.educations.index', [
            'educations' => Education::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.educations.form', [
            'education' => new Education(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'institution' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
            'field_of_study' => ['nullable', 'string', 'max:255'],
            'period' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'evidence_photo' => ['nullable', 'image', 'max:2048'],
            'show_on_homepage' => ['nullable', 'boolean'],
        ]);

        $data['show_on_homepage'] = $request->boolean('show_on_homepage');

        if ($request->hasFile('evidence_photo')) {
            $data['evidence_photo'] = $request->file('evidence_photo')->store('educations', 'public');
        }

        Education::create($data);

        return redirect()->route('admin.educations.index')->with('success', 'Pendidikan berhasil ditambahkan.');
    }

    public function edit(Education $education)
    {
        return view('admin.educations.form', [
            'education' => $education,
        ]);
    }

    public function update(Request $request, Education $education)
    {
        $data = $request->validate([
            'institution' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
            'field_of_study' => ['nullable', 'string', 'max:255'],
            'period' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'evidence_photo' => ['nullable', 'image', 'max:2048'],
            'show_on_homepage' => ['nullable', 'boolean'],
        ]);

        $data['show_on_homepage'] = $request->boolean('show_on_homepage');

        if ($request->hasFile('evidence_photo')) {
            if ($education->evidence_photo) {
                Storage::disk('public')->delete($education->evidence_photo);
            }
            $data['evidence_photo'] = $request->file('evidence_photo')->store('educations', 'public');
        }

        $education->update($data);

        return redirect()->route('admin.educations.index')->with('success', 'Pendidikan berhasil diperbarui.');
    }

    public function destroy(Education $education)
    {
        if ($education->evidence_photo) {
            Storage::disk('public')->delete($education->evidence_photo);
        }

        $education->delete();

        return back()->with('success', 'Pendidikan berhasil dihapus.');
    }
}
