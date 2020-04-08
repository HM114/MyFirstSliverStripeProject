<?php


namespace App\Code;


use Page;

class ProjectsHolder extends Page
{
    private static $allowed_children = [
        Project::class
    ];
}
