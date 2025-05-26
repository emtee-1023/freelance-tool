@extends('layouts.guest')
@section('title', 'Add a Task')

@section('content')
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">

                        {{-- <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">NiceAdmin</span>
                                </a>
                            </div><!-- End Logo --> --}}

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Add a Task</h5>
                                    <p class="text-center small">
                                        Enter the task details
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('tasks.store') }}">
                                    @csrf

                                    <div class="d-flex flex-row justify-between mt-4">
                                        <div class="col-12">
                                            <x-input-label for="description" :value="__('Description')" />
                                            <textarea rows="4" id="description" class="block mt-1 w-full" name="description" required autofocus> </textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row justify-between mt-4">
                                        <div class="col-5">
                                            <x-input-label for="assigned_to" :value="__('Assigned To')" />
                                            <x-select-input id="assigned_to" class="select2 mt-1 w-full" name="assigned_to"
                                                :value="old('assigned_to')" autofocus>

                                                <option value="" disabled selected>Select a freelancer</option>
                                                @foreach ($freelancers as $freelancer)
                                                    <option value="{{ $freelancer->id }}">
                                                        {{ $freelancer->name }}
                                                    </option>
                                                @endforeach
                                            </x-select-input>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addFreelancerModal"
                                                class="btn btn-sm btn-outline-primary mt-2">
                                                + Add New Freelancer
                                            </a>

                                            <x-input-error :messages="$errors->get('assigned_to')" class="mt-2" />
                                        </div>

                                        <div class="col-5">
                                            <x-input-label for="client" :value="__('Client')" />
                                            <x-select-input id="client" class="select2 mt-1 w-full" name="client_id"
                                                :value="old('client_id')" autofocus>

                                                <option value="" disabled selected>Select a client</option>
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client->id }}">
                                                        {{ $client->name }}
                                                    </option>
                                                @endforeach
                                            </x-select-input>
                                            <!-- Button to open Client modal -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addClientModal"
                                                class="btn btn-sm btn-outline-primary mt-2">
                                                + Add New Client
                                            </a>
                                            <x-input-error :messages="$errors->get('assigned_to')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row justify-between mt-4">
                                        <div class="col-5">
                                            <x-input-label for="amount" :value="__('Amount')" />
                                            <div class="mt-1 input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">Kes</span>
                                                <x-text-input id="amount" type="number" name="amount" :value="old('amount')"
                                                    required autofocus />
                                            </div>
                                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                                        </div>

                                        <div class="col-5">
                                            <x-input-label for="freelancer_pay" :value="__('Freelancer Pay')" />
                                            <div class="mt-1 input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">Kes</span>
                                                <x-text-input id="freelancer_pay" type="number" name="freelancer_pay"
                                                    :value="old('freelancer_pay')" required autofocus />
                                            </div>
                                            <x-input-error :messages="$errors->get('freelancer_pay')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row justify-between mt-4">

                                        <div class="col-5">
                                            <x-input-label for="fiverr_account" :value="__('Fiverr Account')" />
                                            <x-select-input id="fiverr_account" class="select2 mt-1 w-full"
                                                name="fiverr_account" :value="old('fiverr_account')" autofocus>
                                                <option value="" disabled selected>Select a fiverr account</option>
                                                @foreach ($fiverrAccounts as $fiverrAccount)
                                                    <option value="{{ $fiverrAccount->id }}">
                                                        {{ $fiverrAccount->username }}
                                                    </option>
                                                @endforeach
                                            </x-select-input>
                                            <!-- Button to open Fiverr Account modal -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#addFiverrModal"
                                                class="btn btn-sm btn-outline-primary mt-2">
                                                + Add New Fiverr Account
                                            </a>
                                            <x-input-error :messages="$errors->get('fiverr_account')" class="mt-2" />
                                        </div>

                                        <div class="col-5">
                                            <x-input-label for="deadline" :value="__('Deadline')" />
                                            <x-text-input id="deadline" class="block mt-1 w-full" type="datetime-local"
                                                name="deadline" :value="old('deadline')" required autofocus />
                                            <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="ml-4">
                                            {{-- <x-primary-button> --}}
                                            {{ __('Add Task') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Freelancer Modal --}}
    <div class="modal fade" id="addFreelancerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="freelancerForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Freelancer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        {{-- Name --}}
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <span class="text-danger error-text" id="error-name"></span>

                        </div>

                        {{-- Email --}}
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <span class="text-danger error-text" id="error-email"></span>

                        </div>

                        {{-- Phone Number --}}
                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('Phone Number')" />
                            <div class="input-group">
                                <span class="input-group-text">+254</span>
                                <x-text-input id="phone" class="block w-full" type="tel" name="phone_number"
                                    required maxlength="9" placeholder="712345678" />
                            </div>
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            <span class="text-danger error-text" id="error-phone_number"></span>

                        </div>

                        {{-- Country and City --}}
                        <div class="mt-4 flex gap-5 justify-between">
                            {{-- Country --}}
                            <div class="w-1/2">
                                <x-input-label for="country" :value="__('Country')" />
                                <x-select-input name="country">
                                    @php
                                        $countries = [
                                            'Kenya',
                                            'Uganda',
                                            'Tanzania',
                                            'Rwanda',
                                            'Nigeria',
                                            'South Africa',
                                            'United States',
                                            'United Kingdom',
                                            'India',
                                        ];
                                    @endphp
                                    @foreach ($countries as $country)
                                        <option value="{{ $country }}" {{ $country == 'Kenya' ? 'selected' : '' }}>
                                            {{ $country }}
                                        </option>
                                    @endforeach
                                </x-select-input>
                                <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                <span class="text-sm text-red-600 error-text" id="error-country"></span>
                            </div>

                            {{-- City --}}
                            <div class="w-1/2">
                                <x-input-label for="city" :value="__('City')" />
                                <x-text-input name="city" type="text" :value="old('city')"
                                    autocomplete="home city"></x-text-input>
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                <span class="text-sm text-red-600 error-text" id="error-city"></span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Freelancer</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    {{-- Client Modal --}}
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="clientForm" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Add New Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div>
                        <x-input-label for="client-name" :value="__('Name')" />
                        <x-text-input id="client-name" class="block mt-1 w-full" type="text" name="name" required
                            autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <span class="text-danger error-text" id="error-name"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Fiverr Account Modal --}}
    <div class="modal fade" id="addFiverrModal" tabindex="-1" aria-labelledby="addFiverrModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="fiverrForm" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addFiverrModalLabel">Add New Fiverr Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div>
                        <x-input-label for="username" :value="__('Account UserName')" />
                        <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" required
                            autofocus />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        <span class="text-danger error-text" id="error-username"></span>
                    </div>

                    <div class="mt-3">
                        <x-input-label for="link" :value="__('Account Link')" />
                        <x-text-input id="link" class="block mt-1 w-full" type="text" name="link" required />
                        <x-input-error :messages="$errors->get('link')" class="mt-2" />
                        <span class="text-danger error-text" id="error-link"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
