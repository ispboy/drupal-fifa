<?php

namespace Drupal\fifa_team\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the team entity edit forms.
 */
class FifaTeamForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => \Drupal::service('renderer')->render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New team %label has been created.', $message_arguments));
      $this->logger('fifa_team')->notice('Created new team %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The team %label has been updated.', $message_arguments));
      $this->logger('fifa_team')->notice('Updated new team %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.fifa_team.canonical', ['fifa_team' => $entity->id()]);
  }

}
