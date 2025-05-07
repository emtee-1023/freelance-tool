@extends('layouts.app')
@section('title', 'Clients')

@section('content')
    <div class="d-flex justify-between">
        <div class="pagetitle">
            <h1>Clients</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Freelancers</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div>
            <a href="{{ route('clients.create') }}" class="btn btn-primary">Add New</a>
        </div>
    </div>


    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Showing all Clients</h5>

                        <!-- Table with stripped rows -->
                        <table id="datatablesSimple" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}</td>
                                        <td>
                                            <a
                                                class="btn btn-primary btn-sm"href="{{ route('clients.edit', $client->id) }}">Edit
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
