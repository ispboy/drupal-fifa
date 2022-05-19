<?php

namespace Drupal\fifa_tournament\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\fifa_tournament\Standings;

/**
 * Returns responses for Fifa Tournament routes.
 */
class FifaTournamentController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build($fifa_tournament) {
    $target_id = $fifa_tournament->id();
    $storage = $this->entityTypeManager()->getStorage('fifa_match');
    $query = $storage->getQuery();
    $query -> condition('status', 1);
    $query -> condition('field_tournament', ['target_id' => $target_id]);
    $ids = $query->execute();
    $matches = $storage->loadMultiple($ids);

    $standings = new Standings($fifa_tournament, $matches);
    $results = $standings->getResults();

    $groups = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
    foreach ($results as $gid => $items) {
      $caption = \is_numeric($gid) ? $groups[$gid-1]. '组' : NULL;

      $rows = [];
      foreach ($items as $key => $row) {
        $id = $row['nid'];
        $name = \Drupal\Core\Link::createFromRoute($row['name'], 'entity.fifa_team.canonical', ['fifa_team' => $id]);
        $rows[] = [
          $key+1,
          $name,
          $row['mp'],
          $row['w'],
          $row['d'],
          $row['l'],
          $row['gs']. ' / '. $row['ga']. ' / '. $row['gd'],
          $row['pt'],
        ];
      }
      $build['content']['group-'. $gid] = [
        '#type'   => 'table',
        '#caption' => $caption,
        // '#sticky' => FALSE,
        '#header' => ['#', '球队', '场', '胜', '平', '负', '得失净', '积分'],
        '#rows'   => $rows,
      ];
    }

    return $build;
  }

  public function setTitle($fifa_tournament) {
    return $fifa_tournament->label();
  }

}
