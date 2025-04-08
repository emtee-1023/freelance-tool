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
                                        <div class="col-5">
                                            <x-input-label for="description" :value="__('Description')" />
                                            <textarea id="description" class="block mt-1 w-full" name="description" required autofocus> </textarea>
                                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                        </div>

                                        <div class="col-5">
                                            <x-input-label for="assigned_to" :value="__('Assigned To')" />
                                            <x-select-input id="assigned_to" class="block mt-1 w-full" name="assigned_to"
                                                :value="old('assigned_to')" autofocus>

                                                <option value="" disabled selected>Select a freelancer</option>
                                                @foreach ($freelancers as $freelancer)
                                                    <option value="{{ $freelancer->id }}">
                                                        {{ $freelancer->name }}
                                                    </option>
                                                @endforeach
                                            </x-select-input>
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

                                    <div class="mt-4">
                                        <x-input-label for="deadline" :value="__('Deadline')" />
                                        <x-text-input id="deadline" class="block mt-1 w-full" type="datetime-local"
                                            name="deadline" :value="old('deadline')" required autofocus />
                                        <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
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
@endsection
