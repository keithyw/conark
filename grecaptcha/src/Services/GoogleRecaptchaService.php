<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 4/28/15
 * Time: 1:07 PM
 */

namespace Conark\Grecaptcha\Services;

use Config;
use Conark\ServiceWrapper\Services\BaseRemoteCallService;
use Conark\Grecaptcha\Contracts\GoogleRecaptchaServiceInterface;

class GoogleRecaptchaServiceException extends \Exception{

}

class GoogleRecaptchaService extends BaseRemoteCallService implements GoogleRecaptchaServiceInterface {

    private $_url = 'https://www.google.com/recaptcha/api/siteverify';
    /**
     * Verifies if the person enter the correct captcha info
     *
     * @param string $userResponse
     * @return boolean
     */
    public function verify($userResponse)
    {
        $secret = Config::get('grecaptcha.google_recaptcha.secret');
        if (!$secret){
            throw new GoogleRecaptchaServiceException('grecaptcha.google_recaptcha.secret is empty');
        }
        $data = ['secret' => $secret, 'response' => $userResponse];
        $res = $this->postCall($this->_url, ['body' => $data]);
        if (200 == $res->getStatusCode()){
            $json = json_decode($res->getBody(), 1);
            return $json['success'];
        }
        return false;
    }
}