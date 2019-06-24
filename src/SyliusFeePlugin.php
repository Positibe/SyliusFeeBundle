<?php

declare(strict_types=1);

namespace Positibe\Sylius\FeePlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SyliusFeePlugin extends Bundle
{
    use SyliusPluginTrait;
}
