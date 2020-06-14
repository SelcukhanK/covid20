<?php
// Dit bestand hoort bij de router, enb bevat nog een aantal extra functiesdie je kunt gebruiken
// Lees meer: https://github.com/skipperbent/simple-php-router#helper-functions
require_once __DIR__ . '/route_helpers.php';

// Hieronder kun je al je eigen functies toevoegen die je nodig hebt
// Maar... alle functies die gegevens ophalen uit de database horen in het Model PHP bestand

/**
 * Verbinding maken met de database
 * @return \PDO
 */
function dbConnect() {

	$config = get_config( 'DB' );

	try {
		$dsn = 'mysql:host=' . $config['HOSTNAME'] . ';dbname=' . $config['DATABASE'] . ';charset=utf8';

		$connection = new PDO( $dsn, $config['USER'], $config['PASSWORD'] );
		$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$connection->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );

		return $connection;

	} catch ( \PDOException $e ) {
		echo 'Fout bij maken van database verbinding: ' . $e->getMessage();
		exit;
	}

}

/**
 * Geeft de juiste URL terug: relatief aan de website root url
 * Bijvoorbeeld voor de homepage: echo url('/');
 *
 * @param $path
 *
 * @return string
 */
function site_url( $path = '' ) {
	return get_config( 'BASE_URL' ) . $path;
}

function get_config( $name ) {
	$config = require __DIR__ . '/config.php';
	$name   = strtoupper( $name );

	if ( isset( $config[ $name ] ) ) {
		return $config[ $name ];
	}

	throw new \InvalidArgumentException( 'Er bestaat geen instelling met de key: ' . $name );
}

/**
 * Hier maken we de template engine en vertellen de template engine waar de templates/views staan
 * @return \League\Plates\Engine
 */
function get_template_engine() {

	$templates_path = get_config( 'PRIVATE' ) . '/views';

	return new League\Plates\Engine( $templates_path );

}

/**
 * Geef de naam (name) van de route aan deze functie, en de functie geeft
 * terug of dat de route is waar je nu bent
 *
 * @param $name
 *
 * @return bool
 */
function current_route_is( $name ) {
	$route = request()->getLoadedRoute();

	if ( $route ) {
		return $route->hasName( $name );
	}

	return false;

}

function validateRegistrationData($data) {

	$errors = [];

	$email		= filter_var( $data['email'], FILTER_VALIDATE_EMAIL );
	$wachtwoord = trim( $data['wachtwoord'] );

	if ( $email === false ) {
		$errors['email'] = 'Geen geldige email ingevuld';
	}

	if ( strlen( $wachtwoord ) < 6 ) {
		$errors['wachtwoord'] = 'Geen geldige wachtwoord, minimaal 6 tekens!';
	}

	$data = [
		'firstname' => $data['firstname'],
		'lastname' => $data['lastname'],
		'email' => $data['email'],
		'wachtwoord' => $wachtwoord,
		'postcode' => $data['postcode'],
		'straatnaam' => $data['straatnaam'],
		'stad' => $data['stad'],
		'land' => $data['land']
	];

	return [
		'data' => $data,
		'errors' => $errors
	];


}

function validateLoginData($data) {

	$errors = [];

	$email		= filter_var( $data['email'], FILTER_VALIDATE_EMAIL );
	$wachtwoord = trim( $data['wachtwoord'] );

	if ( $email === false ) {
		$errors['email'] = 'Geen geldige email ingevuld';
	}

	if ( strlen( $wachtwoord ) < 6 ) {
		$errors['wachtwoord'] = 'Geen geldige wachtwoord, minimaal 6 tekens!';
	}

	$data = [
		'email' => $data['email'],
		'wachtwoord' => $wachtwoord,
	];

	return [
		'data' => $data,
		'errors' => $errors
	];


}

function userNotRegistered($email) {

	$connection = dbConnect();
	$sql        = "SELECT * FROM `gebruikers` WHERE `email` = :email";
	$statement	= $connection->prepare( $sql );
	$statement->execute( [ 'email' => $email ] );

	return ( $statement->rowCount() === 0 );
}

function createUser($firstname, $lastname, $email, $wachtwoord, $postcode, $straatnaam, $stad, $land) {

	$connection = dbConnect();

	$sql	   = "INSERT INTO `gebruikers` (`firstname`, `lastname`, `email`, `wachtwoord`, `postcode`, `straatnaam`, `stad`, `land`) VALUES (:firstname, :lastname, :email, :wachtwoord, :postcode, :straatnaam, :stad, :land)";
	$safe_password = password_hash( $wachtwoord, PASSWORD_DEFAULT );
	$params = [
		'firstname' => $firstname,
		'lastname' => $lastname,
		'email' => $email,
		'wachtwoord' => $safe_password,
		'postcode' => $postcode,
		'straatnaam' => $straatnaam,
		'stad' => $stad,
		'land' => $land
	];	
	$statement = $connection->prepare( $sql );
	$statement->execute( $params );

}

function loginUser($user) {
	 $_SESSION['user_id'] = $user['id'];
}

function logoutUser(){
	unset($_SESSION['user_id']);
}

function isLoggedIn(){
	return !empty($_SESSION['user_id']);
}

function loginCheck() {
	if ( ! isLoggedIn() ) {
		$login_url = url( 'login.form' );
		redirect( $login_url );
	}
}