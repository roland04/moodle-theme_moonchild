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
 * Callback implementations for Moonchild theme
 *
 * Documentation: {@link https://docs.moodle.org/dev/Themes}
 *
 * @package    theme_moonchild
 * @copyright  2025 Mikel Martín <mikel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_moonchild_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';

    // Load Moonchild SCSS variables (to override  LMS variables).
    $scss .= file_get_contents($CFG->dirroot . '/theme/moonchild/scss/variables.scss');
    // Load theme boost default preset scss.
    $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    // Load Moonchild main SCSS.
    $scss .= file_get_contents($CFG->dirroot . '/theme/moonchild/scss/main.scss');


    return $scss;
}

/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_moonchild_get_extra_scss($theme) {
    return !empty($theme->settings->scss) ? $theme->settings->scss : '';
}

/**
 * Get SCSS to prepend.
 *
 * @param theme_config $theme The theme config object.
 * @return array
 */
function theme_moonchild_get_pre_scss($theme) {
    return !empty($theme->settings->scsspre) ? $theme->settings->scsspre : '';
}

/**
 * Get compiled CSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string compiled CSS
 */
function theme_moonchild_get_precompiled_css($theme) {
    global $CFG;
    // By default fallback to Boost CSS.
    return file_get_contents($CFG->dirroot . '/theme/boost/style/moodle.css');
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_moonchild_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM && $filearea === 'loginbackgroundimage') {
        $theme = theme_config::load('moonchild');
        // By default, theme files must be cache-able by both browsers and proxies.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
        return false;
    }
}
