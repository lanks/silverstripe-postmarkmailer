<?php

/**
 * A {@link Mailer} subclass to handle sending emails through the 
 * Postmark webservice API rather then send_mail().
 *
 * @author Will Rossiter <will (dot) rossiter (at) gmail (dot) com>
 */

class PostmarkMailer extends Mailer {
	
	/**
	 * Send a plain-text email.
	 *  
	 * @param string $to
	 * @param string $from
	 * @param string §subject
	 * @param string $plainContent
	 * @param bool $attachedFiles
	 * @param array $customheaders
	 *
	 * @return bool
	 */
	public function sendPlain($to, $from, $subject, $plainContent, $attachedFiles = false, $customheaders = false) {
		$mail = $this->setupPostmark($to, $from, $subject, $plainContent, $attachedFiles, $customheaders);
		$mail->messagePlain($plainContent);
		
		return $mail->send();
	}
	
	/**
	 * Send a multi-part HTML email.
	 * 
	 * @return bool
	 */
	public function sendHTML($to, $from, $subject, $htmlContent, $attachedFiles = false, $customheaders = false, $plainContent = false, $inlineImages = false) {
		$mail = $this->setupPostmark($to, $from, $subject, $plainContent, $attachedFiles, $customheaders);
		$mail->messageHtml($htmlContent);
		
		return $mail->send();
	}
	
	/**
	 * Converts a string which contains email addresses to
	 * an array of email addresses.
	 *
	 * @todo Pull out the given names.
	 */
	public static function parse_email_addresses($emails) {
		preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $emails, $matches);
		
		return $matches[0];
	}
	
	/**
	 * Setup postmark app and check for configuration
	 *
	 * @throws PostmarkMailerException
	 * @return Mail_Postmark
	 */
	private function setupPostmark($to, $from, $subject, $content, $attachedFiles = false, $customheaders = false) {
		$required = array('POSTMARKAPP_API_KEY', 'POSTMARKAPP_MAIL_FROM_ADDRESS');
		
		foreach($required as $const) {
			if(!defined($const)) {
				user_error('Please set '. $const .' in your _config file', E_USER_ERROR);
			}
		}
		
		require_once('../postmarkmailer/thirdparty/postmark-php/Postmark.php');
		
		
		$mail = Mail_Postmark::compose()
			->subject($subject);
		
		$to = self::parse_email_addresses($to);
		if(!$to) throw new PostmarkMailerException('No recipient set for email.', E_USER_ERROR);
		
		foreach($to as $address) $mail->addTo($address);
		
		if($attachedFiles) {
			foreach($attachedFiles as $file) {
				$mail->addAttachment(Controller::join_links(
					Director::absoluteBaseURL(), 
					$file->Filename
				));
			}
		}
		
		if($customheaders) {
			foreach(array('Cc', 'Bcc') as $header) {
				if(isset($customheaders[$header])) {
					$addresses = self::parse_email_addresses($customheaders[$header]);
				
					if($addresses) {
						foreach($addresses as $address) {
							$mail->add{$header}($address);
						}
					}
				}
			}
		}
		
		return $mail;
	}
}

/**
 * @package postmarkmailer
 */
class PostmarkMailerException extends Exception {}