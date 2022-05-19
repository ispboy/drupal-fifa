<?php

namespace Drupal\fifa_league;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the league entity type.
 */
class FifaLeagueAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    $uid = $account->id();

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view league');

      case 'update':
        if ($uid > 0 && $entity->getOwnerId() === $uid) {
          return AccessResult::allowedIfHasPermissions($account, ['edit own league', 'administer league'], 'OR');
        } else {
          return AccessResult::allowedIfHasPermissions($account, ['edit any league', 'administer league'], 'OR');
        }

      case 'delete':
        return AccessResult::allowedIfHasPermissions($account, ['delete league', 'administer league'], 'OR');

      default:
        // No opinion.
        return AccessResult::neutral();
    }

  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermissions($account, ['create league', 'administer league'], 'OR');
  }

}
