<?php

namespace App\Security;

/**
 * Password static interface
 *
 * @author alex
 */
class Password
{
    /**
     * Crypt password
     *
     * @param string $password
     * @return string
     */
    public static function crypt($password)
    {
        return password_hash($password);
    }

    /**
     * Validate password hash
     *
     * @param string $password
     * @param string $hash
     * @return boolean
     */
    public static function validate($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
