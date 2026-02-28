<style>
    .setup-window {
        width: calc(420px * var(--sw-scale, 1));
        height: calc(420px * var(--sw-scale, 1));
        background-color: #1e1e1e;
        border: 1px solid #3E3E42;
        display: flex;
        flex-direction: column;
        box-shadow: 0 3px 8px rgba(0,0,0,0.5);
        color: #EFEFEF;
        position: relative;
        z-index: 2;
        overflow-x: hidden;
    }

    .setup-window .title-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 7px;
        background-color: #FFFFFF;
        color: #000000;
        height: calc(21px * var(--sw-scale, 1));
        user-select: none;
        flex-shrink: 0;
    }

    .setup-window .title { font-size: calc(8px * var(--sw-scale, 1)); display: flex; align-items: center; gap: 6px; }
    .setup-window .title-icon { width: calc(14px * var(--sw-scale, 1)); height: calc(14px * var(--sw-scale, 1)); margin-top: calc(2px * var(--sw-scale, 1)); }
    .setup-window .controls { display: flex; height: 100%; }

    .setup-window .control-btn {
        width: calc(21px * var(--sw-scale, 1)); display: flex; justify-content: center;
        align-items: center; font-size: calc(10px * var(--sw-scale, 1)); color: #000000;
    }

    .setup-window .content { flex: 1; padding: 0; overflow-y: auto; overflow-x: hidden; background-color: #1e1e1e; }

    .setup-window table { width: 100%; border-collapse: collapse; font-size: calc(9px * var(--sw-scale, 1)); }
    .setup-window th, .setup-window td { border: 1px solid #3E3E42; padding: calc(1px * var(--sw-scale, 1)) calc(2px * var(--sw-scale, 1)); text-align: left; }
    .setup-window th { background-color: #080808; color: #EFEFEF; font-weight: normal; }
    .setup-window tr { background-color: #1e1e1e; }
    .setup-window tr.last-row { background-color: #141414; font-weight: bold; }

    .setup-window th.icon-cell, .setup-window td.icon-cell {
        text-align: center;
        width: calc(10px * var(--sw-scale, 1));
        min-width: calc(10px * var(--sw-scale, 1));
        max-width: calc(10px * var(--sw-scale, 1));
        padding: calc(1px * var(--sw-scale, 1));
        color: #EFEFEF; border-top: none; border-bottom: none;
    }
    .setup-window th.icon-cell { background-color: #080808; }
    .setup-window td.icon-cell { background-color: #1e1e1e; }
    .setup-window tbody tr:first-child td.icon-cell { background-color: #080808; }
    .setup-window .refresh-icon { font-size: calc(10px * var(--sw-scale, 1)); }

    .setup-window .footer {
        padding: calc(10px * var(--sw-scale, 1)) 0px 0px 0px; background-color: #1e1e1e;
        border-top: 1px solid #3E3E42; display: flex; flex-direction: column;
        gap: calc(8px * var(--sw-scale, 1));
        flex-shrink: 0;
    }

    .setup-window .footer .button {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .setup-window .footer-top { display: flex; justify-content: space-between; align-items: center; }
    .setup-window .examples-link { color: #EFEFEF; font-size: calc(9px * var(--sw-scale, 1)); text-decoration: underline; margin: 0 calc(3px * var(--sw-scale, 1)); }
    .setup-window .footer-middle { display: flex; justify-content: space-between; align-items: center; }

    .setup-window .dropdown {
        background-color: #080808; color: #EFEFEF;
        border: 1px solid #080808; padding: calc(3px * var(--sw-scale, 1)); font-size: calc(9px * var(--sw-scale, 1)); outline: none;
        display: flex; justify-content: space-between; align-items: center;
    }
    .setup-window .dropdown::after {
        content: '▾'; font-size: calc(8px * var(--sw-scale, 1)); color: #999; margin-left: calc(4px * var(--sw-scale, 1));
    }
    .setup-window .trash-icon {
        background-color: #080808; color: #EFEFEF; border: none;
        padding: calc(3px * var(--sw-scale, 1)) calc(6px * var(--sw-scale, 1));
        font-size: calc(11px * var(--sw-scale, 1));
        height: calc(19px * var(--sw-scale, 1));
        display: flex; align-items: center; justify-content: center;
    }
    .setup-window .footer-bottom { display: flex; justify-content: space-between; gap: calc(7px * var(--sw-scale, 1)); }

    .setup-window .button {
        background-color: #080808; color: #EFEFEF; border: none;
        padding: calc(7px * var(--sw-scale, 1)) calc(8px * var(--sw-scale, 1));
        font-size: calc(9px * var(--sw-scale, 1)); flex: 1;
        text-align: center; text-transform: uppercase;
    }
</style>

<div class="setup-window">
    <div class="title-bar">
        <div class="title">
            <svg class="title-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34 34">
                <path fill="#000" transform="translate(3 0)" d="M 25.875 0.0625 C 7.531 0.0625 8.78125 11.4375 8.78125 11.4375 C 8.2290994 12.246696 7.6995693 13.046426 7.25 13.84375 C 7.2192731 13.898245 7.1865288 13.94563 7.15625 14 L 4 14 A 1.0001 1.0001 0 0 0 3.90625 14 A 1.001098 1.001098 0 0 0 3.5 15.90625 L 3 16 C 1.343 16 0 17.344 0 19 L 0 23 C 0 24.656 1.343 26 3 26 L 13 26 C 14.657 26 16 24.656 16 23 L 16 19 C 16 17.344 14.657 16 13 16 L 12.46875 15.875 A 1.0001 1.0001 0 0 0 12 14 L 8.78125 14 C 9.3768313 12.98664 10.046844 11.978044 10.8125 10.96875 C 10.850157 10.925536 10.924518 10.804345 10.96875 10.75 C 11.312321 10.305889 11.682667 9.871631 12.0625 9.4375 C 12.206935 9.262417 12.364614 9.0972071 12.53125 8.90625 C 14.065329 7.2428175 15.90652 5.6997788 18.0625 4.40625 C 16.2125 6.10525 13.15425 9.5635 11.65625 12.1875 C 14.10025 12.4015 17.5465 11.016 19.9375 9 C 19.3975 8.939 16.875 8.48475 16.125 7.84375 C 17.563 7.95975 19.95325 7.97425 20.90625 7.90625 C 22.84525 6.47025 25.063 3.0785 25.875 0.0625 z"/>
            </svg>
            Inkybot - Préparer
        </div>
        <div class="controls">
            <div class="control-btn">_</div>
            <div class="control-btn close">✕</div>
        </div>
    </div>
    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Caractéristique</th>
                    <th>Valeur</th>
                    <th>Cible</th>
                    <th>Minimum</th>
                    <th>Priorité</th>
                    <th class="icon-cell">-</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Vitalité</td><td>292</td><td>250</td><td>240</td><td>10</td><td class="icon-cell refresh-icon">⟲</td></tr>
                <tr><td>Chance</td><td>59</td><td>55</td><td>-</td><td>8</td><td class="icon-cell"></td></tr>
                <tr><td>Agilité</td><td>58</td><td>55</td><td>-</td><td>8</td><td class="icon-cell"></td></tr>
                <tr><td>Sagesse</td><td>30</td><td>38</td><td>-</td><td>7</td><td class="icon-cell"></td></tr>
                <tr><td>Portée</td><td>1</td><td>1</td><td>-</td><td>0</td><td class="icon-cell"></td></tr>
                <tr><td>Dommages Eau</td><td>11</td><td>11</td><td>-</td><td>6</td><td class="icon-cell"></td></tr>
                <tr><td>Dommages Air</td><td>11</td><td>11</td><td>-</td><td>6</td><td class="icon-cell"></td></tr>
                <tr><td>Prospection</td><td>6</td><td>0</td><td>-</td><td>0</td><td class="icon-cell"></td></tr>
                <tr><td>Initiative</td><td>391</td><td>380</td><td>-</td><td>0</td><td class="icon-cell"></td></tr>
                <tr><td>% Résistance Neutre</td><td>7</td><td>7</td><td>-</td><td>9</td><td class="icon-cell"></td></tr>
                <tr><td>% Résistance Terre</td><td>7</td><td>7</td><td>-</td><td>9</td><td class="icon-cell"></td></tr>
                <tr><td>% Résistance Feu</td><td>7</td><td>7</td><td>-</td><td>9</td><td class="icon-cell"></td></tr>
                <tr><td>Tacle</td><td>4</td><td>4</td><td>-</td><td>5</td><td class="icon-cell"></td></tr>
                <tr class="last-row"><td>PM</td><td>0</td><td>1</td><td>1</td><td>0</td><td class="icon-cell"></td></tr>
            </tbody>
        </table>
    </div>
    <div class="footer">
        <div class="footer-top"><a href="#" class="examples-link">Voir des exemples</a></div>
        <div class="footer-middle">
            <div class="dropdown" style="width: calc(105px * var(--sw-scale, 1));">PM</div>
            <div style="display: flex; align-items: center; gap: 5px;">
                <div class="dropdown" style="width: calc(140px * var(--sw-scale, 1));">Alliance Gloursonne</div>
                <div class="trash-icon">🗑️</div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="button">AJOUTER EXO</div>
            <div class="button">SUPPRIMER EXOS</div>
            <div class="button">ENREGISTRER LE PRÉRÉGLAGE</div>
        </div>
    </div>
</div>
