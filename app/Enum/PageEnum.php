<?php

namespace App\Enum;

enum PageEnum: string
{
    case PRIVACY = 'Privacy policy';
    case TERMS = 'Terms and conditions';
    case REFUND = 'Refund policy';
    case ABOUT = 'About us';
    case CONTACT = 'Contact us';
    case FAQ = 'Faq';
}
