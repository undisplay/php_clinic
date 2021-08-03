<?php 

require_once("./core/Template.php");
require_once("./models/models.php");

use Core\Template;

function patient_create()
{   

    Patient()->create($_POST);

    $patients = Patient()->get([
        "id"=>[
            "selector"=>">=",
            "value"=>0
        ]
    ]);

    $id = $patients[count($patients)-1]["id"];

    Dossier()->create([
        "id_patient"=>$id
    ]);

    Template::redirect('/patient');
}

function patient_liste()
{
    if (!empty($_GET['q'])) {
        Template::render("./templates/patient/patient_liste.php",[
            "active_page"=>"patient",
            "patients"=>Patient()->get([
                "id"=>[
                    "selector"=>"LIKE",
                    "value"=>intval($_GET['q']),
                    "linker"=>"OR"
                ],
                "nom"=>[
                    "selector"=>"LIKE",
                    "value"=>$_GET['q'],
                    "linker"=>"OR"
                ],
                "prenom"=>[
                    "selector"=>"LIKE",
                    "value"=>$_GET['q'],
                    "linker"=>"OR"
                ],
                "email"=>[
                    "selector"=>"LIKE",
                    "value"=>$_GET['q']
                ]
            ])
        ]); 
    } 
    else {
        Template::render("./templates/patient/patient_liste.php",[
            "active_page"=>"patient",
            "patients"=>Patient()->get([
                "id"=>[
                    "selector"=>">=",
                    "value"=>0
                ]
            ])
        ]); 
    }
    
    
      
}

function patient_details($id)
{

    $dossier = Dossier()->get([
        "id_patient"=>[
            "selector"=>"=",
            "value"=>$id
        ]
    ])[0];

    $consultations = consultation()->get([
        "id"=>[
            "selector"=>">=",
            "value"=>0,
            "linker"=>"AND"
        ],
        "id_dossier"=>[
            "selector"=>"=",
            "value"=>$dossier["id"]
        ],
    ]);

    Template::render("./templates/patient/patient_details.php",[
        "active_page"=>"patient",
        "patient"=>Patient()->get([
            "id"=>[
                "selector"=>"=",
                "value"=>$id
            ]
        ])[0],
        "dossier"=>$dossier,
        "consultations"=>$consultations
    ]);   
}

function patient_update($id)
{
    Patient()->update([
        "id"=>[
            "selector"=>"=",
            "value"=>intval($id)
        ]
    ],
    $_POST);

    Template::redirect("/patient/{$id}");
}

function patient_delete($id)
{
    Patient()->delete([
        "id"=>[
            "selector"=>"=",
            "value"=>$id
        ]
    ]);

    Template::redirect("/patient");   
}
?>