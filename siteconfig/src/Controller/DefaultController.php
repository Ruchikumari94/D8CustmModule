<?php

namespace Drupal\siteconfig\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\HeaderBag;

/**
 * Class DefaultController.
 */
class DefaultController extends ControllerBase {

  /**
   * Hello.
   *
   * @return string
   *   Return Hello string.
   */
  public function hello($siteapi,$node_id) {

    $output=['status' => false,
             'data' => '',];

    $path = \Drupal::request()->getpathInfo();
    $arg  = explode('/',$path);
    $varsiteapi = \Drupal::config('siteconfig.settings')
      ->get('siteapikey');

    if($arg[2]!=$varsiteapi){
      $output['data'] = 'Access Denied';
      return new JsonResponse($output);
    }

    $nid = $arg[3];
    $node = \Drupal\node\Entity\Node::load($nid);
    if( empty( $node ) ) {
      $output['data'] = 'Please enter valid node id';
      $output['status'] = false; 
    }
    else{
      $serializer = \Drupal::service('serializer');
      //$node = Node::load(2);
      $data = $serializer->serialize($node, 'json', ['plugin_id' => 'entity']);
      $output['data'] = $data;
      $output['status'] = true;
    }
    return new JsonResponse($output);
  }
  /**
   * Siteapi.
   *
   * @return string
   *   Return Hello string.
   */
  public function siteapi() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: siteapi')
    ];
  }

}
