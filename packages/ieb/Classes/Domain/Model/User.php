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
 * User
 */
class User extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    protected $username = '';

    /**
     * @var bool
     */
    protected $disable = false;

    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * email
     *
     * @var string
     */
    protected $email = '';

    /**
     * trAdmin
     *
     * @var bool
     */
    protected $trAdmin = false;

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
     * Returns the trAdmin
     *
     * @return bool trAdmin
     */
    public function getTrAdmin()
    {
        return $this->trAdmin;
    }

    /**
     * Sets the trAdmin
     *
     * @param bool $trAdmin
     * @return void
     */
    public function setTrAdmin(bool $trAdmin)
    {
        $this->trAdmin = $trAdmin;
    }

    /**
     * Returns the boolean state of trAdmin
     *
     * @return bool trAdmin
     */
    public function isTrAdmin()
    {
        return $this->trAdmin;
    }

    /**
     * @return bool
     */
    public function isDisable()
    {
        return $this->disable;
    }

    /**
     * @param bool $disable
     */
    public function setDisable(bool $disable)
    {
        $this->disable = $disable;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
}
