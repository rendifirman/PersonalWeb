<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

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
            $uploadApi = new UploadApi();
            $result = $uploadApi->upload($request->file('evidence_photo')->getRealPath(), [
                'folder' => 'portfolio/educations',
                'public_id' => 'edu_' . time() . '_' . uniqid(),
                'transformation' => [
                    ['width' => 400, 'height' => 300, 'crop' => 'limit'],
                ]
            ]);
            $data['evidence_photo'] = $result['secure_url'];
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
                // Delete old image from Cloudinary if it's a Cloudinary URL
                if (str_contains($education->evidence_photo, 'cloudinary')) {
                    $publicId = $this->extractPublicIdFromUrl($education->evidence_photo);
                    if ($publicId) {
                        (new UploadApi())->destroy($publicId);
                    }
                }
            }
            $uploadApi = new UploadApi();
            $result = $uploadApi->upload($request->file('evidence_photo')->getRealPath(), [
                'folder' => 'portfolio/educations',
                'public_id' => 'edu_' . time() . '_' . uniqid(),
                'transformation' => [
                    ['width' => 400, 'height' => 300, 'crop' => 'limit'],
                ]
            ]);
            $data['evidence_photo'] = $result['secure_url'];
        }

        $education->update($data);

        return redirect()->route('admin.educations.index')->with('success', 'Pendidikan berhasil diperbarui.');
    }

    public function destroy(Education $education)
    {
        if ($education->evidence_photo) {
            // Delete image from Cloudinary if it's a Cloudinary URL
            if (str_contains($education->evidence_photo, 'cloudinary')) {
                $publicId = $this->extractPublicIdFromUrl($education->evidence_photo);
                if ($publicId) {
                    (new UploadApi())->destroy($publicId);
                }
            }
        }

        $education->delete();

        return back()->with('success', 'Pendidikan berhasil dihapus.');
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
