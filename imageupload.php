<?php
include_once 'core/init.php';

if(File::exists('image')){

    $file = new File('image');


    $file->validate([

        'size'		=>		[
            'min'		=>		'5',
            'max'		=>		'20000000000'

        ],
        'type'		=>		[

            'picture'	=>		[

                'min'		=>		[

                    'width'		=>		'20',
                    'height'	=>		'20'

                ],
                'max'		=>		[
                    'width'		=>		'2500',
                    'height'	=>		'3500'


                ]

            ]

        ]

    ]);


    if ($file->passed()) {
        $save = $file->save('picture');
        echo $save[0][1];


    }else {
        echo $file->errors()[0];
    }



}
else echo("not ava");




?>