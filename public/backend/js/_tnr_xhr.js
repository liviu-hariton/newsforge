$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

class TnrXHR {
    loadMailerFormFields(obj) {
        Tnr.block();

        $.ajax({
            url: obj.data('route'),
            type: 'POST',
            data: 'mailer=' + obj.val(),
            success: function(response) {
                $("#" + obj.data('target')).html(response);

                Tnr.unblock();
            },
            error: function(xhr, status, error) {
                Tnr.unblock();

                Tnr.errorAlert(xhr.responseJSON.message, error);
            }
        });
    }

    setMapPositioning(obj) {
        if(obj.val() === '10') {
            $("#contact-map-container").removeClass("d-none");
        } else {
            $("#contact-map-container").addClass("d-none");
        }
    }

    deleteContactOption(obj) {
        bootbox.confirm({
            locale: _locale,
            buttons: {confirm: {className: 'btn-danger'}, cancel: {className: 'btn-outline-success'}},
            title: '<i class="fas fa-exclamation-triangle"></i> Careful!',
            message: 'You have chosen to delete this contact option. Are you sure?',
            callback: function(result) {
                if(result === true) {
                    Tnr.block();

                    $.ajax({
                        url: obj.data('route'),
                        type: 'DELETE',
                        success: function(response) {
                            Tnr.remove("#row-" + obj.data('id'));

                            Tnr.unblock();

                            toastr.success(response.message);
                        },
                        error: function(xhr, status, error) {
                            Tnr.unblock();

                            Tnr.errorAlert(xhr.responseJSON.message, error);
                        }
                    });
                }
            }
        });
    }

    changeAttribute(obj){
        Tnr.block();

        // this acts as a value to update if the `obj` is a link
        let _enabled;

        const _data_value = obj.data('value');

        if(_data_value !== undefined) { // a specific value is set
            _enabled = _data_value;
        } else { // the `obj` is a checkbox
            _enabled = obj.is(':checked') === true ? '1' : '0';
        }

        let _id = obj.data('id');
        let _attribute = obj.data('attribute');
        let _model = obj.data('model');

        let _css_toggle = obj.data('css-toggle');

        $.ajax({
            type: 'PATCH',
            url: obj.data('route'),
            data: {
                "enabled" : _enabled,
                "id": _id,
                "attribute": _attribute,
                "model": _model
            },
            success: function(data) {
                Tnr.unblock();

                if(data.status === 'success') {
                    toastr.success(data.message);

                    if(_css_toggle !== undefined) {
                        let _css_toggle_parts = _css_toggle.split("|");

                        Tnr.toggleCSSClass(_css_toggle_parts[0], _css_toggle_parts[1], _css_toggle_parts[2]);
                    }
                } else {
                    toastr.warning(data.message);
                }
            },
            error: function(xhr, status, error) {
                Tnr.unblock();

                Tnr.errorAlert(xhr.responseJSON.message, error);
            }
        });
    }

    saveContactOptionMap(id, latitude, longitude, route) {
        Tnr.inlineStatusIcon('working', 'map_option_' + id);

        $.ajax({
            url: route,
            type: 'PUT',
            data: 'id=' + id + '&latitude=' + latitude + '&longitude=' + longitude,
            success: function(response) {
                Tnr.inlineStatusIcon('finished', 'map_option_' + id);
            },
            error: function(xhr, status, error) {
                Tnr.unblock();

                Tnr.errorAlert(xhr.responseJSON.message, error);
            }
        });
    }

    saveContactMap(latitude, longitude, route) {
        Tnr.inlineStatusIcon('working', 'overall_map');

        $.ajax({
            url: route,
            type: 'PUT',
            data: 'latitude=' + latitude + '&longitude=' + longitude,
            success: function(response) {
                if(response.status === 'success') {
                    Tnr.inlineStatusIcon('finished', 'overall_map');
                } else {
                    toastr.warning(response.message);
                }
            },
            error: function(xhr, status, error) {
                Tnr.unblock();

                Tnr.errorAlert(xhr.responseJSON.message, error);
            }
        });
    }

    setSortOrder(_items, obj) {
        Tnr.block(obj.data('container'));

        let _model = obj.data('model');

        $.ajax({
            url: obj.data('route'),
            type: 'PUT',
            data: {
                "items": _items,
                "model": _model
            },
            success: function(data) {
                Tnr.unblock(obj.data('container'));

                if(data.status === 'success') {
                    toastr.success(data.message);
                } else {
                    toastr.warning(data.message);
                }
            },
            error: function(xhr, status, error) {
                Tnr.unblock(obj.data('container'));

                Tnr.errorAlert(xhr.responseJSON.message, error);
            }
        });
    }

    deleteContactField(obj) {
        bootbox.confirm({
            locale: _locale,
            buttons: {confirm: {className: 'btn-danger'}, cancel: {className: 'btn-outline-success'}},
            title: '<i class="fas fa-exclamation-triangle"></i> Careful!',
            message: 'You have chosen to delete this contact form field. Are you sure?',
            callback: function(result) {
                if(result === true) {
                    Tnr.block();

                    $.ajax({
                        url: obj.data('route'),
                        type: 'DELETE',
                        success: function(response) {
                            Tnr.remove("#field-row-" + obj.data('id'));
                            Tnr.remove("#field-as-tag-" + obj.data('id'));

                            Tnr.unblock();

                            toastr.success(response.message);
                        },
                        error: function(xhr, status, error) {
                            Tnr.unblock();

                            Tnr.errorAlert(xhr.responseJSON.message, error);
                        }
                    });
                }
            }
        });
    }

