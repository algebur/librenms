<?php
/**
 * powerwalker.inc.php
 *
 * LibreNMS current sensor discovery module for PowerWalker
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    LibreNMS
 * @link       http://librenms.org
 * @copyright  2017 Neil Lathwood
 * @author     Neil Lathwood <neil@lathwood.co.uk>
 */

if ($device['os'] === 'powerwalker') {
    echo("PowerWalker ");

    $descr = 'Battery Current';
    $oid = '.1.3.6.1.2.1.33.1.2.6.0';
    $value = snmp_get($device, 'upsBatteryCurrent.0', '-Oqv', 'UPS-MIB');
    $value = preg_replace('/\D/', '', $value);

    if (is_numeric($value) && $value > 0) {
        discover_sensor($valid['sensor'], 'current', $device, $oid, 1, 'powerwalker', $descr, '1', '1', null, null, null, null, $value);
    }

    if (is_numeric($pre_cache['powerwalker']['upsInputCurrent'][1])) {
        $descr = 'Input Voltage';
        $oid = '.1.3.6.1.2.1.33.1.3.3.1.4.1.0';
        discover_sensor($valid['sensor'], 'current', $device, $oid, 2, 'powerwalker', $descr, '1', '1', null, null, null, null, $value);
    }

    if (is_numeric($pre_cache['powerwalker']['upsOutputCurrent'][1])) {
        $descr = 'Output Voltage';
        $oid = '.1.3.6.1.2.1.33.1.4.4.1.3.1.0';
        discover_sensor($valid['sensor'], 'current', $device, $oid, 3, 'powerwalker', $descr, '1', '1', null, null, null, null, $value);
    }
}
