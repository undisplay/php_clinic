
<link href="/static/assets/custom/navbar-top-fixed.css" rel="stylesheet">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
      <span class="navbar-brand ms-2" href="">ESIH Clinic</span>
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