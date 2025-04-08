@extends('layouts.app')
@section('title', 'Tasks')

@section('content')
    <div class="d-flex justify-between">
        <div class="pagetitle">
            <h1>Tasks</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tasks</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div>
            <a href="/tasks/create" class="btn btn-primary">Add New</a>
        </div>
    </div>


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Showing all tasks</h5>

                        <!-- Table with stripped rows -->
                        <table id="datatablesSimple" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Assigned To</th>
                                    <th>Amount</th>
                                    <th>Freelancer Pay</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->description }}</td>
                                        <td>{{ optional($task->freelancer)->name ?? 'Not Assigned' }}</td>
                                        <td>{{ $task->amount }}</td>
                                        <td>{{ $task->freelancer_pay }}</td>
                                        <td>
                                            {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d/m/Y \a\t H:i:s') : 'N/A' }}
                                        </td>

                                        <td>
                                            @if ($task->status == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @elseif ($task->status == 'pending assignment')
                                                <span class="badge bg-warning">Pending Assignment</span>
                                            @elseif ($task->status == 'in progress')
                                                <span class="badge bg-info">In Progress</span>
                                            @else
                                                <span class="badge bg-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"href="{{ route('tasks.edit', $task->id) }}">Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
