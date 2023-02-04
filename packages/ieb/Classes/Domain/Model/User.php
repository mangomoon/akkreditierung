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

    /**
     * @var bool
     */
    protected $disable = false;
    protected $username = '';
    protected $firstName = '';
    protected $lastName = '';
    protected $password = '';
    protected $usergroup = '';

    /**
     * name
     *
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var bool
     */
    protected $trAdmin = false;

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
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

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsergroup()
    {
        return $this->usergroup;
    }

    /**
     * @param string $usergroup
     */
    public function setUsergroup(string $usergroup)
    {
        $this->usergroup = $usergroup;
    }
    public function getFullname()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
