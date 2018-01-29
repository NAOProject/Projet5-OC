<?php

namespace OC\NAOBundle\Services;


class email
{
  private $mailer;

  public function __construct(\Swift_Mailer $mailer)
  {
      $this->mailer = $mailer;

  }

  public function sendMail($subject, $emailTo, $emailForm, $content)
  {
      $message = \Swift_Message::newInstance()
          ->setSubject($subject)
          ->setFrom($emailForm)
          ->setTo($emailto)
          ->setBody($content),'text/html');

      $this->mailer->send($message);
  }
}
