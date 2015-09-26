<?php

namespace App\Models;

use App\Models\Abstraction\Model as AbstractModel;

final class UserModel extends AbstractModel
{
    /** @var string */
    private $_username;

    /** @var string */
    private $_password;

    /** @var string */
    private $_email;

    /** @var \DateTime */
    private $_dateOfRegistration;

    /** @var \DateTime|null */
    private $_lastActivity;

    /**
     * @param string $username
     * @param string $password
     * @param string $email
     * @param \DateTime $dateOfRegistration
     * @param \DateTime|null $lastActivity
     */
    public function __construct(
        $username, $password, $email, \DateTime $dateOfRegistration, \DateTime $lastActivity = null
    )
    {
        $this->_username = $username;
        $this->_password = $password;
        $this->_email = $email;
        $this->_dateOfRegistration = $dateOfRegistration;
        $this->_lastActivity = $lastActivity;
    }

    /**
     * @param string $newEmail
     */
    public function changeEmail($newEmail)
    {
        // email validation process
        $this->updateLastActivity();
        $this->_email = $newEmail;
    }

    /**
     * @param string $newPassword
     */
    public function changePassword($newPassword)
    {
        // password encryption process
        $this->updateLastActivity();
        $this->_password = $newPassword;
    }

    public function updateLastActivity()
    {
        $this->_lastActivity = new \DateTime;
    }
}