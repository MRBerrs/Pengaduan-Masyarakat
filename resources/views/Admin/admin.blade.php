@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Admin Dashboard</h2>
    <div class="row">
        <!-- Example Card: Total Users -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalUsers ?? '0' }}</h5>
                </div>
            </div>
        </div>
        <!-- Example Card: Total Reports -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Reports</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalReports ?? '0' }}</h5>
                </div>
            </div>
        </div>
        <!-- Example Card: Pending Reports -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Pending Reports</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $pendingReports ?? '0' }}</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Reports Table -->
    <div class="card mt-4">
        <div class="card-header">Recent Reports</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Report Title</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentReports ?? [] as $report)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $report->user->name }}</td>
                        <td>{{ $report->title }}</td>
                        <td>{{ ucfirst($report->status) }}</td>
                        <td>{{ $report->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No recent reports found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection