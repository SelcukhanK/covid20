<?php $this->layout('website') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <title>Inloggen</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container-fluid w-100 d-flex justify-content-center yarrag align-items-center hulpverlener-foto">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h2>Inloggen</h2>
                </div>
                <div class="card-body">
                    <form action="<?php echo url( 'login.handle' ) ?>" method="POST" class="login-form">
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" value="<?php echo input( 'email' ) ?>" class="form-control" id="email" aria-describedby="emailHelp"  placeholder="Email address" required autofocus> 
                        <?php if ( isset( $errors['email'] ) ): ?>
                            <?php echo $errors['email'] ?>
                        <?php endif;?>
                    </div>
                    <div class="form-group">
                        <label for="wachtwoord" class="sr-only">Wachtwoord</label>
                        <input type="password" name="wachtwoord" class="form-control" id="wachtwoord" placeholder="Wachtwoord" required>
                        <?php if ( isset( $errors['wachtwoord'] ) ): ?>
                            <?php echo $errors['wachtwoord'] ?>
                        <?php endif;?>
                    </div>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Aanmelden</button>
                    <a href="<?php echo url('register.form') ?>" class="btn btn-link">Registreren</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
