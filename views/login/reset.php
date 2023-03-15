<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo constant("SYS") ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo constant("URL") ?>/assets/images/favicon.ico" />

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/css/core/libs.min.css" />

    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/css/hope-ui.min.css?v=2.0.0" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/css/custom.min.css?v=2.0.0" />

    <!-- Dark Css -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/css/dark.min.css" />

    <!-- Customizer Css -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/css/customizer.min.css" />

    <!-- RTL Css -->
    <link rel="stylesheet" href="<?php echo constant("URL") ?>/assets/css/rtl.min.css" />
</head>

<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <section class="login-content">
            <div class="row m-0 align-items-center bg-white vh-100">
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                                <div class="card-body">
                                    <div class="navbar-brand d-flex align-items-center mb-3">
                                        <!--Logo start-->
                                        <!--logo End-->

                                        <!--Logo start-->
                                        <div class="logo-main">
                                            <div class="logo-normal">
                                                <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                                                    <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                                                    <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                                                    <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                                                </svg>
                                            </div>
                                            <div class="logo-mini">
                                                <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor" />
                                                    <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor" />
                                                    <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor" />
                                                    <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor" />
                                                </svg>
                                            </div>
                                        </div>
                                        <!--logo End-->

                                        <h4 class="logo-title ms-3"><?php echo constant("SYS-SHORT") ?></h4>
                                    </div>
                                    <h2 class="mb-2 text-center">Cambio de contrase&ntilde;a</h2>
                                    <p class="text-center">Ingresa nueva contrase&ntilde;a</p>
                                    <form action="<?php echo constant("URL") ?>/login/reset" method="post">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="password" class="form-label">Contrase&ntilde;a nueva</label>
                                                    <input type="password" class="form-control" id="password" aria-describedby="password" name="newpass" minlength="8">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="password" class="form-label">Repita contrase&ntilde;a</label>
                                                    <input type="password" class="form-control" id="new-password" aria-describedby="password" name="pass" minlength="8">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary" disabled="true" id="reset-pass">Restablecer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 text-center" id="message-error">
                    </div>
                    <div class="sign-bg">
                        <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.05">
                                <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF" />
                                <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF" />
                                <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF" />
                                <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF" />
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                    <img src="<?php echo constant("URL") ?>/assets/images/auth/01.png" class="img-fluid gradient-main animated-scaleX" alt="images">
                </div>
            </div>
        </section>
    </div>

    <!-- Library Bundle Script -->
    <script src="<?php echo constant("URL") ?>/assets/js/core/libs.min.js"></script>

    <!-- External Library Bundle Script -->
    <script src="<?php echo constant("URL") ?>/assets/js/core/external.min.js"></script>

    <!-- Widgetchart Script -->
    <script src="<?php echo constant("URL") ?>/assets/js/charts/widgetcharts.js"></script>

    <!-- mapchart Script -->
    <script src="<?php echo constant("URL") ?>/assets/js/charts/vectore-chart.js"></script>
    <script src="<?php echo constant("URL") ?>/assets/js/charts/dashboard.js"></script>

    <!-- fslightbox Script -->
    <script src="<?php echo constant("URL") ?>/assets/js/plugins/fslightbox.js"></script>

    <!-- Settings Script -->
    <script src="<?php echo constant("URL") ?>/assets/js/plugins/setting.js"></script>

    <!-- Slider-tab Script -->
    <script src="<?php echo constant("URL") ?>/assets/js/plugins/slider-tabs.js"></script>

    <!-- Form Wizard Script -->
    <script src="<?php echo constant("URL") ?>/assets/js/plugins/form-wizard.js"></script>

    <!-- App Script -->
    <script src="<?php echo constant("URL") ?>/assets/js/hope-ui.js" defer></script>

    <!-- App Script -->
    <script>
        document.getElementById('password').addEventListener('keyup', function(e) {
            let pass = document.getElementById('password').value;
            let message = document.getElementById('message-error');
            if (pass.length < 8)
                message.innerHTML = "<p>M&iacute;nimo debe poseer 8 caracteres</p>";
            else
                message.innerHTML = "";
        });

        document.getElementById('new-password').addEventListener('keyup', function(e) {
            let pass = document.getElementById('password').value;
            let passNew = document.getElementById('new-password').value;
            let message = document.getElementById('message-error');
            document.getElementById('reset-pass').disabled = pass != passNew
            if (pass != passNew)
                message.innerHTML = "<p>Contrase&ntilde;as no coinciden.</p>";
            else
                message.innerHTML = "";
        });
    </script>

</body>

</html>