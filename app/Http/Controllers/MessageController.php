<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Liste des conversations de l'utilisateur connecté
     */
    public function index()
    {
        $user = auth()->user();
        
        // Récupérer le dernier message de chaque conversation
        // On groupe par l'ID de l'autre personne
        $latestMessages = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $conversations = [];
        $processedUsers = [];

        foreach ($latestMessages as $message) {
            $otherId = ($message->sender_id == $user->id) ? $message->receiver_id : $message->sender_id;
            
            if (!isset($processedUsers[$otherId])) {
                $otherUser = User::find($otherId);
                if ($otherUser) {
                    $conversations[] = [
                        'user' => $otherUser,
                        'last_message' => $message,
                    ];
                    $processedUsers[$otherId] = true;
                }
            }
        }

        // Vue différente selon le rôle pour le layout
        $view = 'recruteur.messages.index';
        if ($user->role == 'academie') $view = 'academie.messages.index';
        if ($user->role == 'coach') $view = 'coach.messages.index';
        if ($user->role == 'joueur') $view = 'joueur.messages.index';

        return view($view, compact('conversations'));
    }

    /**
     * Affiche les messages avec un utilisateur spécifique
     */
    public function show($otherUserId)
    {
        $user = auth()->user();
        $otherUser = User::findOrFail($otherUserId);

        $messages = Message::where(function($q) use ($user, $otherUserId) {
                $q->where('sender_id', $user->id)->where('receiver_id', $otherUserId);
            })->orWhere(function($q) use ($user, $otherUserId) {
                $q->where('sender_id', $otherUserId)->where('receiver_id', $user->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Marquer comme lu
        Message::where('sender_id', $otherUserId)
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json([
            'messages' => $messages,
            'other_user' => $otherUser
        ]);
    }

    /**
     * Envoie un message
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
            'subject' => 'nullable|string|max:255'
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'subject' => $request->subject ?? 'Sans sujet',
            'content' => $request->content,
            'is_read' => false
        ]);

        if ($request->ajax()) {
            return response()->json($message);
        }

        return back()->with('success', 'Message envoyé !');
    }
}
