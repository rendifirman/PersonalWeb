<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

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
            $file = $request->file('evidence_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/educations'), $filename);
            $data['evidence_photo'] = 'images/educations/' . $filename;
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
                $oldPath = public_path($education->evidence_photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $file = $request->file('evidence_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/educations'), $filename);
            $data['evidence_photo'] = 'images/educations/' . $filename;
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
