<?php

namespace Drupal\fifa_club\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the club entity edit forms.
 */
class FifaClubForm extends ContentEntityForm {

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
      $this->messenger()->addStatus($this->t('New club %label has been created.', $message_arguments));
      $this->logger('fifa_club')->notice('Created new club %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The club %label has been updated.', $message_arguments));
      $this->logger('fifa_club')->notice('Updated new club %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.fifa_club.canonical', ['fifa_club' => $entity->id()]);
  }

}
