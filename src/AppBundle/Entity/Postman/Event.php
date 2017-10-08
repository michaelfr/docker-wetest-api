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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Event
 * @package AppBundle\Entity\Postman
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"event", "event-read"}},
 *          "denormalization_context"={"groups"={"event", "event-write"}}
 *     }
 * )
 *
 * @ORM\Entity()
 */
class Event
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
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"event"})
     */
    protected $listen;

    /**
     * @var Script|null
     * @ORM\Column(name="script_id", nullable=true)
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Postman\Script", mappedBy="event")
     * @Groups({"event-read"})
     */
    protected $script = null;

    /**
     * @var Item
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Postman\Item", inversedBy="events")
     * @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * @Groups({"event-write"})
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
     * @return Event
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getListen(): string
    {
        return $this->listen;
    }

    /**
     * @param string $listen
     *
     * @return Event
     */
    public function setListen(string $listen)
    {
        $this->listen = $listen;

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
     * @return Event
     */
    public function setItem(Item $item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * @return Script
     */
    public function getScript(): Script
    {
        return $this->script;
    }

    /**
     * @param Script $script
     *
     * @return Event
     */
    public function setScript(Script $script)
    {
        $this->script = $script;

        return $this;
    }

}