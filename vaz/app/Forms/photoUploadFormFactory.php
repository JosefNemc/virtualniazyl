<?php
declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;


class PhotoUploadFormFactory extends Form
{
    public function create(): Form
    {
        $form = new Form;

        $form->addMultiUpload('photos', ' ')
            ->setHtmlAttribute('class', 'form-control inputfile')
            ->setRequired('Vyberte alespoň jednu fotku')
            ->setHtmlAttribute('accept', 'image/*')
            ->addRule($form::MaxLength, 'Maximálně lze nahrát %d souborů', 10)
            ->setHtmlAttribute('multiple');


        $form->addSubmit('uploadPhotos', 'Nahrát')
            ->setHtmlAttribute('class', 'btn btn-success form-control');

        return $form;
    }
}