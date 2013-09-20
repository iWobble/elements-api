<?php

namespace Elements;


class User extends AbstractApiHandler {

	public function addUser($params = null, $apiKey = null) {
		return self::getCall('user', $params, $apiKey);
	}

	public function findUserById() {

	}

	public function findUserByExternalKey() {

	}

	public function updateUserById() {

	}

	public function updateUserByExternalKey() {

	}

	public function setUserProperty() {

	}

	public function addUserTag() {

	}

	public function deleteUserTag() {

	}

	public function findUserEmail() {

	}

	public function addUserEmail() {

	}

	public function updateUserEmail() {

	}

	public function deleteUserEmail() {

	}

	public function getUsers($params = null, $apiKey = null) {
		return self::getCall('users', $params, $apiKey);
	}

	public function getFinancialSummaries() {

	}

	public function getItemInstances() {

	}

	public function getRecommendations() {

	}

	public function getRestrictions() {

	}

	public function createSecureKey() {

	}

	public function blockUser() {

	}

	public function getBlock() {

	}

	public function unblockUser() {

	}

	public function setUserLoginTime() {

	}


}