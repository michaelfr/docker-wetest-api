<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 14/10/17
 * Time: 20:45
 */

namespace AppBundle\Service;


use AppBundle\Entity\Specification;
use AppBundle\Interfaces\DocumentationInterface;
use AppBundle\Interfaces\SpecificationInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Yaml\Parser;

class SpecificationManager
{
    /**
     * @var DenormalizerInterface
     */
    private $denormalizer;

    /**
     * @var JsonEncoder
     */
    private $jsonEncoder;

    /**
     * @var string|null
     */
    private $schemaPath;

    /**
     * @var Parser
     */
    private $yamlParser;

    /**
     * Postman constructor.
     *
     * @param DenormalizerInterface $denormalizer
     * @param JsonEncoder           $jsonEncoder
     * @param null|string           $schemaPath
     */
    public function __construct(DenormalizerInterface $denormalizer, JsonEncoder $jsonEncoder, string $schemaPath)
    {
        $this->denormalizer = $denormalizer;
        $this->jsonEncoder = $jsonEncoder;
        $this->schemaPath = $schemaPath;

        $this->yamlParser = new Parser();
    }

    public function getSchemas()
    {

        $schemas = [];

        $finder = new Finder();
        /** @var SplFileInfo $filename */
        foreach ($finder->name('*.yml')->files()->in($this->schemaPath) as $filename) {
            $data = $this->yamlParser->parse($filename->getContents());
            $format = isset($data['swagger']) ? DocumentationInterface::SWAGGER_FORMAT : DocumentationInterface::RAML_FORMAT;
            $schemas[] = $this->denormalizer->denormalize($data, Specification::class, $format);
        }

        $finder = new Finder();
        /** @var SplFileInfo $filename */
        foreach ($finder->name('*.json')->files()->in($this->schemaPath) as $filename) {
            $data = $this->jsonEncoder->decode($filename->getContents(), JsonEncoder::FORMAT);
            $format = isset($data['swagger']) ? DocumentationInterface::SWAGGER_FORMAT : DocumentationInterface::RAML_FORMAT;
            $schemas[] = $this->denormalizer->denormalize($data, Specification::class, $format);
        }
        dump($schemas);
        return $schemas;
    }
}