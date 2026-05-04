<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use App\Models\Skill;
use Illuminate\Http\Request;

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
                $oldPath = public_path($settings->hero_photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('hero_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/homepage'), $filename);
            $data['hero_photo'] = 'images/homepage/' . $filename;
        }

        if ($request->hasFile('photo')) {
            if ($settings->photo) {
                $oldPath = public_path($settings->photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/homepage'), $filename);
            $data['photo'] = 'images/homepage/' . $filename;
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
}
