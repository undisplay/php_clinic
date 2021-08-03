<?php
  use Core\Template;
?>

<!doctype html>
<html lang="en">
  <?php
    Template::render("./templates/partials/head.php");
  ?>
  <body>

    <?php
      Template::render("./templates/partials/header.php",["active_page"=>"consultation"]);
    ?>
    <div class="container d-flex justify-content-between align-items-center">
      <h3>Consultations</h3>

      <form class="row me-2 ms-2">
        <div class="col-6 col-md-10">
          <input type="search" value="<?php echo$_GET['q'];?>" class="form-control" name="q" placeholder="No Dossier">
        </div>
        <div class="col-2">
          <button type="submit" class="btn btn-outline-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
          </button>
        </div>
      </form>
      <!-- Button trigger modal -->
      <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ajouter Consultation
      </button>
    </div>
    <!-- Modal -->
    <form method="POST" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Consultation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row md-3">
              <div class="col-12 col-md-6">
                <label  class="form-label">Medecin</label>
                <select class="form-control"  required name="id_medecin" >
                  <?php
                    foreach ($medecins as $medecin) {
                      echo '
                      <option value='.$medecin["id"].'>'.$medecin["id"].'-'.$medecin["nom"].' '.$medecin["prenom"].'</option>
                      ';
                    }
                  ?> 
                </select>
              </div>
              <div class="col-12 col-md-6">
                <label  class="form-label">Patient</label>
                <select class="form-control"  required name="id_patient" >
                  <?php
                      foreach ($patients as $patient) {
                        echo '
                        <option value='.$patient["id"].'>'.$patient["id"].'-'.$patient["nom"].' '.$patient["prenom"].'</option>
                        ';
                      }
                  ?> 
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label  class="form-label">Symptomes</label>
              <textarea class="form-control"  required name="symptomes" placeholder="Ex: 6, Tabarre Haiti" rows="2"></textarea>
            </div>
            <div class="mb-3">
              <label  class="form-label">Date</label>
              <input type="date" class="form-control" value="<?php echo date("Y-m-d");?>"  required name="date" placeholder="Ex: 02/11/2000">
            </div>
            <h5>Prescription</h5>
            <div class="mb-3">
              <label  class="form-label">Ordonnance</label>
              <textarea class="form-control"  required name="ordonnance" placeholder="Ex: paracetamol(250mg)" rows="2"></textarea>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary">Ajouter</button>
          </div>
          </div>
      </div>
    </form>

    <table class="table table-dark table-responsive container mt-2">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">No Dossier</th>
          <th scope="col">Id Medecin</th>
          <th class="col-3 col-md-2" scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($consultations as $consultation) {
            echo '
            <tr>
              <th scope="row">'.$consultation['id'].'</th>
              <td>'.$consultation['id_dossier'].'</td>
              <td>'.$consultation['id_medecin'].'</td>
              <td class="text-center">
                <a href="/consultation/'.$consultation['id'].'" class="btn btn-primary">Voir plus</a>
              </td>
            </tr>
            ';
          }
        ?>
      </tbody>
    </table> 
  </body>
</html>