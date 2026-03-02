<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SymfonyMailer\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\SymfonyMailer\Business\Renderer\RendererInterface;
use Spryker\Zed\SymfonyMailer\Business\Renderer\TwigRenderer;
use Spryker\Zed\SymfonyMailer\Business\Translator\GlossaryTranslator;
use Spryker\Zed\SymfonyMailer\Business\Translator\TranslatorInterface;
use Spryker\Zed\SymfonyMailer\Dependency\External\SymfonyMailerToMailerInterface;
use Spryker\Zed\SymfonyMailer\Dependency\External\SymfonyMailerToSymfonyMailerAdapter;
use Spryker\Zed\SymfonyMailer\Dependency\Facade\SymfonyMailerToGlossaryFacadeInterface;
use Spryker\Zed\SymfonyMailer\Dependency\Facade\SymfonyMailerToLocaleFacadeInterface;
use Spryker\Zed\SymfonyMailer\Dependency\Renderer\SymfonyMailerToRendererInterface;
use Spryker\Zed\SymfonyMailer\SymfonyMailerDependencyProvider;

/**
 * @method \Spryker\Zed\SymfonyMailer\SymfonyMailerConfig getConfig()
 */
class SymfonyMailerBusinessFactory extends AbstractBusinessFactory
{
    public function createSymfonyMailerAdapter(): SymfonyMailerToMailerInterface
    {
        return new SymfonyMailerToSymfonyMailerAdapter(
            $this->createRenderer(),
            $this->createTranslator(),
            $this->getConfig(),
        );
    }

    public function createRenderer(): RendererInterface
    {
        return new TwigRenderer(
            $this->getRenderer(),
            $this->getLocaleFacade(),
        );
    }

    public function createTranslator(): TranslatorInterface
    {
        return new GlossaryTranslator(
            $this->getGlossaryFacade(),
        );
    }

    public function getLocaleFacade(): SymfonyMailerToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(SymfonyMailerDependencyProvider::FACADE_LOCALE);
    }

    public function getRenderer(): SymfonyMailerToRendererInterface
    {
        return $this->getProvidedDependency(SymfonyMailerDependencyProvider::RENDERER);
    }

    public function getGlossaryFacade(): SymfonyMailerToGlossaryFacadeInterface
    {
        return $this->getProvidedDependency(SymfonyMailerDependencyProvider::FACADE_GLOSSARY);
    }
}
