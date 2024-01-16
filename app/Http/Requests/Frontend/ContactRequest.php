<?php

namespace App\Http\Requests\Frontend;

use App\Models\ContactForm;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // There is no need to validate the _token field and the _method field
        // because Laravel does that automatically.
        $fields = $this->except(['_token', '_method']);

        $rules = [];

        foreach($fields as $field_slug=>$field_value) {
            if($field_properties = ContactForm::with('type')->where('slug', $field_slug)->first()) {
                $field_rules = [];

                if($field_properties->required) {
                    $field_rules[] = 'required';
                } else {
                    $field_rules[] = 'nullable';
                }

                if(in_array($field_properties->type->type, ['text', 'password', 'textarea', 'datetime-local', 'time', 'tel'])) {
                    $field_rules[] = 'string';
                }

                if($field_properties->type->type === 'email') {
                    $field_rules[] = 'email';
                }

                if(!in_array($field_properties->type->type, ['file', 'checkbox', 'radio', 'select', 'color', 'datetime-local', 'date', 'time'])) {
                    $field_rules[] = 'min:'.$field_properties->min_length;
                    $field_rules[] = 'max:'.$field_properties->max_length;
                }

                if($field_properties->type->type === 'url') {
                    $field_rules[] = 'url';
                }

                if($field_properties->type->type === 'date') {
                    $field_rules[] = 'date';
                }

                if($field_properties->type->type === 'file') {
                    $field_rules[] = 'file';

                    if($field_properties->extensions && $field_properties->extensions !== '*') {
                        $field_rules[] = 'mimetypes:'.$field_properties->extensions;
                    }
                }

                if($field_properties->type->type === 'color') {
                    $field_rules[] = 'hex_color';
                }

                if(count($field_rules) > 0) {
                    $rules[$field_slug] = implode("|", $field_rules);
                }
            }
        }

        return $rules;
    }
}
