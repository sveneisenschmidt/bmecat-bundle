<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SE\Bundle\BmecatBundle\Tests\DependencyInjection;

use SE\Bundle\BmecatBundle\SEBmecatBundle;

use Symfony\Component\DependencyInjection\Compiler\ResolveParameterPlaceHoldersPass;
use Symfony\Component\DependencyInjection\Compiler\ResolveDefinitionTemplatesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 *
 * @package SE\Bundle\BmecatBundle\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class SEBmecatBundleExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function Document_Builder_manager_Registered_As_Service()
    {
        $container = $this->getContainerForConfig(array(array()));
        $service   = $container->get('se.bmecat.document_builder_manager');

        $this->assertInstanceOf('\SE\Bundle\BmecatBundle\DocumentBuilderManager', $service);
    }

    /**
     *
     * @test
     */
    public function Loads_Builder_From_Config()
    {
        $name = sha1(uniqid(microtime(), true));
        $config = [
            [
                'documents' => [ $name => [] ]
            ]
        ];

        $container = $this->getContainerForConfig($config);
        $service   = $container->get('se.bmecat.document_builder_manager');
        $builder   = $service->getDocumentBuilder($name);
    }

    /**
     *
     * @test
     * @expectedException \SE\Bundle\BmecatBundle\Exception\UnkownDocumentBuilderException
     */
    public function Loads_Unkown_Builder_From_Config()
    {
        $name = sha1(uniqid(microtime(), true));
        $config = [
            [
                'documents' => []
            ]
        ];

        $container = $this->getContainerForConfig($config);
        $service   = $container->get('se.bmecat.document_builder_manager');
        $builder   = $service->getDocumentBuilder($name);
    }

    /**
     * @author Johannes M. Schmitt <schmittjoh@gmail.com>
     *
     * @param array $configs
     * @return \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    private function getContainerForConfig(array $configs)
    {
        $bundle = new SEBmecatBundle();
        $extension = $bundle->getContainerExtension();

        $container = new ContainerBuilder();
        $container->setParameter('kernel.debug', true);
        $container->setParameter('kernel.cache_dir', sys_get_temp_dir().'/bmecat-bundle');
        $container->setParameter('kernel.bundles', array());
        $container->set('service_container', $container);
        $container->registerExtension($extension);
        $extension->load($configs, $container);

        $bundle->build($container);

        $container->getCompilerPassConfig()->setOptimizationPasses(array(
            new ResolveParameterPlaceHoldersPass(),
            new ResolveDefinitionTemplatesPass(),
        ));
        $container->getCompilerPassConfig()->setRemovingPasses(array());
        $container->compile();

        return $container;
    }
}