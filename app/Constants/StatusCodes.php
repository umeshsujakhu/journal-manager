<?php

namespace App\Constants;

/**
 * Class StatusCodes
 * @package App\Constants
 */
class StatusCodes
{
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_REQUEST_TIMEOUT = 408;
    const HTTP_EXPECTATION_FAILED = 417;
    const HTTP_UNPROCESSABLE_ENTITY = 422;                                        // RFC4918
    const HTTP_INTERNAL_SERVER_ERROR = 500;
    const HTTP_ERROR = 500;
}
