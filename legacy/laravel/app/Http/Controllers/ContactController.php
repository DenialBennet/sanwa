<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        $validated = $request->validated();

        // Simpan ke database (opsional, jika model & migration sudah dibuat)
        // ContactMessage::create($validated);

        // Contoh alternatif: kirim notifikasi email ke tim CS
        // Mail::to('cs@sanwaantarnusa.co.id')->send(new NewContactMessage($validated));

        return back()->with('success', 'Terima kasih! Pesan Anda telah kami terima, tim kami akan segera menghubungi Anda.');
    }
}
