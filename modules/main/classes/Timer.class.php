<?php
/**
 * SmartSystem v.5
 *
 * @package smartsystem
 */


/**
 * Stoper
 *
 * @package smartsystem
 */
class Timer {

  /**
   * Moment, w którym zaczynamy liczyć czas
   *
   * @var float
   */
  protected $start  = 0;

  /**
   * Moment, w którym kończymy liczyć czas
   *
   * @var float
   */
  protected $stop   = 0;

  /**
   * Rezultat pomiaru czasu
   *
   * @var float
   */
  protected $time   = 0;


  /**
   * Uruchamia pomiar czasu
   *
   */
  public function start() {
    $this->start = microtime(true);
  }

  /**
   * Kończy pomiar czasu
   *
   */
  public function stop() {
    $this->stop = microtime(true);
    $this->time = $this->stop - $this->start;
  }

  /**
   * Zwraca rezultat pomiaru czasu.
   *
   * Rezultat jest domyślnie zaokrąglony do 3 miejsc po przecinku.
   *
   * @param integer $precision
   * @return float
   */
  public function getTime($precision = 3) {
    return round($this->time, $precision);
  }

}
?>