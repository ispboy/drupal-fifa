<?php

namespace Drupal\fifa_tournament;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of tournament type entities.
 *
 * @see \Drupal\fifa_tournament\Entity\FifaTournamentType
 */
class FifaTournamentTypeListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['title'] = $this->t('Label');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['title'] = [
      'data' => $entity->label(),
      'class' => ['menu-label'],
    ];

    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $build = parent::render();

    $build['table']['#empty'] = $this->t(
      'No tournament types available. <a href=":link">Add tournament type</a>.',
      [':link' => Url::fromRoute('entity.fifa_tournament_type.add_form')->toString()]
    );

    return $build;
  }

}
