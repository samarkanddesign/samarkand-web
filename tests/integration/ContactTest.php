<?php

namespace integration;

use App\User;
use MailThief\Testing\InteractsWithMail;
use TestCase;

class ContactTest extends TestCase
{
    use InteractsWithMail;

  /** @test */
  public function it_sends_an_email_from_the_contact_page()
  {
      config(['mail.recipients.contact' => 'foo@example.com']);

      // Make an admin user to send email to
      $user = factory(User::class)->create(['is_shop_manager' => true]);

      $this->visit('/contact')
          ->type('Joe Bloggs', 'name')
          ->type('joe@example.com', 'email')
          ->type('This is an email', 'subject')
          ->type('Lorem Ipsum', 'message')
          ->press('send');

      $this->seeMessageFor('foo@example.com');

      $this->seeMessageWithSubject('This is an email');
      $this->seeMessageFrom('Joe Bloggs');

      $this->seePageIs('/contact')
           ->see('your message has been sent');
  }

  /** @test */
  public function it_validates_the_contact_form()
  {
      $this->visit('/contact')
    ->press('send')
    ->seePageIs('/contact')
    ->see('email field is required');
  }
}
