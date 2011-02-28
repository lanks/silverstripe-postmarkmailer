<?php

/**
 * @package postmarkmailer
 */

class PostmarkMailerTest extends SapphireTest {
	
	function testParseEmailString() {
		$emails = array(
			'foo@bar.com' => 'foo@bar.com',
			'<foo@bar.com>' => 'foo@bar.com',
			'Baz <foo@bar.com>' => 'foo@bar.com'
		);
		
		foreach($emails as $string => $email) {
			$results = PostmarkMailer::parse_email_addresses($string);

			$this->assertEquals(1, count($results));
			$this->assertEquals($email, $results[0]);
		}
		
		$complex = array(
			'foo@bar.com, bar@foo.com' => array(
				'foo@bar.com',
				'bar@foo.com'
			),
			'Baz <foo@bar.com>, bar@foo.com' => array(
				'foo@bar.com',
				'bar@foo.com'
			)
		);
		
		foreach($complex as $string => $emails) {
			$results = PostmarkMailer::parse_email_addresses($string);
			
			$this->assertEquals(2, count($results));
			$this->assertEquals($emails, $results);
		}
	}
}
