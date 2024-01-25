// Function to handle and remember tab clicks and manage active tabs
function handleTabClick(e) {
    const clickedTabId = $(this).attr('href');
    let activeTabs = localStorage.getItem('active_tab') ? localStorage.getItem('active_tab').split(',') : [];
    const sameLevelTabs = $(e.target).parents('.nav-tabs').find('[data-toggle="pill"]');

    sameLevelTabs.each(function (index, element) {
        const tabId = $(element).attr('href');

        // Remove inactive tabs from the list of active tabs
        if (clickedTabId !== tabId && activeTabs.includes(tabId)) {
            activeTabs = activeTabs.filter(activeTab => activeTab !== tabId);
        }
    });

    // Add the clicked tab to the list of active tabs if not present
    if (!activeTabs.includes($(e.target).attr('href'))) {
        activeTabs.push($(e.target).attr('href'));
    }

    // Update local storage with the new list of active tabs
    localStorage.setItem('active_tab', activeTabs.join(','));
}

// Event handler for clicks on anchor elements with data-toggle attribute set to "pill"
$('a[data-toggle="pill"]').on('click', handleTabClick);

// Show active tabs on page load
const activeTabs = localStorage.getItem('active_tab') ? localStorage.getItem('active_tab').split(',') : [];

if (activeTabs.length > 0) {
    activeTabs.forEach(tab => {
        $('[data-toggle="pill"][href="' + tab + '"]').tab('show');
    });
}

function iconFormat(icon) {
    if(!icon.id) {
        return icon.text;
    }

    return '<i class="' + $(icon.element).data('icon') + ' mr-2"></i>' + icon.text;
}

function showTab(tab) {
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
}

var _last_focused_field;

