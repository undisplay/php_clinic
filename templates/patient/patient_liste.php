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
      Template::render("./templates/partials/header.php",["active_page"=>"patient"]);
    ?>
    <div class="container d-flex justify-content-between align-items-center">
      <h3>Patients</h3>

      <form class="row me-2 ms-2">
        <div class="col-6 col-md-10">
          <input type="search" value="<?php echo$_GET['q'];?>" class="form-control" name="q" placeholder="Nom, Prenom ou Email">
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
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
          <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
        </svg>
        Ajouter Patient
      </button>
    </div>
    <!-- Modal -->
    <form method="POST" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Patient</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row md-3">
              <div class="col-12 col-md-6">
                <label  class="form-label">Nom</label>
                <input type="text" class="form-control"  required name="nom" placeholder="Ex: Snow">
              </div>
              <div class="col-12 col-md-6">
                <label  class="form-label">Prenom</label>
                <input type="text" class="form-control"  required name="prenom" placeholder="Ex: Jhon">
              </div>
            </div>
            <div class="row md-3">
              <div class="col-12 col-md-6">
                <label  class="form-label">Email</label>
                <input type="email" class="form-control"  required name="email" placeholder="Ex: name@example.com">
              </div>
              <div class="col-12 col-md-6">
                <label  class="form-label">Telephone</label>
                <input type="tel" class="form-control"  required name="telephone" placeholder="Ex: +50900000000">
              </div>
            </div>
            <div class="row md-3">
              <div class="col-12 col-md-6">
                <label  class="form-label">Sexe</label>
                <select class="form-control"  required name="sexe" placeholder="Ex: sexe">
                  <option value="Homme">
                    Homme
                  </option>
                  <option value="Femme">
                    Femme
                  </option>
                </select>
              </div>
              <div class="col-12 col-md-6">
                <label  class="form-label">Date de naissance</label>
                <input type="date" class="form-control"  required name="date_naissance" placeholder="Ex: 02/11/2000">
              </div>
            </div>
            <div class="md-3">
              <label  class="form-label">Nom jeune fille mere</label>
              <input type="text" class="form-control"  required name="nom_jeune_fille_mere" placeholder="Ex: Jessica Alba">
            </div>
            <div class="mb-3">
              <label  class="form-label">Adresse</label>
              <textarea class="form-control"  required name="adresse" placeholder="Ex: 6, Tabarre Haiti" rows="2"></textarea>
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
          <th scope="col">Nom</th>
          <th scope="col">Prenom</th>
          <th class="col-3 col-md-2" scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($patients as $patient) {
            echo '
            <tr>
              <th scope="row">'.$patient['id'].'</th>
              <td>'.$patient['nom'].'</td>
              <td>'.$patient['prenom'].'</td>
              <td class="text-center">
                <a href="/patient/'.$patient['id'].'" class="btn btn-primary">Voir plus</a>
              </td>
            </tr>
            ';
          }
        ?>
      </tbody>
    </table>
  </body>
</html>