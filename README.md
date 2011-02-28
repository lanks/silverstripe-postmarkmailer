# Postmarkapp Mailer for SilverStripe

## Maintainer Contact 
 * Will Rossiter 
   <will (dot) rossiter (at) gmail (dot) com>
	
## Requirements
 * SilverStripe 2.3 or newer.

## Overview

This module provides a Postmark (http://postmarkapp.com/) mailer subclass for use within SilverStripe
projects. 

Uses the superb Postmark PHP Library (https://github.com/Znarkus/postmark-php) from Markus Hedlund 
(http://www.mimmin.com) as the back end. The module hooks transparently into your SilverStripe 
installation via __Email::set_mailer();__.

## How to use

 * Sign up to Postmarkapp (http://postmarkapp.com)
 * Define your POSTMARKAPP_API_KEY and POSTMARKAPP_MAIL_FROM_ADDRESS you can define from your 
 Postmarkapp.com dashboard. Place the following in your _config.php

		define('POSTMARKAPP_MAIL_FROM_NAME', 'Your Name');
		define('POSTMARKAPP_MAIL_FROM_ADDRESS', 'mailer@yourdomain.com');
		define('POSTMARKAPP_API_KEY', '...5aef660..');
	
 * Set the Mailer to be your SilverStripe Mailer instance, Again, place this in your _config.php or
before the code you need to send the email

		Email::set_mailer('PostmarkMailer');
	
## Known Issues

Currently I have only been using this for simple text emails from a SaaS application and haven't tested
some of the other functionality. For example attaching files, customizing emails (reply to, cc)

If you need a missing feature please fork and contribute or get in touch.

## License

This module is released under the BSD license.

The Postmark PHP library is released under the MIT License
http://www.opensource.org/licenses/mit-license.php