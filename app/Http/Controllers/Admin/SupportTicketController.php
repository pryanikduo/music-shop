<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.support-tickets.index', compact('tickets'));
    }

    public function show(SupportTicket $supportTicket)
    {
        return view('admin.support-tickets.show', compact('supportTicket'));
    }

    public function update(Request $request, SupportTicket $supportTicket)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,closed',
            'admin_reply' => 'nullable|string',
        ]);
        $supportTicket->update($validated);
        return redirect()->route('admin.support-tickets.index')->with('success', 'Тикет обновлён');
    }
}