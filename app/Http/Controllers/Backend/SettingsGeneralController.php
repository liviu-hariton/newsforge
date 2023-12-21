<?php

namespace App\Http\Controllers\Backend;

use App\Events\SettingsUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SettingsGeneralRequest;
use App\Models\Settings;
use Composer\InstalledVersions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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
            if($value) {
                $settings->updateOrCreate(
                    ['key' => $key, 'group' => $settings_group],
                    ['group' => $settings_group, 'value' => $value]
                );
            }
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
}
