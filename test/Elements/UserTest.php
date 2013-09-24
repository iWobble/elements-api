<?php

class UserTest extends ElementsTest {

	

    public function testListUsers() {
	$response = Elements\User::getUsers();
	$this->assertTrue(isset($response['users']));
    }

    public function testCreateUser() {
	Elememnts\User::addUser(
    }
}
