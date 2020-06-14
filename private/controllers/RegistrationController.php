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
class RegistrationController {

	public function registrationForm() {

        // $users = getUsers();

		$template_engine = get_template_engine();
        echo $template_engine->render('register_form');
        // , ['users' => $users]

	}

	public function handleRegistrationForm() {

		$result = validateRegistrationData($_POST);
		// print_r($result);
		if ( count( $result['errors'] ) === 0 ) {

			if (userNotRegistered($result['data']['email'])) {
				createUser($result['data']['firstname'], $result['data']['lastname'], $result['data']['email'], $result['data']['wachtwoord'], $result['data']['postcode'], $result['data']['straatnaam'], $result['data']['stad'], $result['data']['land']);

				$loginUrl = url('login.form');
				redirect($loginUrl);

			} else {

				$errors['email'] = 'Dit account bestaat al';
				
			}      
			
		}

		$template_engine = get_template_engine();
        echo $template_engine->render('register_form', ['errors' => $result['errors']]);

	}

}