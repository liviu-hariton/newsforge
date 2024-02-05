@extends('layouts.backend')

@section('page-title', 'Contacts')

@section('main-content')
    <div class="email-wrapper rounded border bg-white">
        <div class="row no-gutters justify-content-center">
            <div class="col-lg-4 col-xl-3 col-xxl-2">
                @include('backend.contact.blocks.menu')
            </div>
            <div class="col-lg-8 col-xl-9 col-xxl-10">
                <div class="email-right-column p-4 p-xl-5">
                    <div class="email-right-header mb-5">
                        <div class="head-left-options">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">Select All</label>
                            </div>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle border rounded-pill" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start"
                                     style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <div class="dropdown-submenu">
                                        <a href="#" class="dropdown-item">Set label</a>
                                        <div class="dropdown-menu">
                                            @foreach($contact_labels as $contact_label)
                                            <a href="#" class="dropdown-item"><i class="mdi mdi-checkbox-blank-circle-outline mr-3" style="color: {{ $contact_label->color }};"></i> {{ $contact_label->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#"><i class="fas fa-trash-alt"></i> Delete</a>
                                </div>
                            </div>
                        </div>

                        <div class="head-right-options">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @if($contacts->currentPage() > 1)
                                <a href="{{ $contacts->previousPageUrl() }}" data-popup="tooltip" title="Previous page" class="btn border btn-pill">
                                    <i class="mdi mdi-chevron-left"></i>
                                </a>
                                @endif
                                @if($contacts->hasMorePages())
                                <a href="{{ $contacts->nextPageUrl() }}" data-popup="tooltip" title="Next page" class="btn border btn-pill">
                                    <i class="mdi mdi-chevron-right"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="border border-top-0 rounded table-responsive email-list">
                        <table class="table mb-0 table-email table-hover">
                            <tbody>
                                @foreach($contacts as $contact)
                                    @include('backend.contact.blocks.listing-item', ['data' => $contact])
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-5">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
