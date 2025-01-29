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
namespace report_ucnl;

class helper {
    public static function get_categories() {
        global $DB;
        $sql = "SELECT id, name FROM {course_categories} WHERE parent = 0";
        $categories = $DB->get_records_sql($sql);
        $category = [];
        foreach ($categories as $key => $value) {
            $category[$key] = $value->name;
        }
        return $category;
    }
    public static function get_subcategory($categoryid) {
        global $DB;
        $sql = "SELECT id, name FROM {course_categories} WHERE parent = :categoryid";
        $params = array('categoryid' => $categoryid);
        $subcategories = $DB->get_records_sql($sql, $params);
        $data[0] = 'Todos';
        foreach ($subcategories as $subcategory) {
            $data[$subcategory->id] = $subcategory->name;
        }
        return $data;
    }   
    public static function get_course($category) {
        global $DB;
        $sql = "SELECT id, fullname FROM {course} WHERE category = :category";
        $params = array('category' => $category);
        $courses = $DB->get_records_sql($sql, $params);
        $data[0] = 'Todos';
        foreach ($courses as $course) {
            $data[$course->id] = $course->fullname;
        }
        return $data;
    }
    public static function get_group($id) {
        global $DB;
        $sql = "SELECT id, name FROM {groups} WHERE courseid = ?";
        $categories = $DB->get_records_sql($sql, [$id]);
        $category = [];
        foreach ($categories as $key => $value) {
            $category[$key] = $value->name;
        }
        return $category;
    }
    public static function get_user($courseid, $role) {
        global $DB;
        switch ($role) {
            case 'student':
                $roleid = 5;
                break;
            case 'teacher':
                $roleid = '3,4';
                break;
            default:
                $roleid = 5;
                break;
        }
        $sql = "SELECT u.id, u.firstname, u.lastname FROM {user} u
            JOIN {role_assignments} ra ON ra.userid = u.id
            JOIN {context} c ON c.id = ra.contextid
            JOIN {course} co ON co.id = c.instanceid
            WHERE co.id = :courseid AND ra.roleid IN ({$roleid})";
        $params = array('courseid' => $courseid);       
        $users = $DB->get_records_sql($sql, $params);
        $data[0] = 'Todos';
        foreach ($users as $user) {
            $data[$user->id] = $user->firstname . ' ' . $user->lastname;
        }
        return $data;
    }
}