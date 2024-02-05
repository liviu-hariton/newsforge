@extends('layouts.backend')

@section('page-title', 'Contacts')

@section('main-content')
    <div class="email-wrapper rounded border bg-white">
        <div class="row no-gutters justify-content-center">
            <div class="col-lg-4 col-xl-3 col-xxl-2">
                @include('backend.contact.blocks.menu')
            </div>
            <div class="col-lg-8 col-xl-9 col-xxl-10">
                <div class="email-right-column p-4">
                    <div class="border border-top-0 rounded table-responsive email-list">
                        <table class="table mb-0 table-email table-hover" id="contacts-bulk-set">
                            <tbody>
                                @include('backend.contact.blocks.listing-actions')

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
