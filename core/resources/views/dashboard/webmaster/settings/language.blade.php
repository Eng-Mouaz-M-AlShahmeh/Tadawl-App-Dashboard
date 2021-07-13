
<div class="tab-pane {{  ( Session::get('active_tab') == 'languageSettingsTab') ? 'active' : '' }}"
     id="tab-2">
    <div class="p-a-md"><h5>{!!  __('backend.languageSettings') !!}</h5></div>

    <div class="p-a-md col-md-12">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>{{ __('backend.defaultLanguage') }} : </label>
                    <div>
                        <select name="languages_by_default" class="form-control c-select">
                            @foreach(Helper::languagesList() as $ActiveLanguage)
                                @if($ActiveLanguage->box_status)
                                    <option
                                        value="{{ $ActiveLanguage->code }}" {{ ($WebmasterSetting->languages_by_default==$ActiveLanguage->code)?"selected='selected'":"" }}>{{ $ActiveLanguage->title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>{{ __('backend.timezone') }} : </label>

                    <select name="timezone" id="timezone"
                            class="form-control select2 select2-hidden-accessible" ui-jp="select2"
                            ui-options="{theme: 'bootstrap'}">
                        <option value="America/New_York">America, Eastern</option>
                        <option value="America/Chicago">America, Central</option>
                        <option value="America/Denver">America, Mountain</option>
                        <option value="America/Phoenix">America, Mountain (no DST)</option>
                        <option value="America/Los_Angeles">America, Pacific</option>
                        <option value="America/Anchorage">America, Alaska</option>
                        <option value="America/Adak">America, Hawaii</option>
                        <option value="Pacific/Honolulu">Pacific, Hawaii (no DST)</option>
                        <option value="Pacific/Midway">Pacific, Midway (GMT-11:00)</option>
                        <option value="Pacific/Niue">Pacific, Niue (GMT-11:00)</option>
                        <option value="Pacific/Pago_Pago">Pacific, Pago Pago (GMT-11:00)</option>
                        <option value="Pacific/Honolulu">Pacific, Honolulu (GMT-10:00)</option>
                        <option value="Pacific/Johnston">Pacific, Johnston (GMT-10:00)</option>
                        <option value="Pacific/Rarotonga">Pacific, Rarotonga (GMT-10:00)</option>
                        <option value="Pacific/Tahiti">Pacific, Tahiti (GMT-10:00)</option>
                        <option value="Pacific/Marquesas">Pacific, Marquesas (GMT-09:30)</option>
                        <option value="America/Adak">America, Adak (GMT-09:00)</option>
                        <option value="Pacific/Gambier">Pacific, Gambier (GMT-09:00)</option>
                        <option value="America/Anchorage">America, Anchorage (GMT-08:00)</option>
                        <option value="America/Juneau">America, Juneau (GMT-08:00)</option>
                        <option value="America/Metlakatla">America, Metlakatla (GMT-08:00)</option>
                        <option value="America/Nome">America, Nome (GMT-08:00)</option>
                        <option value="America/Sitka">America, Sitka (GMT-08:00)</option>
                        <option value="America/Yakutat">America, Yakutat (GMT-08:00)</option>
                        <option value="Pacific/Pitcairn">Pacific, Pitcairn (GMT-08:00)</option>
                        <option value="America/Creston">America, Creston (GMT-07:00)</option>
                        <option value="America/Dawson">America, Dawson (GMT-07:00)</option>
                        <option value="America/Dawson_Creek">America, Dawson Creek (GMT-07:00)
                        </option>
                        <option value="America/Fort_Nelson">America, Fort Nelson (GMT-07:00)
                        </option>
                        <option value="America/Hermosillo">America, Hermosillo (GMT-07:00)</option>
                        <option value="America/Los_Angeles">America, Los Angeles (GMT-07:00)
                        </option>
                        <option value="America/Phoenix">America, Phoenix (GMT-07:00)</option>
                        <option value="America/Tijuana">America, Tijuana (GMT-07:00)</option>
                        <option value="America/Vancouver">America, Vancouver (GMT-07:00)</option>
                        <option value="America/Whitehorse">America, Whitehorse (GMT-07:00)</option>
                        <option value="America/Belize">America, Belize (GMT-06:00)</option>
                        <option value="America/Boise">America, Boise (GMT-06:00)</option>
                        <option value="America/Cambridge_Bay">America, Cambridge Bay (GMT-06:00)
                        </option>
                        <option value="America/Chihuahua">America, Chihuahua (GMT-06:00)</option>
                        <option value="America/Costa_Rica">America, Costa Rica (GMT-06:00)</option>
                        <option value="America/Denver">America, Denver (GMT-06:00)</option>
                        <option value="America/Edmonton">America, Edmonton (GMT-06:00)</option>
                        <option value="America/El_Salvador">America, El Salvador (GMT-06:00)
                        </option>
                        <option value="America/Guatemala">America, Guatemala (GMT-06:00)</option>
                        <option value="America/Inuvik">America, Inuvik (GMT-06:00)</option>
                        <option value="America/Managua">America, Managua (GMT-06:00)</option>
                        <option value="America/Mazatlan">America, Mazatlan (GMT-06:00)</option>
                        <option value="America/Ojinaga">America, Ojinaga (GMT-06:00)</option>
                        <option value="America/Regina">America, Regina (GMT-06:00)</option>
                        <option value="America/Swift_Current">America, Swift Current (GMT-06:00)
                        </option>
                        <option value="America/Tegucigalpa">America, Tegucigalpa (GMT-06:00)
                        </option>
                        <option value="America/Yellowknife">America, Yellowknife (GMT-06:00)
                        </option>
                        <option value="Pacific/Galapagos">Pacific, Galapagos (GMT-06:00)</option>
                        <option value="America/Atikokan">America, Atikokan (GMT-05:00)</option>
                        <option value="America/Bahia_Banderas">America, Bahia Banderas (GMT-05:00)
                        </option>
                        <option value="America/Bogota">America, Bogota (GMT-05:00)</option>
                        <option value="America/Cancun">America, Cancun (GMT-05:00)</option>
                        <option value="America/Cayman">America, Cayman (GMT-05:00)</option>
                        <option value="America/Chicago">America, Chicago (GMT-05:00)</option>
                        <option value="America/Eirunepe">America, Eirunepe (GMT-05:00)</option>
                        <option value="America/Guayaquil">America, Guayaquil (GMT-05:00)</option>
                        <option value="America/Indiana/Knox">America, Indiana, Knox (GMT-05:00)
                        </option>
                        <option value="America/Indiana/Tell_City">America, Indiana, Tell City
                            (GMT-05:00)
                        </option>
                        <option value="America/Jamaica">America, Jamaica (GMT-05:00)</option>
                        <option value="America/Lima">America, Lima (GMT-05:00)</option>
                        <option value="America/Matamoros">America, Matamoros (GMT-05:00)</option>
                        <option value="America/Menominee">America, Menominee (GMT-05:00)</option>
                        <option value="America/Merida">America, Merida (GMT-05:00)</option>
                        <option value="America/Mexico_City">America, Mexico City (GMT-05:00)
                        </option>
                        <option value="America/Monterrey">America, Monterrey (GMT-05:00)</option>
                        <option value="America/North_Dakota/Beulah">America, North Dakota, Beulah
                            (GMT-05:00)
                        </option>
                        <option value="America/North_Dakota/Center">America, North Dakota, Center
                            (GMT-05:00)
                        </option>
                        <option value="America/North_Dakota/New_Salem">America, North Dakota, New
                            Salem
                            (GMT-05:00)
                        </option>
                        <option value="America/Panama">America, Panama (GMT-05:00)</option>
                        <option value="America/Port-au-Prince">America, Port-au-Prince (GMT-05:00)
                        </option>
                        <option value="America/Rainy_River">America, Rainy River (GMT-05:00)
                        </option>
                        <option value="America/Rankin_Inlet">America, Rankin Inlet (GMT-05:00)
                        </option>
                        <option value="America/Resolute">America, Resolute (GMT-05:00)</option>
                        <option value="America/Rio_Branco">America, Rio Branco (GMT-05:00)</option>
                        <option value="America/Winnipeg">America, Winnipeg (GMT-05:00)</option>
                        <option value="Pacific/Easter">Pacific, Easter (GMT-05:00)</option>
                        <option value="America/Anguilla">America, Anguilla (GMT-04:00)</option>
                        <option value="America/Antigua">America, Antigua (GMT-04:00)</option>
                        <option value="America/Aruba">America, Aruba (GMT-04:00)</option>
                        <option value="America/Asuncion">America, Asuncion (GMT-04:00)</option>
                        <option value="America/Barbados">America, Barbados (GMT-04:00)</option>
                        <option value="America/Blanc-Sablon">America, Blanc-Sablon (GMT-04:00)
                        </option>
                        <option value="America/Boa_Vista">America, Boa Vista (GMT-04:00)</option>
                        <option value="America/Campo_Grande">America, Campo Grande (GMT-04:00)
                        </option>
                        <option value="America/Caracas">America, Caracas (GMT-04:00)</option>
                        <option value="America/Cuiaba">America, Cuiaba (GMT-04:00)</option>
                        <option value="America/Curacao">America, Curacao (GMT-04:00)</option>
                        <option value="America/Detroit">America, Detroit (GMT-04:00)</option>
                        <option value="America/Dominica">America, Dominica (GMT-04:00)</option>
                        <option value="America/Grand_Turk">America, Grand Turk (GMT-04:00)</option>
                        <option value="America/Grenada">America, Grenada (GMT-04:00)</option>
                        <option value="America/Guadeloupe">America, Guadeloupe (GMT-04:00)</option>
                        <option value="America/Guyana">America, Guyana (GMT-04:00)</option>
                        <option value="America/Havana">America, Havana (GMT-04:00)</option>
                        <option value="America/Indiana/Indianapolis">America, Indiana, Indianapolis
                            (GMT-04:00)
                        </option>
                        <option value="America/Indiana/Marengo">America, Indiana, Marengo
                            (GMT-04:00)
                        </option>
                        <option value="America/Indiana/Petersburg">America, Indiana, Petersburg
                            (GMT-04:00)
                        </option>
                        <option value="America/Indiana/Vevay">America, Indiana, Vevay (GMT-04:00)
                        </option>
                        <option value="America/Indiana/Vincennes">America, Indiana, Vincennes
                            (GMT-04:00)
                        </option>
                        <option value="America/Indiana/Winamac">America, Indiana, Winamac
                            (GMT-04:00)
                        </option>
                        <option value="America/Iqaluit">America, Iqaluit (GMT-04:00)</option>
                        <option value="America/Kentucky/Louisville">America, Kentucky, Louisville
                            (GMT-04:00)
                        </option>
                        <option value="America/Kentucky/Monticello">America, Kentucky, Monticello
                            (GMT-04:00)
                        </option>
                        <option value="America/Kralendijk">America, Kralendijk (GMT-04:00)</option>
                        <option value="America/La_Paz">America, La Paz (GMT-04:00)</option>
                        <option value="America/Lower_Princes">America, Lower Princes (GMT-04:00)
                        </option>
                        <option value="America/Manaus">America, Manaus (GMT-04:00)</option>
                        <option value="America/Marigot">America, Marigot (GMT-04:00)</option>
                        <option value="America/Martinique">America, Martinique (GMT-04:00)</option>
                        <option value="America/Montserrat">America, Montserrat (GMT-04:00)</option>
                        <option value="America/Nassau">America, Nassau (GMT-04:00)</option>
                        <option value="America/New_York">America, New York (GMT-04:00)</option>
                        <option value="America/Nipigon">America, Nipigon (GMT-04:00)</option>
                        <option value="America/Pangnirtung">America, Pangnirtung (GMT-04:00)
                        </option>
                        <option value="America/Port_of_Spain">America, Port of Spain (GMT-04:00)
                        </option>
                        <option value="America/Porto_Velho">America, Porto Velho (GMT-04:00)
                        </option>
                        <option value="America/Puerto_Rico">America, Puerto Rico (GMT-04:00)
                        </option>
                        <option value="America/Santo_Domingo">America, Santo Domingo (GMT-04:00)
                        </option>
                        <option value="America/St_Barthelemy">America, St. Barthelemy (GMT-04:00)
                        </option>
                        <option value="America/St_Kitts">America, St. Kitts (GMT-04:00)</option>
                        <option value="America/St_Lucia">America, St. Lucia (GMT-04:00)</option>
                        <option value="America/St_Thomas">America, St. Thomas (GMT-04:00)</option>
                        <option value="America/St_Vincent">America, St. Vincent (GMT-04:00)</option>
                        <option value="America/Thunder_Bay">America, Thunder Bay (GMT-04:00)
                        </option>
                        <option value="America/Toronto">America, Toronto (GMT-04:00)</option>
                        <option value="America/Tortola">America, Tortola (GMT-04:00)</option>
                        <option value="America/Araguaina">America, Araguaina (GMT-03:00)</option>
                        <option value="America/Argentina/Buenos_Aires">America, Argentina, Buenos
                            Aires
                            (GMT-03:00)
                        </option>
                        <option value="America/Argentina/Catamarca">America, Argentina, Catamarca
                            (GMT-03:00)
                        </option>
                        <option value="America/Argentina/Cordoba">America, Argentina, Cordoba
                            (GMT-03:00)
                        </option>
                        <option value="America/Argentina/Jujuy">America, Argentina, Jujuy
                            (GMT-03:00)
                        </option>
                        <option value="America/Argentina/La_Rioja">America, Argentina, La Rioja
                            (GMT-03:00)
                        </option>
                        <option value="America/Argentina/Mendoza">America, Argentina, Mendoza
                            (GMT-03:00)
                        </option>
                        <option value="America/Argentina/Rio_Gallegos">America, Argentina, Rio
                            Gallegos
                            (GMT-03:00)
                        </option>
                        <option value="America/Argentina/Salta">America, Argentina, Salta
                            (GMT-03:00)
                        </option>
                        <option value="America/Argentina/San_Juan">America, Argentina, San Juan
                            (GMT-03:00)
                        </option>
                        <option value="America/Argentina/San_Luis">America, Argentina, San Luis
                            (GMT-03:00)
                        </option>
                        <option value="America/Argentina/Tucuman">America, Argentina, Tucuman
                            (GMT-03:00)
                        </option>
                        <option value="America/Argentina/Ushuaia">America, Argentina, Ushuaia
                            (GMT-03:00)
                        </option>
                        <option value="America/Bahia">America, Bahia (GMT-03:00)</option>
                        <option value="America/Belem">America, Belem (GMT-03:00)</option>
                        <option value="America/Cayenne">America, Cayenne (GMT-03:00)</option>
                        <option value="America/Fortaleza">America, Fortaleza (GMT-03:00)</option>
                        <option value="America/Glace_Bay">America, Glace Bay (GMT-03:00)</option>
                        <option value="America/Goose_Bay">America, Goose Bay (GMT-03:00)</option>
                        <option value="America/Halifax">America, Halifax (GMT-03:00)</option>
                        <option value="America/Maceio">America, Maceio (GMT-03:00)</option>
                        <option value="America/Moncton">America, Moncton (GMT-03:00)</option>
                        <option value="America/Montevideo">America, Montevideo (GMT-03:00)</option>
                        <option value="America/Paramaribo">America, Paramaribo (GMT-03:00)</option>
                        <option value="America/Recife">America, Recife (GMT-03:00)</option>
                        <option value="America/Santarem">America, Santarem (GMT-03:00)</option>
                        <option value="America/Santiago">America, Santiago (GMT-03:00)</option>
                        <option value="America/Sao_Paulo">America, Sao Paulo (GMT-03:00)</option>
                        <option value="America/Thule">America, Thule (GMT-03:00)</option>
                        <option value="Antarctica/Palmer">Antarctica, Palmer (GMT-03:00)</option>
                        <option value="Antarctica/Rothera">Antarctica, Rothera (GMT-03:00)</option>
                        <option value="Atlantic/Bermuda">Atlantic, Bermuda (GMT-03:00)</option>
                        <option value="Atlantic/Stanley">Atlantic, Stanley (GMT-03:00)</option>
                        <option value="America/St_Johns">America, St. Johns (GMT-02:30)</option>
                        <option value="America/Godthab">America, Godthab (GMT-02:00)</option>
                        <option value="America/Miquelon">America, Miquelon (GMT-02:00)</option>
                        <option value="America/Noronha">America, Noronha (GMT-02:00)</option>
                        <option value="Atlantic/South_Georgia">Atlantic, South Georgia (GMT-02:00)
                        </option>
                        <option value="Atlantic/Cape_Verde">Atlantic, Cape Verde (GMT-01:00)
                        </option>
                        <option value="Africa/Abidjan">Africa, Abidjan (GMT)</option>
                        <option value="Africa/Accra">Africa, Accra (GMT)</option>
                        <option value="Africa/Bamako">Africa, Bamako (GMT)</option>
                        <option value="Africa/Banjul">Africa, Banjul (GMT)</option>
                        <option value="Africa/Bissau">Africa, Bissau (GMT)</option>
                        <option value="Africa/Conakry">Africa, Conakry (GMT)</option>
                        <option value="Africa/Dakar">Africa, Dakar (GMT)</option>
                        <option value="Africa/Freetown">Africa, Freetown (GMT)</option>
                        <option value="Africa/Lome">Africa, Lome (GMT)</option>
                        <option value="Africa/Monrovia">Africa, Monrovia (GMT)</option>
                        <option value="Africa/Nouakchott">Africa, Nouakchott (GMT)</option>
                        <option value="Africa/Ouagadougou">Africa, Ouagadougou (GMT)</option>
                        <option value="Africa/Sao_Tome">Africa, Sao Tome (GMT)</option>
                        <option value="America/Danmarkshavn">America, Danmarkshavn (GMT)</option>
                        <option value="America/Scoresbysund">America, Scoresbysund (GMT)</option>
                        <option value="Atlantic/Azores">Atlantic, Azores (GMT)</option>
                        <option value="Atlantic/Reykjavik">Atlantic, Reykjavik (GMT)</option>
                        <option value="Atlantic/St_Helena">Atlantic, St. Helena (GMT)</option>
                        <option value="UTC">UTC (GMT)</option>
                        <option value="Africa/Algiers">Africa, Algiers (GMT+01:00)</option>
                        <option value="Africa/Bangui">Africa, Bangui (GMT+01:00)</option>
                        <option value="Africa/Brazzaville">Africa, Brazzaville (GMT+01:00)</option>
                        <option value="Africa/Casablanca">Africa, Casablanca (GMT+01:00)</option>
                        <option value="Africa/Douala">Africa, Douala (GMT+01:00)</option>
                        <option value="Africa/El_Aaiun">Africa, El Aaiun (GMT+01:00)</option>
                        <option value="Africa/Kinshasa">Africa, Kinshasa (GMT+01:00)</option>
                        <option value="Africa/Lagos">Africa, Lagos (GMT+01:00)</option>
                        <option value="Africa/Libreville">Africa, Libreville (GMT+01:00)</option>
                        <option value="Africa/Luanda">Africa, Luanda (GMT+01:00)</option>
                        <option value="Africa/Malabo">Africa, Malabo (GMT+01:00)</option>
                        <option value="Africa/Ndjamena">Africa, Ndjamena (GMT+01:00)</option>
                        <option value="Africa/Niamey">Africa, Niamey (GMT+01:00)</option>
                        <option value="Africa/Porto-Novo">Africa, Porto-Novo (GMT+01:00)</option>
                        <option value="Africa/Tunis">Africa, Tunis (GMT+01:00)</option>
                        <option value="Africa/Windhoek">Africa, Windhoek (GMT+01:00)</option>
                        <option value="Atlantic/Canary">Atlantic, Canary (GMT+01:00)</option>
                        <option value="Atlantic/Faroe">Atlantic, Faroe (GMT+01:00)</option>
                        <option value="Atlantic/Madeira">Atlantic, Madeira (GMT+01:00)</option>
                        <option value="Europe/Dublin">Europe, Dublin (GMT+01:00)</option>
                        <option value="Europe/Guernsey">Europe, Guernsey (GMT+01:00)</option>
                        <option value="Europe/Isle_of_Man">Europe, Isle of Man (GMT+01:00)</option>
                        <option value="Europe/Jersey">Europe, Jersey (GMT+01:00)</option>
                        <option value="Europe/Lisbon">Europe, Lisbon (GMT+01:00)</option>
                        <option value="Europe/London">Europe, London (GMT+01:00)</option>
                        <option value="Africa/Blantyre">Africa, Blantyre (GMT+02:00)</option>
                        <option value="Africa/Bujumbura">Africa, Bujumbura (GMT+02:00)</option>
                        <option value="Africa/Cairo">Africa, Cairo (GMT+02:00)</option>
                        <option value="Africa/Ceuta">Africa, Ceuta (GMT+02:00)</option>
                        <option value="Africa/Gaborone">Africa, Gaborone (GMT+02:00)</option>
                        <option value="Africa/Harare">Africa, Harare (GMT+02:00)</option>
                        <option value="Africa/Johannesburg">Africa, Johannesburg (GMT+02:00)
                        </option>
                        <option value="Africa/Kigali">Africa, Kigali (GMT+02:00)</option>
                        <option value="Africa/Lubumbashi">Africa, Lubumbashi (GMT+02:00)</option>
                        <option value="Africa/Lusaka">Africa, Lusaka (GMT+02:00)</option>
                        <option value="Africa/Maputo">Africa, Maputo (GMT+02:00)</option>
                        <option value="Africa/Maseru">Africa, Maseru (GMT+02:00)</option>
                        <option value="Africa/Mbabane">Africa, Mbabane (GMT+02:00)</option>
                        <option value="Africa/Tripoli">Africa, Tripoli (GMT+02:00)</option>
                        <option value="Antarctica/Troll">Antarctica, Troll (GMT+02:00)</option>
                        <option value="Arctic/Longyearbyen">Arctic, Longyearbyen (GMT+02:00)
                        </option>
                        <option value="Europe/Amsterdam">Europe, Amsterdam (GMT+02:00)</option>
                        <option value="Europe/Andorra">Europe, Andorra (GMT+02:00)</option>
                        <option value="Europe/Belgrade">Europe, Belgrade (GMT+02:00)</option>
                        <option value="Europe/Berlin">Europe, Berlin (GMT+02:00)</option>
                        <option value="Europe/Bratislava">Europe, Bratislava (GMT+02:00)</option>
                        <option value="Europe/Brussels">Europe, Brussels (GMT+02:00)</option>
                        <option value="Europe/Budapest">Europe, Budapest (GMT+02:00)</option>
                        <option value="Europe/Busingen">Europe, Busingen (GMT+02:00)</option>
                        <option value="Europe/Copenhagen">Europe, Copenhagen (GMT+02:00)</option>
                        <option value="Europe/Gibraltar">Europe, Gibraltar (GMT+02:00)</option>
                        <option value="Europe/Kaliningrad">Europe, Kaliningrad (GMT+02:00)</option>
                        <option value="Europe/Ljubljana">Europe, Ljubljana (GMT+02:00)</option>
                        <option value="Europe/Luxembourg">Europe, Luxembourg (GMT+02:00)</option>
                        <option value="Europe/Madrid">Europe, Madrid (GMT+02:00)</option>
                        <option value="Europe/Malta">Europe, Malta (GMT+02:00)</option>
                        <option value="Europe/Monaco">Europe, Monaco (GMT+02:00)</option>
                        <option value="Europe/Oslo">Europe, Oslo (GMT+02:00)</option>
                        <option value="Europe/Paris">Europe, Paris (GMT+02:00)</option>
                        <option value="Europe/Podgorica">Europe, Podgorica (GMT+02:00)</option>
                        <option value="Europe/Prague">Europe, Prague (GMT+02:00)</option>
                        <option value="Europe/Rome">Europe, Rome (GMT+02:00)</option>
                        <option value="Europe/San_Marino">Europe, San Marino (GMT+02:00)</option>
                        <option value="Europe/Sarajevo">Europe, Sarajevo (GMT+02:00)</option>
                        <option value="Europe/Skopje">Europe, Skopje (GMT+02:00)</option>
                        <option value="Europe/Stockholm">Europe, Stockholm (GMT+02:00)</option>
                        <option value="Europe/Tirane">Europe, Tirane (GMT+02:00)</option>
                        <option value="Europe/Vaduz">Europe, Vaduz (GMT+02:00)</option>
                        <option value="Europe/Vatican">Europe, Vatican (GMT+02:00)</option>
                        <option value="Europe/Vienna">Europe, Vienna (GMT+02:00)</option>
                        <option value="Europe/Warsaw">Europe, Warsaw (GMT+02:00)</option>
                        <option value="Europe/Zagreb">Europe, Zagreb (GMT+02:00)</option>
                        <option value="Europe/Zurich">Europe, Zurich (GMT+02:00)</option>
                        <option value="Africa/Addis_Ababa">Africa, Addis Ababa (GMT+03:00)</option>
                        <option value="Africa/Asmara">Africa, Asmara (GMT+03:00)</option>
                        <option value="Africa/Dar_es_Salaam">Africa, Dar es Salaam (GMT+03:00)
                        </option>
                        <option value="Africa/Djibouti">Africa, Djibouti (GMT+03:00)</option>
                        <option value="Africa/Juba">Africa, Juba (GMT+03:00)</option>
                        <option value="Africa/Kampala">Africa, Kampala (GMT+03:00)</option>
                        <option value="Africa/Khartoum">Africa, Khartoum (GMT+03:00)</option>
                        <option value="Africa/Mogadishu">Africa, Mogadishu (GMT+03:00)</option>
                        <option value="Africa/Nairobi">Africa, Nairobi (GMT+03:00)</option>
                        <option value="Antarctica/Syowa">Antarctica, Syowa (GMT+03:00)</option>
                        <option value="Asia/Aden">Asia, Aden (GMT+03:00)</option>
                        <option value="Asia/Amman">Asia, Amman (GMT+03:00)</option>
                        <option value="Asia/Baghdad">Asia, Baghdad (GMT+03:00)</option>
                        <option value="Asia/Bahrain">Asia, Bahrain (GMT+03:00)</option>
                        <option value="Asia/Beirut">Asia, Beirut (GMT+03:00)</option>
                        <option value="Asia/Damascus">Asia, Damascus (GMT+03:00)</option>
                        <option value="Asia/Famagusta">Asia, Famagusta (GMT+03:00)</option>
                        <option value="Asia/Gaza">Asia, Gaza (GMT+03:00)</option>
                        <option value="Asia/Hebron">Asia, Hebron (GMT+03:00)</option>
                        <option value="Asia/Jerusalem">Asia, Jerusalem (GMT+03:00)</option>
                        <option value="Asia/Kuwait">Asia, Kuwait (GMT+03:00)</option>
                        <option value="Asia/Nicosia">Asia, Nicosia (GMT+03:00)</option>
                        <option value="Asia/Qatar">Asia, Qatar (GMT+03:00)</option>
                        <option value="Asia/Riyadh">Asia, Riyadh (GMT+03:00)</option>
                        <option value="Europe/Athens">Europe, Athens (GMT+03:00)</option>
                        <option value="Europe/Bucharest">Europe, Bucharest (GMT+03:00)</option>
                        <option value="Europe/Chisinau">Europe, Chisinau (GMT+03:00)</option>
                        <option value="Europe/Helsinki">Europe, Helsinki (GMT+03:00)</option>
                        <option value="Europe/Istanbul">Europe, Istanbul (GMT+03:00)</option>
                        <option value="Europe/Kiev">Europe, Kiev (GMT+03:00)</option>
                        <option value="Europe/Kirov">Europe, Kirov (GMT+03:00)</option>
                        <option value="Europe/Mariehamn">Europe, Mariehamn (GMT+03:00)</option>
                        <option value="Europe/Minsk">Europe, Minsk (GMT+03:00)</option>
                        <option value="Europe/Moscow">Europe, Moscow (GMT+03:00)</option>
                        <option value="Europe/Riga">Europe, Riga (GMT+03:00)</option>
                        <option value="Europe/Simferopol">Europe, Simferopol (GMT+03:00)</option>
                        <option value="Europe/Sofia">Europe, Sofia (GMT+03:00)</option>
                        <option value="Europe/Tallinn">Europe, Tallinn (GMT+03:00)</option>
                        <option value="Europe/Uzhgorod">Europe, Uzhgorod (GMT+03:00)</option>
                        <option value="Europe/Vilnius">Europe, Vilnius (GMT+03:00)</option>
                        <option value="Europe/Volgograd">Europe, Volgograd (GMT+03:00)</option>
                        <option value="Europe/Zaporozhye">Europe, Zaporozhye (GMT+03:00)</option>
                        <option value="Indian/Antananarivo">Indian, Antananarivo (GMT+03:00)
                        </option>
                        <option value="Indian/Comoro">Indian, Comoro (GMT+03:00)</option>
                        <option value="Indian/Mayotte">Indian, Mayotte (GMT+03:00)</option>
                        <option value="Asia/Baku">Asia, Baku (GMT+04:00)</option>
                        <option value="Asia/Dubai">Asia, Dubai (GMT+04:00)</option>
                        <option value="Asia/Muscat">Asia, Muscat (GMT+04:00)</option>
                        <option value="Asia/Tbilisi">Asia, Tbilisi (GMT+04:00)</option>
                        <option value="Asia/Yerevan">Asia, Yerevan (GMT+04:00)</option>
                        <option value="Europe/Astrakhan">Europe, Astrakhan (GMT+04:00)</option>
                        <option value="Europe/Samara">Europe, Samara (GMT+04:00)</option>
                        <option value="Europe/Saratov">Europe, Saratov (GMT+04:00)</option>
                        <option value="Europe/Ulyanovsk">Europe, Ulyanovsk (GMT+04:00)</option>
                        <option value="Indian/Mahe">Indian, Mahe (GMT+04:00)</option>
                        <option value="Indian/Mauritius">Indian, Mauritius (GMT+04:00)</option>
                        <option value="Indian/Reunion">Indian, Reunion (GMT+04:00)</option>
                        <option value="Asia/Kabul">Asia, Kabul (GMT+04:30)</option>
                        <option value="Asia/Tehran">Asia, Tehran (GMT+04:30)</option>
                        <option value="Antarctica/Mawson">Antarctica, Mawson (GMT+05:00)</option>
                        <option value="Asia/Aqtau">Asia, Aqtau (GMT+05:00)</option>
                        <option value="Asia/Aqtobe">Asia, Aqtobe (GMT+05:00)</option>
                        <option value="Asia/Ashgabat">Asia, Ashgabat (GMT+05:00)</option>
                        <option value="Asia/Atyrau">Asia, Atyrau (GMT+05:00)</option>
                        <option value="Asia/Dushanbe">Asia, Dushanbe (GMT+05:00)</option>
                        <option value="Asia/Karachi">Asia, Karachi (GMT+05:00)</option>
                        <option value="Asia/Oral">Asia, Oral (GMT+05:00)</option>
                        <option value="Asia/Samarkand">Asia, Samarkand (GMT+05:00)</option>
                        <option value="Asia/Tashkent">Asia, Tashkent (GMT+05:00)</option>
                        <option value="Asia/Yekaterinburg">Asia, Yekaterinburg (GMT+05:00)</option>
                        <option value="Indian/Kerguelen">Indian, Kerguelen (GMT+05:00)</option>
                        <option value="Indian/Maldives">Indian, Maldives (GMT+05:00)</option>
                        <option value="Asia/Colombo">Asia, Colombo (GMT+05:30)</option>
                        <option value="Asia/Kolkata">Asia, Kolkata (GMT+05:30)</option>
                        <option value="Asia/Kathmandu">Asia, Kathmandu (GMT+05:45)</option>
                        <option value="Antarctica/Vostok">Antarctica, Vostok (GMT+06:00)</option>
                        <option value="Asia/Almaty">Asia, Almaty (GMT+06:00)</option>
                        <option value="Asia/Bishkek">Asia, Bishkek (GMT+06:00)</option>
                        <option value="Asia/Dhaka">Asia, Dhaka (GMT+06:00)</option>
                        <option value="Asia/Omsk">Asia, Omsk (GMT+06:00)</option>
                        <option value="Asia/Qyzylorda">Asia, Qyzylorda (GMT+06:00)</option>
                        <option value="Asia/Thimphu">Asia, Thimphu (GMT+06:00)</option>
                        <option value="Asia/Urumqi">Asia, Urumqi (GMT+06:00)</option>
                        <option value="Indian/Chagos">Indian, Chagos (GMT+06:00)</option>
                        <option value="Asia/Yangon">Asia, Yangon (GMT+06:30)</option>
                        <option value="Indian/Cocos">Indian, Cocos (GMT+06:30)</option>
                        <option value="Antarctica/Davis">Antarctica, Davis (GMT+07:00)</option>
                        <option value="Asia/Bangkok">Asia, Bangkok (GMT+07:00)</option>
                        <option value="Asia/Barnaul">Asia, Barnaul (GMT+07:00)</option>
                        <option value="Asia/Ho_Chi_Minh">Asia, Ho Chi Minh (GMT+07:00)</option>
                        <option value="Asia/Jakarta">Asia, Jakarta (GMT+07:00)</option>
                        <option value="Asia/Krasnoyarsk">Asia, Krasnoyarsk (GMT+07:00)</option>
                        <option value="Asia/Novokuznetsk">Asia, Novokuznetsk (GMT+07:00)</option>
                        <option value="Asia/Novosibirsk">Asia, Novosibirsk (GMT+07:00)</option>
                        <option value="Asia/Phnom_Penh">Asia, Phnom Penh (GMT+07:00)</option>
                        <option value="Asia/Pontianak">Asia, Pontianak (GMT+07:00)</option>
                        <option value="Asia/Tomsk">Asia, Tomsk (GMT+07:00)</option>
                        <option value="Asia/Vientiane">Asia, Vientiane (GMT+07:00)</option>
                        <option value="Indian/Christmas">Indian, Christmas (GMT+07:00)</option>
                        <option value="Asia/Brunei">Asia, Brunei (GMT+08:00)</option>
                        <option value="Asia/Hong_Kong">Asia, Hong Kong (GMT+08:00)</option>
                        <option value="Asia/Hovd">Asia, Hovd (GMT+08:00)</option>
                        <option value="Asia/Irkutsk">Asia, Irkutsk (GMT+08:00)</option>
                        <option value="Asia/Kuala_Lumpur">Asia, Kuala Lumpur (GMT+08:00)</option>
                        <option value="Asia/Kuching">Asia, Kuching (GMT+08:00)</option>
                        <option value="Asia/Macau">Asia, Macau (GMT+08:00)</option>
                        <option value="Asia/Makassar">Asia, Makassar (GMT+08:00)</option>
                        <option value="Asia/Manila">Asia, Manila (GMT+08:00)</option>
                        <option value="Asia/Shanghai">Asia, Shanghai (GMT+08:00)</option>
                        <option value="Asia/Singapore">Asia, Singapore (GMT+08:00)</option>
                        <option value="Asia/Taipei">Asia, Taipei (GMT+08:00)</option>
                        <option value="Australia/Perth">Australia, Perth (GMT+08:00)</option>
                        <option value="Asia/Pyongyang">Asia, Pyongyang (GMT+08:30)</option>
                        <option value="Australia/Eucla">Australia, Eucla (GMT+08:45)</option>
                        <option value="Asia/Chita">Asia, Chita (GMT+09:00)</option>
                        <option value="Asia/Choibalsan">Asia, Choibalsan (GMT+09:00)</option>
                        <option value="Asia/Dili">Asia, Dili (GMT+09:00)</option>
                        <option value="Asia/Jayapura">Asia, Jayapura (GMT+09:00)</option>
                        <option value="Asia/Khandyga">Asia, Khandyga (GMT+09:00)</option>
                        <option value="Asia/Seoul">Asia, Seoul (GMT+09:00)</option>
                        <option value="Asia/Tokyo">Asia, Tokyo (GMT+09:00)</option>
                        <option value="Asia/Ulaanbaatar">Asia, Ulaanbaatar (GMT+09:00)</option>
                        <option value="Asia/Yakutsk">Asia, Yakutsk (GMT+09:00)</option>
                        <option value="Pacific/Palau">Pacific, Palau (GMT+09:00)</option>
                        <option value="Australia/Adelaide">Australia, Adelaide (GMT+09:30)</option>
                        <option value="Australia/Broken_Hill">Australia, Broken Hill (GMT+09:30)
                        </option>
                        <option value="Australia/Darwin">Australia, Darwin (GMT+09:30)</option>
                        <option value="Antarctica/DumontDUrville">Antarctica, DumontDUrville
                            (GMT+10:00)
                        </option>
                        <option value="Asia/Ust-Nera">Asia, Ust-Nera (GMT+10:00)</option>
                        <option value="Asia/Vladivostok">Asia, Vladivostok (GMT+10:00)</option>
                        <option value="Australia/Brisbane">Australia, Brisbane (GMT+10:00)</option>
                        <option value="Australia/Currie">Australia, Currie (GMT+10:00)</option>
                        <option value="Australia/Hobart">Australia, Hobart (GMT+10:00)</option>
                        <option value="Australia/Lindeman">Australia, Lindeman (GMT+10:00)</option>
                        <option value="Australia/Melbourne">Australia, Melbourne (GMT+10:00)
                        </option>
                        <option value="Australia/Sydney">Australia, Sydney (GMT+10:00)</option>
                        <option value="Pacific/Chuuk">Pacific, Chuuk (GMT+10:00)</option>
                        <option value="Pacific/Guam">Pacific, Guam (GMT+10:00)</option>
                        <option value="Pacific/Port_Moresby">Pacific, Port Moresby (GMT+10:00)
                        </option>
                        <option value="Pacific/Saipan">Pacific, Saipan (GMT+10:00)</option>
                        <option value="Australia/Lord_Howe">Australia, Lord Howe (GMT+10:30)
                        </option>
                        <option value="Antarctica/Casey">Antarctica, Casey (GMT+11:00)</option>
                        <option value="Antarctica/Macquarie">Antarctica, Macquarie (GMT+11:00)
                        </option>
                        <option value="Asia/Magadan">Asia, Magadan (GMT+11:00)</option>
                        <option value="Asia/Sakhalin">Asia, Sakhalin (GMT+11:00)</option>
                        <option value="Asia/Srednekolymsk">Asia, Srednekolymsk (GMT+11:00)</option>
                        <option value="Pacific/Bougainville">Pacific, Bougainville (GMT+11:00)
                        </option>
                        <option value="Pacific/Efate">Pacific, Efate (GMT+11:00)</option>
                        <option value="Pacific/Guadalcanal">Pacific, Guadalcanal (GMT+11:00)
                        </option>
                        <option value="Pacific/Kosrae">Pacific, Kosrae (GMT+11:00)</option>
                        <option value="Pacific/Norfolk">Pacific, Norfolk (GMT+11:00)</option>
                        <option value="Pacific/Noumea">Pacific, Noumea (GMT+11:00)</option>
                        <option value="Pacific/Pohnpei">Pacific, Pohnpei (GMT+11:00)</option>
                        <option value="Antarctica/McMurdo">Antarctica, McMurdo (GMT+12:00)</option>
                        <option value="Asia/Anadyr">Asia, Anadyr (GMT+12:00)</option>
                        <option value="Asia/Kamchatka">Asia, Kamchatka (GMT+12:00)</option>
                        <option value="Pacific/Auckland">Pacific, Auckland (GMT+12:00)</option>
                        <option value="Pacific/Fiji">Pacific, Fiji (GMT+12:00)</option>
                        <option value="Pacific/Funafuti">Pacific, Funafuti (GMT+12:00)</option>
                        <option value="Pacific/Kwajalein">Pacific, Kwajalein (GMT+12:00)</option>
                        <option value="Pacific/Majuro">Pacific, Majuro (GMT+12:00)</option>
                        <option value="Pacific/Nauru">Pacific, Nauru (GMT+12:00)</option>
                        <option value="Pacific/Tarawa">Pacific, Tarawa (GMT+12:00)</option>
                        <option value="Pacific/Wake">Pacific, Wake (GMT+12:00)</option>
                        <option value="Pacific/Wallis">Pacific, Wallis (GMT+12:00)</option>
                        <option value="Pacific/Chatham">Pacific, Chatham (GMT+12:45)</option>
                        <option value="Pacific/Apia">Pacific, Apia (GMT+13:00)</option>
                        <option value="Pacific/Enderbury">Pacific, Enderbury (GMT+13:00)</option>
                        <option value="Pacific/Fakaofo">Pacific, Fakaofo (GMT+13:00)</option>
                        <option value="Pacific/Tongatapu">Pacific, Tongatapu (GMT+13:00)</option>
                        <option value="Pacific/Kiritimati">Pacific, Kiritimati (GMT+14:00)</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label>{{ __('backend.dateFormat') }} : </label>
                <select name="date_format" class="form-control select2 select2-hidden-accessible" ui-jp="select2"
                        ui-options="{theme: 'bootstrap'}">
                    <option value="Y-m-d" {{ (env("DATE_FORMAT","Y-m-d")=="Y-m-d")?"selected":"" }}>Y-m-d</option>
                    <option value="d-m-Y" {{ (env("DATE_FORMAT","Y-m-d")=="d-m-Y")?"selected":"" }}>d-m-Y</option>
                    <option value="m-d-Y" {{ (env("DATE_FORMAT","Y-m-d")=="m-d-Y")?"selected":"" }}>m-d-Y</option>
                    <option value="d/m/Y" {{ (env("DATE_FORMAT","Y-m-d")=="d/m/Y")?"selected":"" }}>d/m/Y</option>
                    <option value="m/d/Y" {{ (env("DATE_FORMAT","Y-m-d")=="m/d/Y")?"selected":"" }}>m/d/Y</option>
                    <option value="d.m.Y" {{ (env("DATE_FORMAT","Y-m-d")=="d.m.Y")?"selected":"" }}>d.m.Y</option>
                    <option value="m.d.Y" {{ (env("DATE_FORMAT","Y-m-d")=="m.d.Y")?"selected":"" }}>m.d.Y</option>

                </select>
            </div>
            <div class="col-sm-6">
                <label>{{ __('backend.calendarFirstDay') }} : </label>
                <select name="first_day_of_week" class="form-control select2 select2-hidden-accessible" ui-jp="select2"
                        ui-options="{theme: 'bootstrap'}">
                    @foreach( __('backend.daysName') as $key=>$dayName)
                    <option value="{{ $key }}" {{ (env("FIRST_DAY_OF_WEEK",0)==$key)?"selected":"" }}>{{ $dayName }}</option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="m-t-2">
            <h5>{{ __('backend.languages') }}</h5>
            <div class="box">
                <table class="table table-striped b-t">
                    <thead class="dker">
                    <tr>
                        <th>{{ __('backend.languageTitle') }}</th>
                        <th class="text-center">{{ __('backend.languageCode') }}</th>
                        <th class="text-center">{{ __('backend.languageDirection') }}</th>
                        <th class="text-center">{{ __('backend.status') }}</th>
                        <th class="text-center">{{ __('backend.options') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Languages as $Language)
                        <tr>
                            <td>
                                @if($Language->icon !="")
                                    <img
                                        src="{{ asset('assets/dashboard/images/flags/'.$Language->icon.".svg") }}"
                                        alt="" class="w-20">
                                @endif
                                &nbsp; {{ $Language->title }}</td>
                            <td class="text-center">{{ $Language->code }}</td>
                            <td class="text-center">{{ $Language->direction }}</td>
                            <td class="text-center"><i
                                    class="fa {{ ($Language->status==1) ? "fa-check text-success":"fa-times text-danger" }} inline"></i>
                            </td>
                            <td class="text-center">
                                @if(@Auth::user()->permissionsGroup->edit_status)
                                    <button type="button" class="btn btn-sm success"
                                            data-toggle="modal"
                                            data-target="#edit_language_{{ $Language->id }}">
                                        <small><i
                                                class="material-icons">&#xe3c9;</i> {{ __('backend.edit') }}
                                        </small>
                                    </button>
                                @endif
                                @if(count($Languages) >1)
                                    @if(@Auth::user()->permissionsGroup->delete_status)
                                        <button type="button" class="btn btn-sm warning"
                                                data-toggle="modal"
                                                data-target="#delete_language_{{ $Language->id }}"
                                                ui-toggle-class="bounce"
                                                ui-target="#animate">
                                            <small><i
                                                    class="material-icons">&#xe872;</i> {{ __('backend.delete') }}
                                            </small>
                                        </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn primary" data-toggle="modal"
                    data-target="#add_language">
                <i class="material-icons">&#xe145;</i> {{ __('backend.addNewLanguage') }}
            </button>
            <a class="btn info " target="_blank"
               href="{{ url(env('BACKEND_PATH').'/webmaster/translations') }}">
                <i class="material-icons">&#xe8e2;</i> {{ __('backend.updateTranslation') }}
            </a>
        </div>
    </div>
</div>
