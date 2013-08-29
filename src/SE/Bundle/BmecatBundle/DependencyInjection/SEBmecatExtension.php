<?php

namespace SE\Bundle\BmecatBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SEBmecatExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $documents = $config['documents'];
        foreach($documents as $id => $document) {

            $name = 'se.bmecat.document_builder'.$id;

            $definition = new Definition('SE\Component\BMEcat\DocumentBuilder');
            $definition->addMethodCall('load', [$document]);

            $container->setDefinition($name, $definition);

            $manager = $container->findDefinition('se.bmecat.document_builder_manager');
            $manager->addMethodCall('addDocumentBuilder', [$id, new Reference($name)]);
        }
    }
}
