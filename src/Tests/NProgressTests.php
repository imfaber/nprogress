<?php

namespace Drupal\nprogress\Tests;

use Drupal\simpletest\WebTestBase;

/**
* Tests for the NProgress module.
*
* @group NProgress
*/
class NProgressTests extends WebTestBase {

  /**
  * Modules to install.
  *
  * @var array
  */
  public static $modules = array('nprogress');

  private $user;

  public function setUp() {
    parent::setUp();

    $this->user = $this->DrupalCreateUser(array(
      'administer site configuration',
      'administer nprogress',
    ));
  }

  /**
  * Tests the config form.
  */
  public function testNProgressConfiguration() {
    // Login
    $this->drupalLogin($this->user);

    // Access config page
    $this->drupalGet('admin/config/user-interface/nprogress');
    $this->assertResponse(200);
    // Test the form elements exist and have defaults
    $config = $this->config('nprogress.settings');
    $this->assertFieldByName(
      'nprogress_page_display',
      $config->get('page.title'),
      'Page display field has the default value'
    );
    $this->assertFieldByName(
      'nprogress_page_timer',
      $config->get('page.timer'),
      'Page timer field has the default value'
    );
    $this->assertFieldByName(
      'nprogress_page_color',
      $config->get('page.color'),
      'Page color field has the default value'
    );
    $this->assertFieldByName(
      'nprogress_ajax_display',
      $config->get('ajax.display'),
      'Ajax display field has the default value'
    );
    $this->assertFieldByName(
      'nprogress_ajax_color',
      $config->get('ajax.color'),
      'Ajax color field has the default value'
    );

    // Test form submission
    $this->drupalPostForm(NULL, array(
      'nprogress_page_timer' => '500',
      'nprogress_page_color' => '#00FFFF',
    ), t('Save configuration'));
    $this->assertText(
      'The configuration options have been saved.',
      'The form was saved correctly.'
    );

    // Test the new values are there.
    $this->drupalGet('admin/config/user-interface/nprogress');
    $this->assertResponse(200);
    $this->assertFieldByName(
      'nprogress_page_timer',
      '500',
      'Page timer is OK.'
    );
    $this->assertFieldByName(
      'nprogress_page_color',
      '#00FFFF',
      'Page color is OK.'
    );
  }
}
