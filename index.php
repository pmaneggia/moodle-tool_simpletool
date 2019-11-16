<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Defines the version and other meta-info about the plugin
 *
 * @package    tool_simpletool
 * @copyright  2018 Richard Jones <richardnz@outlook.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @see https://moodledev.moodle.school/mod/page/view.php?id=50
 */
use \tool_simpletool\local\debugging;
use \tool_simpletool\local\fetch_data;
require_once(__DIR__ . '/../../../config.php');

$sorting = optional_param('sorting', 'name', PARAM_ALPHA);

$url = new moodle_url('/admin/tool/simpletool/index.php');
$title = get_string('pluginname', 'tool_simpletool');

// Setup the page.
$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_pagelayout('report');
$PAGE->set_title($title);
$PAGE->set_heading(get_string('index_header', 'tool_simpletool'));

// Get some data
$data = fetch_data::collaborate_submission_data($sorting);

// Call the renderer to display the data.
$renderer = $PAGE->get_renderer('tool_simpletool');
$renderer->display_table($data);