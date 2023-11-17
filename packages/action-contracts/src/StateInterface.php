<?php

declare(strict_types=1);

namespace Kiboko\Contract\Action;

interface StateInterface
{
    public function initialize(): void;

    public function success(): void;

    public function failure(): void;
}
