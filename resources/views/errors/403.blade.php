@extends('layouts.frontend')

@section('content')
    <section class="error-404 section-padding">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="error-block ">
                        <div class="throw-code">
                            <h2>403</h2>
                        </div>
                        <div class="error-info">
                            <h2 class="mb-2">Forbidden!</h2>
                            <p class="mb-5">{{ __($exception->getMessage() ?: 'The request has been rejected because the client does not have rights to access the content') }}</p>
                            <a href="{{ route('home') }}">go back to Home <i class="fa fa-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="broken-img mt-5 mt-lg-0">
                        <img src="{{ asset('frontend/images/broken.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
