 <h3 class="text-muted">Teamspeak &sup3; Infusion f&uuml;r PHP-Fusion v7.02.xx</h3>
 
<strong>Teamspeak&sup3; Overview 3rd Addon
</strong><br>Authors: Septron, Harlekin, PlanetTeamspeak, ts3admin
<br>Version: 1.4
<br>PHP-Fusion: v7.02.xx
<br>E-Mail: support@septron.de
<br>Webseite: https://www.septron.de
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;http://www.septron.eu
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;http://www.septron.net
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;http://www.septron.org
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;http://www.septron.info
<br>Supportseite: https://phpfusion-deutschland.de
<br><br>Creditsites: http://harlekinpower.de
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;https://www.planetteamspeak.com
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;http://ts3admin.info

<h2>derzeitiger Download der v1.4</h2>
Webseite: https://www.septron.de
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;https://phpfusion-deutschland.de

<h2>weitere geänderter Version</h2>
Webseite: http://harlekinpower.de

<h2>Installation</h2>
<p>Lade die unter der Ordner files den Ordner administration und den Ordner infusions<br />
in dein Hauptverzeichnis von PHP-Fusion hoch.<br /><br />

Gehe nun in deine Administration -> System -> Infusions<br /><br />

Installiere -> Ts3_panel<br /><br />

dann rufe in deiner Administration folgendes auf Infusions -> Teamspeak 3<br />
dort kannst du nun ein paar angaben machen<br /><br />

Host: IP oder link des TS3 Server<br />
Query Port: ist in den meisten f&uuml;llen immer 10011<br />
Port: der Port deines TS3 Server (standart 9987)<br />
Admin Name: dein Querylogin f&uuml;r deinen TS3 Server (wird f&uuml;r die serverliste ben&ouml;tigt)<br />
Admin Passwort: dein Querypasswort (wird f&uuml;r die serverliste ben&ouml;tigt)<br />
Join Passwort: dein Serverpasswort eingeben falls eingegeben<br />
Die weiteren Auswahlfelder verstehen sich von selbst.<br /><br />

auf Speichern klicken Fertig.<br /><br />

nun kannst du unter<br />
Administration -> System -> Navigationslinks -> Aktuell vorhandene Navigationslinks<br />
finden und noch bearbeiten ob dieser nur im Navigationspanel angezeigt wird<br />
oder im Header und im Navigationspanel oder nur im Header so wie in einem neuen Tab/Fenster &ouml;ffnen.<br /><br />
Nun solltest du auf deinem TeamSpeak&sup3; Server gehen (VirtualServer oder bei deinem TeamSpeak&sup3; Hoster)<br />
und dort deine <b>whitelist.txt</b> &ouml;ffnen und dort deine Domain oder die Domain IP eintragen (Beipiel: Domain = septron.de - IP = 127.0.0.1).<br /><br />
Nun hast du bestimmt das Problem und bekommst eine Meldung von wegen: Error Code: 2568 insufficient client permissions etc.<br />
Beschreibung f&uuml;r deine Richtige Teamspeak&sup3; Gast rechtevergabe diese ist von <a href="https://www.tsviewer.com/index.php?page=faq&id=6&newlanguage=de/" target="_blank">TSViewer</a>
Diese Fehlermeldung sagt, dass ein oder mehrere Rechte die der TSViewer ben&ouml;tigt auf dem Server nicht erlaubt sind.<br />
<b>Schritt 1 - Fortgeschrittenes Rechtesystem anschalten</b><br />
Öffne den TeamSpeak 3 Client. Klicke oben in der Men&uuml;leiste auf <b>Einstellungen</b> und dann <b>Optionen</b>. Das Optionen Fenster &ouml;ffnet sich nun.<br />
Dort in der linken Leiste dann auf <b>Anwendung</b> klicken, dort dann unter <b>Verschiedenes</b> ein H&auml;kchen reinsetzen bei <b>Fortgeschrittenes Rechtesystem</b>.<br />
Schlie&szlig;e nun das Optionen Fenster einem Klick auf den OK Knopf.<br />
<img src="https://static.tsviewer.com/images/faq/2568_advanced_permissions_de.png"><br /><br />
<b>Schritt 2 - Rechte erlauben</b><br />
Nicht wundern, bei einem frisch installierten TS3 Server sind diese Rechte standardm&auml;&szlig;ig nicht erlaubt. Daher sieht normalerweise fast jeder die Error Code 2568 Fehlermeldung<br />
wenn er einen TSViewer benutzen m&ouml;chte. Der folgende Screenshot zeigt, welche Rechte noch zus&auml;tzlich erlaubt werden m&uuml;ssen:<br />
<img src="https://static.tsviewer.com/images/faq/2568_permissions_de.png"><br /><br />
Verbinde dich zu deinem TeamSpeak 3 Server und &ouml;ffne dann dieses Fenster indem zuerst oben in der Men&uuml;leiste auf <b>Rechte</b> und dann auf <b>Server Gruppen</b> klickst.<br />
Änder zun&auml;chst die Anzeige der Rechte, stelle sie auf <b>Namen anzeigen</b> (Dropdown Men&uuml; in der Mitte ganz unten in diesem Fenster).<br />
W&auml;hle jetzt links bei <b>Server Gruppen</b> den <b>Guest (8)</b> aus.<br />
In der Mitte, dem Hauptbereich dieses Fensters siehst du s&auml;mtliche Rechte deines Servers nach Kategorien unterteilt (Global, Virtueller Server, Channel, Gruppe, ...).<br />
Diese kannst du aufklappen, um zu sehen welche weiteren Unterkategorien sowie Rechte dort zu finden sind.<br />
Suche jetzt wie in dem Screenshot dargestellt die Rechte in ihren entsprechenden Kategorien und <b>erlaube diese</b> (indem du auf sie doppelklickst, es wird automatisch ein H&auml;kchen bei<br />
<b>Wert</b> gesetzt werden womit das entsprechende Recht dann auch erlaubt ist). Sollte ein Recht vorher bereits hinzugef&uuml;gt gewesen sein (schwarze anstatt graue Schrift),<br />
aber ein H&auml;kchen bei <b>Wert</b> fehlen, dann erlaube dieses Recht indem du ein H&auml;kchen bei <b>Wert</b> setzt.<br />
Wenn alle angaben richtig eingetragen worden sind<br />
kannst du deinen Teamspeak 3 Server nun sehen mit einigen Informationen.<br />
Sollte dies immernoch nicht funktionieren so klicke auf den TSViewer link und lese die FAQ weiter.<br /><br />

