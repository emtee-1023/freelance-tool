@extends('layouts.guest')

@section('title', 'Register')


@section('content')
    <main>
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
                                        <h5 class="card-title text-center pb-0 fs-4">Register a Freelancer</h5>
                                        <p class="text-center small">
                                            Enter the freelancer's details to create their account
                                        </p>
                                    </div>

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <!-- Name -->
                                        <div>
                                            <x-input-label for="name" :value="__('Name')" />
                                            <x-text-input id="name" class="block mt-1 w-full" type="text"
                                                name="name" :value="old('name')" required autofocus autocomplete="name" />
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>

                                        <!-- Email Address -->
                                        <div class="mt-4">
                                            <x-input-label for="email" :value="__('Email')" />
                                            <x-text-input id="email" class="block mt-1 w-full" type="email"
                                                name="email" :value="old('email')" required autocomplete="username" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        {{-- Phone Number --}}
                                        <div class="mt-4">
                                            <x-input-label for="phone" :value="__('Phone Number')" />
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroupPrepend">+254</span>
                                                <x-text-input id="phone" class="block w-full" type="tel"
                                                    name="phone_number" :value="old('phone_number')" required autocomplete="tel"
                                                    maxlength="9" placeholder="712345678" />
                                            </div>
                                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                                        </div>

                                        {{-- City And Country --}}
                                        <div class="mt-4 flex gap-5 justify-between">
                                            {{-- Country --}}
                                            <div>
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
                                                        ]; // Add more as needed
                                                    @endphp

                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country }}"
                                                            {{ $country == 'Kenya' ? 'selected' : '' }}>
                                                            {{ $country }}
                                                        </option>
                                                    @endforeach
                                                </x-select-input>
                                                <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                            </div>

                                            {{-- City --}}
                                            <div>
                                                <x-input-label for="city" :value="__('City')" />
                                                <x-text-input name="city" type="text" :value="old('city')"
                                                    autocomplete="home city"></x-text-input>
                                            </div>

                                        </div>

                                        <!-- Password -->
                                        <div class="mt-4">
                                            <x-input-label for="password" :value="__('Password')" />

                                            <x-text-input id="password" class="block mt-1 w-full" type="password"
                                                name="password" required autocomplete="new-password" />

                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mt-4">
                                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                type="password" name="password_confirmation" required
                                                autocomplete="new-password" />

                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                            <a class="small mb-0" href="{{ route('login') }}">
                                                {{ __('Already registered?') }}
                                            </a>

                                            <x-primary-button class="ml-4">
                                                {{-- <x-primary-button> --}}
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
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

@endsection
