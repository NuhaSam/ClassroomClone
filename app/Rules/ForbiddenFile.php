<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ForbiddenFile implements ValidationRule
{
    protected $types ;

    public function __construct(...$types){
        $this->types = $types;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // echo $value;
    //    $type = $value->getMimeType();
    $type = Storage::mimeType($value);
       if( in_array($type, $this->types)){
        $fail('file type not supported');
       }

    }
}
