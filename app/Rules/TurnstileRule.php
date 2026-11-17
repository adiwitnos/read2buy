<?php

namespace App\Rules;

use App\Services\Turnstile;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TurnstileRule implements ValidationRule
{
    /**
     * Create a new rule instance.
     *
     * @param string|null $action The expected Turnstile action name.
     */
    public function __construct(protected ?string $action = null)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || trim($value) === '') {
            $fail('Verifikasi keamanan wajib diselesaikan.');
            return;
        }

        if (strlen($value) > 2048) {
            $fail('Token verifikasi keamanan tidak valid.');
            return;
        }

        $ip = request()->ip();

        if (! Turnstile::verify($value, $this->action, $ip)) {
            $fail('Verifikasi keamanan (Turnstile) tidak berhasil. Silakan coba lagi.');
        }
    }
}
