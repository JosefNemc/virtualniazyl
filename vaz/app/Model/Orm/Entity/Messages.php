<?php
declare(strict_types=1);
namespace App\Entity;

use App\Model\Orm\Enums\MessageTypeEnum;
use DateTimeImmutable;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(type: 'datetime')]
    private DateTimeImmutableType $createdAt;

    #[ORM\ManyToOne(targetEntity: "Users", inversedBy: "sentMessages")]
    #[ORM\JoinColumn(name: "sender_id", referencedColumnName: "id")]
    private Users $sender;

    #[ORM\ManyToOne(targetEntity: "Users", inversedBy: "receivedMessages")]
    #[ORM\JoinColumn(name: "receiver_id", referencedColumnName: "id")]
    private Users $receiver;

    #[ORM\Column(type: 'boolean')]
    private bool $readed;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private DateTimeImmutableType $readedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private DateTimeImmutableType $deletedAt;

    #[ORM\Column(type: MessageTypeEnum::MASSAGE_TYPE_ENUM, length: 255)]
    private MessageTypeEnum $type;

}