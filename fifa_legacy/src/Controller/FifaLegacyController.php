<?php

namespace Drupal\fifa_legacy\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Returns responses for Fifa legacy routes.
 */
class FifaLegacyController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function club() {
    $bundle = 'club';
    $storage = $this->entityTypeManager()->getStorage('node');
    $query = $storage->getQuery();
    $query->condition('status', 1)
      ->condition('type', $bundle)
      ->accessCheck(FALSE);
    $ids = $query->execute();
    // $nodes = $storage->loadMultiple($nids);
    $result = [];
    $photos = $storage->load(3)->get('field_photo')->getValue();
    foreach ($photos as $photo) {
      $fid = $photo['target_id'];
      $uri = \Drupal\file\Entity\File::load($fid)->getFileUri();
      dpm(file_create_url($uri));
    }

    // return new JsonResponse([
    //   'data' => $result,
    //   'method' => 'GET',
    // ]);

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('Club works!'),
    ];

    return $build;
  }

}
