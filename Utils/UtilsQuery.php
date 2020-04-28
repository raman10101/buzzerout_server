<?php

class UtilsQuery
{

	private $conn;

	function __construct()
	{
		require_once  './../Config/Connect.php';
		$db = new Connect();
		$this->conn = $db->connect();
	}

	public function lowerCase($text)
	{
		$response = array();
		$response['error'] = false;
		$response['old_username'] = $text;
		$response['new_username'] = strtolower($text);
		return $response;
	}
	public function noSpecialChar($text)
	{
		$response = array();
		if (!ctype_alnum($text)) {
			$response['error'] = true;
			$response['message'] = "username contain special character";
		} else {
			$response['error'] = false;
			$response['message'] = "username does not contain special character";
		}
		return strtolower($text);
	}
	public function passwordLenght($text)
	{
		$response = array();
		if (strlen($text) < 11) {
			$response['error'] = true;
			$response['message'] = "password lenght is small";
		} else {
			$response['error'] = false;
			$response['message'] = "strong password ";
		}
		return $response;
	}
	public function passwordEncrypt($text)
	{
		$response = array();
		$response['error'] = false;
		$response['message'] = "password encrypted";
		$ciphering = "AES-128-CTR";

		// Use OpenSSl Encryption method 
		$iv_length = openssl_cipher_iv_length($ciphering);
		$options = 0;

		// Non-NULL Initialization Vector for encryption 
		$encryption_iv = '1234567891011121';

		// Store the encryption key 
		$encryption_key = "password";

		// Use openssl_encrypt() function to encrypt the data 
		$response['encrypt_password'] = openssl_encrypt(
			$text,
			$ciphering,
			$encryption_key,
			$options,
			$encryption_iv
		);
		return $response;
	}
	public function passwordDecrypt($text)
	{
		$response = array();
		$response['error'] = false;
		$response['message'] = "password decrypt";
		// Non-NULL Initialization Vector for decryption 
		$decryption_iv = '1234567891011121';
		$ciphering = "AES-128-CTR"; 
		// Store the decryption key 
		$decryption_key = "password";
		$options = 0;
		// Use openssl_decrypt() function to decrypt the data 
		$response['decrypted_password'] = openssl_decrypt(
			$text,
			$ciphering,
			$decryption_key,
			$options,
			$decryption_iv
		);
		return $response;
	}
}
