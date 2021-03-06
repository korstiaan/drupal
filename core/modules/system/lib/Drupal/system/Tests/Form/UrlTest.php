<?php

/**
 * @file
 * Definition of Drupal\system\Tests\Form\UrlTest.
 */

namespace Drupal\system\Tests\Form;

use Drupal\simpletest\WebTestBase;

/**
 * Tests url element.
 */
class UrlTest extends WebTestBase {
  protected $profile = 'testing';

  public static function getInfo() {
    return array(
      'name' => 'Form API url',
      'description' => 'Tests the form API url element.',
      'group' => 'Form API',
    );
  }

  public function setUp() {
    parent::setUp('form_test');
  }

  /**
   * Tests that #type 'url' fields are properly validated and trimmed.
   */
  function testFormUrl() {
    $edit = array();
    $edit['url'] = 'http://';
    $edit['url_required'] = ' ';
    $this->drupalPost('form-test/url', $edit, 'Submit');
    $this->assertRaw(t('The URL %url is not valid.', array('%url' => 'http://')));
    $this->assertRaw(t('!name field is required.', array('!name' => 'Required URL')));

    $edit = array();
    $edit['url'] = "\n";
    $edit['url_required'] = 'http://example.com/   ';
    $values = drupal_json_decode($this->drupalPost('form-test/url', $edit, 'Submit'));
    $this->assertIdentical($values['url'], '');
    $this->assertEqual($values['url_required'], 'http://example.com/');

    $edit = array();
    $edit['url'] = 'http://foo.bar.example.com/';
    $edit['url_required'] = 'http://drupal.org/node/1174630?page=0&foo=bar#new';
    $values = drupal_json_decode($this->drupalPost('form-test/url', $edit, 'Submit'));
    $this->assertEqual($values['url'], $edit['url']);
    $this->assertEqual($values['url_required'], $edit['url_required']);
  }
}
