<?php
/**
 * User: ignat
 * Date: 14.07.16 22:32
 */
use App\User;

return [

        // Users
    [
        'name'          => 'Георгий Фёдорович Кузьмин',
        'email'         => 'user1@example.com',
        'password'      => \Hash::make('qwerty'),
        'type'          => User::TYPE_USER,
        'rating'        => 0,
        'gender'        => 'male',
    ],[
        'name'          => 'Петр Фёдорович Горбунов',
        'email'         => 'user2@example.com',
        'password'      => \Hash::make('qwerty'),
        'type'          => User::TYPE_USER,
        'rating'        => 0,
        'gender'        => 'male',
    ],[
        'name'          => 'Никита Аркадьевич Силин',
        'email'         => 'awesomesun56@example.com',
        'password'      => \Hash::make('qwerty'),
        'type'          => User::TYPE_DOCTOR,
        'speciality'    => 'Кардиолог',
        'rating'        => 0,
        'gender'        => 'male',
    ],[
        'name'          => 'Геннадий Лаврентьевич Быков ',
        'email'         => 'brownapple86@example.com',
        'password'      => \Hash::make('qwerty'),
        'type'          => User::TYPE_DOCTOR,
        'speciality'    => 'Офтальмолог',
        'rating'        => 0,
        'gender'        => 'male',
    ],
        //    Doctors
    [
        'name'          => 'Кристина Арсеньевна Максимова',
        'email'         => 'doc1@example.com',
        'password'      => \Hash::make('qwerty'),
        'type'          => User::TYPE_DOCTOR,
        'description'   => 'Офтальмолог',
        'speciality'    => 'Офтальмолог',
        'rating'        => 0,
        'gender'        => 'female',
    ],[
        'name'          => 'Мария Ильинична Казакова',
        'email'         => 'doc2@example.com',
        'password'      => \Hash::make('qwerty'),
        'type'          => User::TYPE_DOCTOR,
        'description'   => 'Терапевт общего профиля',
        'speciality'    => 'Терапевт',
        'rating'        => 0,
        'gender'        => 'female',
    ]
];