@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Report Management</h1>
        
        <div class="mb-3">
            <a href="{{ route('admin.reports', ['filter' => 'recent']) }}" class="btn btn-outline-primary">Recent</a>
            <a href="{{ route('admin.reports', ['filter' => 'viewed']) }}" class="btn btn-outline-primary">Most Viewed</a>
            <a href="{{ route('admin.reports', ['filter' => 'replies']) }}" class="btn btn-outline-primary">Most Replies</a>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Report ID</th>
                    <th>Thread</th>
                    <th>Reply</th>
                    <th>Reported By</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->reply->thread->title }}</td>
                        <td>{{ Str::limit($report->reply->content, 50) }}</td>
                        <td>{{ $report->user->name }}</td>
                        <td>{{ $report->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.reports.hide', $report->reply) }}" class="btn btn-danger btn-sm">Hide Reply</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $reports->links() }}
    </div>
@endsection