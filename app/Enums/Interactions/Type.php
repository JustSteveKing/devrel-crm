<?php

declare(strict_types=1);

namespace App\Enums\Interactions;

enum Type: string
{
    case Email = 'email';
    case Meeting = 'meeting';
    case Call = 'call';
    case Message = 'message';
    case SocialMedia = 'social-media';
    case NetworkEvent = 'network-event';
    case Conference = 'conference';
    case Webinar = 'webinar';
    case Presentation = 'presentation';
    case Demonstration = 'demonstration';
    case FollowUp = 'follow-up';
    case Feedback = 'feedback';
    case Other = 'other';
}
