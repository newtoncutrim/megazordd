<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordComplexRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) < 8 || !preg_match('/[A-Z]/', $value) || !preg_match('/[\W_]/', $value)) {
            $fail('A senha deve conter pelo menos 8 caracteres, 1 letra maiúscula e 1 símbolo.');
        }
    }
}




/* namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordComplexRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Verifica se a senha tem pelo menos 8 caracteres
        if (strlen($value) < 8) {
            return false;
        }

        // Verifica se a senha contém pelo menos 1 letra maiúscula
        if (!preg_match('/[A-Z]/', $value)) {
            return false;
        }

        // Verifica se a senha contém pelo menos 1 símbolo (caracter especial)
        if (!preg_match('/[\W_]/', $value)) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'A senha deve conter pelo menos 8 caracteres, 1 letra maiúscula e 1 símbolo.';
    }
}
 */
