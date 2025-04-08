@extends('layouts.guest')
@section('title', 'Add Fiverr Account')

@section('content')
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

                        {{-- <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">NiceAdmin</span>
                                </a>
                            </div><!-- End Logo --> --}}

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Add a Fiverr Account</h5>
                                    <p class="text-center small">
                                        Enter the Account's details to link an account
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('fiverr-accounts.store') }}">
                                    @csrf

                                    <!-- UserName -->
                                    <div>
                                        <x-input-label for="username" :value="__('Account UserName')" />
                                        <x-text-input id="username" class="block mt-1 w-full" type="text"
                                            name="username" :value="old('username')" required autofocus />
                                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                    </div>

                                    <!-- Link -->
                                    <div>
                                        <x-input-label for="link" :value="__('Account Link')" />
                                        <x-text-input id="link" class="block mt-1 w-full" type="text" name="link"
                                            :value="old('link')" required autofocus />
                                        <x-input-error :messages="$errors->get('link')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button class="ml-4">
                                            {{ __('Register') }}
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
@endsection
