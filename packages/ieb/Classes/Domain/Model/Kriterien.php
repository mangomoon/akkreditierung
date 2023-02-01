<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model;


/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Georg Ringer <mail@ringer.it>
 */

/**
 * Kriterien
 */
class Kriterien extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * chiffre
     *
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $chiffre = '';

    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * hinweis
     *
     * @var string
     */
    protected $hinweis = '';

    /**
     * pruefkriterien
     *
     * @var string
     */
    protected $pruefkriterien = '';

    /**
     * hilfetext
     *
     * @var string
     */
    protected $hilfetext = '';

    /**
     * Returns the chiffre
     *
     * @return string
     */
    public function getChiffre()
    {
        return $this->chiffre;
    }

    /**
     * Sets the chiffre
     *
     * @param string $chiffre
     * @return void
     */
    public function setChiffre(string $chiffre)
    {
        $this->chiffre = $chiffre;
    }

    /**
     * Returns the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns the hinweis
     *
     * @return string
     */
    public function getHinweis()
    {
        return $this->hinweis;
    }

    /**
     * Sets the hinweis
     *
     * @param string $hinweis
     * @return void
     */
    public function setHinweis(string $hinweis)
    {
        $this->hinweis = $hinweis;
    }

    /**
     * Returns the pruefkriterien
     *
     * @return string
     */
    public function getPruefkriterien()
    {
        return $this->pruefkriterien;
    }

    /**
     * Sets the pruefkriterien
     *
     * @param string $pruefkriterien
     * @return void
     */
    public function setPruefkriterien(string $pruefkriterien)
    {
        $this->pruefkriterien = $pruefkriterien;
    }

    /**
     * Returns the hilfetext
     *
     * @return string
     */
    public function getHilfetext()
    {
        return $this->hilfetext;
    }

    /**
     * Sets the hilfetext
     *
     * @param string $hilfetext
     * @return void
     */
    public function setHilfetext(string $hilfetext)
    {
        $this->hilfetext = $hilfetext;
    }
}
