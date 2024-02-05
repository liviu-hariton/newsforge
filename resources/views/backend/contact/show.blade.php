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
                    <div class="border rounded email-details">
                        <div class="email-details-header">
                            <h4 class="text-dark">{{ $contact->subject }}</h4>

                            <div class="labels" id="labels-{{ $contact->id }}">
                                @foreach($contact->labels as $label)
                                    @include('backend.contact.blocks.label', ['label' => $label])
                                @endforeach
                            </div>
                        </div>

                        <div class="email-details-content">
                            <div class="email-details-content-header">

                                <div class="media media-sm mb-lg-0">
                                    <div class="media-body">
                                        <h6 class="mt-0 text-dark font-weight-bold">{{ $contact->from_name }}</h6>
                                        <span>
                                          Email:
                                          <i class="mdi mdi-chevron-left"></i>{{ $contact->from_email }}
                                          <i class="mdi mdi-chevron-right"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="email-details-content-header-right">
                                    <time class="p-1 p-xl-2">{{ $contact->created_at->format('d M') }}</time>

                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a class="list-icons-item dropdown-toggle text-primary"
                                               data-toggle="dropdown" href="#"><i class="fas fa-ellipsis-v"></i></a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                @foreach($contact_labels as $contact_label)
                                                    @include('backend.contact.blocks.set-label', ['contact' => $contact, 'contact_label' => $contact_label])
                                                @endforeach
                                                <div class="dropdown-divider"></div>
                                                <a
                                                    class="dropdown-item text-danger tnr-xhr"
                                                    href="#"
                                                    data-id="{{ $contact->id }}"
                                                    data-popup="tooltip"
                                                    title="Delete"
                                                    data-call-method="click"
                                                    data-prevent
                                                    data-xhr="deleteContactForm"
                                                    data-route="{{ route('admin.contact.destroy', ['contact' => $contact, 'redirect' => true]) }}"
                                                    data-redirect="{{ route('admin.contact.index') }}"
                                                >
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {!! nl2br(cleanOutput($contact->message)) !!}

                            @if($contact->attachments)
                                <p class="pt-4 mt-4 border-top">
                                    <i class="fa fa-paperclip ml-2"></i>
                                    <span
                                        class="text-dark">{{ count($contact->attachments) }} {{ Str::plural('Attachment', count($contact->attachments)) }}</span>
                                </p>
                                <div
                                    class="email-img d-inline-block rounded overflow-hidden mt-3 mt-lg-4 mr-2 mr-md-3 mr-lg-4">
                                    <img src="images/products/pa1.jpg" alt="Product">
                                </div>
                                <div
                                    class="email-img d-inline-block rounded overflow-hidden mt-3 mt-lg-4 mr-2 mr-md-3 mr-lg-4">
                                    <img src="images/products/pa2.jpg" alt="Product">
                                </div>
                                <div
                                    class="email-img d-inline-block rounded overflow-hidden mt-3 mt-lg-4 mr-2 mr-md-3 mr-lg-4">
                                    <img src="images/products/pa3.jpg" alt="Product">
                                </div>
                                <div
                                    class="email-img d-inline-block rounded overflow-hidden mt-3 mt-lg-4 mr-2 mr-md-3 mr-lg-4">
                                    <img src="images/products/pa4.jpg" alt="Product">
                                </div>
                            @endif
                        </div>
                    </div>

                    <form class="email-compose mt-5">
                        <h5 class="text-primary">Reply</h5>

                        <div id="standalone" class="mt-5">
                            <div id="toolbar">
                                <span class="ql-formats">
                                    <select class="ql-font"></select>
                                    <select class="ql-size"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-bold"></button>
                                    <button class="ql-italic"></button>
                                    <button class="ql-underline"></button>
                                </span>
                                <span class="ql-formats">
                                    <select class="ql-color"></select>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-blockquote"></button>
                                </span>
                                <span class="ql-formats">
                                    <button class="ql-list" value="ordered"></button>
                                    <button class="ql-list" value="bullet"></button>
                                    <button class="ql-indent" value="-1"></button>
                                    <button class="ql-indent" value="+1"></button>
                                </span>
                                <span class="ql-formats">
                                    <select class="ql-align"></select>
                                </span>
                            </div>
                        </div>

                        <div id="editor"></div>

                        <div class="email-attachment mt-4 mb-3">
                            <i class="fa fa-paperclip fa-1x"></i>
                            <span class="text-dark d-inline-block font-weight-medium pl-2">Attachments</span>
                        </div>

                        <div class="custom-file">
                            <input type="file" name="attachments" id="attachments" multiple class="custom-file-input">
                            <label class="custom-file-label" for="customFile">Choose files</label>
                        </div>

                        <button class="btn btn-primary btn-pill mt-5" type="submit">Send reply</button>
                        <button class="btn btn-outline-smoke btn-pill mt-5" type="submit">Save draft</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
