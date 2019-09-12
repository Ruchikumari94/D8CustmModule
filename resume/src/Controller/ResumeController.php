<?php
namespace Drupal\resume\Controller;
 
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Database\Database;
 
/**
 * Provides route responses for the Example module.
 */
class ResumeController extends ControllerBase {
 
  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function successpage() {
  //display resume page
    $element = array(
      '#title' => 'Example',
      '#markup' => 'Form data submitted',
    );
    return $element;
  }
 
  // public function example() {
  //   //fetch data from employee table.
  //   $connection = \Drupal::database();
  //   $query = $connection->query("SELECT * FROM resume");
  //   $result = $query->fetchAll();
  // }
}