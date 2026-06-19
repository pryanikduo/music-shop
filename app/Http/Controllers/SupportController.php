<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function store($locale, Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $ticket = new SupportTicket();
        $ticket->user_id = Auth::id(); // может быть null для гостей
        $ticket->email = $validated['email'];
        $ticket->subject = $validated['subject'];
        $ticket->message = $validated['message'];
        $ticket->status = 'open';
        $ticket->save();

        return back()->with('success', 'Ваш запрос принят. Мы ответим вам в ближайшее время.');
    }
}