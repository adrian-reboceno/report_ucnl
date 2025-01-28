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
 * Version metadata for the report_ucnl plugin.
 *
 * @package   report_ucnl
 * @copyright 2024, Universindad Ciudadana de Nuevo leon {@link http://www.ucnl.edu.mx/}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author    Adrian Francisco Lozada Reboceño <adrian.lozada@ucnl.edu.mx>
 */

defined('MOODLE_INTERNAL') || die();


$ADMIN->add('reports', new admin_category('ucnlfolder', get_string('pluginname', 'report_ucnl')));
$ADMIN->add('ucnlfolder', new admin_externalpage(
    'reportucnl',
    get_string('configucnl', 'report_ucnl'),
    new moodle_url($CFG->wwwroot . '/report/ucnl/index.php'),
    'report/ucnl:view'
));
$ADMIN->add('ucnlfolder', new admin_externalpage(
    'reportucnl',
    get_string('studentsession', 'report_ucnl'),
    new moodle_url($CFG->wwwroot . '/report/studentsession/index.php'),
    'report/ucnl:view'
));
$ADMIN->add('ucnlfolder', new admin_externalpage(
    'reportucnl',
    get_string('teachersession', 'report_ucnl'),
    new moodle_url($CFG->wwwroot . '/report/teachersession/index.php'),
    'report/ucnl:view'
));
$ADMIN->add('ucnlfolder', new admin_externalpage(
    'reportucnl',
    get_string('moduleassignment', 'report_ucnl'),
    new moodle_url($CFG->wwwroot . '/report/moduleassignment/index.php'),
    'report/ucnl:view'
));

$category = 'ucnl';
if (!$ADMIN->locate($category)) {
    $ADMIN->add('root', new admin_category($category, ' UCNL'));
}
$ucnlstudent= 'ucnl_student';
if (!$ADMIN->locate($ucnlstudent)) {
    $ADMIN->add($category, new admin_category($ucnlstudent, get_string('student', 'report_ucnl')));
}

$ucnlteacher= 'ucnl_teacher';
if (!$ADMIN->locate($ucnlteacher)) {
    $ADMIN->add($category, new admin_category($ucnlteacher, get_string('teacher', 'report_ucnl')));
}

$ucnlcourse= 'ucnl_course';
if (!$ADMIN->locate($ucnlcourse)) {
    $ADMIN->add($category, new admin_category($ucnlcourse, get_string('course', 'report_ucnl')));
}


if ($hassiteconfig) {
    $ADMIN->add($category, new admin_externalpage(
        'report_ucnl/dashboard',
        get_string('dashboard', 'report_ucnl'),
        new moodle_url('/report/ucnl/index.php')
    ));   
    $ADMIN->add($ucnlstudent, new admin_externalpage(
        'report_ucnl/studentsession',
        get_string('studentsession', 'report_ucnl'),
        new moodle_url('/report/studentsession/index.php')
    ));
    $ADMIN->add($ucnlteacher, new admin_externalpage(
        'report_ucnl/teachersession',
        get_string('teachersession', 'report_ucnl'),
        new moodle_url('/report/teachersession/index.php')
    ));
    $ADMIN->add($ucnlcourse, new admin_externalpage(
        'report_ucnl/moduleassignment',
        get_string('moduleassignment', 'report_ucnl'),
        new moodle_url('/report/moduleassignment/index.php')
    ));
}
if ($ADMIN->fulltree) {
    $config = get_config('report_ucnl');

    $settings->add(new admin_setting_heading('report_ucnl_addheading_daysmaximum',
    get_string('daysmaximum', 'report_ucnl'), ''));

    $name = 'report_ucnl/daysinactivitystudents';
    $title = get_string('daysinactivitystudents', 'report_ucnl');
    $description = get_string('daysinactivitystudents_desc', 'report_ucnl');
    $settings->add(new admin_setting_configtext($name, $title,$description , 7, PARAM_INT));

    $name = 'report_ucnl/daysinactivityteachers';
    $title = get_string('daysinactivityteachers', 'report_ucnl');
    $description = get_string('daysinactivityteachers_desc', 'report_ucnl');
    $settings->add(new admin_setting_configtext($name, $title,$description , 7, PARAM_INT));

    $settings->add(new admin_setting_heading('report_ucnl_addheading_academiclevel',
    get_string('academicdegree', 'report_ucnl'), ''));

    $name = 'report_ucnl/academicdegree';
    $title = get_string('academicdegree', 'report_ucnl');
    $description = get_string('academiclevel_desc', 'report_ucnl');
    $academicdegree = [ '1' => get_string('bachillerato', 'report_ucnl'), '2' => get_string('licenciatura', 'report_ucnl'), '3' => get_string('maestria', 'report_ucnl')];
    $settings->add( new admin_setting_configselect($name, $title, $description, '1', $academicdegree));


    $settings->add(new admin_setting_heading('report_ucnl_addheading_colortrafficlinght',
    get_string('colorscale', 'report_ucnl'), ''));

    $name = 'report_ucnl/notqualified';
    $title = get_string('notqualified', 'report_ucnl');
    $description = get_string('notqualified_desc', 'report_ucnl');
    $settings->add( new admin_setting_configcolourpicker($name, $title, $description, '#ec7063'));

    $name = 'report_ucnl/mediumqualified';
    $title = get_string('mediumqualified', 'report_ucnl');
    $description = get_string('mediumqualified_desc', 'report_ucnl');
    $settings->add( new admin_setting_configcolourpicker($name, $title, $description, '#FFC300'));


    $name = 'report_ucnl/qualified';
    $title = get_string('qualified', 'report_ucnl');
    $description = get_string('qualified_desc', 'report_ucnl');
    $settings->add( new admin_setting_configcolourpicker($name, $title, $description, '#239b56'));
}
//$page->add($setting);
