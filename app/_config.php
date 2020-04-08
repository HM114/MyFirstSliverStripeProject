<?php

use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;


SilverStripe\ORM\Search\FulltextSearchable::enable();

// remove PasswordValidator for SilverStripe 5.0
$validator = PasswordValidator::create();
// Settings are registered via Injector configuration - see passwords.yml in framework
Member::set_password_validator($validator);
