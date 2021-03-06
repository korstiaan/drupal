<?php

/**
 * @file
 * Definition of Drupal\Core\Config\NullStorage.
 */

namespace Drupal\Core\Config;

/**
 * Defines a stub storage controller.
 *
 * This storage is always empty; the controller reads and writes nothing.
 *
 * The stub implementation is needed for synchronizing configuration during
 * installation of a module, in which case all configuration being shipped with
 * the module is known to be new. Therefore, the module installation process is
 * able to short-circuit the full diff against the active store; the diff would
 * yield all currently available configuration as items to remove, since they do
 * not exist in the module's default configuration directory.
 *
 * This also can be used for testing purposes.
 */
class NullStorage implements StorageInterface {
  /**
   * Implements Drupal\Core\Config\StorageInterface::__construct().
   */
  public function __construct(array $options = array()) {
  }

  /**
   * Implements Drupal\Core\Config\StorageInterface::read().
   */
  public function read($name) {
    return array();
  }

  /**
   * Implements Drupal\Core\Config\StorageInterface::write().
   */
  public function write($name, array $data) {
    return FALSE;
  }

  /**
   * Implements Drupal\Core\Config\StorageInterface::delete().
   */
  public function delete($name) {
    return FALSE;
  }

  /**
   * Implements Drupal\Core\Config\StorageInterface::encode().
   */
  public static function encode($data) {
    return $data;
  }

  /**
   * Implements Drupal\Core\Config\StorageInterface::decode().
   */
  public static function decode($raw) {
    return $raw;
  }

  /**
   * Implements Drupal\Core\Config\StorageInterface::listAll().
   */
  public function listAll($prefix = '') {
    return array();
  }
}
