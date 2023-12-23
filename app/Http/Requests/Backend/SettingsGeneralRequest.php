<?php

namespace App\Http\Requests\Backend;

use App\Models\Settings;
use App\Rules\GoogleMapsApiKey;
use App\Rules\Latitude;
use App\Rules\Longitude;
use Illuminate\Foundation\Http\FormRequest;

class SettingsGeneralRequest extends FormRequest
{
    private Settings $settings;

    public function __construct(Settings $settings)
    {
        parent::__construct();

        $this->settings = $settings;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    private function socialNetworksValidationRules(): array
    {
        $socialNetworks = $this->settings->socialNetworks();

        $rules = [];

        foreach($socialNetworks as $socialNetwork) {
            $rules[$socialNetwork['field']] = 'nullable|url|max:255';
        }

        return $rules;
    }

    private function socialNetworksValidationMessages(): array
    {
        $socialNetworks = $this->settings->socialNetworks();

        $messages = [];

        foreach($socialNetworks as $socialNetwork) {
            $messages[$socialNetwork['field'].'.url'] = 'Enter a valid '.ucwords($socialNetwork['field']).' profile URL';
            $messages[$socialNetwork['field'].'.max'] = 'The URL must not be longer than :max characters';
        }

        return $messages;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'group' => 'required|string',
            'from_address' => 'required_if:group,mailer|email',
            'from_name' => 'required_if:group,mailer|string|max:255',

            //-- Mailer --//
            'mailer_type' => 'string|max:255',

            // SMTP
            'smtp_host' => 'required_if:mailer_type,smtp|string|max:255',
            'smtp_port' => 'required_if:mailer_type,smtp|integer',
            'smtp_username' => 'required_if:mailer_type,smtp|string|max:255',
            'smtp_password' => 'required_if:mailer_type,smtp|string|max:255',
            'smtp_encryption' => 'required_if:mailer_type,smtp|string|max:255',
            'smtp_url' => 'nullable|url|max:255',
            'smtp_local_domain' => 'nullable|string|max:255',

            // Sendmail
            'sendmail_path' => 'required_if:mailer_type,sendmail|string|max:255',

            // Mailgun
            'mailgun_domain' => 'required_if:mailer_type,mailgun|string|max:255',
            'mailgun_secret' => 'required_if:mailer_type,mailgun|string|max:255',
            'mailgun_endpoint' => 'nullable|string|max:255|regex:/^api(\.[a-z]+)?\.mailgun\.net$/i',

            // Postmark
            'postmark_token' => 'required_if:mailer_type,postmark|string|max:255',
            'postmark_message_stream_id' => 'nullable|string|max:255',

            // Amazon SES
            'ses_key' => 'required_if:mailer_type,ses|string|max:255',
            'ses_secret' => 'required_if:mailer_type,ses|string|max:255',
            'ses_region' => 'required_if:mailer_type,ses|string|max:255',
            'ses_token' => 'nullable|string|max:255',

            // MailerSend
            'mailersend_api_key' => 'required_if:mailer_type,mailersend|string|max:255',

            //-- Social --//
            ...$this->socialNetworksValidationRules(),

            //-- Other --//
            'google_maps_api_key' => ['nullable', 'string', 'max:255', new GoogleMapsApiKey],

            'latitude' => ['nullable', 'numeric', new Latitude],
            'longitude' => ['nullable', 'numeric', new Longitude],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'from_address.required' => 'The sender\'s email address is required',
            'from_address.email' => 'Enter a valid email address',
            'from_name.required' => 'The sender\'s name is required',
            'from_name.max' => 'The sender name must not be longer than :max characters',

            //-- Mailer --//
            // SMTP
            'smtp_host' => 'The SMTP host is required (usually <em class="text-black-50">smtp.example.com</em> or <em class="text-black-50">localhost</em>)',
            'smtp_port' => 'The SMTP port number is required<br />(usually <em class="text-black-50">587</em> or <em class="text-black-50">465</em>)',
            'smtp_username' => 'The SMTP username is required',
            'smtp_password' => 'The SMTP username\'s password is required',
            'smtp_url' => 'The SMTP URL must be a valid address of an unique resource<br />(usually <em class="text-black-50">smtp://$emailaddress:$password@box.domain.com:587</em>)',

            // Sendmail
            'sendmail_path' => 'The Sendmail path is required<br />(usually <em class="text-black-50">/usr/sbin/sendmail -bs -i</em> )',

            // Mailgun
            'mailgun_domain' => 'The Mailgun domain is required',
            'mailgun_secret' => 'The Mailgun secret is required',
            'mailgun_endpoint' => 'The Mailgun endpoint (usually <em class="text-black-50">api(.eu).mailgun.net</em> )',

            // Postmark
            'postmark_token' => 'The Postmark token is required',

            // Amazon SES
            'ses_key' => 'The Amazon SES access key is required',
            'ses_secret' => 'The Amazon SES secret access is required',
            'ses_region' => 'The Amazon SES region is required (usually a <em class="text-black-50">us-east-1</em> format)',

            // MailerSend
            'mailersend_api_key' => 'The MailerSend API Token is required',

            //-- Social --//
            ...$this->socialNetworksValidationMessages(),

            //-- Other --//
            'google_maps_api_key' => 'The Google Maps API Key is not valid',
            'latitude' => 'The latitude must be a valid value<br />(between -90 and 90 degrees, usually a <em class="text-black-50">48.200022871201654</em> format)',
            'longitude' => 'The longitude must be a valid value<br />(between -180 and 180 degrees, usually a <em class="text-black-50">17.087633309325387</em> format)',
        ];
    }
}
