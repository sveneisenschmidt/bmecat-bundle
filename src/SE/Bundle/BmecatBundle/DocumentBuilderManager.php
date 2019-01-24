<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SE\Bundle\BmecatBundle;

use SE\Bundle\BmecatBundle\Exception\UnkownDocumentBuilderException;
use SE\Component\BMECat\DocumentBuilder;

/**
 *
 * @package SE\Bundle\BmecatBundle
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
class DocumentBuilderManager
{
    /**
     *
     * @var \SE\Component\BMECat\DocumentBuilder[]
     */
    protected $builders = [];

    /**
     * @param $name
     * @param \SE\Component\BMECat\DocumentBuilder $builder
     */
    public function addDocumentBuilder($name, DocumentBuilder $builder)
    {
        $this->builders[$name] = $builder;
    }

    /**
     * @param string $name
     * @throws Exception\UnkownDocumentBuilderException
     * @return \SE\Component\BMECat\DocumentBuilder
     */
    public function getDocumentBuilder($name)
    {
        if(isset($this->builders[$name]) === false) {
            throw new UnkownDocumentBuilderException(sprintf('Unknown document builder %s.', $name));
        }

        return $this->builders[$name];
    }

    /**
     *
     * @return \SE\Component\BMECat\DocumentBuilder[]
     */
    public function getAllDocumentBuilder()
    {
        return $this->builders;
    }
}
