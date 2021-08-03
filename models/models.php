<?php

require_once("./core/Model.php");
require_once("./models/mixins.php");

use Core\Model;

function Patient(){
    $patient = new Model("patient",
        array_merge(Mixins::$commons,Mixins::$user,[
            "date_naissance"=>"date",
            "nom_jeune_fille_mere"=>"varchar(255) unique"
        ])
    );

    $patient->sync();

    return $patient;
}

function Medecin(){
    $medecin = new Model("medecin",
        array_merge(Mixins::$commons,Mixins::$user,[
            "specialisation"=>"varchar(255)"
        ])
    );

    $medecin->sync();

    return $medecin;
}

function Dossier(){
    $dossier = new Model("dossier",
        array_merge(Mixins::$commons,[
            "id_patient"=>"integer",
            "FOREIGN KEY(id_patient)" => " REFERENCES patient(id)"
        ])
    );

    $dossier->sync();

    return $dossier;
}

function Consultation(){
    $consultation = new Model("consultation",
        array_merge(Mixins::$commons,[
            "id_dossier"=>"integer",
            "id_medecin"=>"integer",
            "symptomes"=>"text",
            "date"=>"date",
            "FOREIGN KEY(id_dossier)"=>"REFERENCES dossier(id)",
            "FOREIGN KEY(id_medecin)"=>"REFERENCES medecin(id)"
        ])
    );

    $consultation->sync();

    return $consultation;
}

function Prescription(){
    $prescription = new Model("prescription",
        array_merge(Mixins::$commons,[
            "id_consultation"=>"integer",
            "ordonnance"=>"text",
            "FOREIGN KEY(id_consultation)"=>"REFERENCES consultation(id)",
        ])
    );

    $prescription->sync();

    return $prescription;
}

