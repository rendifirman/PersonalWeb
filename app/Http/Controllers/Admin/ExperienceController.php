<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Cloudinary\Api\Upload\UploadApi;

class ExperienceController extends Controller
{
    public function index()
    {
        return view('admin.experiences.index', [
            'experiences' => Experience::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.experiences.form', [
            'experience' => new Experience(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'period' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'evidence_photo' => ['nullable', 'image', 'max:2048'],
            'show_on_homepage' => ['nullable', 'boolean'],
        ]);

        $data['show_on_homepage'] = $request->boolean('show_on_homepage');

        if ($request->hasFile('evidence_photo')) {
            $uploadApi = new UploadApi();
            $result = $uploadApi->upload($request->file('evidence_photo')->getRealPath(), [
                'folder' => 'portfolio/experiences',
                'public_id' => 'exp_' . time() . '_' . uniqid(),
                'transformation' => [
                    ['width' => 800, 'height' => 600, 'crop' => 'limit'],
                ]
            ]);
            $data['evidence_photo'] = $result['secure_url'];
        }

        Experience::create($data);

        return redirect()->route('admin.experiences.index')->with('success', 'Pengalaman berhasil ditambahkan.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.form', [
            'experience' => $experience,
        ]);
    }

    public function update(Request $request, Experience $experience)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'period' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'evidence_photo' => ['nullable', 'image', 'max:2048'],
            'show_on_homepage' => ['nullable', 'boolean'],
        ]);

        $data['show_on_homepage'] = $request->boolean('show_on_homepage');

        if ($request->hasFile('evidence_photo')) {
            if ($experience->evidence_photo) {
                // Delete old image from Cloudinary if it's a Cloudinary URL
                if (str_contains($experience->evidence_photo, 'cloudinary')) {
                    $publicId = $this->extractPublicIdFromUrl($experience->evidence_photo);
                    if ($publicId) {
                        (new UploadApi())->destroy($publicId);
                    }
                }
            }
            $uploadApi = new UploadApi();
            $result = $uploadApi->upload($request->file('evidence_photo')->getRealPath(), [
                'folder' => 'portfolio/experiences',
                'public_id' => 'exp_' . time() . '_' . uniqid(),
                'transformation' => [
                    ['width' => 800, 'height' => 600, 'crop' => 'limit'],
                ]
            ]);
            $data['evidence_photo'] = $result['secure_url'];
        }

        $experience->update($data);

        return redirect()->route('admin.experiences.index')->with('success', 'Pengalaman berhasil diperbarui.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();

        return back()->with('success', 'Pengalaman berhasil dihapus.');
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
