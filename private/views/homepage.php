<?php $this->layout('website');?>
<div class="row justify-content-center">
<div class="col-md-10">
		<h5 class="section-title my-3">Categorieën</h5>
	<div class="col-md-12  p-0 d-flex flex-wrap">
			<?php foreach($categories as $key=>$value): ?>
				<a href="<?php echo url('home.category', ['id' =>  $value['id']]) ?>">
				<div class="card m-2" style="width: 18rem;">
		<div class="card-img-top__container mt-3">
		<img class="card-img-top" src="<?php echo $value['img'] ?>" alt="Card image cap">
		</div>
		<div class="card-body pb-0 w-100 d-flex justify-content-center">
		<h6 class="card-subtitle mb-2 category-title"><?php echo $value['name']  ?> (<?php echo $value['amount']?>)</h6>
		</div>
		</div>
			</a>
    		<?php endforeach; ?>
	</div>
</div>
</div>
<div class="row mt-3 justify-content-flex">
	<div class="col-md-10 ">
	<h5 class="section-title my-3">Producten</h5>
	<div class="w-100 d-flex flex-wrap justify-content-center">
	<?php foreach($products as $key=>$value): ?>
		<div class="card col-md-3 m-4 p-0">
		<div class="card-img-top__container mt-3">
			<a href="<?php echo url('product', ['id' => $value['id']]) ?>"><img class="card-img-top" src="<?php echo $value['img'] ?>" alt="<?php echo $value['name'] ?>"></a>
		</div>
			<div class="card-body pb-0">
			<a href="<?php echo url('product', ['id' => $value['id']]) ?>" class="btn-no_underline"><h5 class="card-title"><?php echo $value['name'] ?></h5></a>
				<p class="card-text"><?php echo substr($value['discription'], 0, 40) ?><?php if(strlen ( $value['discription'] )> 40): ?>...<?php endif ?></p>
				<div class="d-flex justify-content-end mb-3">
					<div class="price-tag d-flex">
						<p class="mb-0 mx-1 ml-2">€ <?php echo $value['price'] ?></p>
						<div class="ml-2 bg-primary btn-add"><i class="fas fa-plus"></i></div>
					</div>
				</div>
			</div>
		</div>
    <?php endforeach; ?>
	</div>
		
	</div>
</div>