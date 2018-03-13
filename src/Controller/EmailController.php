<?php
class EmailController extends AppController{

public $components=array('Email');

  function send(){

  //create an array of values to be replaced in email html template//
      $this->Email->to = 'ababaze@gmail.com'; //receiver email id
      $this->Email->subject = 'Subject Line';
      $this->Email->replyTo = 'reply@address.com'; //reply to email//
      $this->Email->template = 'sample';//email template //
      $this->Email->sendAs = 'html';
      if($this->Email->send()){
      //mail send //
      }

  }
}

?>
