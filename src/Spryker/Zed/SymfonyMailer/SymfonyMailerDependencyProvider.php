<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SymfonyMailer;

use Spryker\Shared\Kernel\ContainerInterface;
use Spryker\Zed\Glossary\Communication\Plugin\TwigTranslatorPlugin;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\SymfonyMailer\Dependency\Facade\SymfonyMailerToGlossaryFacadeBridge;
use Spryker\Zed\SymfonyMailer\Dependency\Facade\SymfonyMailerToLocaleFacadeBridge;
use Spryker\Zed\SymfonyMailer\Dependency\Renderer\SymfonyMailerToRendererBridge;

/**
 * @method \Spryker\Zed\SymfonyMailer\SymfonyMailerConfig getConfig()
 */
class SymfonyMailerDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_LOCALE = 'FACADE_LOCALE';

    /**
     * @var string
     */
    public const FACADE_GLOSSARY = 'FACADE_GLOSSARY';

    /**
     * @var string
     */
    public const RENDERER = 'twig';

    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addRenderer($container);
        $container = $this->addLocaleFacade($container);
        $container = $this->addGlossaryFacade($container);

        return $container;
    }

    protected function addRenderer(Container $container): Container
    {
        $container->set(static::RENDERER, function (ContainerInterface $container) {
            $twig = $container->getApplicationService(static::RENDERER);

            if (!$twig->hasExtension(TwigTranslatorPlugin::class)) {
                $translator = new TwigTranslatorPlugin();
                $twig->addExtension($translator);
            }

            return new SymfonyMailerToRendererBridge($twig);
        });

        return $container;
    }

    protected function addLocaleFacade(Container $container): Container
    {
        $container->set(static::FACADE_LOCALE, function (Container $container) {
            return new SymfonyMailerToLocaleFacadeBridge(
                $container->getLocator()->locale()->facade(),
            );
        });

        return $container;
    }

    protected function addGlossaryFacade(Container $container): Container
    {
        $container->set(static::FACADE_GLOSSARY, function (Container $container) {
            return new SymfonyMailerToGlossaryFacadeBridge(
                $container->getLocator()->glossary()->facade(),
            );
        });

        return $container;
    }
}
