<style>
    .setup-window {
        width: 420px;
        height: 420px;
        background-color: #1e1e1e;
        border: 1px solid #3E3E42;
        display: flex;
        flex-direction: column;
        box-shadow: 0 3px 8px rgba(0,0,0,0.5);
        color: #EFEFEF;
        position: relative;
        z-index: 2;
    }

    .setup-window .title-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 7px;
        background-color: #FFFFFF;
        color: #000000;
        height: 21px;
        user-select: none;
    }

    .setup-window .title { font-size: 8px; display: flex; align-items: center; gap: 6px; }
    .setup-window .title-icon { width: 10px; height: 10px; background-color: #333; border-radius: 50%; }
    .setup-window .controls { display: flex; height: 100%; }

    .setup-window .control-btn {
        width: 21px; display: flex; justify-content: center;
        align-items: center; cursor: pointer; font-size: 10px; color: #000000;
    }
    .setup-window .control-btn:hover { background-color: #E5E5E5; }
    .setup-window .control-btn.close:hover { background-color: #E81123; color: white; }

    .setup-window .content { flex: 1; padding: 0; overflow-y: auto; background-color: #1e1e1e; }

    .setup-window table { width: 100%; border-collapse: collapse; font-size: 9px; }
    .setup-window th, .setup-window td { border: 1px solid #3E3E42; padding: 1px 2px; text-align: left; }
    .setup-window th { background-color: #080808; color: #EFEFEF; font-weight: normal; }
    .setup-window tr { background-color: #1e1e1e; }
    .setup-window tr.last-row { background-color: #141414; font-weight: bold; }

    .setup-window th.icon-cell, .setup-window td.icon-cell {
        text-align: center; width: 10px; min-width: 10px; max-width: 10px;
        padding: 1px 1px; color: #EFEFEF; border-top: none; border-bottom: none;
    }
    .setup-window th.icon-cell { background-color: #080808; }
    .setup-window td.icon-cell { background-color: #1e1e1e; }
    .setup-window tbody tr:first-child td.icon-cell { background-color: #080808; }
    .setup-window .refresh-icon { cursor: pointer; font-size: 10px; }

    .setup-window .footer {
        padding: 10px 0px 0px 0px; background-color: #1e1e1e;
        border-top: 1px solid #3E3E42; display: flex; flex-direction: column; gap: 8px;
    }
    .setup-window .footer-top { display: flex; justify-content: space-between; align-items: center; }
    .setup-window .examples-link { color: #EFEFEF; font-size: 9px; text-decoration: underline; margin: 0 3px; }
    .setup-window .footer-middle { display: flex; justify-content: space-between; align-items: center; }

    .setup-window .dropdown {
        background-color: #080808; color: #EFEFEF;
        border: 1px solid #080808; padding: 3px; font-size: 9px; outline: none;
    }
    .setup-window .trash-icon {
        background-color: #080808; color: #EFEFEF; border: none;
        padding: 3px 6px; cursor: pointer; font-size: 11px; height: 19px;
        display: flex; align-items: center; justify-content: center;
    }
    .setup-window .footer-bottom { display: flex; justify-content: space-between; gap: 7px; }

    .setup-window .button {
        background-color: #080808; color: #EFEFEF; border: none;
        padding: 7px 8px; font-size: 9px; cursor: pointer; flex: 1;
        text-align: center; text-transform: uppercase;
    }
    .setup-window .button:hover { background-color: #1a1a1a; }
</style>

<div class="setup-window">
    <div class="title-bar">
        <div class="title">
            <div class="title-icon"></div>
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
                <tr style="border-bottom: 1px solid var(--border-color);">
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
            <select class="dropdown" style="width: 105px;"><option>PM</option></select>
            <div style="display: flex; align-items: center; gap: 5px;">
                <select class="dropdown" style="width: 140px;"><option>Alliance Gloursonne</option></select>
                <button class="trash-icon">🗑️</button>
            </div>
        </div>
        <div class="footer-bottom">
            <button class="button">AJOUTER EXO</button>
            <button class="button">SUPPRIMER EXOS</button>
            <button class="button">ENREGISTRER LE PRÉRÉGLAGE</button>
        </div>
    </div>
</div>