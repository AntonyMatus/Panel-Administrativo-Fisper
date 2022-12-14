
<?php 
require 'Admin/config.php';

$id = intval($_GET['id']);

$sql = "SELECT * FROM blog WHERE id = :id AND status = 0";
$query = $pdo->prepare($sql);
$query->bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();

$blog = $query->fetch(PDO::FETCH_OBJ);

if(! $blog){
    header('location:blog.php');
}
?>



<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title><?php echo $blog->name ?> | FISPER | </title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="Búho Solutions">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="description" content="FISPER es una consultoría de servicios empresariales en la que se abarca un gran espectro de servicios, manejando desde el área administrativa, el área contable, el área fiscal, el área legal, tramitología y todo lo que incluya trámite ante instituciones gubernamentales.">
        <meta name="image" content="http://fisper.com.mx/Admin/assets/images/blogs/<?php echo $blog->img ?>">

        <!-- Google / Search Engine Tags -->
        <meta itemprop="name" content="Test website">
        <meta itemprop="description" content="<?php echo $blog->description ?>">
        <meta itemprop="image" content="http://fisper.com.mx/Admin/assets/images/blogs/<?php echo $blog->img ?>">
        
        <!-- Facebook Meta Tags -->
        
        <meta property="og:type" content="website">
        <meta property="og:description" content="<?php echo $blog->description ?>">
        <meta property="og:image" content="http://fisper.com.mx/Admin/assets/images/blogs/<?php echo $blog->img ?>">
        <meta property="og:image:alt" content="http://fisper.com.mx/Admin/assets/images/blogs/<?php echo $blog->img ?>">
        <meta property="og:url" content="https://fisper.com.mx/single_blog.php?id=<?php echo $id ?>">

        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:description" content="<?php echo $blog->description ?>">
        <meta name="twitter:image" content="http://fisper.com.mx/Admin/assets/images/blogs/<?php echo $blog->img ?>">

        
        <!-- favicon icon -->
        <link rel="shortcut icon" href="client/images/logos/favicon-white.svg">
        <link rel="apple-touch-icon" href="client/images/logos/favicon-white.svg">
        <link rel="apple-touch-icon" sizes="72x72" href="client/images/logos/favicon-white.svg">
        <link rel="apple-touch-icon" sizes="114x114" href="client/images/logos/favicon-white.svg">
        <!-- style sheets and font icons  -->
        <link rel="stylesheet" type="text/css" href="client/css/font-icons.min.css">
        <link rel="stylesheet" type="text/css" href="client/css/theme-vendors.min.css">
        <link rel="stylesheet" type="text/css" href="client/css/style.css" />
        <link rel="stylesheet" type="text/css" href="client/css/responsive.css" />
    </head>
    <body data-mobile-nav-style="classic">
        <!-- start header -->
        <header class="header-with-topbar">
            
            <nav class="navbar navbar-expand-lg navbar-white bg-green2 border-bottom border-color-white-transparent header-light fixed-top navbar-boxed header-reverse-scroll">
                <div class="container-fluid nav-header-container">
                    <div class="col-6 col-lg-2 me-auto ps-lg-0">
                        <a class="navbar-brand" href="index.php">
                            <img src="client/images/logos/logo-white.svg" data-at2x="images/logos/logo-white.svg" class="default-logo" alt="" >
                            <img src="client/images/logos/logo-white.svg" data-at2x="images/logos/logo-white.svg" class="alt-logo" alt="">
                            <img src="client/images/logos/logo-white.svg" data-at2x="images/logos/logo-white.svg" class="mobile-logo" alt="">
                        </a>
                    </div>
                    <div class="col-auto menu-order px-lg-0">
                        <button class="navbar-toggler float-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                            <span class="navbar-toggler-line"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                            <ul class="navbar-nav alt-font">
                                <li class="nav-item dropdown megamenu">
                                    <a href="index.php" class="nav-link">Inicio</a>
                                    
                                </li>
                                <li class="nav-item dropdown simple-dropdown">
                                    <a href="nosotros.php" class="nav-link">Nosotros</a>
                                   
                                </li>
                                <li class="nav-item dropdown simple-dropdown">
                                    <a href="Servicios.php" class="nav-link">Servicios</a>
                                   
                                </li>
                                <li class="nav-item dropdown simple-dropdown">
                                    <a href="blog.php" class="nav-link">Blog</a>
                                   
                                </li>
                                <li class="nav-item dropdown simple-dropdown">
                                    <a href="videos.php" class="nav-link">Vídeos</a>
                                   
                                </li>
                                <li class="nav-item dropdown megamenu">
                                    <a href="contacto.php" class="nav-link">Contacto</a>
                                    
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </nav>
        </header>
        <!-- end header -->
        <!-- start blog content section --> 
        <section class="blog-right-side-bar">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-8 right-sidebar md-margin-60px-bottom sm-margin-40px-bottom">
                        <div class="row">
                            <div class="col-12 blog-details-text last-paragraph-no-margin margin-6-rem-bottom">
                                <ul class="list-unstyled margin-2-rem-bottom">
                                    <li class="d-inline-block align-middle margin-25px-right"><i class="feather icon-feather-calendar text-green2 margin-10px-right"></i><a><?php echo date("d M Y", strtotime($blog->date)) ?></a></li>
                                    </ul>
                                <h5 class="alt-font font-weight-500 text-green2 margin-4-half-rem-bottom">
                                    <?php echo $blog->name ?>
                                </h5>
                                <img 
                                loading="lazy"
                                src="Admin/assets/images/blogs/<?php echo $blog->img ?>" 
                                alt="Imagen de portada"
                                class="w-100 border-radius-6px margin-4-half-rem-bottom">
                                <?php echo $blog->body ?>                                
                               </div>
                                                   
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- end blog content section -->
        
       
       <!-- start footer -->
       <footer class="footer-consulting footer-dark bg-green2">
            <div class="footer-top padding-six-tb lg-padding-eight-tb md-padding-50px-tb">
                <div class="container">
                    <div class="row">
                        <!-- start footer column -->
                        <div class="col-12 col-lg-5 col-sm-6 order-sm-1 order-lg-0 last-paragraph-no-margin md-margin-40px-bottom xs-margin-25px-bottom">
                            <img src="client/images/logos/logo-white.svg" alt="logo" width="219px" class="margin-30px-bottom"> 
                            <p class="alt-font text-white">FISPER es una consultoría de servicios empresariales en la que se abarca un gran espectro de servicios, manejando desde el área administrativa, el área contable, el área fiscal,  el área legal, tramitología y todo lo que incluya trámite ante instituciones gubernamentales.</p>
                        </div>
                        <!-- end footer column -->
                        <!-- start footer column -->
                        
                        <!-- end footer column -->
                        <!-- start footer column -->
                        <div class="col-12 col-lg-2 col-sm-5 offset-sm-1 offset-lg-0 order-sm-4 order-lg-0 xs-margin-25px-bottom">
                            
                        </div>
                        <!-- end footer column -->                    
                        <!-- start footer column -->
                        <div class="col-12 col-lg-4 offset-xl-1 col-lg-4 col-sm-6 order-sm-3 order-lg-0">                       
                            <span id="info" class="alt-font font-weight-500 d-block text-white margin-20px-bottom xs-margin-10px-bottom">Informacion de contacto</span>
                            
                            <p id="tel"><strong>Phone: 999 4903 992</strong> </p>
                            <p id="email"><strong>Email: auxadministrativo@fisper.com.mx</strong> </p>
                            <p id="direc"><strong>Address: Calle 38 #85, Fraccionamiento del Norte, 97120 Mérida, Yuc.</strong> </p>
                            <div class="social-icon-style-12">
                                <ul class="extra-small-icon light">
                                    <li><a class="facebook " href="https://www.facebook.com/Fisperasesoriaintegral/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="instagram" href="https://instagram.com/fispermx?igshid=ODBkMDk1MTU=" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    <li><a class="whatsapp" href="https://api.whatsapp.com/send?phone=529993474635&app=facebook&entry_point=page_cta" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                    
                                </ul>
                            </div>
                        </div>
                        <!-- end footer column -->
                    </div>
                </div>
            </div>
            <div class="footer-bottom padding-35px-tb border-top border-width-1px border-color-white-transparent">
                <div class="container"> 
                    <div class="row align-items-center">
                        
                        <div class="col-12 col-md-12 text-center last-paragraph-no-margin sm-margin-20px-bottom">
                            <p><a class="padding-two-right" href="admin/login.php"><i class="fa fa-user" aria-hidden="true"></i></a> Fisper 2022 &copy; Desarrollado por  <a href="https://www.buho-solutions.com" target="_blank" class="text-decoration-line-bottom text-tussock text-white-hover font-weight-500">Buho Solutions</a></p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->
        <!-- start scroll to top -->
        <a class="scroll-top-arrow" href="javascript:void(0);"><i class="feather icon-feather-arrow-up"></i></a>
        <!-- end scroll to top -->
        <!-- javascript -->
        <script type="text/javascript" src="client/js/jquery.min.js"></script>
        <script type="text/javascript" src="client/js/theme-vendors.min.js"></script>
        <script type="text/javascript" src="client/js/main.js"></script>
    </body>
</html>