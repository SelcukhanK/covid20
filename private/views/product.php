<?php $this->layout('website');?>



<section class="webshop">

    <?php foreach ($statement as $product) { ?>


        <div class="row mt-3">
            <div class="card">
                <h2 class="product_title"><?php echo $product['name'] ?></h2>

                <div class="product_image">
                    <img src="<?php echo $product['img']?>" >
                </div>

                <p class="beschrijving">
                            <?php echo $product['discription'] ?>
                </p>
                <p class="prijs">
                    <strong>€<?php echo $product['price'] ?></strong>
                </p>

                <p>
                    Aantal beschikbaar: <?php echo $product['stock'] ?>
                </p>
                <div class="d-block">
                    <a class="tshirt-detail__order btn btn-primary" href="bestel.php?id=<?php echo $product['id'] ?>">Voeg toe aan winkelmandje</a>
                </div>
                <p>
                    <a href="<?php echo url('home') ?>" class="btn btn-link">Terug</a>
                </p>

            </div>
        </div>
    <?php } ?>
</section>
