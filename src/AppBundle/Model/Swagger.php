<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 14/10/17
 * Time: 20:46
 */

namespace AppBundle\Model;


class Swagger
{
    /** @var null|string */
    protected $swagger = null;

    /** @var null|string */
    protected $basePath = null;

    /** @var null|string */
    protected $title = null;

    /** @var null|string */
    protected $version = null;

    /** @var array */
    protected $paths = [];

    /** @var array */
    protected $definitions = [];

    /**
     * @return null|string
     */
    public function getSwagger()
    {
        return $this->swagger;
    }

    /**
     * @param null|string $swagger
     *
     * @return Swagger
     */
    public function setSwagger($swagger)
    {
        $this->swagger = $swagger;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param null|string $basePath
     *
     * @return Swagger
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;

        return $this;
    }

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
     * @return Swagger
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
     * @return Swagger
     */
    public function setVersion($version)
    {
        $this->version = $version;

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
     * @return Swagger
     */
    public function setPaths(array $paths)
    {
        $this->paths = $paths;

        return $this;
    }

    /**
     * @return array
     */
    public function getDefinitions(): array
    {
        return $this->definitions;
    }

    /**
     * @param array $definitions
     *
     * @return Swagger
     */
    public function setDefinitions(array $definitions)
    {
        $this->definitions = $definitions;

        return $this;
    }
}