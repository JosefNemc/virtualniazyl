<?php
declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;

class newsFormFactory extends Form
{
    public function create(): Form
    {
        $form = new Form;
        $form->addText('title', 'Title:')
            ->setRequired('Nadpis.');
        $form->addTextArea('content', 'Content:')
            ->setMaxLength(2048)
            ->setHtmlAttribute('rows', 20)
            ->setHtmlAttribute('cols', 80)
            ->setHtmlAttribute('class','form-control')
            ->setRequired('Obsah novinky.');
        $form->addSubmit('send', 'Uložit');
        $form->addCheckbox('global', 'Globální');
        $form->addDateTime('visibleFrom', 'Viditelné od:');
        return $form;
    }
}