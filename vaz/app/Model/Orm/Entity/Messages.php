<?php
declare(strict_types=1);
namespace App\Entity;

use App\Model\Orm\Enums\MessageTypeEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'messages')]


class Message
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private string $title;
    #[ORM\Column(type: 'text', length: 2048)]
    private string $message;

    #[ORM\Column(type: 'datetimeimmutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(targetEntity: "Users", inversedBy: "sentMessages")]
    #[ORM\JoinColumn(name: "sender_id", referencedColumnName: "id")]
    private Users $sender;

    #[ORM\ManyToOne(targetEntity: "Users", inversedBy: "receivedMessages")]
    #[ORM\JoinColumn(name: "receiver_id", referencedColumnName: "id")]
    private Users $receiver;

    #[ORM\Column(type: 'boolean')]
    private bool $readed;

    #[ORM\Column(type: 'datetimeimmutable', nullable: true)]
    private \DateTimeImmutable $readedAt;

    #[ORM\Column(type: 'datetimeimmutable' , nullable: true)]
    private \DateTimeImmutable $deletedAt;

    #[ORM\Column(type: MessageTypeEnum::MASSAGE_TYPE_ENUM, length: 255)]
    private MessageTypeEnum $type;

}