<?php
//use Nette;
use App\Entity\Users;
use Nette\Security\SimpleIdentity;
use Nette\Security\Passwords;


class MyAuthenticator implements Nette\Security\Authenticator
{
    private Passwords $passwords;
    private Users $users;

    public function __construct(Users $users, Passwords $passwords)
    {
        $this->users = $users;
        $this->passwords = $passwords;
    }

    public function authenticate(string $email, string $password): SimpleIdentity
    {
        $row = $this->users->getUserName(['email' => $email]);

        if (!$row) {
            throw new Nette\Security\AuthenticationException('Chyba přihlášení.');
        }

        if (!$this->passwords->verify($password, $row->password)) {
            throw new Nette\Security\AuthenticationException('Chyba přihlášení.');
        }

        $user = new SimpleIdentity($row->id,$row->level,

            [
                'name' => $row->lastname,
                'login' => $row->firstname,
                'email' => $row->email,
                'nickname' => $row->nickname,
                'admin' => $row->admin
            ]

        );

        return $user;
    }
}