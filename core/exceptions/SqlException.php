<?php 

namespace app\core\exceptions;

class SqlException extends \Exception
{
    protected $code ='309';
    protected $message ='Lỗi truy vấn sql';
}

