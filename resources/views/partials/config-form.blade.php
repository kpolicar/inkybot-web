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

    .config-window .dropdown {
        background-color: #080808; color: #EFEFEF;
        border: 1px solid #080808; padding: 3px; font-size: 9px;
        display: flex; justify-content: space-between; align-items: center;
    }
    .config-window .dropdown::after { content: '▾'; font-size: 8px; color: #999; margin-left: 4px; }

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
            <svg class="title-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#000" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
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
                        <th class="cb-cell">Use SM Runes</th>
                        <th class="cb-cell">Use PA Runes</th>
                        <th class="cb-cell">Use RA Runes</th>
                        <th>PA Rune Threshold</th>
                        <th>RA Rune Threshold</th>
                        <th>Max (SM Rune)</th>
                        <th>Max (PA Rune)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Initiative</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>170</td><td>470</td><td>210</td><td>570</td></tr>
                    <tr><td>Vitality</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>90</td><td>310</td><td>115</td><td>315</td></tr>
                    <tr><td>Pods</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>90</td><td>470</td><td>110</td><td>570</td></tr>
                    <tr><td>Strength</td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>55</td><td>21</td><td>62</td></tr>
                    <tr><td>Intelligence</td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>55</td><td>21</td><td>62</td></tr>
                    <tr><td>Agility</td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>55</td><td>21</td><td>62</td></tr>
                    <tr><td>Chance</td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>55</td><td>21</td><td>62</td></tr>
                    <tr><td>Critical Resis...</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>Pushback Re...</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>Power</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>50</td><td>21</td><td>54</td></tr>
                    <tr><td>Power (traps)</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>50</td><td>21</td><td>54</td></tr>
                    <tr><td>Neutral Resis...</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>Earth Resista...</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>Fire Resistance</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>Air Resistance</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>Water Resist...</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
                    <tr><td>Wisdom</td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td>17</td><td>40</td><td>19</td><td>45</td></tr>
                    <tr><td>Prospecting</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>17</td><td>-</td><td>19</td><td>-</td></tr>
                    <tr><td>Lock</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>19</td><td>-</td></tr>
                    <tr><td>Dodge</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>19</td><td>-</td></tr>
                    <tr><td>Neutral Dam...</td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb checked"></div></td><td class="cb-cell"><div class="cb"></div></td><td>14</td><td>-</td><td>17</td><td>-</td></tr>
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
                    <div class="dropdown" style="width: 70px;">Disabled</div>
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
            <div class="file-picker">
                Custom Maging Script
                <div class="button">Choose File</div>
            </div>
        </div>
        <div class="footer-right">
            <div class="item-dropdown-group">
                <div class="dropdown" style="width: 150px;">Levitrof Wedding Ring</div>
                <div class="dropdown" style="width: 20px;"></div>
                <div class="trash-icon">🗑️</div>
            </div>
            <div class="button save">SAVE AS PRESET</div>
        </div>
    </div>
</div>
