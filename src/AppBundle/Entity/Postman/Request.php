<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 08/10/17
 * Time: 10:30
 */

namespace AppBundle\Entity\Postman;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request as SfRequest;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Request
 * @package AppBundle\Entity\Postman
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"request", "request-read"}},
 *          "denormalization_context"={"groups"={"request", "request-write"}}
 *     }
 * )
 * @ORM\Entity()
 */
class Request
{
    const DATA_MODE_PARAMS = 'params';
    const DATA_MODE_RAW = 'raw';

    /**
     * @var string The entity Id
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="AppBundle\Doctrine\UuidGenerator")
     * @ORM\Column(type="string")
     */
    protected $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"request"})
     */
    protected $url = null;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(callback = {"Request", "getAllowedMethods"})
     * @Groups({"request"})
     */
    protected $method;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"Request::DATA_MODE_RAW", "Request::DATA_MODE_PARAMS"})
     * @Groups({"request"})
     */
    protected $mode;

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"request"})
     */
    protected $body;

    /**
     * @var array
     * @ORM\Column(type="array")
     * @Assert\NotBlank()
     * @Groups({"request"})
     */
    protected $headers = [];

    /**
     * @var string|null
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"request"})
     */
    protected $description = null;

    /**
     * @var Item
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Postman\Item", inversedBy="request")
     * @ORM\JoinColumn(name="request_id", referencedColumnName="id")
     * @Groups({"request-write"})
     */
    protected $item;

    public static function getAllowedMethods()
    {
        return [
            SfRequest::METHOD_GET,
            SfRequest::METHOD_POST,
            SfRequest::METHOD_PUT,
            SfRequest::METHOD_DELETE,
            SfRequest::METHOD_PATCH,
            SfRequest::METHOD_OPTIONS,
            SfRequest::METHOD_HEAD,
        ];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return Request
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     *
     * @return Request
     */
    public function setUrl(string $url = null)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string|null $method
     *
     * @return Request
     */
    public function setMethod(string $method = null)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @param string|null $mode
     *
     * @return Request
     */
    public function setMode(string $mode = null)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string|null $body
     *
     * @return Request
     */
    public function setBody(string $body = null)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     *
     * @return Request
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     *
     * @return Request
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * @param Item $item
     *
     * @return Request
     */
    public function setItem(Item $item)
    {
        $this->item = $item;

        return $this;
    }

}