<?php

namespace Drupal\fifa_tournament\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the tournament entity edit forms.
 */
class FifaTournamentForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New tournament %label has been created.', $message_arguments));
      $this->logger('fifa_tournament')->notice('Created new tournament %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The tournament %label has been updated.', $message_arguments));
      $this->logger('fifa_tournament')->notice('Updated new tournament %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.fifa_tournament.canonical', ['fifa_tournament' => $entity->id()]);
  }

}
