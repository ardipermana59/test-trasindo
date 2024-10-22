<?php

return [
  /**
   * Daftar dan login di Digiflazz
   * lalu atur konfigurasi di bawah ini.
   * URL: https://member.digiflazz.com/buyer-area/connection/api
   */

  /**
   * Base URL API Digiflazz
   */
  'url' => env('DIGI_URL', 'https://api.digiflazz.com/v1/'),

  /**
   * API Key untuk mode production
   */
  'key' => env('DIGI_KEY', null),

  /**
   * API Key untuk mode development (test)
   */
  'key_test' => env('DIGI_KEY_TEST', null),

  /**
   * Username Digiflazz
   */
  'username' => env('DIGI_USERNAME', '-'),

  'devmode' => env('DIGI_DEBUG_MODE', true),
];
