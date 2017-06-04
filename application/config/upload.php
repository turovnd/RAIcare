<?php

return array(

    Model_Uploader::NAME => array(
        'path' => 'uploads/',
        /**
         * Image sizes config
         * key - filename prefix_
         * first argument  — need crop square or should resize with saving ratio
         * second argument — max width
         * third argument  — max height
         */
        'sizes' => array(
            'o'  => array(false, 1500, 1500),
            'b'  => array(true , 200, 200),
            'm'  => array(true , 100, 100),
            's'  => array(true , 50),
        ),

    ),

);
