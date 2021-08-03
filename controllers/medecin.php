<?php 

require_once("./core/Template.php");
require_once("./models/models.php");

use Core\Template;

function medecin_create()
{   

    medecin()->create($_POST);

    Template::redirect('/medecin');
}

function medecin_liste()
{
    if (!empty($_GET['q'])) {
        Template::render("./templates/medecin/medecin_liste.php",[
            "active_page"=>"medecin",
            "medecins"=>medecin()->get([
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
        Template::render("./templates/medecin/medecin_liste.php",[
            "active_page"=>"medecin",
            "medecins"=>medecin()->get([
                "id"=>[
                    "selector"=>">=",
                    "value"=>0
                ]
            ])
        ]); 
    }
    
    
      
}

function medecin_details($id)
{
    $consultations = consultation()->get([
        "id"=>[
            "selector"=>">=",
            "value"=>0,
            "linker"=>"AND"
        ],
        "id_medecin"=>[
            "selector"=>"=",
            "value"=>$id
        ],
    ]);

    Template::render("./templates/medecin/medecin_details.php",[
        "active_page"=>"medecin",
        "medecin"=>medecin()->get([
            "id"=>[
                "selector"=>"=",
                "value"=>$id
            ]
        ])[0],
        "consultations"=>$consultations
    ]);   
}

function medecin_update($id)
{
    medecin()->update([
        "id"=>[
            "selector"=>"=",
            "value"=>intval($id)
        ]
    ],
    $_POST);

    Template::redirect("/medecin/{$id}");
}

function medecin_delete($id)
{
    medecin()->delete([
        "id"=>[
            "selector"=>"=",
            "value"=>$id
        ]
    ]);

    Template::redirect("/medecin");   
}
?>