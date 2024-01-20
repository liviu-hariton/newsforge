@extends('layouts.frontend')

@section('breadcrumbs')
    @breadcrumbs($breadcrumbs)
@endsection

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    @include('frontend.contact.blocks.form')

                    @include('frontend.contact.blocks.methods')
                </div>
            </div>
        </div>
    </div>

    @include('frontend.contact.blocks.map')
@endsection
