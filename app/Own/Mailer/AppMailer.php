<?php

namespace App\Own\Mailer;

use App\User;
use Illuminate\Contracts\Mail\Mailer;

/**
 *
 */
class AppMailer
{
  protected $mailer;

  protected $from = 'postmaster@sandbox36e0be12d3de4e0abb9a70914d6ee5de.mailgun.org';

  protected $to;

  protected $subject;

  protected $view;

  protected $data = [];

  public function __construct(Mailer $mailer)
  {
    $this->mailer = $mailer;
  }

  public function sendEmailConfirmationTo(User $user)
  {
    $this->to = $user->email;
    $this->view = 'email.confirm';
    $this->data = compact('user');
    $this->subject = 'Confimação de email';
    $this->deliver();
  }

  public function deliver()
  {
    $result = $this->mailer->send($this->view, $this->data, function($message){
      $message->from($this->from, 'AppCambio')
              ->to($this->to)
              ->subject($this->subject);
    });
  }
}
