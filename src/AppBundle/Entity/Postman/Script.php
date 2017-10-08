<?php
/**
 * Created by PhpStorm.
 * User: gdelre
 * Date: 08/10/17
 * Time: 10:30
 */

namespace AppBundle\Entity\Postman;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\Interfaces\ResourceInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Script
 * @package AppBundle\Entity\Postman
 *
 * @ApiResource(
 *     attributes={
 *          "normalization_context"={"groups"={"script", "script-read"}},
 *          "denormalization_context"={"groups"={"script", "script-write"}}
 *     }
 * )
 * @ORM\Entity()
 */
class Script
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
     * @var Event|null
     * @ORM\Column(name="event_id", nullable=true)
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Postman\Event", inversedBy="script")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * @Groups({"script-read"})
     */
    protected $event = null;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"script"})
     */
    protected $type;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Groups({"script"})
     */
    protected $exec;

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
     * @return Script
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * @param Event $event
     *
     * @return Script
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Script
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getExec(): string
    {
        return $this->exec;
    }

    /**
     * @param string $exec
     *
     * @return Script
     */
    public function setExec(string $exec)
    {
        $this->exec = $exec;

        return $this;
    }
}