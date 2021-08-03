<?php 

class Mixins{

    public static $commons = [
        "id"=>"integer primary key"
    ];

    public static $user = [
        "nom"=>"varchar(255)",
        "prenom"=>"varchar(255)",
        "sexe"=>"varchar(255)",
        "email"=>"varchar(255)",
        "adresse"=>"text(500)",
        "telephone"=>"varchar(255)"
    ];

}

?>