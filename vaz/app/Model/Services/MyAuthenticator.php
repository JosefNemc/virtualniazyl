<?php

namespace App\Model\Services;

use Nette;
use App\Model\Orm\Repository\UsersRepository;
use Nette\Security\SimpleIdentity;
use Nette\Security\Passwords;


class MyAuthenticator implements Nette\Security\Authenticator
{
    private Passwords $passwords;
    private UsersRepository $usersRepository;

    public function __construct(UsersRepository $usersRepository, Passwords $passwords)
    {
        $this->usersRepository = $usersRepository;
        $this->passwords = $passwords;
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

            return new SimpleIdentity($user->id, $user->getRole(),

                [
                    'lastName' => $user->getLastName(),
                    'firstName' => $user->getFirstName(),
                    'email' => $user->getEmail(),
                    'userName' => $user->getUserName()
                ]

            );
        }
    }
}