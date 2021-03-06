<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Parser Enabled
|--------------------------------------------------------------------------
|
| Should the Parser library be used for the entire page?
|
| Can be overridden with $this->template->enable_parser(TRUE/FALSE);
|
|   Default: TRUE
|
*/

$config['parser_enabled'] = TRUE;

/*
|--------------------------------------------------------------------------
| Parser Enabled for Body
|--------------------------------------------------------------------------
|
| If the parser is enabled, do you want it to parse the body or not?
|
| Can be overridden with $this->template->enable_parser(TRUE/FALSE);
|
|   Default: FALSE
|
*/

$config['parser_body_enabled'] = FALSE;

/*
|--------------------------------------------------------------------------
| Title Separator
|--------------------------------------------------------------------------
|
| What string should be used to separate title segments sent via $this->template->title('Foo', 'Bar');
|
|   Default: ' | '
|
*/

$config['title_separator'] = ' | ';

/*
|--------------------------------------------------------------------------
| Layout
|--------------------------------------------------------------------------
|
| Which layout file should be used? When combined with theme it will be a layout file in that theme
|
| Change to 'main' to get /application/views/layouts/main.php
|
|   Default: 'default'
|
*/

$config['layout'] = 'default';

/*
|--------------------------------------------------------------------------
| Theme
|--------------------------------------------------------------------------
|
| Which theme to use by default?
|
| Can be overriden with $this->template->set_theme('foo');
|
|   Default: ''
|
*/

$config['theme'] = '';

/*
|--------------------------------------------------------------------------
| Theme Locations
|--------------------------------------------------------------------------
|
| Where should we expect to see themes?
|
| Default: array(APPPATH.'themes/' => '../themes/')
|
*/

$config['theme_locations'] = array(
  APPPATH.'themes/'
);


$template['active_template'] = 'default';

$template['default']['template'] = 'template/default_template.php';
$template['default']['regions'] = array(
   'title' => array('content' => array('Ajhoel Tragedy Template')),
   'header',
   'navs',
   'sidenavs',
   'content',
   'footer' => array(
        'content' => array(lang('appdev')),
    ),
);

$template['default']['parser'] = 'parser';
$template['default']['parser_method'] = 'parse';
$template['default']['parse_template'] = FALSE;

$template['simple']['template'] = 'template/simple_template.php';
$template['simple']['regions'] = array(
   'title' => array('content' => array('Ajhoel Tragedy Template')),
   'header',
   'navs',
   'sidenavs',
   'content',
   'footer' => array(
        'content' => array(lang('appdev')),
    ),
);

$template['simple']['parser'] = 'parser';
$template['simple']['parser_method'] = 'parse';
$template['simple']['parse_template'] = FALSE;
