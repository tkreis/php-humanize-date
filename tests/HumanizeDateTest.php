<?php

require('src/HumanizeDate.php');

class HumanizeDateTest extends PHPUnit_Framework_TestCase{

  public function setUp(){
    date_default_timezone_set('UTC');
    $this->humanize = new HumanizeDate();
  }

  public function testHumanizeRecievesATimestampAndReturnsAstring(){
    $this->assertInternalType('string', $this->humanize->me(mktime()));
  }

  public function testHumanizeRecievesATimestampAndReturnsCorrectDayResponse(){
    $this->assertContains('1 day ago', $this->humanize->me($this->getDaysFromTimestapAgo(1)));
    $this->assertContains('2 days ago', $this->humanize->me($this->getDaysFromTimestapAgo(2)));

    $this->assertContains('in 1 day', $this->humanize->me($this->getDaysFromTimestapFuture(1)));
    $this->assertContains('in 2 days', $this->humanize->me($this->getDaysFromTimestapFuture(2)));
  }

  public function testHumanizeRecievesATimestampAndReturnsCorrectSecondResponse(){
    $this->assertContains('10 second ago', $this->humanize->me($this->getSecondsFromTimestapAgo(10)));
    $this->assertContains('20 second ago', $this->humanize->me($this->getSecondsFromTimestapAgo(20)));

    $this->assertContains('in 10 seconds', $this->humanize->me($this->getSecondsFromTimestapFuture(10)));
    $this->assertContains('in 20 seconds', $this->humanize->me($this->getSecondsFromTimestapFuture(20)));
  }

  public function testHumanizeRecievesATimestampAndReturnsCorrectMinuteResponse(){
    $this->assertContains('1 minute ago', $this->humanize->me($this->getSecondsFromTimestapAgo(1)));
    $this->assertContains('10 minutes ago', $this->humanize->me($this->getSecondsFromTimestapAgo(10)));

    $this->assertContains('in 1 minute', $this->humanize->me($this->getSecondsFromTimestapFuture(1)));
    $this->assertContains('in 20 minutes', $this->humanize->me($this->getSecondsFromTimestapFuture(20)));
  }

  private function getDaysFromTimestampAgo($days){
   return  mktime() - (24*60*60 *$days);
  }

  private function getMinutesFromTimestampAgo($minutes){
   return  mktime() - (60*60 *$minutes);
  }

  private function getSecondsFromTimestampAgo($seconds){
   return  mktime() - (60*$seconds);
  }

  private function getDaysFromTimestampInFuture($days){
   return  mktime() + (24*60*60 *$days);
  }

  private function getMinutesFromTimestampFuture($minutes){
   return  mktime() + (60*60 *$minutes);
  }

  private function getSecondsFromTimestampFuture($seconds){
   return  mktime() + (60*$seconds);
  }
}
