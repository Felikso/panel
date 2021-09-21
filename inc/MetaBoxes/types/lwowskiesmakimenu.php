<?php 

/* $dir = basename(__FILE__);
$postName = str_replace('.php', '', $dir);


 $lwowskiesmakimenu = new MetaboxRegisterFields;

 //TEXT INPUTS

 $lwowskiesmakimenu->create_text_field_array(
    [
        'productName'  => 'nazwa produktu',
    ], 
    [
        'productName'  => 'nazwa produktu',
    ],
    );

//NUMBER INPUTS

 $lwowskiesmakimenu->create_quantity_input_field_array(
    [
        'price'  => 'cena',
        'quantity' => 'ilość'
    ], 
     1, 
     100
    );

//IMAGES INPUTS
 $lwowskiesmakimenu->create_image_upload_field_array(
    [
        'photo1'  => 'zdjęcie-1',
        'photo2'  => 'zdjęcie-2',
        'photo3'  => 'zdjęcie-3',
        'photo4'  => 'zdjęcie-4',
    ] 
    );

//SELECT INPUTS

$lwowskiesmakimenu->create_select_field_array(
    [
        'menuCategory'  => 'kategoria',
    ],
    [
        'danie główne',
        'zupy',
        'napoje'
    ],
);

$lwowskiesmakimenu->create_select_field_array(
    [
        'currency'  => 'waluta',
    ], 
    [
        'pln',
        'euro'
    ],
);


//CHECKBOX INPUTS

$lwowskiesmakimenu->create_checkbox_field_array(
    [
        'promotion'  => 'promocja',
    ], 
    [
        'czy produkt aktualnie jest w prmocji?'  => false
    ],
    "checkbox"
    );

$lwowskiesmakimenu->create_checkbox_field_array(
    [
        'vegetarian'  => 'wegetariański',
    ], 
    [
        'czy produkt jest wegetariański?'  => false
    ],
    "checkbox"
    );

//TEXT AREA INPUTS

$lwowskiesmakimenu->create_textarea_field_array(
    [
        'mainContent' => 'główna treść',
        'components' => 'składniki',
    ], 
    );


    
  */