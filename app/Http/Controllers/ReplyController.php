<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Thread $thread)
    {
        $data = $request->validate(['body' => 'required']);
        Reply::create([
            'thread_id' => $thread->id,
            'user_id' => auth()->id(),
            'body' => $data['body'],
        ]);
        return redirect()->route('threads.show', $thread)->with('success', 'Reply added!');
    }

    public function edit(Reply $reply)
    {
        $this->authorize('update', $reply);
        return view('forum.replies.edit', compact('reply'));
    }

    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply);
        $data = $request->validate(['body' => 'required']);
        $reply->update($data);
        return redirect()->route('threads.show', $reply->thread)->with('success', 'Reply updated!');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);
        $reply->delete();
        return redirect()->route('threads.show', $reply->thread)->with('success', 'Reply deleted!');
    }
}