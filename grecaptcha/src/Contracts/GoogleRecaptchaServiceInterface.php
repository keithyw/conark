<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 4/28/15
 * Time: 10:03 AM
 */

namespace Conark\Grecaptcha\Contracts;


interface GoogleRecaptchaServiceInterface {
    /**
     * Verifies if the person enter the correct captcha info
     *
     * @param string $userResponse
     * @return boolean
     */
    public function verify($userResponse);
}