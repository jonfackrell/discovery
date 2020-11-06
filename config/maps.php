<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    'routes' => [

        'patron' => '/maps',

        'admin' => '/maps/admin'

    ],

    'table_names' => [

        'libraries' => 'libraries',

        'floors' => 'floors',

        'locations' => 'locations',

        'categories' => 'categories',

        'amenities' => 'amenities',

        'amenity_location' => 'amenity_location',

        'range_groups' => 'range_groups',

        'ranges' => 'ranges',
    ],

    'middleware' => [

        'patron' => ['web'],

        'admin' => ['web'],

    ],

];
