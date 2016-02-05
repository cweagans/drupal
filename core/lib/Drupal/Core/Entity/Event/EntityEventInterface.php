<?php

/**
 * @file
 * Contains Drupal\Core\Entity\Event\EntityEventInterface.
 */

namespace Drupal\Core\Entity\Event;

/**
 * Interface for Entity events.
 */
interface EntityEventInterface {
  /**
   * Getter for the entity that was operated on.
   *
   * @return \Drupal\Core\Entity\EntityInterface
   *   The entity that was operated on.
   */
  public function getEntity();
}
