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
 * Unit tests for the quizaccess_timelimit plugin.
 *
 * @package    quizaccess
 * @subpackage timelimit
 * @copyright  2008 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/mod/quiz/accessrule/timelimit/rule.php');


/**
 * Unit tests for the quizaccess_timelimit plugin.
 *
 * @copyright  2008 The Open University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class quizaccess_timelimit_testcase extends basic_testcase {
    public function test_time_limit_access_rule() {
        $quiz = new stdClass();
        $quiz->timelimit = 3600;
        $quiz->questions = '';
        $cm = new stdClass();
        $cm->id = 0;
        $quizobj = new quiz($quiz, $cm, null);
        $rule = new quizaccess_timelimit($quizobj, 10000);
        $attempt = new stdClass();

        $this->assertEquals($rule->description(),
            get_string('quiztimelimit', 'quizaccess_timelimit', format_time(3600)));

        $attempt->timestart = 10000;
        $attempt->preview = 0;
        $this->assertEquals($rule->end_time($attempt), 13600);
        $this->assertEquals($rule->time_left_display($attempt, 10000), 3600);
        $this->assertEquals($rule->time_left_display($attempt, 12000), 1600);
        $this->assertEquals($rule->time_left_display($attempt, 14000), -400);

        $this->assertFalse($rule->prevent_access());
        $this->assertFalse($rule->prevent_new_attempt(0, $attempt));
        $this->assertFalse($rule->is_finished(0, $attempt));
    }
}
