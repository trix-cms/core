<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Theme
|--------------------------------------------------------------------------
|
| Which theme to use by default?
|
| Can be overriden with $this->template->set_theme('foo');
|
*/

$config['theme'] = 'public';

/*
|--------------------------------------------------------------------------
| Theme location
|--------------------------------------------------------------------------
|
| Where should we expect to see themes?
|
|	Default: array(APPPATH.'themes/')
|
*/

$config['theme_location'] = 'themes/';

/*
|--------------------------------------------------------------------------
| Layout
|--------------------------------------------------------------------------
|
| Which layout to use by default?
|
| Can be overriden with $this->template->set_theme('foo');
|
*/

$config['layout'] = 'layouts/default';

$config['wysiwyg'] = array(
    'admin'=>array(
        'page'=>array('add', 'edit'),
        'news'=>array('add', 'edit')
    ),
    'public'=>array(
    
    )
);