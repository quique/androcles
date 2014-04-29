<?php

class ColorTableSeeder extends Seeder {

    public function run()
    {
        DB::table('colors')->delete();

        Color::create(array('id' =>  1, 'name' => 'Negro'));
        Color::create(array('id' =>  2, 'name' => 'Blanco'));
        Color::create(array('id' =>  3, 'name' => 'Negro y blanco'));
        Color::create(array('id' =>  4, 'name' => 'Pelirrojo'));
        Color::create(array('id' =>  5, 'name' => 'Blanco y negro'));
        Color::create(array('id' =>  6, 'name' => 'Torti'));
        Color::create(array('id' =>  7, 'name' => 'Atigrado'));
        Color::create(array('id' =>  8, 'name' => 'Marrón claro'));
        Color::create(array('id' =>  9, 'name' => 'Negro y marrón claro'));
        Color::create(array('id' => 10, 'name' => 'Marrón claro y negro'));
        Color::create(array('id' => 11, 'name' => 'Marrón'));
        Color::create(array('id' => 12, 'name' => 'Marrón y negro'));
        Color::create(array('id' => 13, 'name' => 'Negro y marrón'));
        Color::create(array('id' => 14, 'name' => 'Manchado'));
        Color::create(array('id' => 15, 'name' => 'Manchado y negro'));
        Color::create(array('id' => 16, 'name' => 'Manchado y blanco'));
        Color::create(array('id' => 17, 'name' => 'Negro y manchado'));
        Color::create(array('id' => 18, 'name' => 'Blanco y manchado'));
        Color::create(array('id' => 19, 'name' => 'Tricolor'));
        Color::create(array('id' => 20, 'name' => 'Con lunares'));
        Color::create(array('id' => 21, 'name' => 'Con lunares y blanco'));
        Color::create(array('id' => 22, 'name' => 'Blanco y con lunares'));
        Color::create(array('id' => 23, 'name' => 'Crema'));
        Color::create(array('id' => 24, 'name' => 'Marrón claro y blanco'));
                                 // 25
        Color::create(array('id' => 26, 'name' => 'Blanco y marrón claro'));
        Color::create(array('id' => 27, 'name' => 'Torti y blanco'));
        Color::create(array('id' => 28, 'name' => 'Atigrado y blanco'));
        Color::create(array('id' => 29, 'name' => 'Pelirrojo y blanco'));
        Color::create(array('id' => 30, 'name' => 'Gris'));
        Color::create(array('id' => 31, 'name' => 'Gris y blanco'));
        Color::create(array('id' => 32, 'name' => 'Blanco y gris'));
        Color::create(array('id' => 33, 'name' => 'Blanco y torti'));
                                 // 34
        Color::create(array('id' => 35, 'name' => 'Marrón y blanco'));
        Color::create(array('id' => 36, 'name' => 'Azul'));
        Color::create(array('id' => 37, 'name' => 'Blanco y atigrado'));
        Color::create(array('id' => 38, 'name' => 'Amarillo y gris'));
        Color::create(array('id' => 39, 'name' => 'Varios'));
        Color::create(array('id' => 40, 'name' => 'Blanco y marrón'));
        Color::create(array('id' => 41, 'name' => 'Verde'));
        Color::create(array('id' => 42, 'name' => 'Ámbar'));
        Color::create(array('id' => 43, 'name' => 'Tortuga negra'));
        Color::create(array('id' => 44, 'name' => 'Tortuga azul'));
        Color::create(array('id' => 45, 'name' => 'Chocolate'));
        Color::create(array('id' => 46, 'name' => 'Tortuga chocolate'));
        Color::create(array('id' => 47, 'name' => 'Canela'));
        Color::create(array('id' => 48, 'name' => 'Tortuga canela'));
        Color::create(array('id' => 49, 'name' => 'Cervato'));
        Color::create(array('id' => 50, 'name' => 'Tortuga cervato'));
        Color::create(array('id' => 51, 'name' => 'Dorado'));
        Color::create(array('id' => 52, 'name' => 'Ámbar claro'));
        Color::create(array('id' => 53, 'name' => 'Lila'));
        Color::create(array('id' => 54, 'name' => 'Tortuga lila'));
        Color::create(array('id' => 55, 'name' => 'Liebre'));
        Color::create(array('id' => 56, 'name' => 'Foca'));
        Color::create(array('id' => 57, 'name' => 'Plata'));
        Color::create(array('id' => 58, 'name' => 'Rojizo'));
        Color::create(array('id' => 59, 'name' => 'Tortuga rojiza'));
    }

}
