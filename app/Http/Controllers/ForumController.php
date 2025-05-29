<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $query = Thread::where('is_hidden', false)->with('user', 'category', 'replies');
        $filter = $request->query('filter', 'recent');

        // New: Filter by category if provided
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($filter === 'viewed') {
            $query->orderBy('view_count', 'desc');
        } elseif ($filter === 'replies') {
            $query->orderBy('replies_count', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $threads = $query->withCount('replies')->paginate(10);

        $categories = Category::all();

        return view('forum.index', compact('threads', 'categories', 'filter'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('forum.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Thread::create([
            'user_id' => Auth::id(),
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        return redirect()->route('forum.index')->with('success', 'Thread created successfully.');
    }

    public function show(Thread $thread)
    {
        $thread->increment('view_count');
        $replies = $thread->replies()->where('is_hidden', false)->with('user')->get();
        return view('forum.show', compact('thread', 'replies'));
    }

    public function edit(Thread $thread)
    {
        $this->authorize('update', $thread);
        $categories = Category::all();
        return view('forum.edit', compact('thread', 'categories'));
    }

    public function update(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $thread->update($data);
        return redirect()->route('forum.show', $thread)->with('success', 'Thread updated successfully.');
    }

    public function destroy(Thread $thread)
    {
        $this->authorize('delete', $thread);
        $thread->delete();
        return redirect()->route('forum.index')->with('success', 'Thread deleted successfully.');
    }

    public function storeReply(Request $request, Thread $thread)
    {
        $data = $request->validate(['content' => 'required|string']);
        Reply::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'content' => $data['content'],
        ]);

        return redirect()->route('forum.show', $thread)->with('success', 'Reply posted successfully.');
    }

    public function editReply(Reply $reply)
    {
        $this->authorize('update', $reply);
        return view('forum.reply_edit', compact('reply'));
    }

    public function updateReply(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply);
        $data = $request->validate(['content' => 'required|string']);
        $reply->update($data);
        return redirect()->route('forum.show', $reply->thread)->with('success', 'Reply updated successfully.');
    }

    public function destroyReply(Reply $reply)
    {
        $this->authorize('delete', $reply);
        $reply->delete();
        return redirect()->route('forum.show', $reply->thread)->with('success', 'Reply deleted successfully.');
    }

    public function report(Request $request, Reply $reply)
    {
        $data = $request->validate(['reason' => 'required|string']);
        Report::create([
            'reply_id' => $reply->id,
            'user_id' => Auth::id(),
            'reason' => $data['reason'],
        ]);

        return redirect()->route('forum.show', $reply->thread)->with('success', 'Reply reported successfully.');
    }
}
