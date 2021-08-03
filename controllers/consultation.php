<?php 

require_once("./core/Template.php");
require_once("./models/models.php");

use Core\Template;

function consultation_create()
{
    $id_dossier = Dossier()->get([
        "id_patient"=>[
            "selector"=>"=",
            "value"=>$_POST["id_patient"]
        ]
    ])[0]["id"];
    
    $ordonnance = $_POST["ordonnance"];
    
    unset($_POST["ordonnance"]);
    unset($_POST["id_patient"]);
    
    consultation()->create(array_merge(["id_dossier"=>$id_dossier],$_POST));


    $consultations = Consultation()->get([
        "id"=>[
            "selector"=>">=",
            "value"=>0
        ]
    ]);

    $id = $consultations[count($consultations)-1]["id"];

    Prescription()->create([
        "id_consultation"=>$id,
        "ordonnance"=>$ordonnance
    ]);

    Template::redirect('/consultation');
}

function consultation_liste()
{

    $patients = Patient()->get([
        "id"=>[
            "selector"=>">=",
            "value"=>0
        ]
    ]);

    $medecins = medecin()->get([
        "id"=>[
            "selector"=>">=",
            "value"=>0
        ]
    ]);

    if (!empty($_GET['q'])) {
        $consultations = consultation()->get([
            "id_dossier"=>[
                "selector"=>"LIKE",
                "value"=>intval($_GET['q'])
            ]
        ]); 
    } 
    else {
        $consultations = consultation()->get([
            "id"=>[
                "selector"=>">=",
                "value"=>0
            ]
        ]);
    }
    
    Template::render("./templates/consultation/consultation_liste.php",[
        "active_page"=>"consultation",
        "consultations"=>$consultations,
        "medecins"=>$medecins,
        "patients"=>$patients
    ]); 
      
}

function consultation_details($id)
{

    $consultation = consultation()->get([
        "id"=>[
            "selector"=>"=",
            "value"=>$id
        ]
    ])[0];

    $prescriptions = Prescription()->get([
        "id"=>[
            "selector"=>">=",
            "value"=>0,
            "linker"=>"AND"
        ],
        "id_consultation"=>[
            "selector"=>"=",
            "value"=>$consultation["id"]
        ]
    ]);

    $patient = Patient()->get([
        "id"=>[
            "selector"=>"=",
            "value"=>$consultation["id_dossier"]
        ]
    ])[0];

    $medecin = medecin()->get([
        "id"=>[
            "selector"=>"=",
            "value"=>$consultation["id_medecin"]
        ]
    ])[0];

    Template::render("./templates/consultation/consultation_details.php",[
        "active_page"=>"consultation",
        "consultation"=>$consultation,
        "medecin"=>$medecin,
        "patient"=>$patient,
        "prescriptions"=>$prescriptions
    ]);   
}
?>