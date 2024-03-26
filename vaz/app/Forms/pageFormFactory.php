<?php

declare(strict_types=1);

namespace App\Forms;

use App\Model\Orm\Entity\Pages;
use Nette\Application\UI\Form;

class PageFormFactory extends Form
{
    public function create(Pages $page): Form
    {
        $form = new Form();
        $form->addText('title', 'Title')
            ->setHtmlAttribute('class', 'form-control')
            ->setRequired('Název stránky')
            ->setDefaultValue($page->getTitle());
        $form->addTextArea('content', 'Content')
            ->setHtmlAttribute('class', 'form-control')
            ->setRequired('Obsah stránky v HTML5.')
            ->setDefaultValue($page->getContent());
        $form->addText('link', 'Link')
            ->setOption('cols', 50)
            ->setOption('rows', 10)
            ->setHtmlAttribute('class', 'form-control html-editor')
            ->setRequired('Odkaz na stránku')
            ->setEmptyValue('Odkaz na stránku')
            //Odkaz na stránku - žádné mezery, diakritika, speciální znaky, pouze malá písmena a pomlčky.
            ->addRule(Form::PatternInsensitive, 'Odkaz na stránku - žádné mezery, diakritika, speciální znaky, pouze malá písmena a pomlčky.', '^[a-z0-9-]+$')
            ->setDefaultValue($page->getLink());
        $form->addCheckbox('important', 'Important')
            ->setHtmlAttribute('class', 'form-control')
        ->setDefaultValue($page->getImportant());
        $form->addCheckbox('global', 'Global')
            ->setHtmlAttribute('class', 'form-control')
            ->setDefaultValue($page->getGlobal());

        $form->addSubmit('sendPage', 'Save')
            ->setHtmlAttribute('class', 'btn btn-primary');
        return $form;
    }
}