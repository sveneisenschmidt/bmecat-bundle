<?php

namespace SE\Bundle\BmecatBundle;

use \SE\Bundle\BmecatBundle\Exception\UnkownDocumentBuilderException;
use \SE\Component\BMECat\DocumentBuilder;

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
            throw new UnkownDocumentBuilderException(sprintf('Unknown document builder %s.'));
        }

        return $this->builders[$name];
    }
}