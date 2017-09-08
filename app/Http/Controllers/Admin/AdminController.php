<?php

/*
 * This file is part of Fixhub.
 *
 * Copyright (C) 2016 Fixhub.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fixhub\Http\Controllers\Admin;

use Fixhub\Http\Controllers\Controller;

/**
 * Controller for admin.
 */
class AdminController extends Controller
{
    /**
     * Shows admin.
     *
     * @return Response
     */
    public function index()
    {
        $title = trans('admin.dashboard');
        $envs = [
            ['name' => 'Fixhub version',    'value' => APP_VERSION],
            ['name' => 'PHP version',       'value' => PHP_VERSION],
            ['name' => 'Laravel version',   'value' => app()->version()],
            ['name' => 'CGI',               'value' => php_sapi_name()],
            ['name' => 'Server',            'value' => $_SERVER['SERVER_SOFTWARE']],

            ['name' => 'Database',          'value' => config('database.default')],
            ['name' => 'Cache driver',      'value' => config('cache.default')],
            ['name' => 'Session driver',    'value' => config('session.driver')],
            ['name' => 'Queue driver',      'value' => config('queue.default')],

            ['name' => 'Timezone',          'value' => config('app.timezone')],
            ['name' => 'Locale',            'value' => config('app.locale')],
            ['name' => 'Env',               'value' => config('app.env')],
            ['name' => 'URL',               'value' => config('app.url')],
            ['name' => 'Log',               'value' => config('app.log')],

            ['name' => 'Socket URL',        'value' => config('fixhub.socket_url').':'.env('SOCKET_PORT', 6001)],

            ['name' => 'Mail driver',       'value' => env('MAIL_DRIVER', 'log')],

            ['name' => 'Debug',             'value' => config('app.debug') ? 'true' : 'false'],
        ];

        $json = file_get_contents(base_path('composer.json'));
        $dependencies = json_decode($json, true)['require'];

        return view('admin.index', compact('title', 'envs', 'dependencies'));
    }
}
