<?php

namespace App\Enums;

enum UserRole: string
{
    case Member = 'member';
    case Administrator = 'administrator';

    /**
     * Get the human-readable label for the role.
     */
    public function label(): string
    {
        return match ($this) {
            self::Member => 'Member',
            self::Administrator => 'Administrator',
        };
    }

    /**
     * Determine if the role has administrative access.
     */
    public function isAdministrator(): bool
    {
        return $this === self::Administrator;
    }
}
