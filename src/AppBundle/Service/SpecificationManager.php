<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 14/10/17
 * Time: 20:45
 */

namespace AppBundle\Service;


use AppBundle\Model\Raml;
use AppBundle\Model\Swagger;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Yaml\Parser;

class SpecificationManager
{
    const FROM_SWAGGER = Swagger::class;

    const FROM_RAML = Raml::class;

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
            $class = isset($data['swagger']) ? self::FROM_SWAGGER : self::FROM_RAML;
            $schemas[] = $this->denormalizer->denormalize($data, $class);
        }

        $finder = new Finder();
        /** @var SplFileInfo $filename */
        foreach ($finder->name('*.json')->files()->in($this->schemaPath) as $filename) {
            $data = $this->jsonEncoder->decode($filename->getContents(), JsonEncoder::FORMAT);
            $class = isset($data['swagger']) ? self::FROM_SWAGGER : self::FROM_RAML;
            $schemas[] = $this->denormalizer->denormalize($data, $class);
        }

        return $schemas;
    }
}