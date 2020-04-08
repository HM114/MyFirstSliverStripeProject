<?php


namespace App\Code;


use SilverStripe\ORM\DataObject;
use App\Code\Project;

class Mentor extends DataObject
{
    private static $db = [
        'Name' => 'Varchar'
    ];

    private static $belongs_many_many = [
        'Projects' => Project::class
    ];
}
