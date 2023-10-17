<?php

namespace Drupal\fifa_person\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the person entity edit forms.
 */
class FifaPersonForm extends ContentEntityForm {

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
      $this->messenger()->addStatus($this->t('New person %label has been created.', $message_arguments));
      $this->logger('fifa_person')->notice('Created new person %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The person %label has been updated.', $message_arguments));
      $this->logger('fifa_person')->notice('Updated new person %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.fifa_person.canonical', ['fifa_person' => $entity->id()]);
  }

}
