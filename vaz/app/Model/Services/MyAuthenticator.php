<?php

namespace App\Model\Services;

use App\Model\Orm\Entity\Azyl;
use App\Model\Orm\Enums\RoleTypeEnum;
use App\Model\Orm\Repository\AzylRepository;
use Nette;
use App\Model\Orm\Repository\UsersRepository;
use Nette\Security\SimpleIdentity;
use Nette\Security\Passwords;


class MyAuthenticator implements Nette\Security\Authenticator
{
    private Passwords $passwords;
    private UsersRepository $usersRepository;
    private $azylRepository;
    private ?Azyl $azyl;

    public function __construct(UsersRepository $usersRepository, Passwords $passwords, AzylRepository $azylRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->passwords = $passwords;
        $this->azylRepository = $azylRepository;
        $this->azyl = null;
    }

    public function authenticate(string $email, string $password): SimpleIdentity
    {
        $user = $this->usersRepository->findOneBy(['email' => $email]);

        if (!$user) {
            throw new Nette\Security\AuthenticationException('Chyba přihlášení.');
        }

        if (!$this->passwords->verify($password, $user->getPassword())) {
            throw new Nette\Security\AuthenticationException('Chyba přihlášení.');
        }
        else {

            if ($user->getRole() === RoleTypeEnum::ROLE_AZYL)
            {
                $this->azyl = $this->azylRepository->findOneBy(['id' => $user->getAzyl()]);

            }


            return new SimpleIdentity($user->id, $user->getRole(),

                [
                    'email' => $user->getEmail(),
                    'userName' => $user->getUserName(),
                    'User'=> $user,
                    'Azyl' => $this->azyl

                ]

            );
        }
    }
}