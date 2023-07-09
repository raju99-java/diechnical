<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = ['*cancel-signup*','*success-signup*','*dopayment*','*cancel-payment*','*pay-supply-fee*','*cancel-supply-payment*','*success-student-add*','*cancel-student-add*',
                            '*success-student-assign-course*','*cancel-student-assign-course*','*success-exam-fees*','*cancel-exam-fees*','*success-element-purchase*','*cancel-element-purchase*',
                          '*success-apply-online*','*cancel-apply-online*','*success-center-add*','*cancel-center-add*','*success-renew-plan*','*cancel-renew-plan*'];
}
