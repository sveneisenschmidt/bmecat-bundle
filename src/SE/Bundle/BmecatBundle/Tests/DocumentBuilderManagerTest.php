<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Bundle\BmecatBundle\Tests;

/**
 *
 * @package SE\Bundle\BmecatBundle\Tests
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DocumentBuilderManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function Add_Document_Builder()
    {
        $manager = new \SE\Bundle\BmecatBundle\DocumentBuilderManager();
        $this->assertEmpty($manager->getAllDocumentBuilder());

        $builder = new \SE\Component\BMEcat\DocumentBuilder();
        $name    = sha1(uniqid(microtime(), true));
        $manager->addDocumentBuilder($name, $builder);
        $this->assertSame($builder, $manager->getDocumentBuilder($name));
    }

    /**
     *
     * @test
     * @expectedException \SE\Bundle\BmecatBundle\Exception\UnkownDocumentBuilderException
     */
    public function Load_Unknown_Builder()
    {
        $manager = new \SE\Bundle\BmecatBundle\DocumentBuilderManager();
        $name    = sha1(uniqid(microtime(), true));
        $manager->getDocumentBuilder($name);
    }
}