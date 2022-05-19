<?php

namespace Drupal\fifa_match\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the match entity edit forms.
 */
class FifaMatchForm extends ContentEntityForm {

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
      $this->messenger()->addStatus($this->t('New match %label has been created.', $message_arguments));
      $this->logger('fifa_match')->notice('Created new match %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The match %label has been updated.', $message_arguments));
      $this->logger('fifa_match')->notice('Updated new match %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.fifa_match.canonical', ['fifa_match' => $entity->id()]);
  }

}
