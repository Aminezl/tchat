<?php
   require APPROOT . '/views/includes/head.php';
?>

<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form shadow-sm p-3 mb-5 bg-white rounded" action="<?php echo URLROOT; ?>/users/login" method="post">
                            <h3 class="text-center text-info">Se connecter</h3>
                            <div class="form-group">
                                <label for="email" class="text-info">Email: * </label><br>
                                <input type="text" name="email" id="email" class="form-control">
                                <?php if($data['emailError']) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $data['emailError']; ?>
                                    </div>
                                <?php endif; ?>    
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password: * </label><br>
                                <input type="password" name="password" id="password" class="form-control">
                                <?php if($data['passwordError']) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $data['passwordError']; ?>
                                    </div>
                                <?php endif; ?>    
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Connexion">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
