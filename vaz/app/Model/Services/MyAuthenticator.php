<?php
//use Nette;
use App\Model\Orm\Entity\Users;
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


    /**
     * @param string $email
     * @param string $password
     * @return SimpleIdentity
     * @throws \Nette\Security\AuthenticationException
     */
    #[\Override] function authenticate(Users|string $email, string $password): SimpleIdentity
    {
        $user = $this->usersRepository->findOneBy(['email' => $email]);
        if (!$user) {
            throw new Nette\Security\AuthenticationException('Uživatel nebyl nalezen.');
        }
        if (!$this->passwords->verify($password, $user->getPassword())) {
            throw new Nette\Security\AuthenticationException('Nesprávné heslo.');
        }
        return new SimpleIdentity($user->getId(), $user->getRole(), ['email' => $user->getEmail()]);
    }
}