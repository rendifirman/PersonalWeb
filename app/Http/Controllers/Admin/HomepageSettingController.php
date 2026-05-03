<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSetting;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
                Storage::disk('public')->delete($settings->hero_photo);
            }

            $data['hero_photo'] = $request->file('hero_photo')->store('homepage', 'public');
        }

        if ($request->hasFile('photo')) {
            if ($settings->photo) {
                Storage::disk('public')->delete($settings->photo);
            }

            $data['photo'] = $request->file('photo')->store('identity', 'public');
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
