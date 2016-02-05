<?php

/**
 * @file
 * Contains Drupal\Core\Entity\Event\MutatedEntityEventInterface.
 */

namespace Drupal\Core\Entity\Event;

/**
 * Interface for entity events where the entity after the operation is different
 * from the original.
 */
interface MutatedEntityEventInterface {
  /**
   * Getter for the entity before is was mutated.
   *
   * @return \Drupal\Core\Entity\EntityInterface
   *   The unmodified version of the entity
   */
  public function getOriginalEntity();
}
