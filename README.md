# Postmarkapp Mailer for SilverStripe

## Maintainer Contact 
 * Will Rossiter 
   <will (dot) rossiter (at) gmail (dot) com>
	
## Requirements
 * SilverStripe 2.3 or newer.

## Overview

This module provides a Postmark (http://postmarkapp.com/) mailer subclass for use within SilverStripe
projects. 

Uses the superb Postmark PHP Library from Markus Hedlund as the back end. The module includes any
required files and hooks transparently into your installation via Email::set_mailer();

## How to use

 * Sign up to Postmarkapp
 * Define your POSTMARKAPP_API_KEY and POSTMARKAPP_MAIL_FROM_ADDRESS you can define from your 
 Postmarkapp dashboard

	**mysite/_config.php**
	define('POSTMARKAPP_MAIL_FROM_NAME', 'Your Name');
	define('POSTMARKAPP_MAIL_FROM_ADDRESS', 'mailer@yourdomain.com');
	define('POSTMARKAPP_API_KEY', '...5aef660..');
	
 * Set the Mailer to be your SilverStripe Mailer instance.

	**mysite/_config.php_**
	Email::set_mailer('PostmarkMailer');
	
## Known Issues

Currently I have only been using this for simple text emails from a SaaS application and haven't tested
some of the other functionality. For example attaching files, customizing emails (reply to, cc)

If you need a missing feature please fork and contribute or get in touch.
