<?php

declare(strict_types=1);

trigger_deprecation('php-etl/action-contract', '0.1', 'The "%s" class is deprecated, use "%s" instead.', 'Kiboko\\Contract\\Action\\ActionState', \Kiboko\Components\Action\ActionState::class);

/*
 * @deprecated since Action contract 0.1, use Kiboko\Components\Action\ActionState instead.
 */
class_alias(\Kiboko\Components\Action\ActionState::class, 'Kiboko\\Contract\\Action\\ActionState');
