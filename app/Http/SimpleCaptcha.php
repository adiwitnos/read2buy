<?php

namespace App\Http;

use Closure;

class SimpleCaptcha
{
    public const SESSION_ANSWER_KEY = 'simple_captcha_answer';

    public const SESSION_QUESTION_KEY = 'simple_captcha_question';

    /**
     * Generate a new math captcha pair and store it in session.
     */
    public static function generate(): string
    {
        $num1 = random_int(1, 9);
        $num2 = random_int(1, 9);
        $answer = $num1 + $num2;

        session([
            self::SESSION_ANSWER_KEY => $answer,
            self::SESSION_QUESTION_KEY => "{$num1} + {$num2}",
        ]);

        return "{$num1} + {$num2}";
    }

    /**
     * Retrieve the current question or generate a fresh one if absent.
     */
    public static function getQuestion(): string
    {
        $question = session(self::SESSION_QUESTION_KEY);

        if (! is_string($question) || empty($question)) {
            $question = self::generate();
        }

        return $question;
    }

    /**
     * Retrieve the current expected answer stored in session.
     */
    public static function getAnswer(): ?int
    {
        $answer = session(self::SESSION_ANSWER_KEY);

        return $answer !== null ? (int) $answer : null;
    }

    /**
     * Set a known answer in session (primarily for deterministic tests).
     */
    public static function setAnswer(int $answer): void
    {
        session([
            self::SESSION_ANSWER_KEY => $answer,
            self::SESSION_QUESTION_KEY => "{$answer} + 0",
        ]);
    }

    /**
     * Clear captcha state from session.
     */
    public static function clear(): void
    {
        session()->forget([
            self::SESSION_ANSWER_KEY,
            self::SESSION_QUESTION_KEY,
        ]);
    }

    /**
     * Validation rules for verifying captcha submissions.
     *
     * @return array<int, string|Closure>
     */
    public static function rules(): array
    {
        return [
            'required',
            'integer',
            function (string $attribute, mixed $value, Closure $fail): void {
                $expected = self::getAnswer();

                if ($expected === null || (int) $value !== $expected) {
                    self::generate();
                    $fail('Jawaban verifikasi keamanan (captcha) tidak tepat.');
                }
            },
        ];
    }

    /**
     * Custom validation error messages for captcha field.
     *
     * @return array<string, string>
     */
    public static function messages(): array
    {
        return [
            'captcha.required' => 'Jawaban verifikasi keamanan (captcha) wajib diisi.',
            'captcha.integer' => 'Jawaban verifikasi keamanan (captcha) harus berupa angka.',
        ];
    }
}
