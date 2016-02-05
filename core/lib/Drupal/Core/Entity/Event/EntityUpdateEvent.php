<?php

/**
 * @file
 * Contains Drupal\Core\Entity\Event\EntityUpdatedEvent.
 */

namespace Drupal\Core\Entity\Event;

class EntityUpdateEvent extends EntityEvent implements MutatedEntityEventInterface {

  /**
   * {@inheritDoc}
   */
  public function getOriginalEntity() {
    return $this->entity->original;
  }
}
