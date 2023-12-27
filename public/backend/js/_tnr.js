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

        const toggleInlineEdit = function() {
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

        toggleInlineEdit();

        var sortOrder = function() {
            if(typeof dragula == 'undefined') {
                console.warn('Warning - dragula.min.js is not loaded.');
                return;
            }

            const containers = $('.tnr-sortable').toArray();
            const _obj = $("#tnr-sortable");

            let drake = dragula(containers, {
                mirrorContainer: document.querySelector('.tnr-sortable'),
                moves: function (el, container, handle) {
                    return handle.classList.contains('tnr-sort-handle');
                }
            });

            drake.on('drop', function() {
                let _new_order = [];

                _obj.children().each(function() {
                    _new_order.push($(this).data("option-id"));
                });

                _tnr_xhr['setSortOrder'](_new_order, _obj);
            });
        };

        sortOrder();

        var inlineEdit = function() {
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

        inlineEdit();
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
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    Tnr.initCore();
});
