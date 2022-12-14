<?php
session_start();
require 'Admin/config.php';

$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$search = (isset($_GET["search"]) && !empty($_GET["search"])) ? strval($_GET["search"]) : null;
$itemsPerPage = 3;
$limit = $itemsPerPage;
$offset = ($page - 1) * $itemsPerPage;
$pages = 0;
$videos = [];


if(!is_null($search)){

    $qSearch = "%$search%";

    $sqlForCount = "SELECT count(*) as count FROM videos WHERE name LIKE ?";
    $queryCount = $pdo->prepare($sqlForCount);
    $queryCount->execute([$qSearch]);
    $count = $queryCount->fetchObject()->count;
    $pages = ceil($count / $itemsPerPage);

    $sqlForPosts = "SELECT P.id, P.name, P.description, P.img, P.link, P.date  FROM videos P WHERE P.name LIKE ?";
    $queryPosts = $pdo->prepare($sqlForPosts);
    $queryPosts->execute([$qSearch]);
    $videos = $queryPosts->fetchAll(PDO::FETCH_OBJ);


}

if(is_null($search)){

      // count
      $sqlForCount = $pdo->query("SELECT count(*) as count FROM videos ");
      $count = $sqlForCount->fetchObject()->count;
      $pages = ceil($count / $itemsPerPage);

      $sqlForPosts = "SELECT P.id, P.name, P.description, P.img, P.link, P.date  FROM videos P  ORDER BY `id` DESC  LIMIT :lop OFFSET :osf";
      $query = $pdo->prepare($sqlForPosts); 
      $query->bindValue(':lop', (int) trim($limit), PDO::PARAM_INT);
      $query->bindValue(':osf', (int) trim($offset), PDO::PARAM_INT);
      $query->execute(); 
      $videos = $query->fetchAll(PDO::FETCH_OBJ);

}

?>



<!doctype html>
<html class="no-js" lang="en">
    <head>
        <title>Videos | FISPER</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="Búho Solutions">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="description" content="FISPER es una consultoría de servicios empresariales en la que se abarca un gran espectro de servicios, manejando desde el área administrativa, el área contable, el área fiscal, el área legal, tramitología y todo lo que incluya trámite ante instituciones gubernamentales.">
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
                            <img src="client/images/logos/logo-white.svg" data-at2x="client/images/logos/logo-white.svg" class="default-logo" alt="" >
                            <img src="client/images/logos/logo-white.svg" data-at2x="client/images/logos/logo-white.svg" class="alt-logo" alt="">
                            <img src="client/images/logos/logo-white.svg" data-at2x="client/images/logos/logo-white.svg" class="mobile-logo" alt="">
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
                                    <a href="#" class="nav-link">Vídeos</a>
                                   
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
        <!-- start page title -->
        <section class="half-section bg-light-gray parallax" data-parallax-background-ratio="0.5" >
            <div class="container">
                <div class="row align-items-stretch justify-content-center extra-small-screen">
                    <div class="col-12 col-xl-6 col-lg-7 col-md-8 page-title-extra-small text-center d-flex justify-content-center flex-column">
                        <h1 class="alt-font text-brown2 margin-15px-bottom d-inline-block">Nuestra selección de cursos </h1>
                        <h2 class="text-green2 alt-font font-weight-500 letter-spacing-minus-1px line-height-50 sm-line-height-45 xs-line-height-30 no-margin-bottom">Capacitación continua FISPER</h2>
                       
                    </div>
                </div>
            </div>
        </section>
        <!-- end page title -->
        <!-- start section --> 
        <section class="bg-light-gray pt-0 padding-eleven-lr xl-padding-two-lr xs-no-padding-lr">
            <div class="container-fluid">
                <div class="row justify-content-right" >
                    <div class="col-12 col-xl-3 offset-xl-1 col-lg-4 col-md-7 blog-sidebar lg-padding-4-rem-left md-padding-15px-left">
                        <div class="d-inline-block w-100 margin-5-rem-bottom">
                            <span class="alt-font font-weight-500 text-large text-extra-dark-gray d-block margin-25px-bottom">Buscar curso.</span>
                            <form id="search-form" role="search" method="get" action="videos.php">
                                <div class="position-relative">
                                    <input  
                                    type="text"
                                    name="search"
                                    class="search-input medium-input border-color-medium-gray border-radius-4px mb-0" 
                                    placeholder="Introduzca palabra clave"  
                                    value="<?php echo (isset($_GET["search"]) && !empty($_GET["search"])) ? strval($_GET["search"]) : '' ?>" />
                                    <button type="submit" class="bg-transparent btn text-fast-blue position-absolute right-5px top-8px text-medium md-top-8px sm-top-10px search-button"><i class="feather icon-feather-search ms-0"></i></button>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 blog-content">
                        <ul class="blog-grid blog-wrapper grid grid-loading grid-3col xl-grid-3col lg-grid-3col md-grid-2col sm-grid-2col xs-grid-1col gutter-extra-large">
                            <li class="grid-sizer"></li>
                            <?php foreach($videos as $video): ?>
                            <!-- start blog item -->
                            <li class="grid-item wow animate__fadeIn">
                                <div class="blog-post border-radius-5px bg-white box-shadow-medium">
                                    <div class="blog-post-image bg-medium-slate-blue">
                                        <a href="<?php echo $video->link ?>" title=""><img id="tamaño_img" src="Admin/assets/images/videos/<?php echo $video->img ?>" alt=""></a>
                                        
                                    </div>
                                    <div class="post-details padding-3-rem-lr padding-2-half-rem-tb">
                                        <a href="<?php echo $video->link ?>" class="alt-font text-small d-inline-block margin-10px-bottom"><?php echo date("d M Y", strtotime($video->date)) ?></a>
                                        <a href="<?php echo $video->link ?>" class="alt-font font-weight-500 text-extra-medium text-extra-dark-gray margin-15px-bottom d-block"><?php echo $video->name ?></a>
                                        <p><?php echo $video->description ?></p>
                                        
                                    </div>
                                </div>
                            </li>
                            <!-- end blog item -->
                            <?php endforeach ?>
                            <!-- start blog item -->
                            
                        </ul>
                        <?php if($pages > 1) { ?>
                        <!-- start pagination -->
                        <div class="col-12 d-flex justify-content-center margin-7-half-rem-top lg-margin-5-rem-top xs-margin-4-rem-top wow animate__fadeIn">
                            <?php $queryParams = '&search=' . $search; ?>
                            <ul class="pagination pagination-style-01 text-small font-weight-500 align-items-center">
                                <li class="page-item">
                                    <a class="page-link"
                                    <?php if ($page > 1) { ?>
                                     href="videos.php?page=<?php echo $page - 1 ?> <?php echo $queryParams ?>" <?php }?>>
                                     <i class="feather icon-feather-arrow-left icon-extra-small d-xs-none"></i>
                                    </a>
                                </li>
                                <?php for($i = 1; $i <= $pages; $i++) { ?>
                                <li class="page-item <?php if($i == $page) {echo 'active';} ?>"> 
                                    <a class="page-link" href="videos.php?page=<?php echo $i ?><?php echo $queryParams ?>"><?php echo $i ?></a>
                                </li>
                                <?php } ?>
                                <li class="page-item">
                                    <a class="page-link"
                                    <?php if($page < $pages) {?> href="videos.php?page=<?php echo $page + 1 ?><?php echo $queryParams ?>" <?php } ?>>
                                     <i class="feather icon-feather-arrow-right icon-extra-small  d-xs-none"></i>
                                    </a>
                                </li>
                             </ul>
                        </div>
                        <!-- end pagination -->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->  
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