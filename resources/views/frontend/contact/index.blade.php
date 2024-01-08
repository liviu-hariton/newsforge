@extends('layouts.frontend')

@section('breadcrumbs')
    @breadcrumbs($breadcrumbs)
@endsection

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @if( session()->has('success') )
                    <div class="alert alert-success alert-dismissible fade show alert-styled-left alert-arrow-left alert-icon">
                        <i class="bi bi-check-square-fill"></i> {{ session('success') }}

                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                @endif

                <div class="row">
                    @include('frontend.contact.blocks.form')

                    @include('frontend.contact.blocks.methods')
                </div>
            </div>
        </div>
    </div>

    @include('frontend.contact.blocks.map')
@endsection
