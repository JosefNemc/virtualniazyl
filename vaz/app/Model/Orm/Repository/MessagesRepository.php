<?php
declare(strict_types=1);

namespace App\Model\Orm\Repository;

use App\Model\Orm\Entity\Messages;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class MessagesRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em, string $entityClass = Messages::class)
    {
        parent::__construct($em, $em->getClassMetadata($entityClass));
    }

    public function countUnreadMessages(): int
    {
        return $this->createQueryBuilder('m')
            ->select('COUNT(m)')
            ->andWhere('m.isRead = :isRead')
            ->setParameter('isRead', false)
            ->getQuery()
            ->getSingleScalarResult();
    }


    public function getMessagesByReceiverId(int $receiverId): array
    {
        return $this->findBy(['receiver' => $receiverId]);
    }

    public function getMessagesBySenderId(int $senderId): array
    {
        return $this->findBy(['sender' => $senderId]);
    }

    public function getMessagesByReceiverIdAndSenderId(int $receiverId, int $senderId): array
    {
        return $this->findBy(['receiver' => $receiverId, 'sender' => $senderId]);
    }

    public function getMessagesByReceiverIdAndSenderIdAndType(int $receiverId, int $senderId, string $type): array
    {
        return $this->findBy(['receiver' => $receiverId, 'sender' => $senderId, 'type' => $type]);
    }

    public function getMessagesByReceiverIdAndType(int $receiverId, string $type): array
    {
        return $this->findBy(['receiver' => $receiverId, 'type' => $type]);
    }

    public function getMessagesBySenderIdAndType(int $senderId, string $type): array
    {
        return $this->findBy(['sender' => $senderId, 'type' => $type]);
    }

    public function getMessagesByType(string $type): array
    {
        return $this->findBy(['type' => $type]);
    }

    public function getMessagesByReceiverIdAndReaded(int $receiverId, bool $readed): array
    {
        return $this->findBy(['receiver' => $receiverId, 'readed' => $readed]);
    }

    public function getMessagesBySenderIdAndReaded(int $senderId, bool $readed): array
    {
        return $this->findBy(['sender' => $senderId, 'readed' => $readed]);
    }

    public function getMessagesByReceiverIdAndSenderIdAndReaded(int $receiverId, int $senderId, bool $readed): array
    {
        return $this->findBy(['receiver' => $receiverId, 'sender' => $senderId, 'readed' => $readed]);
    }
}