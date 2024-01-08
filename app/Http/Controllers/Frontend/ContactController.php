<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Contact;
use App\Models\ContactForm;
use App\Models\ContactOption;
use App\Traits\FileUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;

class ContactController extends Controller
{
    use FileUpload;

    public function index()
    {
        $contact_methods = Cache::rememberForever(ContactOption::$cache_key, function () {
            return ContactOption::where('active', 1)->with('type')->orderBy('sort_order')->get();
        });

        $contact_form_fields = Cache::rememberForever(ContactForm::$cache_key, function () {
            return ContactForm::where('active', 1)->with('type')->orderBy('sort_order')->get();
        });

        return view('frontend.contact.index', [
            'breadcrumbs' => ['Contact'],
            'contact_methods' => $contact_methods,
            'contact_form_fields' => $contact_form_fields
        ]);
    }

    public function store(ContactRequest $request, Contact $contact)
    {
        $validated = $request->validated();

        $contact_data['from_name'] = $this->setFieldValue($validated, 'contact_from_name');
        $contact_data['from_email'] = $this->setFieldValue($validated, 'contact_from_email');
        $contact_data['subject'] = $this->setFieldValue($validated, 'contact_subject');
        $contact_data['message'] = $this->setFieldValue($validated, 'contact_message');
        $contact_data['headers'] = $this->setFieldValue($validated, 'contact_headers');

        $attachments = [];

        foreach($request->file() as $file_field=>$file) {
            $attachments[] = $this->uploadFile($request, $file_field, 'uploads/contacts', 'public');
        }

        if(count($attachments) > 0) {
            $contact_data['attachments'] = $attachments;
        }

        $contact_data['ipv4'] = $request->ip();

        $contact->create($contact_data);

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully.');
    }

    /**
     * Set field values in a template based on provided data.
     *
     * @param array  $data Associative array of field names and values.
     * @param string $field_placeholder Placeholder pattern in the template.
     *
     * @return string|null Processed template with replaced field values.
     */
    private function setFieldValue(array $data, string $field_placeholder): ?string
    {
        // Retrieve the initial template with placeholders
        $output = _tnrs($field_placeholder);

        // Iterate through provided data
        foreach($data as $field_name => $field_value) {
            // Skip processing if the field value is an UploadedFile instance
            if(!($field_value instanceof UploadedFile)) {
                // Retrieve field data from the database based on the field slug (or field name as passed from the form)
                $field_data = ContactForm::with('type')->where('slug', $field_name)->first();

                // Replace placeholder with the field value if it's not an array and not a select, checkbox, or radio field
                if (!is_array($field_value) && !in_array($field_data->type->type, ['checkbox', 'radio', 'select'])) {
                    $output = str_replace('[+'.$field_name.'+]', $field_value, $output);
                }

                // Process select, checkbox, or radio fields
                if (in_array($field_data->type->type, ['checkbox', 'radio', 'select'])) {
                    $options = [];

                    $k = 0;

                    // Handle array values (as multiple values can be selected for a checkbox by the user)
                    if(is_array($field_value)) {
                        foreach($field_data->input_options as $input_option_value) {
                            if(in_array($input_option_value['value'], $field_value)) {
                                $options[] = $field_data->input_options[$k]['label'];
                            }

                            $k++;
                        }
                    } else {
                        // Handle non-array values (for radio and select fields)
                        // @todo: Handle select fields with multiple values
                        foreach($field_data->input_options as $input_option_value) {
                            foreach ($input_option_value as $pair_key => $pair_value) {
                                if($pair_value === $field_value) {
                                    $options[] = $field_data->input_options[$k]['label'];
                                }
                            }

                            $k++;
                        }
                    }

                    // Replace placeholder with the processed options
                    $output = str_replace('[+' . $field_name . '+]', implode(', ', $options), $output);
                }
            }
        }

        // Return the final processed template
        return $output;
    }
}
