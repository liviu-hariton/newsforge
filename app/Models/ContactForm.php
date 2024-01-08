<?php

namespace App\Models;

use App\Traits\ModelCache;
use App\Traits\UniqueSlug;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactForm extends Model
{
    use UniqueSlug, ModelCache;

    // Disable timestamps
    public $timestamps = false;

    protected $fillable = [
        'name', 'slug', 'name_as_placeholder', 'description', 'notes', 'contact_field_type_id', 'required', 'min_length', 'max_length', 'extensions', 'input_options', 'columns', 'active', 'sort_order'
    ];

    protected $casts = [
        // Cast to array as it is declared as a JSON field, so we can use it in the blade template as an array
        'input_options' => 'array',
    ];

    // Set the cache key name
    static public string $cache_key = 'contact_form_fields';

    // Set the unique slug separator
    static public string $slug_separator = '_';

    public function type(): BelongsTo
    {
        return $this->belongsTo(ContactFieldType::class, 'contact_field_type_id');
    }

    protected function inputOptions(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => $this->prepareInputOptions($value),
        );
    }

    /**
     * Prepare the input options for the radio, checkbox or select field type
     *
     * <br>Sample input:
     * <br>1,Option 1
     * <br>2,Option 2
     * <br>3,Option 3
     *
     * @param string $value
     * @return string|null
     */
    private function prepareInputOptions(string $value): ?string
    {
        // Split the input string into sets using newline as the delimiter
        $sets = preg_split('/\r?\n/', $value);

        // Use array_map to process each set and filter out invalid pairs
        $result = array_map(function ($set) {
            // Split each set into a pair using comma as the delimiter
            $pair = explode(',', $set);

            // Check if both elements of the pair are non-empty
            return !empty($pair[0]) && !empty($pair[1]) ? ['value' => $pair[0], 'label' => $pair[1]] : null;
        }, array_filter($sets));

        // Check if there are valid pairs and encode the result to JSON
        return $result ? json_encode(array_values($result)) : null;
    }
}
