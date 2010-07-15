<?php

namespace Symfony\Bundle\TwigBundle\DependencyInjection;

use Symfony\Components\DependencyInjection\Loader\LoaderExtension;
use Symfony\Components\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Components\DependencyInjection\BuilderConfiguration;

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * TwigExtension.
 *
 * @package    Symfony
 * @subpackage Bundle_TwigBundle
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class TwigExtension extends LoaderExtension
{
    /**
     * Loads the Twig configuration.
     *
     * @param array                                                        $config        An array of configuration settings
     * @param \Symfony\Components\DependencyInjection\BuilderConfiguration $configuration A BuilderConfiguration instance
     */
    public function configLoad($config, BuilderConfiguration $configuration)
    {
        if (!$configuration->hasDefinition('twig')) {
            $loader = new XmlFileLoader(__DIR__.'/../Resources/config');
            $configuration->merge($loader->load('twig.xml'));
        }

        $configuration->setParameter('twig.options', array_replace($configuration->getParameter('twig.options'), $config));
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    public function getNamespace()
    {
        return 'http://www.symfony-project.org/schema/dic/twig';
    }

    public function getAlias()
    {
        return 'twig';
    }
}
