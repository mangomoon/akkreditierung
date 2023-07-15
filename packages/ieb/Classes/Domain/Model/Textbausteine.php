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
 * Textbausteine
 */
class Textbausteine extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * kriterium
     *
     * @var string
     */
    protected $kriterium = '';

    /**
     * baustein
     *
     * @var string
     */
    protected $baustein = '';

    /**
     * Returns the kriterium
     *
     * @return string
     */
    public function getKriterium()
    {
        return $this->kriterium;
    }

    /**
     * Sets the kriterium
     *
     * @param string $kriterium
     * @return void
     */
    public function setKriterium(string $kriterium)
    {
        $this->kriterium = $kriterium;
    }

    /**
     * Returns the baustein
     *
     * @return string
     */
    public function getBaustein()
    {
        return $this->baustein;
    }

    /**
     * Sets the baustein
     *
     * @param string $baustein
     * @return void
     */
    public function setBaustein(string $baustein)
    {
        $this->baustein = $baustein;
    }
}
