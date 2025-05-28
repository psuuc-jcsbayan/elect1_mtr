<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Reply;
use App\Models\Report;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $threadsCount = Thread::count();
        $repliesCount = Reply::count();
        $usersCount = User::count();
        $reportsCount = Report::count();
        return view('admin.dashboard', compact('threadsCount', 'repliesCount', 'usersCount', 'reportsCount'));
    }

    public function reports(Request $request)
    {
        $query = Report::with('reply.thread', 'user');
        $filter = $request->query('filter', 'recent');

        if ($filter === 'viewed') {
            $query->whereHas('reply.thread', fn($q) => $q->orderBy('view_count', 'desc'));
        } elseif ($filter === 'replies') {
            $query->whereHas('reply.thread', fn($q) => $q->withCount('replies')->orderBy('replies_count', 'desc'));
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $reports = $query->paginate(10);
        return view('admin.reports', compact('reports', 'filter'));
    }

    public function hideReply(Reply $reply)
    {
        $reply->update(['is_hidden' => true]);
        return redirect()->route('admin.reports')->with('success', 'Reply hidden successfully.');
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|unique:categories|max:255']);
        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate(['name' => 'required|string|unique:categories,name,' . $category->id . '|max:255']);
        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}