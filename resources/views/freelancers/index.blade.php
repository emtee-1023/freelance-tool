@extends('layouts.app')
@section('title', 'Freelancers')

@section('content')
    <div class="d-flex justify-between">
        <div class="pagetitle">
            <h1>Freelancers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Freelancers</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div>
            <a href="/freelancers/create" class="btn btn-primary">Add New</a>
        </div>
    </div>


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Showing all Freelancers</h5>

                        <!-- Table with stripped rows -->
                        <table id="datatablesSimple" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($freelancers as $freelancer)
                                    <tr>
                                        <td>{{ $freelancer->name }}</td>
                                        <td>{{ $freelancer->email }}</td>
                                        <td>0{{ $freelancer->phone_number }}</td>
                                        <td>
                                            @if ($freelancer->tasks_in_progress_count > 0)
                                                <span class="badge bg-info p-2">
                                                    {{ $freelancer->tasks_in_progress_count }} task(s) in progress
                                                </span>
                                            @else
                                                <span class="badge bg-success p-2">Free</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a
                                                class="btn btn-primary btn-sm"href="{{ route('freelancers.edit', $freelancer->id) }}">Edit
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
