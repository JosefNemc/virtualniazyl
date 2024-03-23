<?php
declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;

class userDetailsFormFactory extends Form
{
    public function create(): Form
    {
        $form = new Form;
        $form->addText('firstName', 'Jméno')
            ->setRequired('Zadejte jméno');
        $form->addText('lastName', 'Příjmení')
            ->setRequired('Zadejte příjmení');
        $form->addText('address', 'Adresa')
            ->setRequired('Zadejte adresu');
        $form->addSelect('country', 'Země', ['Česko', 'Slovensko'])
            ->setRequired('Zadejte zemi');
        $form->addSelect('region', 'Kraj', ['Hlavní město Praha', 'Jihočeský', 'Jihomoravský', 'Karlovarský', 'Královéhradecký', 'Liberecký', 'Moravskoslezský', 'Olomoucký', 'Pardubický', 'Plzeňský', 'Středočeský', 'Ústecký', 'Vysočina', 'Zlínský'])
            ->setRequired('Zadejte kraj');
        $form->addSelect('city','Město', ['Praha', 'Brno', 'Ostrava', 'Plzeň', 'Liberec', 'Olomouc', 'České Budějovice', 'Hradec Králové', 'Ústí nad Labem', 'Pardubice', 'Zlín', 'Hradec Králové', 'Karlovy Vary', 'Jihlava', 'Tábor', 'Žďár nad Sázavou', 'Jindřichův Hradec', 'Příbram', 'Kolín', 'Kutná Hora', 'Pelhřimov', 'Třebíč'])
            ->setRequired('Zadejte město');

        $form->addSubmit('send', 'Uložit')
            ->setHtmlAttribute('class', 'btn btn-gradient');
        return $form;
    }

    /*
     * Tady je to vyhazování měst obcí a podobně.
     * $city = $form->addSelect('city', 'Obec:') //$city  z $region

             ->setRequired()
             ->setPrompt('Nejprve vyberte okres')
             ->setHtmlAttribute('class', 'form-control col-md-3 form-select')
             ->setHtmlAttribute('data-depends', 'region')
             ->setHtmlAttribute('data-url', $this->link('home:cities', '#'));
        $form ->onAnchor[] = fn() => $city->setItems($region->getValue()
               ? $this->locale->getCityFromRegionForm($region->getValue())
               : []);
     *
     *
     *
     *
     */
}