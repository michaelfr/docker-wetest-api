<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 14/10/17
 * Time: 20:50
 */

namespace AppBundle\Model;


class Raml
{
    /** @var null|string */
    protected $title = null;

    /** @var null|string */
    protected $version = null;

    /** @var null|string */
    protected $baseUri = null;

    /** @var array */
    protected $annotationTypes = [];

    /** @var array */
    protected $types = [];

    /** @var array */
    protected $paths = [];

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     *
     * @return Raml
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param null|string $version
     *
     * @return Raml
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * @param null|string $baseUri
     *
     * @return Raml
     */
    public function setBaseUri($baseUri)
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * @return array
     */
    public function getAnnotationTypes(): array
    {
        return $this->annotationTypes;
    }

    /**
     * @param array $annotationTypes
     *
     * @return Raml
     */
    public function setAnnotationTypes(array $annotationTypes)
    {
        $this->annotationTypes = $annotationTypes;

        return $this;
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * @param array $types
     *
     * @return Raml
     */
    public function setTypes(array $types)
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return array
     */
    public function getPaths(): array
    {
        return $this->paths;
    }

    /**
     * @param array $paths
     *
     * @return Raml
     */
    public function setPaths(array $paths)
    {
        $this->paths = $paths;

        return $this;
    }

}