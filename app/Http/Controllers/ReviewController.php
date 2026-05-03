<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function submit(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        Review::create([
            'name' => $data['name'],
            'role' => $data['role'] ?? 'Pengunjung',
            'message' => $data['message'],
            'rating' => $data['rating'],
            'approved' => false,
        ]);

        return back()->with('success', 'Review Anda sudah dikirim dan menunggu persetujuan admin.');
    }
}
