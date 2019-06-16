<?php


namespace puresoft\jibimo\laravel;


use puresoft\jibimo\exceptions\CurlResultFailedException;
use puresoft\jibimo\exceptions\InvalidJibimoPrivacyLevelException;
use puresoft\jibimo\exceptions\InvalidJibimoResponseException;
use puresoft\jibimo\exceptions\InvalidJibimoTransactionStatusException;
use puresoft\jibimo\exceptions\InvalidMobileNumberException;

class Jibimo
{
    /**
     * This method will request money from a mobile number whose owner may or may not be registered in Jibimo.
     * @param string $mobileNumber Target mobile number that want to request money from.
     * @param int $amountInToman Amount of transaction in Toomaans.
     * @param string $privacyLevel Jibimo privacy level of transaction which could be one of `Public`, `Friend` or `Personal`.
     * @param string $trackerId Tracker ID to be saved in Jibimo and used later for finding transaction. This can be
     * your factor number.
     * @param string|null $description Descriptions of transaction which will be show up in Jibimo.
     * @param string|null $returnUrl The URL to return after payment. If you leave this URL blank, Jibimo will redirect
     * user to your company homepage.
     * @return \puresoft\jibimo\models\request\RequestTransactionResponse
     * @throws CurlResultFailedException
     * @throws InvalidJibimoPrivacyLevelException
     * @throws InvalidJibimoResponseException
     * @throws InvalidJibimoTransactionStatusException
     * @throws InvalidMobileNumberException
     */
    public static function request(string $mobileNumber, int $amountInToman, string $privacyLevel, string $trackerId,
                                   ?string $description = null, ?string $returnUrl = null)
    {
        $baseUrl = config('jibimo.base_url');
        $token = config('jibimo.api_token');

        return \puresoft\jibimo\Jibimo::request($baseUrl, $token, $mobileNumber,
            $amountInToman, $privacyLevel, $trackerId, $description);
    }

    /**
     * This method will pay money to a mobile number whose owner may or may not be registered in Jibimo.
     * @param string $mobileNumber Target mobile number that want to pay money to.
     * @param int $amountInToman Amount of transaction in Toomaans.
     * @param string $privacy Jibimo privacy level of transaction which could be one of `Public`, `Friend` or `Personal`.
     * @param string $trackerId Tracker ID to be saved in Jibimo and used later for finding transaction. This can be
     * your factor number.
     * @param string|null $description Descriptions of transaction which will be show up in Jibimo.
     * @return \puresoft\jibimo\models\pay\PayTransactionResponse
     * @throws CurlResultFailedException
     * @throws InvalidJibimoPrivacyLevelException
     * @throws InvalidJibimoResponseException
     * @throws InvalidJibimoTransactionStatusException
     * @throws InvalidMobileNumberException
     */
    public static function pay(string $mobileNumber, int $amountInToman, string $privacyLevel, string $trackerId,
                                   ?string $description = null)
    {
        $baseUrl = config('jibimo.base_url');
        $token = config('jibimo.api_token');

        return \puresoft\jibimo\Jibimo::pay($baseUrl, $token, $mobileNumber,
            $amountInToman, $privacyLevel, $trackerId, $description);
    }

    /**
     * This method will pay money directly to a combination of mobile number and IBAN (Sheba) number whose owner may or
     * may not be registered in Jibimo and after this transaction money will be automatically transferred to IBAN
     * owner's bank account using Paya system, which will take up to 72 hours to be transferred.
     * @param string $mobileNumber Target mobile number that want to pay money to.
     * @param int $amountInToman Amount of transaction in Toomaans.
     * @param string $privacyLevel Jibimo privacy level of transaction which could be one of `Public`, `Friend` or `Personal`.
     * @param string $iban the IBAN (Sheba) number of who you want to pay money to.
     * @param string $trackerId Tracker ID to be saved in Jibimo and used later for finding transaction. This can be
     * your factor number.
     * @param string|null $description Descriptions of transaction which will be show up in Jibimo.
     * @param string|null $name First name of IBAN (Sheba) owner.
     * @param string|null $family Last name of IBAN (Sheba) owner.
     * @return \puresoft\jibimo\models\pay\ExtendedPayTransactionResponse
     * @throws CurlResultFailedException
     * @throws InvalidJibimoPrivacyLevelException
     * @throws InvalidJibimoResponseException
     * @throws InvalidJibimoTransactionStatusException
     * @throws InvalidMobileNumberException
     * @throws \puresoft\jibimo\exceptions\InvalidIbanException
     */
    public static function extendedPay(string $mobileNumber, int $amountInToman, string $privacyLevel, string $iban,
                                       string $trackerId, ?string $description = null, ?string $name = null,
                                       ?string $family = null)
    {
        $baseUrl = config('jibimo.base_url');
        $token = config('jibimo.api_token');

        return \puresoft\jibimo\Jibimo::extendedPay($baseUrl, $token, $mobileNumber,
            $amountInToman, $privacyLevel, $iban, $trackerId, $description, $name, $family);
    }

