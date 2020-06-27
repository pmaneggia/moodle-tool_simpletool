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
 * Custom renderer for output of data table
 *
 * @package    mod_simplelesson
 * @copyright  2019 Richard Jones <richardnz@outlook.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @see https://github.com/moodlehq/moodle-tool_simpletool
 * @see https://github.com/justinhunt/moodle-tool_simpletool
 */
use \tool_simpletool\local\debugging;
defined('MOODLE_INTERNAL') || die();

/**
 * Renderer for collaborate mod.
 */
class tool_simpletool_renderer extends plugin_renderer_base {

    public function display_table($records) {

        $data = new stdClass();

        // Table headers.
        $headers = array();

        $headers[] = get_string('username', 'tool_simpletool');
        $headers[] = get_string('firstname', 'tool_simpletool');
        $headers[] = get_string('lastname', 'tool_simpletool');
        $data->headers = $headers;

        $data->rows = array();

        // Table rows.
        foreach ($records as $record) {
            $row = array();
            $row['username'] = $record->username;
            $row['firstname'] = $record->firstname;
            $row['lastname'] = $record->lastname;

            $data->rows[] = $row;
        }

        // Display the table.
        echo $this->output->header();
        echo $this->render_from_template('tool_simpletool/table', $data);
        echo $this->output->footer();

    }

    function display_table_collaborate_submissions($records) {
        $data = new stdClass();

        // Table headers.
        $headers = array();
        //$columns = array('collaborate', 'title', 'firstname', 'lastname', 'submission');

        /*
        $headers[] = get_string('collaborate', 'tool_simpletool');
        $headers[] = get_string('title', 'tool_simpletool');
        $headers[] = get_string('firstname', 'tool_simpletool');
        $headers[] = get_string('lastname', 'tool_simpletool');
        $headers[] = get_string('submission', 'tool_simpletool');
        */

        $baseurl = '/admin/tool/simpletool/index.php';
        /*
        foreach ($columns as $column) {
            $header = get_string($column, 'tool_simpletool');
            $url = new moodle_url($baseurl, ['sorting' => $column]);
            $headers[$column] = ['text' => $header, 'url'=> $url->out(false)];
        }
        */
        $header = get_string('collaborate', 'tool_simpletool');
        $url = new moodle_url($baseurl, ['sorting' => 'name']);
        $headers['name'] = ['text' => $header, 'url'=> $url->out(false)];

        $header = get_string('title', 'tool_simpletool');
        $url = new moodle_url($baseurl, ['sorting' => 'title']);
        $headers['title'] = ['text' => $header, 'url'=> $url->out(false)];

        $header = get_string('firstname', 'tool_simpletool');
        $url = new moodle_url($baseurl, ['sorting' => 'firstname']);
        $headers['firstname'] = ['text' => $header, 'url'=> $url->out(false)];

        $header = get_string('lastname', 'tool_simpletool');
        $url = new moodle_url($baseurl, ['sorting' => 'lastname']);
        $headers['lastname'] = ['text' => $header, 'url'=> $url->out(false)];

        $data->headers = $headers;

        $data->rows = array();

        // Table rows.
        foreach ($records as $record) {
            $row = array();
        
            $row['name'] = $record->name;
            $row['title'] = $record->title;
            $row['firstname'] = $record->firstname;
            $row['lastname'] = $record->lastname;
            $row['submission'] = $record->submission;

            $data->rows[] = $row;
        }

        // Display the table.
        echo $this->output->header();
        echo $this->render_from_template('tool_simpletool/collaboratesubmissions', $data);
        echo $this->output->footer();

    }
}