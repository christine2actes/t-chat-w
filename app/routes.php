<?php
	// Quand on essaye à localhost/t-chat/public, l'url réellement est : localhost/t-chat/public/index.php
	// Default#home : Default correspond à Controller/DefaultController - home correspond à la méthode (function) home()
	$w_routes = array(
		['GET', '/', 'Default#home', 'default_home'],
		['GET', '/test', 'Test#monAction', 'test_route'],
		['GET', '/users', 'User#listUsers', 'users_list'],
		['GET|POST', '/salon/[i:id]', 'Salon#seeSalon', 'see_salon'],
		['GET|POST', '/login', 'User#login', 'login'],
		['GET', '/logout', 'User#logout', 'logout']
	);
