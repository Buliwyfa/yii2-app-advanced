<?php
return [
    [
        'first_name' => 'Paulo',
        'last_name' => 'Coutinho',
        'email' => 'paulo@prsolucoes.com',
        'auth_key' => 'ukqBK_g7hZ8zSEX0olsBLQs5DRNWyMed',
        'password_hash' => '$2y$13$VO5i4K7HwyL0GusdNN8/p.R.fN2LzMKq5cONL9UBSz8C.dTIRCxSu', // customer@password
        'password_reset_token' => '$2y$13$CfGv3aBqAJS8bsY6j75E7.cTMIBT3ymYAnm9kSXl5HxWBANx/eaaW',
        'status' => 'active',
        'gender' => 'male',
        'language_id' => 1,
        'created_at' => '1565479064',
        'updated_at' => '1565479064',
    ],
    [
        'first_name' => 'Test',
        'last_name' => 'Inactive',
        'email' => 'test-inactive@test.com',
        'auth_key' => 'ukqBK_g7hZ8zSEX0olsBLQs5DRNWyMed',
        'password_hash' => '$2y$13$VO5i4K7HwyL0GusdNN8/p.R.fN2LzMKq5cONL9UBSz8C.dTIRCxSu', // customer@password
        'password_reset_token' => 'abc_' . time(),
        'status' => 'inactive',
        'gender' => 'male',
        'language_id' => 1,
        'created_at' => '1565479064',
        'updated_at' => '1565479064',
    ],
];
