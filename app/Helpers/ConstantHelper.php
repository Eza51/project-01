<?php

namespace App\Helpers;
//n PHP, however, const is used within classes
// to define class constants, which are similar to static variables but cannot be changed or redefined
//no database here is data
class ConstantHelper
{
    public  const  JOB_ATTRIBUTES_TYPE = [
        'Salary Type',
        'Experience',
        'Job Role',
        'Education',
        'Job Type',
    ];

    public const PLUGINS = [
        'Blog',
    ];

    public const CURRENCY = 'BDT';

    public const CURRENCY_SYMBOL = '৳';
}