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
                    <h2 class="mb-5"><i class="mdi mdi-cogs mr-1"></i> Preferences</h2>
                </div>

                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
@endsection
