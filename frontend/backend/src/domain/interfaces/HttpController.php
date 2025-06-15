<?php

namespace App\domain\interfaces;

interface HttpController
{
    function execute(HttpContext $http_context):mixed;
}
