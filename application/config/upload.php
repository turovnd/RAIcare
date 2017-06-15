<?php

return array(

    Model_Uploader::ORGANIZATION_COVER => array(
        'path' => 'uploads/organizations/cover/',
        /**
         * Image sizes config
         * key - filename prefix_
         * first argument  — need crop square or should resize with saving ratio
         * second argument — max width
         * third argument  — max height
         */
        'sizes' => array(
            'o'  => array(false, 1500, 1500),
        ),

    ),

    Model_Uploader::PENSION_COVER => array(
        'path' => 'uploads/pensions/cover/',
        /**
         * Image sizes config
         * key - filename prefix_
         * first argument  — need crop square or should resize with saving ratio
         * second argument — max width
         * third argument  — max height
         */
        'sizes' => array(
            'o'  => array(false, 1500, 1500),
        ),

    ),

);
