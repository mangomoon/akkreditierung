<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Domain\Model;


/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */

/**
 * Standort
 */
class Standort extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * adresse
     *
     * @var string
     */
    protected $adresse = '';

    /**
     * plz
     *
     * @var int
     */
    protected $plz = 0;

    /**
     * ort
     *
     * @var string
     */
    protected $ort = '';

    /**
     * pruefBescheid
     *
     * @var bool
     */
    protected $pruefBescheid = false;

    /**
     * koopSchule
     *
     * @var string
     */
    protected $koopSchule = '';

    /**
     * koopSchuleDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $koopSchuleDatei = null;

    /**
     * ok
     *
     * @var bool
     */
    protected $ok = false;

    /**
     * lockedBy
     *
     * @var int
     */
    protected $lockedBy = 0;

    /**
     * archiviert
     *
     * @var bool
     */
    protected $archiviert = false;

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
     * Returns the adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Sets the adresse
     *
     * @param string $adresse
     * @return void
     */
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * Returns the plz
     *
     * @return int
     */
    public function getPlz()
    {
        return $this->plz;
    }

    /**
     * Sets the plz
     *
     * @param int $plz
     * @return void
     */
    public function setPlz(int $plz)
    {
        $this->plz = $plz;
    }

    /**
     * Returns the ort
     *
     * @return string
     */
    public function getOrt()
    {
        return $this->ort;
    }

    /**
     * Sets the ort
     *
     * @param string $ort
     * @return void
     */
    public function setOrt(string $ort)
    {
        $this->ort = $ort;
    }

    /**
     * Returns the pruefBescheid
     *
     * @return bool
     */
    public function getPruefBescheid()
    {
        return $this->pruefBescheid;
    }

    /**
     * Sets the pruefBescheid
     *
     * @param bool $pruefBescheid
     * @return void
     */
    public function setPruefBescheid(bool $pruefBescheid)
    {
        $this->pruefBescheid = $pruefBescheid;
    }

    /**
     * Returns the boolean state of pruefBescheid
     *
     * @return bool
     */
    public function isPruefBescheid()
    {
        return $this->pruefBescheid;
    }

    /**
     * Returns the koopSchule
     *
     * @return string
     */
    public function getKoopSchule()
    {
        return $this->koopSchule;
    }

    /**
     * Sets the koopSchule
     *
     * @param string $koopSchule
     * @return void
     */
    public function setKoopSchule(string $koopSchule)
    {
        $this->koopSchule = $koopSchule;
    }

    /**
     * Returns the koopSchuleDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getKoopSchuleDatei()
    {
        return $this->koopSchuleDatei;
    }

    /**
     * Sets the koopSchuleDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $koopSchuleDatei
     * @return void
     */
    public function setKoopSchuleDatei(\TYPO3\CMS\Extbase\Domain\Model\FileReference $koopSchuleDatei)
    {
        $this->koopSchuleDatei = $koopSchuleDatei;
    }

    /**
     * Returns the ok
     *
     * @return bool
     */
    public function getOk()
    {
        return $this->ok;
    }

    /**
     * Sets the ok
     *
     * @param bool $ok
     * @return void
     */
    public function setOk(bool $ok)
    {
        $this->ok = $ok;
    }

    /**
     * Returns the boolean state of ok
     *
     * @return bool
     */
    public function isOk()
    {
        return $this->ok;
    }

    /**
     * Returns the lockedBy
     *
     * @return int
     */
    public function getLockedBy()
    {
        return $this->lockedBy;
    }

    /**
     * Sets the lockedBy
     *
     * @param int $lockedBy
     * @return void
     */
    public function setLockedBy(int $lockedBy)
    {
        $this->lockedBy = $lockedBy;
    }

    /**
     * Returns the archiviert
     *
     * @return bool
     */
    public function getArchiviert()
    {
        return $this->archiviert;
    }

    /**
     * Sets the archiviert
     *
     * @param bool $archiviert
     * @return void
     */
    public function setArchiviert(bool $archiviert)
    {
        $this->archiviert = $archiviert;
    }

    /**
     * Returns the boolean state of archiviert
     *
     * @return bool
     */
    public function isArchiviert()
    {
        return $this->archiviert;
    }
}
