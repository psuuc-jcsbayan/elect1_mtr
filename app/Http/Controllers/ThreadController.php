<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        return view('threads.create', compact('categories')); // Pass to view
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required',
        ]);

        Thread::create([
            'user_id' => auth()->id(), // Ensure this is set
            'category_id' => $request->category_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('threads.index')->with('success', 'Thread created successfully!');
    }

    public function show(Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

    public function destroy(Thread $thread)
    {
        // Ensure only the owner can delete
        if (auth()->id() !== $thread->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $thread->delete();
        return redirect()->route('threads.index')->with('success', 'Thread deleted successfully!');
    }

    public function index(Request $request)
    {
        $category = $request->query('category'); // Get category from URL parameter

        // Fetch and filter threads if a category is selected
        $threads = Thread::when($category, function ($query) use ($category) {
            return $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        })->latest()->paginate(10);

        return view('threads.index', compact('threads', 'category'));
    }

    public function edit(Thread $thread)
    {
        // Ensure only the thread owner can edit
        if (auth()->id() !== $thread->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('threads.edit', compact('thread'));
    }

    public function update(Request $request, Thread $thread)
    {
        // Ensure only the thread owner can update
        if (auth()->id() !== $thread->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $thread->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('threads.show', $thread)->with('success', 'Thread updated successfully.');
    }
}
