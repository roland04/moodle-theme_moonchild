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
 * The configuration for Moonchild theme is defined here.
 *
 * For full list of the configurable properties refer to {@see theme_config::__construct()} function
 *
 * Documentation: {@link https://docs.moodle.org/dev/Themes}
 *
 * @package    theme_moonchild
 * @copyright  2025 Mikel Martín <mikel@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$THEME->name = 'moonchild';

$THEME->parents = ['boost'];
$THEME->sheets = [];
$THEME->editor_sheets = [];
$THEME->usefallback = true;
$THEME->enable_dock = false;
$THEME->yuicssmodules = [];
$THEME->scss = function($theme) {
    return theme_moonchild_get_main_scss_content($theme);
};
$THEME->extrascsscallback = 'theme_moonchild_get_extra_scss';
$THEME->prescsscallback = 'theme_moonchild_get_pre_scss';
$THEME->precompiledcsscallback = 'theme_moonchild_get_precompiled_css';
$THEME->rendererfactory = theme_overridden_renderer_factory::class;
$THEME->requiredblocks = '';
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
$THEME->usescourseindex = true;
$THEME->iconsystem = \core\output\icon_system::FONTAWESOME;
$THEME->haseditswitch = true;
$THEME->removedprimarynavitems = ['home'];
$THEME->activityheaderconfig = [
    'notitle' => true,
];