var Tnr = function () {
    const layoutInteractions = function() {
        const icon_select2 = function() {
            if (!$().select2) {
                console.warn('Warning - select2.js is not loaded.');
                return;
            }

            $('.select-icons').select2({
                language: _locale,
                templateResult: iconFormat,
                minimumResultsForSearch: Infinity,
                templateSelection: iconFormat,
                escapeMarkup: function(m) {
                    return m;
                }
            });
        }

        icon_select2();

        const select2_list = function() {
            if (!$().select2) {
                console.warn('Warning - select2.js is not loaded.');
                return;
            }

            $('.select2list').each(function(e){
                $(this).select2({
                    language: _locale
                });
            });

            $('.select2-search-modal').each(function(e){
                var _dropdown_parent = $(this).data('modal_parent');

                $(this).select2({
                    language: _locale,
                    dropdownParent: $('#' + _dropdown_parent)
                });
            });
        }

        select2_list();

        const toggle_inline_edit = function() {
            $(".tnr-show-inline-edits").each(function() {
                $(this).on("mouseover", function(){
                    $(this).find('.inline-edit-trigger').each(function() {
                        $(this).removeClass("d-none");
                    });
                });

                $(this).on("mouseout", function(){
                    $(this).find('.inline-edit-trigger').each(function() {
                        $(this).addClass("d-none");
                    });
                });
            });
        };

        toggle_inline_edit();

        const inline_edit = function() {
            $(".tnr-inline-edit").each(function() {
                $(this).on("click", function(e){
                    e.stopPropagation();
                    e.preventDefault();

                    const _target = $(this).data('target');
                    const _route = $(_target).data('route');
                    const _target_err = $(_target).data('error-msg');
                    const _target_validation = $(_target).data('validation-type');
                    const _check_exists = $(_target).data('check-exists');
                    const _model = $(_target).data('model');

                    $(_target).editable({
                        ajaxOptions: {
                            type: 'PUT'
                        },
                        url: _route,
                        error: function(response) {
                            if(response.status === 500) {
                                toastr.warning('Service unavailable. Please try later.');
                            } else {
                                toastr.warning(response.responseJSON.message);
                            }
                        },
                        success: function(data) {
                            if(data.status === 'success') {
                                toastr.success(data.message);
                            } else {
                                toastr.warning(data.message);
                            }
                        },
                        params: function(params) {
                            let data = {};

                            data['id'] = params.pk;
                            data['field'] = params.name;
                            data['value'] = params.value;
                            data['model'] = _model;
                            data['check_exists'] = _check_exists;

                            return data;
                        },
                        clear: false,
                        validate: function(value) {
                            if(_target_validation === 'required') {
                                if(value === '') {
                                    return _target_err;
                                }
                            }
                        }
                    }).editable('toggle');
                });
            });
        };

        inline_edit();

        const ays = function() {
            if(!$().areYouSure) {
                console.warn('Warning - jquery.are-you-sure.js is not loaded.');
                return;
            }

            const $tnrAys = $(".tnr-ays");

            if($tnrAys.length) {
                $tnrAys.each(function() {
                    $(this).areYouSure({
                        'message': 'You have not saved the data from the form. Are you sure you want to reload the page?'
                    });
                });
            }
        };

        ays();

        const togle_target_element = function() {
            $(".tnr-target-toggler").each(function(index) {
                $(this).on("click", function(e){
                    const _target_element = $(this).data('tnr-toggle-target');
                    const _data_prevent = $(this).data('prevent');

                    if(_data_prevent !== undefined) {
                        e.preventDefault();
                    }

                    if($("#" + _target_element).length) {
                        if($("#" + _target_element).hasClass("d-none")) {
                            $("#" + _target_element).removeClass("d-none");
                        } else {
                            $("#" + _target_element).addClass("d-none");
                        }
                    } else {
                        if($("." + _target_element).hasClass("d-none")) {
                            $("." + _target_element).removeClass("d-none");
                        } else {
                            $("." + _target_element).addClass("d-none");
                        }
                    }
                });
            });
        };

        togle_target_element();

        const show_hide_alternate = function() {
            const $tnrToggleAlternate = $(".tnr-toggle-alternate");

            if($tnrToggleAlternate.length) {
                $tnrToggleAlternate.on("click", function(){
                    if($(this).data('alternate-1') !== '') {
                        const $_alternate_1 = $("#" + $(this).data('alternate-1'));

                        if($_alternate_1.hasClass("d-none")) {
                            $_alternate_1.removeClass("d-none");
                        } else {
                            $_alternate_1.addClass("d-none");
                        }
                    }

                    if($(this).data('alternate-2') !== '') {
                        const $_alternate_2 = $("#" + $(this).data('alternate-2'));

                        if($_alternate_2.hasClass("d-none")) {
                            $_alternate_2.removeClass("d-none");
                        } else {
                            $_alternate_2.addClass("d-none");
                        }
                    }
                });
            }
        }

        show_hide_alternate();

        const countBulkSelected = function(set) {
            let _items_count = 0;

            $(set).each(function() {
                if($(this).prop('checked')) {
                    _items_count++;
                }
            });

            return _items_count;
        }

        const bulk_select = function() {
            const $tnrBulkSelect = $(".tnr-bulk-select");

            if($tnrBulkSelect.length) {
                const _table = $tnrBulkSelect.data('table');

                $(_table).find('.tnr-bulk-select').change(function () {
                    const set = $(this).data("set");
                    const bulk_actions = $(this).data("bulk-actions");
                    const checked = $(this).is(":checked");

                    $(set).each(function () {
                        if(checked) {
                            $(this).prop("checked", true);
                        } else {
                            $(this).prop("checked", false);
                        }
                    });

                    const _count = countBulkSelected(set);

                    $("#tnr-bulk-count").html(_count);

                    if(_count > 0) {
                        $(bulk_actions).slideDown(500);
                    } else {
                        $(bulk_actions).slideUp(500);
                    }
                });

                $(".tnr-bulk-item").click(function() {
                    const _count = countBulkSelected(".tnr-bulk-item");

                    $("#tnr-bulk-count").html(_count);

                    if(_count > 0) {
                        $('.bulk-actions').slideDown(500);
                    } else {
                        $('.bulk-actions').slideUp(500);
                    }
                });
            }
        }

        bulk_select();

        const insert_at_cursor = function() {
            $(".tnr-insert-at-cursor").each(function(index) {
                $(this).on("click", function(e){
                    const _data_content = $(this).data('content');
                    const _data_prevent = $(this).data('prevent');

                    if(_data_prevent !== undefined) {
                        e.preventDefault();
                    }

                    // Insert the content at the cursor position
                    if(_last_focused_field) {
                        // Get the current value of the last focused field
                        const _last_focused_field_val = $(_last_focused_field).val();

                        // Get the start and end positions of the selection within the last focused field
                        const _last_focused_field_start = _last_focused_field.selectionStart;
                        const _last_focused_field_end = _last_focused_field.selectionEnd;

                        // Create a new value by combining content before, new content, and content after the selection
                        const _new_val = _last_focused_field_val.substring(0, _last_focused_field_start)
                            + _data_content
                            + _last_focused_field_val.substring(_last_focused_field_end);

                        // Update the value of the last focused field with the newly created value
                        $(_last_focused_field).val(_new_val);

                        // Set the focus back to the last focused field
                        $(_last_focused_field).focus();
                    }
                });
            });
        };

        insert_at_cursor();

        const prevent_default = function() {
            $(".prevent-default").each(function(index) {
                $(this).on("click", function(e){
                    e.preventDefault();
                });
            });
        }

        prevent_default();

        const file_input = function() {
            if(!bsCustomFileInput) {
                console.warn('Warning - bs-custom-file-input.min.js is not loaded.');
                return;
            }

            bsCustomFileInput.init();
        };

        file_input();
    }

    const sortables = function() {
        if(typeof dragula == 'undefined') {
            console.warn('Warning - dragula.min.js is not loaded.');
            return;
        }

        let sortOrder = function(value, index, array) {
            const _sortable_el = $('.' + value);

            if(_sortable_el.length) {
                const containers = _sortable_el.toArray();
                const _obj = $("#" + value);

                let drake = dragula(containers, {
                    mirrorContainer: document.querySelector('.' + value),
                    moves: function (el, container, handle) {
                        return handle.classList.contains('tnr-sort-handle');
                    }
                });

                drake.on('drop', function() {
                    let _new_order = [];

                    _obj.children().each(function() {
                        _new_order.push($(this).data("entry-id"));
                    });

                    _tnr_xhr['setSortOrder'](_new_order, _obj);
                });
            }
        };

        const _sortables = ['contact-methods-sortable', 'contact-fields-sortable'];

        _sortables.forEach(sortOrder);
    }

    const xhrCalls = function() {
        const xhrCall = function() {
            $(".tnr-xhr").each(function() {
                let _call_method = $(this).data('call-method');

                $(this).on(_call_method, function(e){
                    let _xhr_call = $(this).data('xhr');
                    const _data_prevent = $(this).data('prevent');

                    if(_data_prevent !== undefined) {
                        e.preventDefault();
                    }

                    _tnr_xhr[_xhr_call]($(this));
                });
            });
        };

        xhrCall();
    };

    return {
        initLayoutInteractions: function() {
            layoutInteractions();
            sortables();
            xhrCalls();
        },

        initCore: function() {
            Tnr.initLayoutInteractions();
        },

        block: function(css_class = 'content-inner') {
            let _el = $('.' + css_class);

            const _dirty_form = $('body').find('.dirty').length;

            if(parseInt(_dirty_form) === 0) {
                $(_el).block({
                    message: '<span class="font-weight-bold"><i class="fas fa-spinner fa-spin mr-2"></i>&nbsp; Processing</span>',
                    overlayCSS: {
                        backgroundColor: '#1b2024',
                        opacity: 0.6,
                        cursor: 'wait'
                    },
                    centerY: 0,
                    css: {
                        border: 0,
                        padding: '10px 15px',
                        color: '#fff',
                        width: 'auto',
                        '-webkit-border-radius': 3,
                        '-moz-border-radius': 3,
                        backgroundColor: '#333'
                    },
                    onBlock: function() {
                        $(_el).css({
                            left: 0
                        });
                    }
                });
            }
        },

        unblock: function(css_class = 'content-inner') {
            let _el = $('.' + css_class);

            $(_el).unblock();
        },

        inlineStatus: function(type, element) {
            var _working = '<span class="text-info"><i class="font-weight-bold fas fa-spinner fa-spin ml-2"></i> Processing...</span>';
            var _finished = '<span class="text-success"><i class="font-weight-bold bi bi-check-circle ml-2"></i> Saved!</span>';


            if(type === 'working') {
                $("." + element + "_status").html(_working);
            }

            if(type === 'finished') {
                $("." + element + "_status").html(_finished);
            }
        },

        inlineStatusIcon: function(type, element) {
            var _working = '<span class="text-info"><i class="font-weight-bold fas fa-spinner fa-spin ml-2"></i></span>';
            var _finished = '<span class="text-success"><i class="font-weight-bold bi bi-check-circle ml-2"></i></span>';


            if(type === 'working') {
                $("." + element + "_status").html(_working);
            }

            if(type === 'finished') {
                $("." + element + "_status").html(_finished);
            }
        },

        remove: function(obj) {
            $(obj).animate({opacity: '0'}, 150, function(){
                $(obj).animate({height: '0px'}, 150, function(){
                    $(obj).remove();
                });
            });
        },

        getUrlParams: function(param) {
            // https://stackoverflow.com/questions/19491336/get-url-parameter-jquery-or-how-to-get-query-string-values-in-js
            return (window.location.search.match(new RegExp('[?&]' + param + '=([^&]+)')) || [undefined, null])[1];
        },

        errorAlert: function(title, message) {
            toastr.options = {
                positionClass: "toast-top-full-width",
                progressBar: true,
                timeOut: 7000,
                closeButton: true,
            };

            toastr.error(title, message);
        },

        setFieldMaxLength: function(value) {
            // Show max length field only if the field type is
            // "Text" (1), "Number" (5), "Phone" (8), "Password" (11) or "Textarea" (12)
            if($.inArray(value, ['1', '5', '8', '11', '12']) > -1) {
                $("#max-length-container").removeClass("d-none");
                $("#min-length-container").removeClass("d-none");
            } else {
                $("#max-length-container").addClass("d-none");
                $("#min-length-container").addClass("d-none");
            }

            // Show extensions field only if the field type is "File" (10)
            if(value === '10') {
                $("#extensions-container").removeClass("d-none");
            } else {
                $("#extensions-container").addClass("d-none");
            }

            // Show options field only if the field type is "Checkbox" (13), "Radio" (14) or "Select" (15)
            if($.inArray(value, ['13', '14', '15']) > -1) {
                $("#input-options-container").removeClass("d-none");
            } else {
                $("#input-options-container").addClass("d-none");
            }
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    // Keep track of the last focused element
    $('input[type="text"], textarea').focus(function() {
        _last_focused_field = this;
    });

    Tnr.initCore();
});
