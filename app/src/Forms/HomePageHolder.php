<?php


namespace App\Forms;


use Page;
use App\Forms\SignupPage;

class HomePageHolder extends Page
{
    private static $allowed_children = [
        SignupPage::class
    ];
}
