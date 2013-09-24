<?php

class UserTest extends ElementsTest {

	public $user;

	public $customer = array(
		'name' => 'UnitTestUser',
		'externalKey' => 'UNIT_TEST_EXTERNALKEY',
		'emailAddress' => 'test@unittest.org',
		'gender' => 'male',
		'dateOfBirth' => '02/23/2000',
		'country' => 'US',
		'properties' => 'property1=property_one;property2=property_two',
		'tags' => 'tag1,tag2',
		'stateProvience' => 'NC',
		'city' 	=> 'Cary',
		'zipCode' => '27560',
	);

	public function setUp() {
		parent::setUp();
		$this->string = $this->randomString();

	}

	public function createUser() {
		try {
			$result = Elements\User::addUser($this->customer);
		} catch (Elements\ElementsException $e) {
			if ($e->getCode() == '990009') {
				$result = Elements\User::findUserByExternalKey($this->customer['externalKey']);
			}
		}

		$this->assertIsA($result, 'Elements\User');
		$this->user = $result->user;
		$this->assertTrue($this->user->id);
	}

    public function testListUsers() {
		$response = Elements\User::findUsers();
		$this->assertTrue(isset($response['users']));
    }

    public function testFindUserById() {
    	$this->createUser();
    	$response = Elements\User::findUserById($this->user->id);
    	$this->assertTrue(isset($response['user']));
    }

    public function testGetUserByExternalKey() {
    	$this->createUser();
    	$response = Elements\User::findUserByExternalKey($this->user['externalKey']);	
    	$this->assertTrue(isset($response['user']));
    }

    public function testUpdateUserById() {
    	if (!isset($this->user->id)) {
			$this->createUser();
		}    	
		$response = Elements\User::updateUserById($this->user->id, array(
			'name' => $this->user['name'],
			'gender' => $this->user['gender'],
		));
		$this->assertTrue(isset($response['empty']));
    }

    public function testUpdateuserByExternalKey() {
		if (!isset($this->user->id)) {
			$this->createUser();
		}    	
		$response = Elements\User::updateUserByExternalKey($this->user['externalKey'], array(
			'name' => $this->user['name'],
			'gender' => $this->user['gender'],
		));
		$this->assertTrue(isset($response['empty']));
    }

    public function testAddUserProperty() {
    	if (!isset($this->user->id)) {
    		$this->createUser();
    	}
    	$response = Elements\User::addUserProperty($this->user->id, array('property_test' => 'property_test'));
    	$this->assertTrue(isset($response['empty']));
    }

    public function testAddUserTag() {
    	if (!isset($this->user->id)) {
    		$this->createUser();
    	}
    	$response = Elements\User::addUserTag($this->user->id, array('name' => 'TestTag'));
    	$this->assertTrue(isset($response['empty']));
    }

    public function testDeleteUserTag() {
    	if (!isset($this->user->id)) {
    		$this->createUser();
    	}
    	$response = Elements\User::deleteUserTag($this->user->id, array('name' => 'TestTag'));
   		$this->assertTrue(isset($response['empty']));
    }

    public function testFindUserEmail() {
    	if (!isset($this->user->id)) {
    		$this->createUser();
    	}
    	$response = Elements\User::findUserEmail($this->user->id);
    	if (isset($response['emailAddresses']['emailAddress'][0])) {
    		foreach ($response['emailAddresses']['emailAddress'] as $array) {
    			if (in_array($this->customer['emailAddress'], $array)) {
    				$this->assertTrue(true);
    			}
    		}
    	} elseif (isset($response['emailAddresses']['emailAddress'])) {
    		$this->assertTrue(in_array($this->customer['emailAddress'], $response['emailAddresses']['emailAddress']->toArray()));
    	} else {
    		$this->assertTrue(false);
    	}
    }

    public function testAddUserEmail() {
    	if (!isset($this->user->id)) {
    		$this->createUser();
    	}
    	$response = Elements\User::addUserEmail($this->user->id, array('email' => $this->string.'@test.com'));
    	$this->assertEqual($response['emailAddress']['@'], $this->string.'@test.com');
    	$response = Elements\User::deleteUserEmail($this->user->id, array('emailId' => $response['emailAddress']['id']));
		$this->assertTrue(isset($response['empty']));
    }

   	public function testUpdateUserEmail() {
   		if (!isset($this->user->id)) {
   			$this->createUser();
   		}
   		$string = $this->randomString();
   		$response = Elements\User::addUserEmail($this->user->id, array('email' => $this->string.'@test.com'));
    	$this->assertEqual($response['emailAddress']['@'], $this->string.'@test.com');
    	$response1 = Elements\User::updateUserEmail($this->user->id, array('emailId' => $response['emailAddress']['id'], 'state' => 'verified', ));
		$this->assertTrue(isset($response1['empty']));
		$response2 = Elements\User::deleteUserEmail($this->user->id, array('emailId' => $response['emailAddress']['id']));
		$this->assertTrue(isset($response2['empty']));
   	}

   	public function testGetFinancialSummaries() {
   		if (!isset($this->user->id)) {
   			$this->createUser();
   		}
   		$response = Elements\User::getFinancialSummaries($this->user->id);
   		$this->assertTrue(isset($response['userFinancialSummaries']));
   	}

	public function testFindUserItemInstances() {
   		if (!isset($this->user->id)) {
   			$this->createUser();
   		}
   		$response = Elements\User::findItemInstances($this->user->id);
	  	$this->assertTrue(isset($response['itemInstances']));
   	}

	public function testFindUserRecommendations() {
   		if (!isset($this->user->id)) {
   			$this->createUser();
   		}
   		$response = Elements\User::findRecommendations($this->user->id);
	  	$this->assertTrue(isset($response['recommendedItemOfferFetchResults']));
   	}

	public function testGetUserRecommendations() {
   		if (!isset($this->user->id)) {
   			$this->createUser();
   		}
   		$response = Elements\User::getRestrictions($this->user->id);
	  	$this->assertTrue(isset($response['restrictions']));
   	}

   	public function testCreateSecureKey() {
   		if (!isset($this->user->id)) {
   			$this->createUser();
   		}
   		$response = Elements\User::createSecureKey($this->user->id);
  		$this->assertTrue(isset($response['secureKey']));
   	}

	public function testBlockUser() {
   		if (!isset($this->user->id)) {
   			$this->createUser();
   		}
   		$response = Elements\User::blockUser($this->user->id);
  		$this->assertTrue(isset($response['userBlock']));
  		$response1 = Elements\User::getBlock($this->user->id);
  		$this->assertTrue(isset($response1['userBlock']));
  		$response2 = Elements\User::unblockUser($this->user->id);
  		$this->assertTrue(isset($response2['empty']));
   	}

	public function testSetUserLoginTimeById() {
   		if (!isset($this->user->id)) {
   			$this->createUser();
   		}
   		$response = Elements\User::setUserLoginTimeById($this->user->id);
   		$this->assertTrue(isset($response['empty']));
   	}

	public function testSetUserLoginTimeByExternalKey() {
   		if (!isset($this->user->id)) {
   			$this->createUser();
   		}
   		$response = Elements\User::setUserLoginTimeByExternalKey($this->customer['externalKey']);
   		$this->assertTrue(isset($response['empty']));
   	}

}
