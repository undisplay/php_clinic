<?php
  use Core\Template;
?>

<link href="/static/assets/custom/navbar-top-fixed.css" rel="stylesheet">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
      <span class="navbar-brand">
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
          </svg>
        </span>
        ESIH Clinique
      </span>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-md-end" id="navbarCollapse">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link <?php  echo $active_page=="patient"?"active":""; ?>" href="/patient">Patients</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php  echo $active_page=="medecin"?"active":""; ?>" href="/medecin">Medecins</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php  echo $active_page=="consultation"?"active":""; ?>" href="/consultation">Consultations</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <?php 
    foreach (Template::$messages as $message) {
      echo'
        <div class="container alert alert-'.$message["level"].' alert-dismissible fade show" role="alert">
          <span>'.$message["message"].'</span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      ';
    }

    
  ?>
  <script>
    var alertList = document.querySelectorAll('.alert');
    alertList.forEach(function (alert) {
      setTimeout(function(){
        var el = new bootstrap.Alert(alert);
        el.close();
      },3000);
    });
  </script>