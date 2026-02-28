<style>
    .config-window {
        width: 600px;
        height: 650px;
        background-color: #1e1e1e;
        border: 1px solid #3E3E42;
        display: flex;
        flex-direction: column;
        box-shadow: 0 3px 8px rgba(0,0,0,0.5);
        color: #EFEFEF;
        font-family: sans-serif;
    }

    .config-window .title-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 7px;
        background-color: #FFFFFF;
        color: #000000;
        height: 21px;
        user-select: none;
        flex-shrink: 0;
    }

    .config-window .title { font-size: 8px; display: flex; align-items: center; gap: 6px; }
    .config-window .title-icon { width: 14px; height: 14px; }
    .config-window .controls { display: flex; height: 100%; }
    .config-window .control-btn {
        width: 21px; display: flex; justify-content: center;
        align-items: center; font-size: 10px; color: #000000;
    }

    .config-window .content { flex: 1; padding: 0; overflow-y: auto; background-color: #1e1e1e; display: flex; flex-direction: column; }

    .config-window .table-container { flex: 1; overflow-y: auto; }
    .config-window table { width: 100%; border-collapse: collapse; font-size: 9px; }
    .config-window th, .config-window td { border: 1px solid #3E3E42; padding: 1px 2px; text-align: left; }
    .config-window th { background-color: #080808; color: #EFEFEF; font-weight: normal; }
    .config-window tr { background-color: #1e1e1e; }
    .config-window td.cb-cell { text-align: center; vertical-align: middle; }
    .config-window .cb {
        display: inline-block; width: 9px; height: 9px;
        border: 1px solid #6E6E72; background-color: #1e1e1e;
        position: relative; vertical-align: middle;
        font-size: 0;
    }
    .config-window .cb.checked { background-color: #080808; border-color: #EFEFEF; }
    .config-window .cb.checked::after {
        content: '✓'; font-size: 8px; line-height: 1;
        color: #EFEFEF; position: absolute; top: -1px; left: 0px;
    }

    .config-window .settings-section {
        padding: 10px;
        border-top: 1px solid #3E3E42;
        font-size: 9px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        flex-shrink: 0;
    }

    .config-window .checkbox-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5px 15px;
    }

    .config-window .checkbox-item { display: flex; align-items: center; gap: 6px; }
    .config-window .checkbox-box {
        width: 10px; height: 10px; border: 1px solid #3E3E42; background-color: #1e1e1e;
        display: flex; justify-content: center; align-items: center; color: #0078D7; font-size: 10px;
        flex-shrink: 0;
    }
    .config-window .checkbox-box.checked::after { content: '✓'; }

    .config-window .controls-group { display: flex; align-items: center; justify-content: space-between; }
    .config-window .control-item { display: flex; align-items: center; gap: 8px; }

    .config-window .custom-dropdown {
        display: flex; align-items: stretch;
        background-color: #080808;
        height: 19px;
    }
    .config-window .custom-dropdown-text {
        flex: 1; padding: 0 5px; font-size: 9px;
        display: flex; align-items: center; color: #EFEFEF;
    }
    .config-window .custom-dropdown-arrow {
        background-color: #FFFFFF; color: #000000;
        width: 16px; display: flex; justify-content: center;
        align-items: center; font-size: 7px; flex-shrink: 0;
    }

    .config-window .num-input {
        background-color: #080808; color: #EFEFEF;
        border: 1px solid #080808; padding: 3px 5px; font-size: 9px;
        width: 40px; text-align: right; display: flex; justify-content: space-between; align-items: center;
    }
    .config-window .num-input-controls { display: flex; flex-direction: column; margin-left: 4px; }
    .config-window .num-input-btn { font-size: 7px; line-height: 7px; color: #999; cursor: pointer; }

    .config-window .footer {
        padding: 10px; background-color: #1e1e1e;
        border-top: 1px solid #3E3E42; display: flex; justify-content: space-between; align-items: flex-end;
        flex-shrink: 0;
    }

    .config-window .footer-left { display: flex; flex-direction: column; gap: 8px; }
    .config-window .footer-right { display: flex; flex-direction: column; gap: 8px; align-items: flex-end; }

    .config-window .examples-link { color: #EFEFEF; font-size: 9px; text-decoration: underline; }

    .config-window .file-picker { display: flex; align-items: center; gap: 8px; font-size: 9px; }

    .config-window .button {
        background-color: #080808; color: #EFEFEF; border: none;
        padding: 7px 8px; font-size: 9px; text-align: center; text-transform: uppercase; cursor: pointer;
        display: flex; justify-content: center; align-items: center;
    }
    .config-window .button.save { background-color: #000000; padding: 7px 15px; }

    .config-window .item-dropdown-group { display: flex; align-items: center; gap: 2px; }
    .config-window .trash-icon {
        background-color: #080808; color: #EFEFEF; border: none;
        padding: 3px 5px; font-size: 11px; height: 19px;
        display: flex; align-items: center; justify-content: center;
    }
</style>

<div class="config-window">
    <div class="title-bar">
        <div class="title">
            <svg class="title-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34 34">
                <path fill="#000" transform="translate(3 0)" d="M 25.875 0.0625 C 7.531 0.0625 8.78125 11.4375 8.78125 11.4375 C 8.2290994 12.246696 7.6995693 13.046426 7.25 13.84375 C 7.2192731 13.898245 7.1865288 13.94563 7.15625 14 L 4 14 A 1.0001 1.0001 0 0 0 3.90625 14 A 1.001098 1.001098 0 0 0 3.5 15.90625 L 3 16 C 1.343 16 0 17.344 0 19 L 0 23 C 0 24.656 1.343 26 3 26 L 13 26 C 14.657 26 16 24.656 16 23 L 16 19 C 16 17.344 14.657 16 13 16 L 12.46875 15.875 A 1.0001 1.0001 0 0 0 12 14 L 8.78125 14 C 9.3768313 12.98664 10.046844 11.978044 10.8125 10.96875 C 10.850157 10.925536 10.924518 10.804345 10.96875 10.75 C 11.312321 10.305889 11.682667 9.871631 12.0625 9.4375 C 12.206935 9.262417 12.364614 9.0972071 12.53125 8.90625 C 14.065329 7.2428175 15.90652 5.6997788 18.0625 4.40625 C 16.2125 6.10525 13.15425 9.5635 11.65625 12.1875 C 14.10025 12.4015 17.5465 11.016 19.9375 9 C 19.3975 8.939 16.875 8.48475 16.125 7.84375 C 17.563 7.95975 19.95325 7.97425 20.90625 7.90625 C 22.84525 6.47025 25.063 3.0785 25.875 0.0625 z"/>
            </svg>
            Inkybot - Config
        </div>
        <div class="controls">
            <div class="control-btn">_</div>
            <div class="control-btn close">✕</div>
        </div>
    </div>
    <div class="content">
        <div style="padding: 5px; font-size: 9px; border-bottom: 1px solid #3E3E42;">Change to PA tra rune when Trap Damage reaches 14</div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Stat</th>
                        <th class="cb-cell" data-hl="cf-use-runes"  data-hl-col="2">Use SM Runes</th>
                        <th class="cb-cell" data-hl="cf-use-runes"  data-hl-col="3">Use PA Runes</th>
                        <th class="cb-cell" data-hl="cf-use-runes"  data-hl-col="4">Use RA Runes</th>
                        <th data-hl="cf-threshold" data-hl-col="5">PA Rune Threshold</th>
                        <th data-hl="cf-threshold" data-hl-col="6">RA Rune Threshold</th>
                        <th data-hl="cf-max-rune"  data-hl-col="7">Max (SM Rune)</th>
                        <th data-hl="cf-max-rune"  data-hl-col="8">Max (PA Rune)</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Primary stats --}}
                    <tr><td>{{ __('stats.ap') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.mp') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.range') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.vitality') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>90</td><td>310</td><td>115</td><td>315</td></tr>
                    <tr><td>{{ __('stats.strength') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>55</td><td>21</td><td>62</td></tr>
                    <tr><td>{{ __('stats.intelligence') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>55</td><td>21</td><td>62</td></tr>
                    <tr><td>{{ __('stats.agility') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>55</td><td>21</td><td>62</td></tr>
                    <tr><td>{{ __('stats.chance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>55</td><td>21</td><td>62</td></tr>
                    <tr><td>{{ __('stats.wisdom') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>40</td><td>19</td><td>45</td></tr>
                    <tr><td>{{ __('stats.power') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>50</td><td>21</td><td>54</td></tr>
                    <tr><td>{{ __('stats.power_traps') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>50</td><td>21</td><td>54</td></tr>
                    <tr><td>{{ __('stats.critical') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.initiative') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>170</td><td>470</td><td>210</td><td>570</td></tr>
                    <tr><td>{{ __('stats.pods') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>90</td><td>470</td><td>110</td><td>570</td></tr>
                    <tr><td>{{ __('stats.summons') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    {{-- Secondary combat stats --}}
                    <tr><td>{{ __('stats.heals') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>15</td><td>-</td><td>19</td><td>-</td></tr>
                    <tr><td>{{ __('stats.prospecting') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>17</td><td>-</td><td>19</td><td>-</td></tr>
                    <tr><td>{{ __('stats.lock') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>19</td><td>-</td></tr>
                    <tr><td>{{ __('stats.dodge') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>19</td><td>-</td></tr>
                    <tr><td>{{ __('stats.ap_reduction') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>12</td><td>-</td><td>15</td><td>-</td></tr>
                    <tr><td>{{ __('stats.ap_parry') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>12</td><td>-</td><td>15</td><td>-</td></tr>
                    <tr><td>{{ __('stats.mp_reduction') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>12</td><td>-</td><td>15</td><td>-</td></tr>
                    <tr><td>{{ __('stats.mp_parry') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>12</td><td>-</td><td>15</td><td>-</td></tr>
                    {{-- Damage stats --}}
                    <tr><td>{{ __('stats.damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.neutral_damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.earth_damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.fire_damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.water_damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.air_damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.critical_damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.pushback_damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.trap_damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.spell_damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.weapon_damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.ranged_damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.melee_damage') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    {{-- Resistance stats --}}
                    <tr><td>{{ __('stats.neutral_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.per_neutral_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.earth_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.per_earth_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.fire_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.per_fire_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.water_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.per_water_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.air_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.per_air_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.critical_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.pushback_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.ranged_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.melee_resistance') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    {{-- Other --}}
                    <tr><td>{{ __('stats.hunting_weapon') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.reflect') }}</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                </tbody>
            </table>
        </div>
        <div class="settings-section">
            <div class="checkbox-group">
                <div class="checkbox-item"><div class="checkbox-box checked"></div>Restore high sink stats immediately (AP, MP, Range, Summons)</div>
                <div class="checkbox-item"><div class="checkbox-box checked"></div>Publish exo mages to Hall of fame</div>
                <div class="checkbox-item"><div class="checkbox-box checked"></div>Automatically start new statistics session on successful exo</div>
                <div class="checkbox-item"><div class="checkbox-box checked"></div>Show helpful tips and warnings</div>
                <div class="checkbox-item"><div class="checkbox-box checked"></div>Track average Kamas spent</div>
                <div class="checkbox-item"><div class="checkbox-box"></div>Mage Queueing Safe Mode</div>
            </div>
            <div class="controls-group">
                <div class="control-item">
                    Automatic shutdown when bot stops
                    <div class="custom-dropdown" style="width: 70px;">
                        <div class="custom-dropdown-text">Disabled</div>
                        <div class="custom-dropdown-arrow">▼</div>
                    </div>
                </div>
                <div class="control-item">
                    Custom OCR Image Resize Ratio<br>(leave at "1" unless stats aren't recognized correctly)
                    <div class="num-input">
                        1.00
                        <div class="num-input-controls">
                            <div class="num-input-btn">▲</div>
                            <div class="num-input-btn">▼</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-left">
            <a href="#" class="examples-link">See examples</a>
            <div class="file-picker" data-hl="cf-script">
                Custom Maging Script
                <div class="button">Choose File</div>
            </div>
        </div>
        <div class="footer-right" data-hl="cf-presets">
            <div class="item-dropdown-group">
                <div class="custom-dropdown" style="width: 150px;">
                    <div class="custom-dropdown-text">Levitrof Wedding Ring</div>
                    <div class="custom-dropdown-arrow">▼</div>
                </div>
                <div class="custom-dropdown" style="width: 20px;">
                    <div class="custom-dropdown-arrow">▼</div>
                </div>
                <div class="trash-icon">🗑️</div>
            </div>
            <div class="button save">SAVE AS PRESET</div>
        </div>
    </div>
</div>
