<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Thread $thread) 
    {
        \Log::info('Reply Request:', ['method' => $request->method(), 'data' => $request->all()]);
        
        if ($request->method() !== 'POST') {
            return response()->json(['error' => 'Only POST requests are allowed'], 405);
        }

        $request->validate(['body' => 'required']);

        auth()->user()->replies()->create([
            'body' => $request->body,
            'thread_id' => $thread->id
        ]);

        return redirect()->route('threads.show', $thread)->with('success', 'Reply posted successfully!');
    }

    public function destroy(Reply $reply)
    {
        // Only allow the reply owner or the thread owner to delete it
        if (auth()->id() !== $reply->user_id && auth()->id() !== $reply->thread->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $reply->delete();
        return back()->with('success', 'Reply deleted successfully!');
    }

    public function edit(Reply $reply)
    {
        // Allow reply owner or thread owner to edit
        if (auth()->id() !== $reply->user_id && auth()->id() !== $reply->thread->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('replies.edit', compact('reply'));
    }

    public function update(Request $request, Reply $reply)
    {
        // Ensure only the reply owner or thread owner can update
        if (auth()->id() !== $reply->user_id && auth()->id() !== $reply->thread->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'body' => 'required|string',
        ]);

        $reply->update([
            'body' => $request->body,
        ]);

        return redirect()->route('threads.show', $reply->thread)->with('success', 'Reply updated successfully.');
    }
}
