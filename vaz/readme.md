Virtuální azil 
=================

Virtuální azil je webová aplikace, která umožňuje uživatelům zaregistrovat se a následně vytvořit profil svého domácího mazlíčka, který je k adopci. Uživatelé mohou prohlížet profily ostatních mazlíčků a pokud se jim nějaký zalíbí, mohou se o něj ucházet.
Projekt je vytvořený v [Nette](https://nette.org/), což je PHP framework. Využívá databázovu vrstvu Doctrine a využívá moderní jazyk PHP 8.2+ .

Autorem je [Josef Němec](https://josefnemec.cz/), systém je navržený s ohledem na maximální anonimitu ze strany azylů a naopak s maximální odpovědností k lidem adoptujícím.


Požadavky
------------
1. Doctrine
2. PHP 8.2+
3. Nette 3.1+
4. Composer
5. MySQL 5.7+
6. Apache 2.4+ nebo Nginx 1.19+
7. PHP extensions: pdo_mysql, intl, curl, json, mbstring, openssl, xml, zip, gd, fileinfo, dom, simplexml
8. Docker (pro vývojové prostředí, nebo pro nasazení)



Installation
------------

To install the Web Project, Composer is the recommended tool. If you're new to Composer,
follow [these instructions](https://doc.nette.org/composer). Then, run:

	composer create-project nette/web-project path/to/install
	cd path/to/install

Ensure the `temp/` and `log/` directories are writable.


Web Server Setup
----------------

To quickly dive in, use PHP's built-in server:

	php -S localhost:8000 -t www

Then, open `http://localhost:8000` in your browser to view the welcome page.

For Apache or Nginx users, configure a virtual host pointing to your project's `www/` directory.

**Important Note:** Ensure `app/`, `config/`, `log/`, and `temp/` directories are not web-accessible.
Refer to [security warning](https://nette.org/security-warning) for more details.


Minimal Skeleton
----------------

For demonstrating issues or similar tasks, rather than starting a new project, use
this [minimal skeleton](https://github.com/nette/web-project/tree/minimal).
