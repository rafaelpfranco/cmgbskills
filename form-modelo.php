<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Portfolio Details - Tempo Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Tempo - v4.0.1
  * Template URL: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="../index.html" class="logo"><img src="../assets/img/LOGO PORTAL DE VAGAS-02.png" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="../index.html">Início</a></li>
          <li><a class="nav-link scrollto" href="../vagas.html">Vagas Disponíveis</a></li>
          <li><a class="nav-link scrollto" href="https://www.cmgb.com.br">Site Institucional</a></li>
          <li><a class="nav-link scrollto" href="https://www.cmgb.com.br/#contact">Contato</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-12">
            <div class="portfolio-info">
              <h3>Candidatar-se para a vaga</h3>
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
          <div class="col-lg-12 mt-5 mt-lg-0">

            <form action="form.php" method="post" role="form" class="php-email-form" enctype='multipart/form-data'>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="inputNome" class="form-control" id="inputNome" placeholder="Nome Completo*" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control fonti" name="inputEmail" id="inputEmail" placeholder="E-mail*" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group ">
                  <input type="text" name="inputTelefone" class="form-control" id="inputTelefone" placeholder="Telefone*" required>
                </div>
                <div class="form-group col-md-6">
                  <select id="inputVaga" name="inputVaga" class="form-control custom-select browser-default form-ajuste fonti" required >
                    <option selected>Escolha uma Vaga</option>
                    <option>Auxiliar de Comex Júnior</option>
                    <option>Analista de DP - Júnior</option>
                    <option>Analista de DP - Pleno</option>
                    <option>Analista de Processos - Pleno</option>
                    <option>Assessor(a) de Investimentos</option>
                    <option>Auxiliar de Manutenção</option>
                    <option>Auxiliar Financeiro</option>
                    <option>Consultor(a) de Vendas</option>
                    <option>Controller</option>
                    <option>Eletricista</option>
                    <option>Gerente Administrativo/RH</option>
                    <option>Gerente Comercial FIDC</option>
                    <option>Gerente de E-Commerce</option>
                    <option>Gerente de Loja Atacado</option>
                    <option>Gerente de Marketing</option>
                    <option>Gerente de Produção</option>
                    <option>Gerente de Produto</option>
                    <option>Gerente Industrial</option>
                    <option>Mecânico de Manutenção</option>
                    <option>Montador</option>
                    <option>Pedreiro</option>
                    <option>Polidor</option>                  
                    <div class="was-validated invalid-feedback">Escolha uma vaga</div>
                  </select>
                  
                </div>
              </div>
              

              <div class="form-group mt-3">
                <textarea class="form-control" name="inputObs" id="inputObs" rows="5" placeholder="Messagem (Não é obrigatório!)" ></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="form-group form-group mt-3">
                <p class="fonti">Anexar Currículo*</p>
                <input type="file" name="anexar_documento[]" id="anexar_documento" class="form-control multi input" accept="doc|docx|txt|jpeg|jpg|png|gif|pdf" />
              </div>
              <div class="form-group form-group mt-3">
                <p class="fonti">Ao informar meus dados, eu concordo com a Política de Privacidade e com os Termos de Uso.</p>
              </div>
              
              <div class="text-center">
                <button type="submit" name="upload">Candidatar-se</button>
              </div>
            </form>

          </div>

        

      </div>
    </section><!-- End Contact Section -->
            </div>
         
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

   <!-- ======= Footer ======= -->
   <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">
        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          Rua Monsenhor Bruno, 1576, Meireles. 60115-191.
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/tempo-free-onepage-bootstrap-theme/ -->
          CMGB*Consultoria & Treinamento&#174; Desde 1988 - Todos os direitos reservados.</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="https://pt-br.facebook.com/PortalCMGB/" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://www.instagram.com/cmgbconsultoria" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="https://www.linkedin.com/company/cmgb" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>