<?php

namespace App\domain\interfaces;

interface HttpContext
{
    function request_body(): mixed;
    function send(int $status, mixed $data): mixed;
    function send_error(mixed $error):mixed;
}