    /**
     * This method will validate that if a previous request transaction was attempted successfully or not.
     * @param int $transactionId The Jibimo transaction ID of that request transaction that you were made before.
     * @param string $mobileNumber Target mobile number that money was requested from.
     * @param int $amountInToman Amount of that previous transaction in Toomaans.
     * @param string $trackerId Tracker ID of that previous transaction.
     * @return \puresoft\jibimo\payment\JibimoValidationResult
     * @throws CurlResultFailedException
     * @throws InvalidJibimoPrivacyLevelException
     * @throws InvalidJibimoResponseException
     * @throws InvalidJibimoTransactionStatusException
     * @throws InvalidMobileNumberException
     */
    public static function validateRequest(int $transactionId, string $mobileNumber, int $amountInToman,
                                           string $trackerId)
    {
        $baseUrl = config('jibimo.base_url');
        $token = config('jibimo.api_token');

        return \puresoft\jibimo\Jibimo::validateRequest($baseUrl, $token, $transactionId,
            $mobileNumber, $amountInToman, $trackerId);
    }

    /**
     * This method will validate that if a previous pay transaction was attempted successfully or not.
     * @param int $transactionId The Jibimo transaction ID of that pay transaction that you were made before.
     * @param string $mobileNumber Target mobile number that money was paid to.
     * @param int $amountInToman Amount of that previous transaction in Toomaans.
     * @param string $trackerId Tracker ID of that previous transaction.
     * @return \puresoft\jibimo\payment\JibimoValidationResult
     * @throws CurlResultFailedException
     * @throws InvalidJibimoPrivacyLevelException
     * @throws InvalidJibimoResponseException
     * @throws InvalidJibimoTransactionStatusException
     * @throws InvalidMobileNumberException
     */
    public static function validatePay(int $transactionId, string $mobileNumber, int $amountInToman,
                                           string $trackerId)
    {
        $baseUrl = config('jibimo.base_url');
        $token = config('jibimo.api_token');

        return \puresoft\jibimo\Jibimo::validatePay($baseUrl, $token, $transactionId,
            $mobileNumber, $amountInToman, $trackerId);
    }

    /**
     * This method will validate that if a previous extended pay transaction was attempted successfully or not.
     * @param int $transactionId The Jibimo transaction ID of that extended pay transaction that you were made before.
     * @param string $mobileNumber Target mobile number that money was paid to.
     * @param int $amountInToman Amount of that previous transaction in Toomaans.
     * @param string $trackerId Tracker ID of that previous transaction.
     * @return \puresoft\jibimo\payment\JibimoValidationResult
     * @throws CurlResultFailedException
     * @throws InvalidJibimoPrivacyLevelException
     * @throws InvalidJibimoResponseException
     * @throws InvalidJibimoTransactionStatusException
     * @throws InvalidMobileNumberException
     */
    public static function validateExtendedPay(int $transactionId, string $mobileNumber, int $amountInToman,
                                       string $trackerId)
    {
        $baseUrl = config('jibimo.base_url');
        $token = config('jibimo.api_token');

        return \puresoft\jibimo\Jibimo::validateExtendedPay($baseUrl, $token, $transactionId,
            $mobileNumber, $amountInToman, $trackerId);
    }
}