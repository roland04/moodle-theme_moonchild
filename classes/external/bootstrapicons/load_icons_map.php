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

namespace theme_moonchild\external\bootstrapicons;

use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_multiple_structure;
use core_external\external_single_structure;
use core_external\external_value;
use theme_config;
use theme_moonchild\output\icon_system_bootstrap;

/**
 * Web service to load Bootstrap icon maps.
 *
 * @package    theme_moonchild
 * @category   external
 * @copyright  2025 Mikel Martín <mikel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class load_icons_map extends external_api {

    /**
     * Description of the parameters suitable for the `execute` function.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters() {
        return new external_function_parameters([
            'themename' => new external_value(PARAM_ALPHANUMEXT, 'The theme to fetch the map for'),
        ]);
    }

    /**
     * Return a mapping of icon names to icons.
     *
     * @param   string $themename The theme to fetch icons for
     * @return  array the mapping
     */
    public static function execute(string $themename) {
        [
            'themename' => $themename,
        ] = self::validate_parameters(self::execute_parameters(), [
            'themename' => $themename,
        ]);

        $theme = theme_config::load($themename);
        $instance = icon_system_bootstrap::instance($theme->get_icon_system());

        $result = [];
        foreach ($instance->get_icon_name_map() as $from => $to) {
            [$component, $pix] = explode(':', $from);
            $result[] = [
                'component' => $component,
                'pix' => $pix,
                'to' => $to,
            ];
        }

        return $result;
    }

    /**
     * Description of the return value for the `execute` function.
     *
     * @return \core_external\external_description
     */
    public static function execute_returns() {
        return new external_multiple_structure(new external_single_structure([
            'component' => new external_value(PARAM_COMPONENT, 'The component for the icon.'),
            'pix' => new external_value(PARAM_RAW, 'Value to map the icon from.'),
            'to' => new external_value(PARAM_RAW, 'Value to map the icon to.'),
        ]));
    }
}
