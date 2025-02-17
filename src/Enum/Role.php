<?php

namespace App\Enum;

enum Role: string
{
    case USER = 'ROLE_USER';
    case SUPERADMIN = 'ROLE_SUPERADMIN';
    case EDITOR = 'ROLE_EDITOR';
    case MANAGER = 'ROLE_MANAGER';

    public function getLabel(): string
    {
        return match ($this) {
            self::USER => 'Přihlášený uživatel',
            self::SUPERADMIN => 'Superadmin',
            self::EDITOR => 'Redaktor',
            self::MANAGER => 'Manažer',
        };
    }

    public static function getAllowedRolesApp()
    {
        return [
            self::SUPERADMIN,
            self::EDITOR,
            self::MANAGER,
        ];
    }
}

