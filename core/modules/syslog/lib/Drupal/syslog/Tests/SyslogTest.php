<?php

/**
 * @file
 * Definition of Drupal\syslog\Tests\SyslogTest.
 */

namespace Drupal\syslog\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Tests the Syslog module functionality.
 */
class SyslogTest extends WebTestBase {
  public static function getInfo() {
    return array(
      'name' => 'Syslog functionality',
      'description' => 'Test syslog settings.',
      'group' => 'Syslog'
    );
  }

  function setUp() {
    parent::setUp('syslog');
  }

  /**
   * Tests the syslog settings page.
   */
  function testSettings() {
    $admin_user = $this->drupalCreateUser(array('administer site configuration'));
    $this->drupalLogin($admin_user);

    $edit = array();
    // If we're on Windows, there is no configuration form.
    if (defined('LOG_LOCAL6')) {
      $this->drupalPost('admin/config/development/logging', array('syslog_facility' => LOG_LOCAL6), t('Save configuration'));
      $this->assertText(t('The configuration options have been saved.'));

      $this->drupalGet('admin/config/development/logging');
      if ($this->parse()) {
        $field = $this->xpath('//option[@value=:value]', array(':value' => LOG_LOCAL6)); // Should be one field.
        $this->assertTrue($field[0]['selected'] == 'selected', t('Facility value saved.'));
      }
    }
  }
}