    changeSettingsValue(obj) {
        Tnr.block(obj.data('container'));

        let _group = obj.data('group');
        let _key = obj.data('key');

        if(obj.is(":checkbox")) {
            var _value = obj.is(':checked') === true ? '1' : '';
        } else {
            var _value = obj.val() !== '' ? obj.val() : '';
        }

        $.ajax({
            url: obj.data('route'),
            type: 'PATCH',
            data: {
                "group": _group,
                "key": _key,
                "value": _value
            },
            success: function(data) {
                Tnr.unblock(obj.data('container'));

                if(data.status === 'success') {
                    toastr.success(data.message);
                } else {
                    toastr.warning(data.message);
                }
            },
            error: function(xhr, status, error) {
                Tnr.unblock(obj.data('container'));

                Tnr.errorAlert(xhr.responseJSON.message, error);
            }
        });
    }

    deleteContactForm(obj) {
        bootbox.confirm({
            locale: _locale,
            buttons: {confirm: {className: 'btn-danger'}, cancel: {className: 'btn-outline-success'}},
            title: '<i class="fas fa-exclamation-triangle"></i> Careful!',
            message: 'You have chosen to delete this submitted contact form. Are you sure?',
            callback: function(result) {
                if(result === true) {
                    Tnr.block();

                    const _data_redirect = obj.data('redirect');

                    $.ajax({
                        url: obj.data('route'),
                        type: 'DELETE',
                        success: function(response) {
                            if(_data_redirect !== undefined) {
                                window.location = _data_redirect;
                            } else {
                                Tnr.remove("#contact-row-" + obj.data('id'));

                                Tnr.unblock();

                                toastr.success(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            Tnr.unblock();

                            Tnr.errorAlert(xhr.responseJSON.message, error);
                        }
                    });
                }
            }
        });
    }

    setContactFormLabel(obj) {
        Tnr.block();

        const _form_id = obj.data('id');
        const _label_id = obj.data('label-id');

        $.ajax({
            url: obj.data('route'),
            type: 'PUT',
            data: {
                "form_id": _form_id,
                "label_id": _label_id,
            },
            success: function(response) {
                $("#labels-" + _form_id).html(response.labels);

                Tnr.unblock();

                toastr.success(response.message);
            },
            error: function(xhr, status, error) {
                Tnr.unblock();

                Tnr.errorAlert(xhr.responseJSON.message, error);
            }
        });
    }

    bulkMarkContactsAsRead(obj) {
        let _ids = [];

        $(obj.data('targets')).each(function() {
            if($(this).prop('checked')) {
                _ids.push($(this).val());
            }
        });

        if(_ids.length > 0) {
            Tnr.block();

            const _data_value = obj.data('value');
            let _attribute = obj.data('attribute');
            let _model = obj.data('model');

            let _css_toggle = obj.data('css-toggle');

            $.ajax({
                type: 'PATCH',
                url: obj.data('route'),
                data: {
                    "enabled" : _data_value,
                    "id": _ids,
                    "attribute": _attribute,
                    "model": _model
                },
                success: function(data) {
                    Tnr.unblock();

                    if(data.status === 'success') {
                        toastr.success(data.message);

                        if(_css_toggle !== undefined) {
                            const _css_toggle_parts = _css_toggle.split("|");

                            _ids.forEach((_id) => {
                                Tnr.toggleCSSClass(_css_toggle_parts[0], _css_toggle_parts[1], '#contact-row-' + _id);
                            });
                        }
                    } else {
                        toastr.warning(data.message);
                    }

                    Tnr.endBulkActions(obj);
                },
                error: function(xhr, status, error) {
                    Tnr.unblock();

                    Tnr.errorAlert(xhr.responseJSON.message, error);
                }
            });
        } else {
            Tnr.warningAlert('Warning', 'Please select the elements that you want to manage');
        }
    }

    bulkDeleteContacts(obj) {
        let _ids = [];

        $(obj.data('targets')).each(function() {
            if($(this).prop('checked')) {
                _ids.push($(this).val());
            }
        });

        if(_ids.length > 0) {
            bootbox.confirm({
                locale: _locale,
                buttons: {confirm: {className: 'btn-danger'}, cancel: {className: 'btn-outline-success'}},
                title: '<i class="fas fa-exclamation-triangle"></i> Careful!',
                message: 'You have chosen to delete this selected contacts. Are you sure?',
                callback: function(result) {
                    if(result === true) {
                        Tnr.block();

                        $.ajax({
                            url: obj.data('route'),
                            type: 'DELETE',
                            data: {
                                "ids": _ids,
                            },
                            success: function(response) {
                                _ids.forEach((_id) => {
                                    Tnr.remove("#contact-row-" + _id);
                                });

                                Tnr.unblock();

                                toastr.success(response.message);
                            },
                            error: function(xhr, status, error) {
                                Tnr.unblock();

                                Tnr.errorAlert(xhr.responseJSON.message, error);
                            }
                        });
                    }

                    Tnr.endBulkActions(obj);
                }
            });
        } else {
            Tnr.warningAlert('Warning', 'Please select the elements that you want to manage');
        }
    }
}

let _tnr_xhr  = new TnrXHR;
