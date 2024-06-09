@extends('layouts.backend')

@section('page-title', 'My profile')

@section('main-content')
    <div class="row">
        <div class="col-xl-3">
            @include('backend.profile.blocks.menu')
        </div>
        <div class="col-xl-9">
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="mb-5"><i class="mdi mdi-account-box mr-1"></i> Public details</h2>
                </div>

                <div class="card-body">
                    @if(auth()->user()->adminProfile->public_avatar)
                    <div class="public-profile-preview">
                        <div class="media media-sm">
                            <div class="media-sm-wrapper">
                                <img src="{{ url('storage/'.auth()->user()->adminProfile->public_avatar) }}" alt="{{ auth()->user()->adminProfile->public_name }}">
                            </div>
                            <div class="media-body">
                                <span class="title h3">{{ auth()->user()->adminProfile->public_name }}</span>
                                <p>
                                    <i class="bi bi-phone-vibrate"></i> {{ auth()->user()->adminProfile->public_phone }} |
                                    <i class="bi bi-envelope-at-fill"></i> {{ auth()->user()->adminProfile->public_email }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('admin.profile.update') }}" method="post" name="f-save-personal" id="f-save-personal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="section" id="section" value="public" />

                        <div class="form-group row">
                            <label for="public_name" class="col-sm-3 col-form-label">Full name</label>
                            <div class="col-sm-5">
                                <input type="text" id="public_name" name="public_name" value="{{ old('public_name', $data->public_name ?? '') }}" class="form-control">

                                @error('public_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="public_phone" class="col-sm-3 col-form-label">Mobile phone number</label>
                            <div class="col-sm-5">
                                <input type="tel" id="public_phone" name="public_phone" value="{{ old('public_phone', $data->public_phone ?? '') }}" class="form-control">

                                @error('public_phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="public_email" class="col-sm-3 col-form-label">Email address</label>
                            <div class="col-sm-5">
                                <input type="email" id="public_email" name="public_email" value="{{ old('public_email', $data->public_email ?? '') }}" class="form-control">

                                @error('public_email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="public_avatar" class="col-sm-3 col-form-label">Avatar</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" name="public_avatar" id="public_avatar" class="custom-file-input">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>

                                @error('public_avatar')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-pill mr-2 mt-5">
                            Save <i class="fas fa-chevron-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
