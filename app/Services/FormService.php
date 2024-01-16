<?php

namespace App\Services;

use App\Models\ContactForm;
use Illuminate\Http\UploadedFile;

class FormService {
    /**
     * Set field values in a template based on provided data.
     *
     * @param array  $data Associative array of field names and values.
     * @param string $field_placeholder Placeholder pattern in the template.
     *
     * @return string|null Processed template with replaced field values.
     */
    public function setFieldValue(array $data, string $field_placeholder): ?string
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
                if(in_array($field_data->type->type, ['checkbox', 'radio', 'select'])) {
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
                    $output = str_replace('[+'.$field_name.'+]', implode(', ', $options), $output);
                }
            }
        }

        // Return the final processed template
        return $output;
    }
}
