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
    
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h3>Consultation</h3>
        <span><strong> Date: </strong><?php echo $consultation["date"];?></span>
      </div>
      <div class="row">
        <div class="col-md-6 col-12 mb-1 d-flex justify-content-between">
          <span><strong class="h5 me-2">Medecin:</strong><?php echo $medecin["nom"].' '.$medecin["prenom"];?></span>
          <a href="<?php echo'/medecin/'.$medecin['id'];?>" class="btn btn-primary">Voir Medecin</a>
        </div>
        <div class="col-md-6 col-12 mb-1 d-flex justify-content-between">
          <span ><strong class="h5 me-2">Patient:</strong><?php echo $patient["nom"].' '.$patient["prenom"];?></span>
          <a href="<?php echo'/patient/'.$patient['id'];?>" class="btn btn-primary">Voir Patient</a>
        </div>
      </div>
      <h5>Symptomes:</h5>
      <p class="card p-2">
        <?php echo $consultation["symptomes"];?>
      </p>
    </div>

    <div class="container">
      <h3>Prescriptions</h3>
      <table class="table table-dark table-responsive container mt-2">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Ordonnance</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($prescriptions as $prescription) {
              echo '
              <tr>
                <th scope="row">'.$prescription['id'].'</th>
                <td>'.$prescription['ordonnance'].'</td>
              </tr>
              ';
            }
          ?>
        </tbody>
      </table> 
    </div>
  </body>
</html>