<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        return view('admin.contact_messages.index', [
            'messages' => ContactMessage::latest()->get(),
        ]);
    }

    public function show(ContactMessage $message)
    {
        return view('admin.contact_messages.show', [
            'message' => $message,
        ]);
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return back()->with('success', 'Pesan kontak berhasil dihapus.');
    }
}
