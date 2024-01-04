<?php

namespace App\Http\Controllers\Backend;

use App\Events\SettingsUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ContactOptionRequest;
use App\Http\Requests\Backend\SettingsGeneralRequest;
use App\Models\ContactFieldType;
use App\Models\ContactForm;
use App\Models\ContactOption;
use App\Models\ContactOptionType;
use App\Models\Settings;
use App\Rules\Latitude;
use App\Rules\Longitude;
use Composer\InstalledVersions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class SettingsGeneralController extends Controller
{
    public function index(Request $request, Settings $settings)
    {
        // If the mailer type is not set in the request,
        // but it is set in the database, then we will use the value from the database
        if(!old('mailer_type')) {
            if(_tnrs('mailer_type')) {
                $request->merge([
                    'mailer' => _tnrs('mailer_type')
                ]);
            }
        } else {
            $request->merge([
                'mailer' => old('mailer_type')
            ]);
        }

        return view('backend.settings.index', [
            'mailers' => $settings->mailers(),
            'selected_mailer' =>  $this->loadMailerFormFields($request, $settings),
            'social_networks' => $settings->socialNetworks(),
            'contact_methods' => ContactOptionType::all(),
            'contact_options' => ContactOption::with('type')->orderBy('sort_order')->get(),
            'form_field_types' => ContactFieldType::all(),
            'form_fields' => ContactForm::with('type')->orderBy('sort_order')->get(),
        ]);
    }

    public function loadMailerFormFields(Request $request, Settings $settings)
    {
        if($request->mailer && View::exists('backend.settings.blocks.mailer.'.$request->mailer)) {
            // Check if the mailer has a Composer package and it is installed
            $composer_package_warning = '';

            $mailers_composer_packages = $settings->mailersComposerPackages();

            if(in_array($request->mailer, array_keys($mailers_composer_packages))) {
                $composer_package_warning = $this->checkComposerPackage($mailers_composer_packages[$request->mailer]) ? '' : tnrAlert(
                    message: 'The Composer package <strong>'.$mailers_composer_packages[$request->mailer].'</strong> is not installed. Please install it to use this mailer driver.',
                    type: 'warning',
                    icon: 'bi-exclamation-triangle-fill',
                    bordered: true,
                );
            }

            return view('backend.settings.blocks.mailer.'.$request->mailer, [
                'encryption_methods' => $settings->smtpEncryptionMethods(),
                'composer_package_warning' => $composer_package_warning,
            ]);
        }

        return tnrAlert(
            message: 'There are no configuration options available for this mail sending method',
            type: 'info',
            icon: '',
            bordered: true
        );
    }

    private function checkComposerPackage($package)
    {
        return InstalledVersions::isInstalled($package);
    }

    public function store(SettingsGeneralRequest $request, Settings $settings)
    {
        $validated = $request->validated();

        // Remove the 'group' key from the validated array
        $settings_group = $validated['group'];
        unset($validated['group']);

        foreach($validated as $key=>$value) {
            $settings->updateOrCreate(
                ['key' => $key, 'group' => $settings_group],
                ['group' => $settings_group, 'value' => $value]
            );
        }

        // Clear the site specific settings cache
        event(new SettingsUpdated($settings));

        return redirect()->route('admin.settings.general')->with('success', 'Settings updated successfully');
    }

    public function reset(Request $request, Settings $settings)
    {
        $settings->where('group', $request->group)
            ->isMailer($request->group)
            ->update(['value' => null]);

        // Clear the site specific settings cache
        event(new SettingsUpdated($settings));

        return redirect()->route('admin.settings.general')->with('warning', 'Settings reset successfully');
    }

    public function storeContactMethod(Request $request, ContactOption $contactOption)
    {
        // A custom Request class is not used in this case because we need to
        // redirect the user back to the settings page with the modal form open
        // (a custom flash session variable is used for this)
        $validator = validator(
            $request->all(),
            [
                'latitude' => ['nullable', 'numeric', new Latitude],
                'longitude' => ['nullable', 'numeric', new Longitude],
                'contact_option_type_id' => 'required|exists:contact_option_types,id',
                'value' => 'required|max:255',
                'active' => 'nullable|boolean',
            ],
            [
                'contact_option_type_id' => 'The contact method is required',
                'value' => 'The value is required',
            ]
        );

        if($validator->fails()) {
            session()->flash('open-new-contact-method-modal');

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        // If the contact option type is not 'Postal address',
        // then we will unset the latitude and longitude
        if($validated['contact_option_type_id'] !== '10') {
            unset($validated['latitude'], $validated['longitude']);
        }

        $contactOption->create($validated);

        return redirect()->route('admin.settings.general')->with('success', 'Contacting method added successfully');
    }

    public function deleteContactMethod(ContactOption $data)
    {
        $data->delete();

        return response([
            'status' => 'success',
            'message' => 'Contacting method deleted successfully'
        ]);
    }

    public function saveContactOptionMap(Request $request)
    {
        $contact_option = ContactOption::findOrFail($request->id);

        $contact_option->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return response([
            'status' => 'success',
            'message' => 'Contact option map has been successfully updated!'
        ]);
    }

    public function storeContactField(Request $request, ContactForm $contactForm)
    {
        // A custom Request class is not used in this case because we need to
        // redirect the user back to the settings page with the modal form open
        // (a custom flash session variable is used for this)
        $validator = validator(
            $request->all(),
            [
                'name' => 'required|max:255',
                'name_as_placeholder' => 'nullable|boolean',
                'description' => 'nullable|max:255',
                'columns' => 'required|integer',
                'contact_field_type_id' => 'required|integer',
                // Require max length field only if the field type is
                // "Text" (1), "Number" (5), "Phone" (8), "Password" (11) or "Textarea" (12)
                'max_length' => 'exclude_unless:contact_field_type_id,1,5,8,11,12|required|integer',
                'required' => 'nullable|boolean',
                // Require extensions field only if the field type is "File" (10)
                'extensions' => 'exclude_unless:contact_field_type_id,10|required|string',
                'active' => 'nullable|boolean',
                'notes' => 'nullable|max:255',
            ],
            [
                'contact_field_type_id' => 'The field type is required',
                'name' => 'The field name is required',
                'extensions' => 'You have to mentions the allowed file extensions',
                'max_length' => 'You have to mentions the maximum length of the field',
            ]
        );

        if($validator->fails()) {
            session()->flash('open-new-form-field-modal');

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $validated['slug'] = Str::slug($validated['name'], '_');

        $contactForm->create($validated);

        return redirect()->route('admin.settings.general')->with('success', 'Contact form field added successfully');
    }

    public function deleteContactField(ContactForm $data)
    {
        $data->delete();

        return response([
            'status' => 'success',
            'message' => 'Contacting method deleted successfully'
        ]);
    }

    public function saveContactMap(Request $request, Settings $settings)
    {
        $validator = validator(
            $request->all(),
            [
                'latitude' => ['required', 'numeric', new Latitude],
                'longitude' => ['required', 'numeric', new Longitude]
            ]
        );

        if($validator->fails()) {
            return response([
                'status' => 'error',
                'message' => 'Invalid latitude or longitude'
            ]);
        }

        $validated = $validator->validated();

        $settings_group = 'other';

        foreach($validated as $key=>$value) {
            $settings->updateOrCreate(
                ['key' => $key, 'group' => $settings_group],
                ['group' => $settings_group, 'value' => $value]
            );
        }

        // Clear the site specific settings cache
        event(new SettingsUpdated($settings));

        return response([
            'status' => 'success',
            'message' => 'Contact map has been successfully updated!'
        ]);
    }

    public function saveSettingValue(Request $request, Settings $settings)
    {
        $settings->updateOrCreate(
            ['key' => $request->key, 'group' => $request->group],
            ['group' => $request->group, 'value' => $request->value]
        );

        // Clear the site specific settings cache
        event(new SettingsUpdated($settings));

        return response([
            'status' => 'success',
            'message' => 'Setting value has been successfully updated!'
        ]);
    }
}
