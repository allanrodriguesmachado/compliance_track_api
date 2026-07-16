<?php

namespace App\Domain\User\Enum;

enum AccessLevel: string
{
    case LEADER = 'Leader';
    case MEMBER = 'Member';

    case AUDITOR = 'Auditor';

}
