<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
  <a class="navbar-brand" href="<?php echo url('home') ?>">Covid-Center</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if ( current_route_is( 'home' ) ): ?>active<?php endif ?>">
        <a class="nav-link" href="<?php echo url( 'home' ) ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php if(isLoggedIn()):?>
      <li class="nav-item <?php if ( current_route_is( 'logout' ) ): ?>active<?php endif ?>">
        <a class="nav-link" href="<?php echo url( 'logout' ) ?>">Uitloggen</a>
      </li>
      <?php else: ?>
      <li class="nav-item <?php if ( current_route_is( 'register.form' ) ): ?>active<?php endif ?>">
        <a class="nav-link" href="<?php echo url( 'register.form' ) ?>">Registreren</a>
      </li>
      <li class="nav-item <?php if ( current_route_is( 'login.form' ) ): ?>active<?php endif ?>">
        <a class="nav-link" href="<?php echo url( 'login.form' ) ?>">Inloggen</a>
      </li>
      <?php endif; ?>
    </ul>
    <?php if ( current_route_is( 'home' ) || current_route_is( 'home.category' ) || current_route_is( 'product' ) || current_route_is( 'product.search' ) ): ?>
      <form action="<?php echo url( 'product.search' ) ?>" method="POST" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="product" placeholder="Broodje Ekmek" aria-label="Search">
      <button class="btn btn-light my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
    </form>
    <?php endif ?>
    <a class="ml-2 btn btn-light my-2 my-sm-0" ><i class="fa fa-shopping-cart"></i></a>
  </div>
</nav>