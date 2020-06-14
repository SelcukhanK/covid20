<?php

namespace Website\Controllers;

/**
 * Class HomeController
 *
 * Deze handelt de logica van de homepage af
 * Haalt gegevens uit de "model" laag van de website (de gegevens)
 * Geeft de gegevens aan de "view" laag (HTML template) om weer te geven
 *
 */
class WebsiteController {

	public function home($id = null) {

		$products = getProducts($id);
		$categories = getCategories();
		$template_engine = get_template_engine();
		echo $template_engine->render('homepage', ['products' => $products, 'categories' => $categories]);

	}
	public function search() {
		$productName = htmlspecialchars($_POST['product']);
		
		$products = getProductsByName($productName);
		$categories = getCategories();
		$template_engine = get_template_engine();
		echo $template_engine->render('homepage', ['products' => $products, 'categories' => $categories]);

	}
	public function product($id = null) {

		$product = getProductById($id);
		$template_engine = get_template_engine();
		echo $template_engine->render('product', ['statement' => $product]);

	}


}