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
                    <h2 class="mb-5"><i class="mdi mdi-account-outline mr-1"></i> Personal details</h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="post" name="f-save-personal" id="f-save-personal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="section" id="section" value="personal" />

                        <div class="form-group row">
                            <label for="firstname" class="col-sm-3 col-form-label">Firstname</label>
                            <div class="col-sm-5">
                                <input type="text" id="firstname" name="firstname" value="{{ old('firstname', $data->firstname ?? '') }}" class="form-control">

                                @error('firstname')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-sm-3 col-form-label">Lastname</label>
                            <div class="col-sm-5">
                                <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $data->lastname ?? '') }}" class="form-control">

                                @error('lastname')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label">Mobile phone number</label>
                            <div class="col-sm-5">
                                <input type="tel" id="phone" name="phone" value="{{ old('phone', $data->phone ?? '') }}" class="form-control">

                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="avatar" class="col-sm-3 col-form-label">Avatar</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" name="avatar" id="avatar" class="custom-file-input">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
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
