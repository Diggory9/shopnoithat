<?php

namespace app\core\exceptions;

class ForbiddenException extends \Exception
{
    protected $code = 403;
    protected $message = 'Bạn không có quyền truy cập vào trang này';
}