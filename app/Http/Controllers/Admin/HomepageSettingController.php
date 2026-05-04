<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use App\Models\Skill;
use Illuminate\Http\Request;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class HomepageSettingController extends Controller
{
    public function edit()
    {
        return view('admin.homepage.edit', [
            'settings' => HomepageSetting::with('selectedSkills')->first(),
            'softSkills' => Skill::soft()->get(),
            'hardSkills' => Skill::hard()->get(),
        ]);
    }

    public function update(Request $request)
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
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['required', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string'],
            'cta_text' => ['nullable', 'string', 'max:100'],
            'hero_photo' => ['nullable', 'image', 'max:2048'],
            'name' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:255'],
            'about_title' => ['required', 'string', 'max:255'],
            'about_text' => ['nullable', 'string'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'twitter' => ['nullable', 'url', 'max:255'],
            'skill_ids' => ['nullable', 'array'],
            'skill_ids.*' => ['exists:skills,id'],
        ]);

        $settings = HomepageSetting::first() ?? new HomepageSetting();

        if ($request->hasFile('hero_photo')) {
            if ($settings->hero_photo) {
                // Delete old image from Cloudinary if it's a Cloudinary URL
                if (str_contains($settings->hero_photo, 'cloudinary')) {
                    $publicId = $this->extractPublicIdFromUrl($settings->hero_photo);
                    if ($publicId) {
                        (new UploadApi())->destroy($publicId);
                    }
                }
            }

            $uploadApi = new UploadApi();
            $result = $uploadApi->upload($request->file('hero_photo')->getRealPath(), [
                'folder' => 'portfolio/homepage',
                'public_id' => 'hero_' . time(),
                'transformation' => [
                    ['width' => 400, 'height' => 400, 'crop' => 'fill'],
                ]
            ]);
            $data['hero_photo'] = $result['secure_url'];
        }

        if ($request->hasFile('photo')) {
            if ($settings->photo) {
                // Delete old image from Cloudinary if it's a Cloudinary URL
                if (str_contains($settings->photo, 'cloudinary')) {
                    $publicId = $this->extractPublicIdFromUrl($settings->photo);
                    if ($publicId) {
                        (new UploadApi())->destroy($publicId);
                    }
                }
            }

            $uploadApi = new UploadApi();
            $result = $uploadApi->upload($request->file('photo')->getRealPath(), [
                'folder' => 'portfolio/homepage',
                'public_id' => 'profile_' . time(),
                'transformation' => [
                    ['width' => 200, 'height' => 200, 'crop' => 'fill'],
                ]
            ]);
            $data['photo'] = $result['secure_url'];
        }

        $settings->fill($data);
        $settings->save();

        if ($request->has('skill_ids')) {
            $settings->selectedSkills()->sync($request->skill_ids);
        } else {
            $settings->selectedSkills()->detach();
        }

        return back()->with('success', 'Master data homepage berhasil diperbarui.');
    }

    private function extractPublicIdFromUrl($url)
    {
        // Extract public_id from Cloudinary URL
        // URL format: https://res.cloudinary.com/{cloud_name}/image/upload/v{version}/{public_id}.{format}
        $pattern = '/\/upload\/(?:v\d+\/)?(.+)\.[a-zA-Z]+$/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
