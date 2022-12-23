@extends('user.layouts.master')

@section('title','Contact')

@section('content')

        <!-- Contact Start -->
        <div class="container-fluid">
            <h2 class="text-center text-secondary mb-3">Contact Us</h2>
                @if (session('successContact'))
                <div class="row">
                    <div class="col-10 offset-1">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('successContact') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    </div>
                </div>
                @endif
            <div class="row px-xl-5">
                <div class="col-lg-10 offset-1 mb-5">
                    <div class="contact-form bg-light p-30">
                        <form action="{{ route('user#sendContact') }}" method="POST" novalidate="novalidate">
                            @csrf
                            <div class="control-group mb-4">
                                <input name="name" type="text" class="form-control" id="name" placeholder="Your Name" value="{{ old('name') }}"/>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="control-group mb-4">
                                <input name="email" type="email" class="form-control" id="email" placeholder="Your Email" value="{{ old('name') }}" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="control-group mb-4">
                                <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject" value="{{ old('name') }}"/>
                                @error('subject')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="control-group mb-4">
                                <textarea name="message" class="form-control" rows="8" id="message" placeholder="Message">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <input type="checkbox" name="terms" id="" style="cursor: pointer;"><span class="ps-2">I agree to the terms and conditions</span><br>
                                @error('terms')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-grid mt-4">
                                <button class="btn btn-outline-primary py-2 px-4" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->

@endsection
