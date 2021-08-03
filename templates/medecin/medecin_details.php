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
      Template::render("./templates/partials/header.php",["active_page"=>"medecin"]);
    ?>
    <div class="container d-flex justify-content-between align-items-center">
      <h3>Medecins</h3>
      <div>
        <button class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#exampleModal">
          Supprimer
        </button>
      </div>
    </div>

    <!-- Modal -->
    <form method="POST" action="/medecin/delete/<?php echo$medecin["id"];?>" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Etes-vous sure?</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-footer d-flex justify-content-center">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
              <button type="submit" class="btn btn-primary">Oui</button>
          </div>
          </div>
      </div>
    </form>

    <form method="POST" class="container">
      <div class="row md-3">
        <div class="col-12 col-md-6">
          <label  class="form-label">Nom</label>
          <input type="text" class="form-control"  required name="nom" value="<?php echo$medecin["nom"];?>" placeholder="Ex: Snow">
        </div>
        <div class="col-12 col-md-6">
          <label  class="form-label">Prenom</label>
          <input type="text" class="form-control"  required name="prenom" value="<?php echo$medecin["prenom"];?>" placeholder="Ex: Jhon">
        </div>
      </div>
      <div class="row md-3">
        <div class="col-12 col-md-6">
          <label  class="form-label">Email</label>
          <input type="email" class="form-control"  required name="email" value="<?php echo$medecin["email"];?>" placeholder="Ex: name@example.com">
        </div>
        <div class="col-12 col-md-6">
          <label  class="form-label">Telephone</label>
          <input type="tel" class="form-control"  required name="telephone" value="<?php echo$medecin["telephone"];?>" placeholder="Ex: +50900000000">
        </div>
      </div>
      <div class="row md-3">
        <div class="col-12 col-md-6">
          <label  class="form-label">Sexe</label>
          <select class="form-control"  required name="sexe" value="<?php echo$medecin["sexe"];?>" placeholder="Ex: sexe">
            <option value="Homme">
              Homme
            </option>
            <option value="Femme">
              Femme
            </option>
          </select>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Specialisation</label>
          <input class="form-control" list="specialisations" name="specialisation" value="<?php echo$medecin["specialisation"];?>" placeholder="specialisation">
          <datalist id="specialisations">
            <option value="Pediatrerie">
            <option value="Generaliste">
            <option value="Cardiologue">
            <option value="ORL">
            <option value="Ginecologue">
            <option value="Odontologue">
          </datalist>
        </div>
      </div>
      <div class="mb-3">
        <label  class="form-label">Adresse</label>
        <textarea class="form-control"  required name="adresse" placeholder="Ex: 6, Tabarre Haiti" rows="2"><?php echo$medecin["adresse"];?></textarea>
      </div>
      <div class="mb-3 text-center">
        <button type="submit" class="btn btn-primary ">
          Enregistrer
        </button>
      </div>
    </form>

    <div class="container" >
      <h3>Consutations</h3>
      <table class="table table-dark table-responsive mt-2">
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
    </div>
  </body>
</html>