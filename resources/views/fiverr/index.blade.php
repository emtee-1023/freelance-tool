@extends('layouts.app')
@section('title', 'Fiverr Accounts')

@section('content')
    <div class="d-flex justify-between">
        <div class="pagetitle">
            <h1>Fiverr Accounts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Fiverr Accounts</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div>
            <a href="/fiverr-accounts/create" class="btn btn-primary">Add New</a>
        </div>
    </div>


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Showing all accounts</h5>

                        <!-- Table with stripped rows -->
                        <table id="datatablesSimple" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>UserName</th>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $account->username }}</td>
                                        <td>
                                            <a href="{{ $account->link }}">{{ $account->link }}</a>
                                        </td>
                                        <td>
                                            @if ($account->tasks_in_progress_count > 0)
                                                <span class="badge bg-warning">
                                                    {{ $account->tasks_in_progress_count }} tasks(s) In Progress
                                                </span>
                                            @else
                                                <span class="badge bg-success">Free</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a
                                                class="btn btn-primary btn-sm"href="{{ route('fiverr-accounts.edit', $account->id) }}">Edit
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