Um deinen TS&sup3; auch als Panel nutzen zu k&ouml;nnen musst du unter<br />
Administration -> System -> Panels (Links oder Rechts) -> Neues Panel<br />
Name (Deinen Panelnamen) -> Dateiname -> ts3_panel -> Admin Passwort eingeben -> Vorschau oder direkt Speichern.<br /><br />

Solltest du ein Älteres Theme benutzen so suche in der <b>ts3_view.php</b> &amp; <b>ts3_panel.php</b> nach:
<figure class="highlight"><pre><code class="language-html" data-lang="html">
#ts3_panel {
margin: 0 auto;
overflow: hidden;
padding: 0;
width: 100%;
}
</code></pre></figure><br />

ersetze es wie folgt:
<figure class="highlight"><pre><code class="language-html" data-lang="html">
#ts3_panel {
margin: 0 auto;
overflow: hidden;
padding: 0;
width: 180px;
}
</code></pre></figure><br />

<br />

Das war es auch schon.<br /><br />
</p>

<h2>Update Informationen</h2>
<p><ul> 
            <li>Version 1.4 
            	<ul>
                    <li>- ts3_admin.php bugfixes</li>
                    <li>- abfrage bugfixes</li>
                    <li>- ts3_view.php &uuml;berarbeitet</li>
                </ul>
         </ul></p>
          <p><ul> 
            <li>Version 1.3 
            	<ul>
            		<li>- &Auml;nderungen aller Dateien</li>
                	<li>- cache Ordner wurde entfernt</li>
                    <li>- data Ordner wurde entfernt</li>
                    <li>- statusviewer Ordner wurde entfernt</li>
                    <li>- tsstatus Ordner wurde entfernt</li>
                    <li>- ts3.info.php wurde entfernt</li>
                    <li>- config.inc.php wurde aus dem includes Ordner entfernt</li>
                    <li>- config.php wurde aus dem includes Ordner entfernt</li>
                    <li>- funktions.php wurde aus dem includes Ordner entfernt</li>
                    <li>- functions_sgif.php wurde aus dem includes Ordner entfernt</li>
                    <li>- Server Icons werden automatisch angezeigt</li>
                    <li>- Button im Panel Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Button im Seitenlink Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Serverliste Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Serverbanner Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Willkommensnachricht Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Servername Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server IP Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Port Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Sicherheitsstufe Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Version Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Plattform Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Status Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Erstellung Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Online Zeit Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Neustart Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Ping Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Benutzer Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Channel Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Monatlicher Datentransfer Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Paket Datentransfer Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Voice Datentransfer Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Datei Datentransfer Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Gesamttransfer Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Passwort angabe wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Passwort Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt</li>
                    <li>- Server Smartphone Benutzer Anzeigen/Verstecken wurde im Adminbereich hinzugef&uuml;gt (derzeit nur Android)</li>
                    <li>- Copyrights wurden im Seitenlink so wie im Adminbereich hinzugef&uuml;gt</li>
                </ul>
         </ul></p>
          <p><ul> 
            <li>Version 1.2 
            	<ul>
                    <li>- E-Mail Callback entfernt</li>
                    <li>- Panel Viewer eingebaut (tsstatus ordner wurde genutzt)</li>
                    <li>- Deaktivierten Code entfernt</li>
                    <li>- Query Login der Viewer entfernt</li>
                    <li>- Versionscheck im Adminbereich hinzugef&uuml;gt</li>
                    <li>- weitere Modifaktionen mit <a href="http://harlekinpower.de/" target="_blank">Harlekin</a> besprochen</li>
                </ul>
         </ul></p>
          <p><ul> 
            <li>Version 1.1 
            	<ul>
            		<li>- &Auml;nderungen an den Localen</li>
                	<li>- Optimierung der Dateien</li>
                    <li>- E-Mail Callback deaktiviert</li>
                </ul>
         </ul></p>
          <p><ul> 
            <li>Version 1.0 
            	<ul>
            		<li>- Deutsche Sprachdatei hinzugef&uuml;gt</li>
                	<li>- Englische Sprachdatei wurde hinzugef&uuml;gt</li>
                </ul>
         </ul></p>

<h2>Changelog</h2>
<p>- TS3 PHP Framework von: <a href="https://www.planetteamspeak.com/powerful-php-framework/" target="_blank">planetteamspeak.com</a><br />
- ts3admin.class von: <a href="http://ts3admin.info/" target="_blank">ts3admin.info</a><br />
</p>
