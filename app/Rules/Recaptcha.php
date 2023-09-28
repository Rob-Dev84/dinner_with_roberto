<?php

namespace App\Rules;

use App\Services\RecaptchaService;
use Illuminate\Contracts\Validation\Rule;

class Recaptcha implements Rule
{

    private $recaptchaService;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(RecaptchaService $recaptchaService)
    {
        $this->recaptchaService = $recaptchaService;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->recaptchaService->verify($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'reCAPTCHA verification failed.';
    }
}
