<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 9/17/15
 * Time: 10:51 AM
 */

namespace Conark\Grecaptcha\Services;

use Illuminate\Validation\Validator;
use Conark\Grecaptcha\Contracts\GoogleRecaptchaServiceInterface;

/**
 * Class GrecaptchaValidatorService
 * @package Conark\Grecaptcha\Services
 *
 *
 */
class GrecaptchaValidatorService extends Validator{
    /**
     * @var GoogleRecaptchaServiceInterface
     */
    private $_googleRecaptchaService;

    /**
     * @param GoogleRecaptchaServiceInterface $service
     */
    public function setGoogleRecaptchaService(GoogleRecaptchaServiceInterface $service){
        $this->_googleRecaptchaService = $service;
    }

    /**
     * @param $attributes
     * @param $value
     * @param $params
     * @return bool
     */
    public function validateGoogleRecaptcha($attributes, $value, $params){
        return $this->_googleRecaptchaService->verify($value);
    }

}