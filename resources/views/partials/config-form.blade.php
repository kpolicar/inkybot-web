<div class="config-window">
    <div class="title-bar">
        <div class="title">
            <svg class="title-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34 34">
                <path fill="#000" transform="translate(3 0)" d="M 25.875 0.0625 C 7.531 0.0625 8.78125 11.4375 8.78125 11.4375 C 8.2290994 12.246696 7.6995693 13.046426 7.25 13.84375 C 7.2192731 13.898245 7.1865288 13.94563 7.15625 14 L 4 14 A 1.0001 1.0001 0 0 0 3.90625 14 A 1.001098 1.001098 0 0 0 3.5 15.90625 L 3 16 C 1.343 16 0 17.344 0 19 L 0 23 C 0 24.656 1.343 26 3 26 L 13 26 C 14.657 26 16 24.656 16 23 L 16 19 C 16 17.344 14.657 16 13 16 L 12.46875 15.875 A 1.0001 1.0001 0 0 0 12 14 L 8.78125 14 C 9.3768313 12.98664 10.046844 11.978044 10.8125 10.96875 C 10.850157 10.925536 10.924518 10.804345 10.96875 10.75 C 11.312321 10.305889 11.682667 9.871631 12.0625 9.4375 C 12.206935 9.262417 12.364614 9.0972071 12.53125 8.90625 C 14.065329 7.2428175 15.90652 5.6997788 18.0625 4.40625 C 16.2125 6.10525 13.15425 9.5635 11.65625 12.1875 C 14.10025 12.4015 17.5465 11.016 19.9375 9 C 19.3975 8.939 16.875 8.48475 16.125 7.84375 C 17.563 7.95975 19.95325 7.97425 20.90625 7.90625 C 22.84525 6.47025 25.063 3.0785 25.875 0.0625 z"/>
            </svg>
            {{ __('winforms.config_title') }}
        </div>
        <div class="controls">
            <div class="control-btn">_</div>
            <div class="control-btn close">✕</div>
        </div>
    </div>
    <div class="content">
        <div class="hint-bar">Change to PA tra rune when Trap Damage reaches 14</div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>{{ __('winforms.config_stat_col') }}</th>
                        <th class="cb-cell" data-hl="cf-use-runes" data-hl-col="2">{{ __('winforms.config_use_sm_runes') }}</th>
                        <th class="cb-cell" data-hl="cf-use-runes" data-hl-col="3">{{ __('winforms.config_use_pa_runes') }}</th>
                        <th class="cb-cell" data-hl="cf-use-runes" data-hl-col="4">{{ __('winforms.config_use_ra_runes') }}</th>
                        <th data-hl="cf-threshold" data-hl-col="5">{{ __('winforms.config_pa_threshold') }}</th>
                        <th data-hl="cf-threshold" data-hl-col="6">{{ __('winforms.config_ra_threshold') }}</th>
                        <th data-hl="cf-max-rune"  data-hl-col="7">{{ __('winforms.config_max_sm_rune') }}</th>
                        <th data-hl="cf-max-rune"  data-hl-col="8">{{ __('winforms.config_max_pa_rune') }}</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Primary stats --}}
                    <tr><td>{{ __('stats.ap') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.mp') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.range') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.vitality') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="non-default">70</td><td>310</td><td>115</td><td class="non-default">290</td></tr>
                    <tr><td>{{ __('stats.strength') }}</td><td class="cb-cell non-default"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td>17</td><td>55</td><td>21</td><td>62</td></tr>
                    <tr><td>{{ __('stats.intelligence') }}</td><td class="cb-cell non-default"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td>17</td><td>55</td><td>21</td><td>62</td></tr>
                    <tr><td>{{ __('stats.agility') }}</td><td class="cb-cell non-default"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td>17</td><td>55</td><td>21</td><td>62</td></tr>
                    <tr><td>{{ __('stats.chance') }}</td><td class="cb-cell non-default"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td>17</td><td>55</td><td>21</td><td>62</td></tr>
                    <tr><td>{{ __('stats.wisdom') }}</td><td class="cb-cell non-default"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td>17</td><td>40</td><td>19</td><td>45</td></tr>
                    <tr><td>{{ __('stats.power') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td>17</td><td>50</td><td>21</td><td>54</td></tr>
                    <tr><td>{{ __('stats.power_traps') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td>17</td><td>50</td><td>21</td><td>54</td></tr>
                    <tr><td>{{ __('stats.critical') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.initiative') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td>170</td><td class="non-default">100</td><td>210</td><td>570</td></tr>
                    <tr><td>{{ __('stats.pods') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td>90</td><td>470</td><td>110</td><td>570</td></tr>
                    <tr><td>{{ __('stats.summons') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    {{-- Secondary combat stats --}}
                    <tr><td>{{ __('stats.heals') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>15</td><td>-</td><td>19</td><td>-</td></tr>
                    <tr><td>{{ __('stats.prospecting') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>17</td><td>-</td><td>19</td><td>-</td></tr>
                    <tr><td>{{ __('stats.lock') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>19</td><td>-</td></tr>
                    <tr><td>{{ __('stats.dodge') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>19</td><td>-</td></tr>
                    <tr><td>{{ __('stats.ap_reduction') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>12</td><td>-</td><td>15</td><td>-</td></tr>
                    <tr><td>{{ __('stats.ap_parry') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>12</td><td>-</td><td>15</td><td>-</td></tr>
                    <tr><td>{{ __('stats.mp_reduction') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>12</td><td>-</td><td>15</td><td>-</td></tr>
                    <tr><td>{{ __('stats.mp_parry') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>12</td><td>-</td><td>15</td><td>-</td></tr>
                    {{-- Damage stats --}}
                    <tr><td>{{ __('stats.damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.neutral_damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.earth_damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.fire_damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.water_damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.air_damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.critical_damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.pushback_damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.trap_damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.spell_damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.weapon_damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.ranged_damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.melee_damage') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    {{-- Resistance stats --}}
                    <tr><td>{{ __('stats.neutral_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.per_neutral_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.earth_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.per_earth_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.fire_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.per_fire_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.water_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.per_water_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.air_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.per_air_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.critical_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.pushback_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>{{ __('stats.ranged_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.melee_resistance') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    {{-- Other --}}
                    <tr><td>{{ __('stats.hunting_weapon') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                    <tr><td>{{ __('stats.reflect') }}</td><td class="cb-cell"><input type="checkbox" disabled checked></td><td class="cb-cell"><input type="checkbox" disabled></td><td class="cb-cell"><input type="checkbox" disabled></td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
                </tbody>
            </table>
        </div>
        <div class="settings-section">
            <div class="checkbox-group">
                <div class="checkbox-item"><input type="checkbox" disabled checked>{{ __('winforms.config_restore_high_sink') }}</div>
                <div class="checkbox-item"><input type="checkbox" disabled checked>{{ __('winforms.config_publish_exos') }}</div>
                <div class="checkbox-item"><input type="checkbox" disabled checked>{{ __('winforms.config_auto_new_session') }}</div>
                <div class="checkbox-item"><input type="checkbox" disabled checked>{{ __('winforms.config_show_tips') }}</div>
                <div class="checkbox-item"><input type="checkbox" disabled checked>{{ __('winforms.config_track_kamas') }}</div>
                <div class="checkbox-item"><input type="checkbox" disabled>{{ __('winforms.config_safe_mode') }}</div>
            </div>
            <div class="controls-group">
                <div class="control-item">
                    {{ __('winforms.config_auto_shutdown') }}
                    <div class="custom-dropdown" style="width: 70px;">
                        <div class="custom-dropdown-text">{{ __('winforms.config_disabled') }}</div>
                        <div class="custom-dropdown-arrow">▼</div>
                    </div>
                </div>
                <div class="control-item">
                    {{ __('winforms.config_ocr_ratio') }}<br>{{ __('winforms.config_ocr_ratio_hint') }}
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
            <span href="#" class="examples-link">{{ __('winforms.config_see_examples') }}</a>
            <div class="file-picker" data-hl="cf-script">
                {{ __('winforms.config_custom_script') }}
                <div class="button">{{ __('winforms.config_choose_file') }}</div>
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
            <div class="button save">{{ __('winforms.config_save_preset') }}</div>
        </div>
    </div>
</div>
