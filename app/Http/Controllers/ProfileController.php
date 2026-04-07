<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updatePhotos(Request $request)
    {
        $request->validate([
            'photo_profil' => 'nullable|image|max:2048',
            'photo_couverture' => 'nullable|image|max:3072',
        ]);

        $user = auth()->user();

        if ($request->hasFile('photo_profil')) {
            if ($user->photo_profil) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->photo_profil);
            }
            $path = $request->file('photo_profil')->store('avatars', 'public');
            $user->update(['photo_profil' => $path]);
        }

        if ($request->hasFile('photo_couverture')) {
            if ($user->photo_couverture) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->photo_couverture);
            }
            $path = $request->file('photo_couverture')->store('covers', 'public');
            $user->update(['photo_couverture' => $path]);
        }

        return back()->with('success', 'Photos mises à jour avec succès !');
    }
}
