<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Propaganistas\LaravelPhone\PhoneNumber;

/**
 * get authenticated user
 *
 * @return User $user
 */
if (! function_exists('authUser')) {
    function authUser(): User
    {
        return Auth::user();
    }
}

/**
 * get phone number validation
 *
 * @param  string  $label
 * @return array
 */
if (! function_exists('getBucketDisk')) {
    function getBucketDisk(): string
    {
        return 'public';
    }
}

/**
 * get phone number validation
 *
 * @param  string  $label
 * @return array
 */
if (! function_exists('getLaravelPhoneNumberValidation')) {
    function getLaravelPhoneNumberValidation(): array
    {
        return ['phone:INTERNATIONAL'];
    }
}

/**
 * get national phone number
 *
 * @param  string  $label
 * @return object
 */
if (! function_exists('formatInternationalPhoneNumber')) {
    function formatInternationalPhoneNumber(?string $phone = null, ?string $label = null, bool $usedInJob = false)
    {
        if ($phone) {
            $label = $label ?? 'phone';
            $phone = Str::startsWith($phone, '+') ? $phone : '+' . $phone;
            if (! preg_match('/^\+(95|66)\d+$/', $phone)) {
                if ($usedInJob) {
                    return [
                        'status' => 422,
                        'message' => 'The ' . $label . ' number field must be a valid number.',
                    ];
                } else {
                    throw ValidationException::withMessages(['message' => 'The ' . $label . ' number field must be a valid number.']);
                }
            }

            if ($usedInJob) {
                return [
                    'status' => 200,
                    'phone' => trim(Str::replace(' ', '', phone($phone)->formatInternational())),
                ];
            } else {
                return trim(Str::replace(' ', '', phone($phone)->formatInternational()));
            }
        }

        return null;
    }
}

/**
 * get national phone number
 *
 * @param  string  $label
 * @return object
 */
if (! function_exists('formatInternationalPhoneNumberResponse')) {
    function formatInternationalPhoneNumberResponse($phone, bool $isString = true): ?array
    {
        $phoneResponses = $isString ? null : [];

        if ($phone) {
            if ($isString) {
                $phoneResponses = formatInternationalPhoneNumberResponseHelper($phone);
            } else {
                if (is_array($phone) && count($phone)) {
                    foreach ($phone as $p) {
                        $phoneResponsesHelper = formatInternationalPhoneNumberResponseHelper($p);
                        if (count($phoneResponsesHelper)) {
                            $phoneResponses[] = $phoneResponsesHelper;
                        }
                    }
                }
            }
        }

        return $phoneResponses;
    }
}

/**
 * format phone response helper
 *
 * @param  string  $label
 * @return object
 */
if (! function_exists('formatInternationalPhoneNumberResponseHelper')) {
    function formatInternationalPhoneNumberResponseHelper(?string $phone = null): array
    {
        $phoneResponse = [];

        if ($phone && $phone != '') {
            $formattedPhone = new PhoneNumber($phone);
            $countryCode = match ($formattedPhone->getCountry()) {
                'MM' => '+95',
                'TH' => '+66',
                default => null,
            };

            $phoneResponse['code'] = $countryCode;
            $phoneResponse['number'] = Str::of($formattedPhone->formatNational())->replace(' ', '')->value();
            $phoneResponse['international_phone_number'] = $phone;
        }

        return $phoneResponse;
    }
}