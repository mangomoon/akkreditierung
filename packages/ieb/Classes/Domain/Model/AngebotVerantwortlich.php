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
 * AngebotVerantwortlich
 */
class AngebotVerantwortlich extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * @var \DateTime
     */
    public $tstamp = null;

    /**
     * nachname
     *
     * @var string
     */
    protected $nachname = '';

    /**
     * vorname
     *
     * @var string
     */
    protected $vorname = '';

    /**
     * email
     *
     * @var string
     */
    protected $email = '';

    /**
     * telefon
     *
     * @var string
     */
    protected $telefon = '';

    /**
     * verantwortlich
     *
     * @var bool
     */
    protected $verantwortlich = false;

    /**
     * ok
     *
     * @var bool
     */
    protected $ok = false;

    /**
     * lebenslaufDatei
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $lebenslaufDatei = null;

    /**
     * lebenslauf
     *
     * @var string
     */
    protected $lebenslauf = '';

    /**
     * archiviert
     *
     * @var bool
     */
    protected $archiviert = false;

    /**
     * Returns the nachname
     *
     * @return string
     */
    public function getNachname()
    {
        return $this->nachname;
    }

    /**
     * Sets the nachname
     *
     * @param string $nachname
     * @return void
     */
    public function setNachname(string $nachname)
    {
        $this->nachname = $nachname;
    }

    /**
     * Returns the vorname
     *
     * @return string
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * Sets the vorname
     *
     * @param string $vorname
     * @return void
     */
    public function setVorname(string $vorname)
    {
        $this->vorname = $vorname;
    }

    /**
     * Returns the email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Returns the telefon
     *
     * @return string
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * Sets the telefon
     *
     * @param string $telefon
     * @return void
     */
    public function setTelefon(string $telefon)
    {
        $this->telefon = $telefon;
    }

    /**
     * Returns the verantwortlich
     *
     * @return bool
     */
    public function getVerantwortlich()
    {
        return $this->verantwortlich;
    }

    /**
     * Sets the verantwortlich
     *
     * @param bool $verantwortlich
     * @return void
     */
    public function setVerantwortlich(bool $verantwortlich)
    {
        $this->verantwortlich = $verantwortlich;
    }

    /**
     * Returns the boolean state of verantwortlich
     *
     * @return bool
     */
    public function isVerantwortlich()
    {
        return $this->verantwortlich;
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
     * Returns the lebenslaufDatei
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getLebenslaufDatei()
    {
        return $this->lebenslaufDatei;
    }

    /**
     * Sets the lebenslaufDatei
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $lebenslaufDatei
     * @return void
     */
    public function setLebenslaufDatei($lebenslaufDatei)
    {
        $this->lebenslaufDatei = $lebenslaufDatei;
    }

    /**
     * Returns the lebenslauf
     *
     * @return string
     */
    public function getLebenslauf()
    {
        return $this->lebenslauf;
    }

    /**
     * Sets the lebenslauf
     *
     * @param string $lebenslauf
     * @return void
     */
    public function setLebenslauf(string $lebenslauf)
    {
        $this->lebenslauf = $lebenslauf;
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
