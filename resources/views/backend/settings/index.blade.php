@extends('layouts.backend')

@section('page-title', 'Settings')

@section('main-content')
    <div class="card card-default text-dark">
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-solid-custom bg-primary mb-3">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#contact"><i class="bi bi-envelope"></i> Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#fiscal"><i class="bi bi-bank2"></i> Banking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#social"><i class="bi bi-share-fill"></i> Social</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#mailing"><i class="bi bi-envelope-arrow-up-fill"></i> Mailing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#other"><i class="bi bi-gear-wide-connected"></i> Other settings</a>
                </li>
            </ul>
            <div class="tab-content mt-5">
                <div class="tab-pane fade show active" id="contact">
                    @include('backend.settings.sections.contact')
                </div>
                <div class="tab-pane fade" id="fiscal">
                    <p>Banking</p>
                </div>
                <div class="tab-pane fade" id="social">
                    @include('backend.settings.sections.social')
                </div>
                <div class="tab-pane fade" id="mailing">
                    @include('backend.settings.sections.mailing')
                </div>
                <div class="tab-pane fade" id="other">
                    @include('backend.settings.sections.other')
                </div>
            </div>
        </div>
    </div>
@endsection
