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
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Response
 * @package AppBundle\Entity\Postman
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"response", "response-read"}},
 *          "denormalization_context"={"groups"={"response", "response-write"}}
 *     }
 * )
 * @ORM\Entity()
 */
class Response
{
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
     * @var Item
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Postman\Item", inversedBy="responses")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * @Groups({"response-write"})
     */
    protected $item;

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
     * @return Response
     */
    public function setId(string $id)
    {
        $this->id = $id;

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
     * @return Response
     */
    public function setItem(Item $item)
    {
        $this->item = $item;

        return $this;
    }

}