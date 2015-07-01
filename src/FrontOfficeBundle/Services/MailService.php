<?php

namespace FrontOfficeBundle\Services;

class MailServices
{
	private $mailer;

	public function __construct($mailer)
	{
		$this -> mailer = $mailer;
	}

	public function send($name,$email,$content)
	{
		$message = \SwiftMessage::newInstance();
		$message -> setSubject('Contact de'.$name)
				 -> setTo('chhoulet@yahoo.fr')
				 -> setFrom('$email')
				 -> setContent($content);

		$this -> mailer -> send($message);
	}
}