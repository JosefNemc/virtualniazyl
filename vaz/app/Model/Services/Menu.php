<?php
declare(strict_types=1);

namespace App\Model\Services;

class Menu
{
    public function getMenu(): array
    {
        return [
            ['logged' => false, 'role' => '', 'name' => 'Domovská stránka', 'link' => 'Home:default', 'alwaysAvailable' => true],
            ['logged' => false, 'role' => '', 'name' => 'O Nás', 'link' => 'Home:page/o-nas', 'alwaysAvailable' => true],
            ['logged' => false, 'role' => '', 'name' => 'Azyly', 'link' => 'Home:azyls', 'alwaysAvailable' => true],
            ['logged' => false, 'role' => '', 'name' => 'Zvířátka k adopci', 'link' => 'Home:adoptions', 'alwaysAvailable' => true],
            ['logged' => false, 'role' => '', 'name' => 'Přihlášení', 'link' => 'home:signIn'],
            ['logged' => false, 'role' => '', 'name' => 'Registrace', 'link' => 'home:register'],
            ['logged' => false, 'role' => '', 'name' => 'Přihlášení', 'link' => 'home:signIn'],
            ['logged' => true, 'role' => '', 'name' => 'Odhlásit', 'link' => 'Home:logOut'],
            ['logged' => true, 'role' => 'admin', 'name' => 'Administrace', 'link' => 'Admin:default'],
            ['logged' => true, 'role' => 'azyl', 'name' => 'Správa Azylu', 'link' => 'Azyl:default'],
            ['logged' => true, 'role' => 'user', 'name' => 'Profil', 'link' => 'User:default'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Administrace', 'link' => 'Admin:default'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Správa Azylu', 'link' => 'Azyl:default'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Profil', 'link' => 'User:default'],
            ['logged' => true, 'role' => 'superadmin', 'name' => '&pi;', 'link' => 'SuperAdmin:default']
        ];
    }

    public function getAdminMenu(): array
    {
        return [
            ['logged' => true, 'role' => 'admin', 'name' => 'Správa uživatelů', 'link' => 'Admin:users'],
            ['logged' => true, 'role' => 'admin', 'name' => 'Správa zvířat', 'link' => 'Admin:animals'],
            ['logged' => true, 'role' => 'admin', 'name' => 'Správa adopcí', 'link' => 'Admin:adoptions'],
            ['logged' => true, 'role' => 'admin', 'name' => 'Správa azylů', 'link' => 'Admin:azyls'],
            ['logged' => true, 'role' => 'admin', 'name' => 'Správa zájemců', 'link' => 'Admin:owners'],
            ['logged' => true, 'role' => 'admin', 'name' => 'Správa novinek', 'link' => 'Admin:news'],
            ['logged' => true, 'role' => 'admin', 'name' => 'Správa sponzorů', 'link' => 'Admin:sponsors'],
            ['logged' => true, 'role' => 'admin', 'name' => 'Správa příspěvků', 'link' => 'Admin:news'],
            ['logged' => true, 'role' => 'admin', 'name' => 'Správa komentářů', 'link' => 'Admin:page']
        ];
    }

    public function getSuperAdminMenu():array
    {
        return [
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Správa uživatelů', 'link' => 'SuperAdmin:users'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Správa zvířat', 'link' => 'SuperAdmin:animals'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Správa adopcí', 'link' => 'SuperAdmin:adoptions'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Správa azylů', 'link' => 'SuperAdmin:azyls'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Správa zájemců', 'link' => 'SuperAdmin:owners'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Správa fotek', 'link' => 'SuperAdmin:photos'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Správa rolí', 'link' => 'SuperAdmin:roles'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Správa vzkazů', 'link' => 'SuperAdmin:vzkazů'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Správa novinek', 'link' => 'SuperAdmin:news'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Správa sponzorů', 'link' => 'SuperAdmin:sponsors'],
            ['logged' => true, 'role' => 'superadmin', 'name' => 'Správa komentářů', 'link' => 'SuperAdmin:page']
        ];
    }

    public function getAzylMenu():array
    {
        return [
            ['logged' => true, 'role' => 'azyl', 'name' => 'Správa zvířat', 'link' => 'Azyl:animals'],
            ['logged' => true, 'role' => 'azyl', 'name' => 'Správa adopcí', 'link' => 'Azyl:adoptions'],
            ['logged' => true, 'role' => 'azyl', 'name' => 'Správa zájemců', 'link' => 'Azyl:owners'],
            ['logged' => true, 'role' => 'azyl', 'name' => 'Správa fotek', 'link' => 'Azyl:photos'],
            ['logged' => true, 'role' => 'azyl', 'name' => 'Správa novinek', 'link' => 'Azyl:news']
        ];
    }

    public function getUserMenu():array
    {
        return [
            ['logged' => true, 'role' => 'user', 'name' => 'Profil', 'link' => 'User:default'],
            ['logged' => true, 'role' => 'user', 'name' => 'Moje adopce', 'link' => 'User:adoptions'],
            ['logged' => true, 'role' => 'user', 'name' => 'Moje zvířátka', 'link' => 'User:animals'],
            ['logged' => true, 'role' => 'user', 'name' => 'Moje fotky', 'link' => 'User:photos']
        ];
    }
}