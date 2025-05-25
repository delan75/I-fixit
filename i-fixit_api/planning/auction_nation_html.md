<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    <meta name="theme-color" content="#d92027" />
    <title>Auction Nation - Online Listings</title>
    <link rel="stylesheet" type="text/css" href="/Content/threesixy/styles/threesixty.css">
    <link rel="stylesheet" type="text/css" href="/content/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/content/skeleton.css" />
    <link rel="stylesheet" type="text/css" href="/content/Site.css" />

    <script src="/scripts/modernizr-2.8.3.js"></script>
    <script src="/scripts/jquery-3.3.1.js"></script>
    <script src="/scripts/jquery.validate.js"></script>

<script src="/scripts/signalr/signalr.min.js"></script>

    <script src="/Scripts/signalr.liveauction.js?v=5cyqVTZlOdxA3pSlKCivxbOXD26ZkzqBUxaURmEcxgI"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/Content/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="/content/uploadStyle.css" />
    <base href="/" />
  

    <script type="text/javascript">!function(T,l,y){var S=T.location,u="script",k="instrumentationKey",D="ingestionendpoint",C="disableExceptionTracking",E="ai.device.",I="toLowerCase",b="crossOrigin",w="POST",e="appInsightsSDK",t=y.name||"appInsights";(y.name||T[e])&&(T[e]=t);var n=T[t]||function(d){var g=!1,f=!1,m={initialize:!0,queue:[],sv:"4",version:2,config:d};function v(e,t){var n={},a="Browser";return n[E+"id"]=a[I](),n[E+"type"]=a,n["ai.operation.name"]=S&&S.pathname||"_unknown_",n["ai.internal.sdkVersion"]="javascript:snippet_"+(m.sv||m.version),{time:function(){var e=new Date;function t(e){var t=""+e;return 1===t.length&&(t="0"+t),t}return e.getUTCFullYear()+"-"+t(1+e.getUTCMonth())+"-"+t(e.getUTCDate())+"T"+t(e.getUTCHours())+":"+t(e.getUTCMinutes())+":"+t(e.getUTCSeconds())+"."+((e.getUTCMilliseconds()/1e3).toFixed(3)+"").slice(2,5)+"Z"}(),iKey:e,name:"Microsoft.ApplicationInsights."+e.replace(/-/g,"")+"."+t,sampleRate:100,tags:n,data:{baseData:{ver:2}}}}var h=d.url||y.src;if(h){function a(e){var t,n,a,i,r,o,s,c,p,l,u;g=!0,m.queue=[],f||(f=!0,t=h,s=function(){var e={},t=d.connectionString;if(t)for(var n=t.split(";"),a=0;a<n.length;a++){var i=n[a].split("=");2===i.length&&(e[i[0][I]()]=i[1])}if(!e[D]){var r=e.endpointsuffix,o=r?e.location:null;e[D]="https://"+(o?o+".":"")+"dc."+(r||"services.visualstudio.com")}return e}(),c=s[k]||d[k]||"",p=s[D],l=p?p+"/v2/track":config.endpointUrl,(u=[]).push((n="SDK LOAD Failure: Failed to load Application Insights SDK script (See stack for details)",a=t,i=l,(o=(r=v(c,"Exception")).data).baseType="ExceptionData",o.baseData.exceptions=[{typeName:"SDKLoadFailed",message:n.replace(/\./g,"-"),hasFullStack:!1,stack:n+"\nSnippet failed to load ["+a+"] -- Telemetry is disabled\nHelp Link: https://go.microsoft.com/fwlink/?linkid=2128109\nHost: "+(S&&S.pathname||"_unknown_")+"\nEndpoint: "+i,parsedStack:[]}],r)),u.push(function(e,t,n,a){var i=v(c,"Message"),r=i.data;r.baseType="MessageData";var o=r.baseData;return o.message='AI (Internal): 99 message:"'+("SDK LOAD Failure: Failed to load Application Insights SDK script (See stack for details) ("+n+")").replace(/\"/g,"")+'"',o.properties={endpoint:a},i}(0,0,t,l)),function(e,t){if(JSON){var n=T.fetch;if(n&&!y.useXhr)n(t,{method:w,body:JSON.stringify(e),mode:"cors"});else if(XMLHttpRequest){var a=new XMLHttpRequest;a.open(w,t),a.setRequestHeader("Content-type","application/json"),a.send(JSON.stringify(e))}}}(u,l))}function i(e,t){f||setTimeout(function(){!t&&m.core||a()},500)}var e=function(){var n=l.createElement(u);n.src=h;var e=y[b];return!e&&""!==e||"undefined"==n[b]||(n[b]=e),n.onload=i,n.onerror=a,n.onreadystatechange=function(e,t){"loaded"!==n.readyState&&"complete"!==n.readyState||i(0,t)},n}();y.ld<0?l.getElementsByTagName("head")[0].appendChild(e):setTimeout(function(){l.getElementsByTagName(u)[0].parentNode.appendChild(e)},y.ld||0)}try{m.cookie=l.cookie}catch(p){}function t(e){for(;e.length;)!function(t){m[t]=function(){var e=arguments;g||m.queue.push(function(){m[t].apply(m,e)})}}(e.pop())}var n="track",r="TrackPage",o="TrackEvent";t([n+"Event",n+"PageView",n+"Exception",n+"Trace",n+"DependencyData",n+"Metric",n+"PageViewPerformance","start"+r,"stop"+r,"start"+o,"stop"+o,"addTelemetryInitializer","setAuthenticatedUserContext","clearAuthenticatedUserContext","flush"]),m.SeverityLevel={Verbose:0,Information:1,Warning:2,Error:3,Critical:4};var s=(d.extensionConfig||{}).ApplicationInsightsAnalytics||{};if(!0!==d[C]&&!0!==s[C]){method="onerror",t(["_"+method]);var c=T[method];T[method]=function(e,t,n,a,i){var r=c&&c(e,t,n,a,i);return!0!==r&&m["_"+method]({message:e,url:t,lineNumber:n,columnNumber:a,error:i}),r},d.autoExceptionInstrumented=!0}return m}(y.cfg);(T[t]=n).queue&&0===n.queue.length&&n.trackPageView({})}(window,document,{
src: "https://az416426.vo.msecnd.net/scripts/b/ai.2.min.js",
cfg: { 
    connectionString: 'InstrumentationKey=41901412-d296-451f-8c15-7bbbf9d56147;IngestionEndpoint=https://southafricanorth-1.in.applicationinsights.azure.com/;LiveEndpoint=https://southafricanorth.livediagnostics.monitor.azure.com/;ApplicationId=3dcc2ccf-fd87-488d-a97a-76203061ec8a'
}});
    </script>
</head>
<head>
    <style>
        #cookieNotice.display-right {
            right: 30px;
            bottom: 30px;
            max-width: 395px;
        }

        #cookieNotice.light {
            background-color: #fff;
            background-color: var(--cookieNoticeProLight);
            color: #393d4d;
            color: var(--cookieNoticeProDark);
        }

        #cookieNotice {
            box-sizing: border-box;
            position: fixed;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 6px 6px rgb(0 0 0 / 25%);
            font-family: inherit;
            z-index: 999997;
        }

            #cookieNotice #closeIcon {
                width: 20px;
                height: 20px;
                cursor: pointer;
                color: #bfb9b9;
                overflow: hidden;
                opacity: .85;
                z-index: 999999;
                position: absolute;
                top: 0;
                right: 0;
                background: url(../images/close-icon.svg) 0 0 / 20px 20px no-repeat;
            }

            #cookieNotice * {
                margin: 0;
                padding: 0;
                text-decoration: none;
                list-style: none;
                box-sizing: border-box;
            }

            #cookieNotice .title-wrap {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
                background: url(../images/cookie-icon.svg) 0 0 / 40px 40px no-repeat;
                padding-left: 45px;
                height: 40px;
            }

                #cookieNotice .title-wrap svg {
                    margin-right: 10px;
                }

            #cookieNotice h4 {
                font-family: inherit;
                font-weight: 700;
                font-size: 18px;
            }

            #cookieNotice.light p, #cookieNotice.light ul {
                color: #393d4d;
                color: var(--cookieNoticeProDark);
            }

            #cookieNotice p, #cookieNotice ul {
                font-size: 14px;
                margin-bottom: 20px;
            }

            #cookieNotice .btn-wrap {
                display: flex;
                flex-direction: row;
                font-weight: 700;
                justify-content: center;
                margin: 0 -5px 0 -5px;
                flex-wrap: wrap;
            }

                #cookieNotice .btn-wrap button {
                    flex-grow: 1;
                    padding: 0 7px;
                    margin: 0 5px 10px 5px;
                    border-radius: 20px;
                    cursor: pointer;
                    white-space: nowrap;
                    min-width: 130px;
                    line-height: 36px;
                    border: none;
                    font-family: inherit;
                    font-size: 16px;
                    transition: box-shadow .3s;
                }

            #cookieNotice button {
                outline: 0;
                border: none;
                appearance: none;
                -webkit-appearance: none;
                appearance: none;
            }

            #cookieNotice .btn-wrap button:hover {
                transition: box-shadow .4s cubic-bezier(.25,.8,.25,1),transform .4s cubic-bezier(.25,.8,.25,1);
                box-shadow: 0 2px 5px 0 rgb(0 0 0 / 30%);
                transform: translate3d(0,-1px,0);
            }

        .btn-primary {
            color: #ffffff;
            background: #115cfa;
            border: 1px solid #115cfa;
        }
    </style>

  

</head>
<body>

   



    <div class="header sticky">
        <div class="nav-bar">
            <div class="container" style="max-width:1200px">
                <div class="left-nav">
                    <a class="site-logo" href="/"><img alt="Auction Nation" src="/Content/Images/logo.png" /></a>
                    <div class="mobile-btn"><span></span><span></span><span></span></div>
                    <ul class="main-menu">
                        <li><a href="/">Home</a></li>
                        <li><a href="/">Live Auctions</a></li>
                        <li><a href="/Listings/BuyNow">Buy Now</a></li>
                        <li><a href="/Listings/Timed">Timed Auctions</a></li>
                        <li><a href="/Listings/Tender">Tenders</a></li>
                        <li><a href="https://sellyourdamagedcar.co.za/">Sell</a></li>
                        <li><a href="/Page/Contact">Contact Us</a></li>
                        <li><a href="/Page/FAQ">FAQ</a></li>
                    </ul>
                </div>
                    <div class="right-nav">
                        <ul>
                            <li>
                                <a id="login-btn" class="lite-btn" href="/Account/Login">
                                    Login
                                </a>
                            </li>
                            <li>
                                <a class="red lite-btn" href="/Account/Login">
                                    Create Account
                                </a>
                            </li>
                        </ul>
                        <div class="login-menu">
                            <h2>Login</h2>
                            <form id="login-modal" class="login-ajax">
                                <input type="email" placeholder="Email" name="email" />
                                <input type="password" placeholder="Password" name="password" />
                                <a href="/Account/ForgotPassword" class="forgot-link">Forgot password</a>
                                <button class="red flat-btn small">Login</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>



    <div class="page-body">
        
<div class="title banner">
    <div class="container">
        <h1>Live Auctions</h1>
    </div>
</div>

    <div class="container">
        <div class="auction-title">
            <b>Online Auction</b> - <span class="lots">200 Lots</span>
        </div>
    </div>
    <div class="diamond-corner">
        <div class="container padding bottom">

                <form action="/Listings/Auction" method="get" id="filter-bar">
                    <table class="filter-table">
                        <tr>
                            <th>
                                Make
                            </th>
                            <td>
                                <select class="filter-option" id="make" name="make">
                                    <option>Select</option>
                                        <option value="VOLKSWAGEN">VOLKSWAGEN</option>
                                        <option value="TOYOTA">TOYOTA</option>
                                        <option value="HYUNDAI">HYUNDAI</option>
                                        <option value="FIAT">FIAT</option>
                                        <option value="FORD">FORD</option>
                                        <option value="CHEVROLET">CHEVROLET</option>
                                        <option value="SUZUKI">SUZUKI</option>
                                        <option value="KIA">KIA</option>
                                        <option value="BMW">BMW</option>
                                        <option value="ISUZU">ISUZU</option>
                                        <option value="MERCEDES-BENZ">MERCEDES-BENZ</option>
                                        <option value="OPEL">OPEL</option>
                                        <option value="NISSAN">NISSAN</option>
                                        <option value="AUDI">AUDI</option>
                                        <option value="HONDA">HONDA</option>
                                        <option value="RENAULT">RENAULT</option>
                                        <option value="DATSUN">DATSUN</option>
                                        <option value="MG">MG</option>
                                        <option value="PEUGEOT">PEUGEOT</option>
                                        <option value="VOLVO">VOLVO</option>
                                        <option value="LAND ROVER">LAND ROVER</option>
                                        <option value="MAHINDRA">MAHINDRA</option>
                                        <option value="JEEP">JEEP</option>
                                        <option value="SSANG YONG">SSANG YONG</option>
                                        <option value="MINI">MINI</option>
                                        <option value="CHERY">CHERY</option>
                                        <option value="LEXUS">LEXUS</option>
                                        <option value="ALFA ROMEO">ALFA ROMEO</option>
                                        <option value="Volvo">Volvo</option>
                                        <option value="PROTON">PROTON</option>
                                        <option value="SUBARU">SUBARU</option>
                                </select>
                            </td>
                            <th>
                                Model
                            </th>
                            <td>
                                <select class="filter-option" name="model">
                                    <option>Select</option>
                                        <option value="VW24X-POLO">VW24X-POLO</option>
                                        <option value="YARIS">YARIS</option>
                                        <option value="YARIS T3 A/C 5DR (INTRO 2005-10)">YARIS T3 A/C 5DR (INTRO 2005-10)</option>
                                        <option value="GRAND I10">GRAND I10</option>
                                        <option value="500 1.2">500 1.2</option>
                                        <option value="IKON 1.6 AMBIENTE (INTRO 2009-02)">IKON 1.6 AMBIENTE (INTRO 2009-02)</option>
                                        <option value="UNO 1.2 VAN F/C P/V">UNO 1.2 VAN F/C P/V</option>
                                        <option value="AVEO">AVEO</option>
                                        <option value="POLO 1.0 TSI COMFORTLINE">POLO 1.0 TSI COMFORTLINE</option>
                                        <option value="S-PRESSO 1.0 GL&#x2B;">S-PRESSO 1.0 GL&#x2B;</option>
                                        <option value="STARLET  A/T">STARLET  A/T</option>
                                        <option value="BANTAM 1.3I XL A/C P/U S/C (INTRO 2006-05)">BANTAM 1.3I XL A/C P/U S/C (INTRO 2006-05)</option>
                                        <option value="POLO 1.6">POLO 1.6</option>
                                        <option value="AVEO 1.5 5DR">AVEO 1.5 5DR</option>
                                        <option value="PICANTO 1.2 EX A/T">PICANTO 1.2 EX A/T</option>
                                        <option value="GETZ">GETZ</option>
                                        <option value="ELANTRA">ELANTRA</option>
                                        <option value="GOLF">GOLF</option>
                                        <option value="FIESTA 1.6 TDCi AMBIENTE 5Dr">FIESTA 1.6 TDCi AMBIENTE 5Dr</option>
                                        <option value="I20 1.6 (INTRO 2009-06)">I20 1.6 (INTRO 2009-06)</option>
                                        <option value="GRAND I10 BA">GRAND I10 BA</option>
                                        <option value="GRAND VITARA V6">GRAND VITARA V6</option>
                                        <option value="GOLF VII">GOLF VII</option>
                                        <option value="IKON">IKON</option>
                                        <option value="3 SERIES SEDAN">3 SERIES SEDAN</option>
                                        <option value="COROLLA [09/1">COROLLA [09/1</option>
                                        <option value="FIGO">FIGO</option>
                                        <option value="KB 250Dc LE LWB P/U S/C">KB 250Dc LE LWB P/U S/C</option>
                                        <option value="C230">C230</option>
                                        <option value="YARIS T3 SPIRIT 5DR">YARIS T3 SPIRIT 5DR</option>
                                        <option value="ML 320 CDI">ML 320 CDI</option>
                                        <option value="ZAFIRA">ZAFIRA</option>
                                        <option value="6 SERIES">6 SERIES</option>
                                        <option value="FOCUS">FOCUS</option>
                                        <option value="CORSA CLASSIC 1.7 DTI ELEGANCE">CORSA CLASSIC 1.7 DTI ELEGANCE</option>
                                        <option value="5 SERIES SEDAN">5 SERIES SEDAN</option>
                                        <option value="ALMERA 1.5 AC">ALMERA 1.5 AC</option>
                                        <option value="CERATO">CERATO</option>
                                        <option value="A4 1.8T AMBITION MULTITRONIC (B8) (52008  12013)">A4 1.8T AMBITION MULTITRONIC (B8) (52008  12013)</option>
                                        <option value="HILUX">HILUX</option>
                                        <option value="BALLADE">BALLADE</option>
                                        <option value="RIO 1.4 4DR (INTRO 2005-10)">RIO 1.4 4DR (INTRO 2005-10)</option>
                                        <option value="FIESTA">FIESTA</option>
                                        <option value="IX35">IX35</option>
                                        <option value="I10">I10</option>
                                        <option value="Scenic Ii Expression 1.9 DCI">Scenic Ii Expression 1.9 DCI</option>
                                        <option value="POLO">POLO</option>
                                        <option value="NP 200">NP 200</option>
                                        <option value="SX4 2.0">SX4 2.0</option>
                                        <option value="ECOSPORT">ECOSPORT</option>
                                        <option value="FORTUNER">FORTUNER</option>
                                        <option value="VW 357-CADDY DEL">VW 357-CADDY DEL</option>
                                        <option value="COROLLA QUEST PLUS 1.8 CVT">COROLLA QUEST PLUS 1.8 CVT</option>
                                        <option value="W221">W221</option>
                                        <option value="[3 SERIES] (G20)">[3 SERIES] (G20)</option>
                                        <option value="NP200">NP200</option>
                                        <option value="W204">W204</option>
                                        <option value="NP300 HARDBODY">NP300 HARDBODY</option>
                                        <option value="GO 1.2 LUX">GO 1.2 LUX</option>
                                        <option value="GRAND i10">GRAND i10</option>
                                        <option value="VW 25X - POLO VIVO">VW 25X - POLO VIVO</option>
                                        <option value="MG ZS 1.5 COM A/T">MG ZS 1.5 COM A/T</option>
                                        <option value="PARTNER 1.6 FC PV">PARTNER 1.6 FC PV</option>
                                        <option value="s40">s40</option>
                                        <option value="ALMERA 1.5 ACENTA">ALMERA 1.5 ACENTA</option>
                                        <option value="ACCENT">ACCENT</option>
                                        <option value="COROLLA CROSS 1.8 XS HYBRID (INTRO 2021-09)">COROLLA CROSS 1.8 XS HYBRID (INTRO 2021-09)</option>
                                        <option value="E200">E200</option>
                                        <option value="Figo/AMBIENTE">Figo/AMBIENTE</option>
                                        <option value="SWIFT">SWIFT</option>
                                        <option value="FREELANDER II 2.2 TD4 HSE A/T">FREELANDER II 2.2 TD4 HSE A/T</option>
                                        <option value="VN AMAROK">VN AMAROK</option>
                                        <option value="MURANO">MURANO</option>
                                        <option value="HONDA JAZZ 1.3 LX M/T">HONDA JAZZ 1.3 LX M/T</option>
                                        <option value="XUV">XUV</option>
                                        <option value="RANGER 2.2TDCi XL PU DC">RANGER 2.2TDCi XL PU DC</option>
                                        <option value="BALENO">BALENO</option>
                                        <option value="MAGNITE ACENTA">MAGNITE ACENTA</option>
                                        <option value="HILUX 2.4 GD PU SC">HILUX 2.4 GD PU SC</option>
                                        <option value="VW 250 - POLO">VW 250 - POLO</option>
                                        <option value="GRAND CHEROKEE 5.7 V8">GRAND CHEROKEE 5.7 V8</option>
                                        <option value="COROLLA">COROLLA</option>
                                        <option value="RIO">RIO</option>
                                        <option value="QASHQAI 1.2T MIDNIGHT CVT">QASHQAI 1.2T MIDNIGHT CVT</option>
                                        <option value="ALMERA">ALMERA</option>
                                        <option value="FRONX 1.5 GL">FRONX 1.5 GL</option>
                                        <option value="CORSA">CORSA</option>
                                        <option value="C30">C30</option>
                                        <option value="JIMNY">JIMNY</option>
                                        <option value="TUCSON">TUCSON</option>
                                        <option value="GRAND CRETA">GRAND CRETA</option>
                                        <option value="KORANDO">KORANDO</option>
                                        <option value="T-ROC 1.4 TSI">T-ROC 1.4 TSI</option>
                                        <option value="CELERIO">CELERIO</option>
                                        <option value="DOBLO CARGO 1.3 MJT FC PV">DOBLO CARGO 1.3 MJT FC PV</option>
                                        <option value="VITO">VITO</option>
                                        <option value="SORENTO  XM F/L">SORENTO  XM F/L</option>
                                        <option value="KB">KB</option>
                                        <option value="EXPERT 2.0 HDI L1H1 F/C P/V (INTRO 2008-09)">EXPERT 2.0 HDI L1H1 F/C P/V (INTRO 2008-09)</option>
                                        <option value="MINI COUNTRYMAN">MINI COUNTRYMAN</option>
                                        <option value="KOMPRESSOR">KOMPRESSOR</option>
                                        <option value="A4">A4</option>
                                        <option value="JETTA VI 1.4 TSI COMFORTLINE">JETTA VI 1.4 TSI COMFORTLINE</option>
                                        <option value="UTILITY">UTILITY</option>
                                        <option value="RANGER">RANGER</option>
                                        <option value="ETIOS">ETIOS</option>
                                        <option value="AU 48X-A5 S/BACK">AU 48X-A5 S/BACK</option>
                                        <option value="STARLET">STARLET</option>
                                        <option value="ECOSPORT 1.5TiVCT TITANIUM A/T">ECOSPORT 1.5TiVCT TITANIUM A/T</option>
                                        <option value="NP300">NP300</option>
                                        <option value="530">530</option>
                                        <option value="K2700">K2700</option>
                                        <option value="HARDBODY NP300">HARDBODY NP300</option>
                                        <option value="CADDY MAXI CREWBUS 2.0 TDi">CADDY MAXI CREWBUS 2.0 TDi</option>
                                        <option value="KONA">KONA</option>
                                        <option value="Ranger/XLS">Ranger/XLS</option>
                                        <option value="TERRITORY">TERRITORY</option>
                                        <option value="COROLLA [2014] 1.8 QUEST PLUS">COROLLA [2014] 1.8 QUEST PLUS</option>
                                        <option value="SUPER CARRY">SUPER CARRY</option>
                                        <option value="320i (E90)">320i (E90)</option>
                                        <option value="PARTNER">PARTNER</option>
                                        <option value="X164">X164</option>
                                        <option value="QQ 0,8 I">QQ 0,8 I</option>
                                        <option value="KADETT">KADETT</option>
                                        <option value="CADDY4 CREWBUS 1.6i  (7 SEAT)">CADDY4 CREWBUS 1.6i  (7 SEAT)</option>
                                        <option value="TAZZ">TAZZ</option>
                                        <option value="NP200 1.6 A/C P/U S/C">NP200 1.6 A/C P/U S/C</option>
                                        <option value="SUPERCARRY">SUPERCARRY</option>
                                        <option value="3 SERIES">3 SERIES</option>
                                        <option value="GO">GO</option>
                                        <option value="UTILITY 1.4 SPORT PU SC">UTILITY 1.4 SPORT PU SC</option>
                                        <option value="W176 - A250">W176 - A250</option>
                                        <option value="RX 350 EX">RX 350 EX</option>
                                        <option value="750il">750il</option>
                                        <option value="GT">GT</option>
                                        <option value="W211">W211</option>
                                        <option value="CADDY F/C P/V">CADDY F/C P/V</option>
                                        <option value="S60 2.0T A/T">S60 2.0T A/T</option>
                                        <option value="A209">A209</option>
                                        <option value="PUNTO">PUNTO</option>
                                        <option value="CLIO IV 900T EXPRESSION 5Dr">CLIO IV 900T EXPRESSION 5Dr</option>
                                        <option value="ELANTRA AD">ELANTRA AD</option>
                                        <option value="CLIO IV 1.2T">CLIO IV 1.2T</option>
                                        <option value="ISUZU KB250D FLEETSIDE P/U S/C">ISUZU KB250D FLEETSIDE P/U S/C</option>
                                        <option value="AVANZA">AVANZA</option>
                                        <option value="SORENTO">SORENTO</option>
                                        <option value="BOLERO 2.5">BOLERO 2.5</option>
                                        <option value="306 2.0 CABRIOLET">306 2.0 CABRIOLET</option>
                                        <option value="AU   48X - A5">AU   48X - A5</option>
                                        <option value="KA">KA</option>
                                        <option value="VW 276 - T-ROC">VW 276 - T-ROC</option>
                                        <option value="SAVVY 1.2">SAVVY 1.2</option>
                                        <option value="COOPER">COOPER</option>
                                        <option value="POLO VIVO">POLO VIVO</option>
                                        <option value="IMPREZA">IMPREZA</option>
                                        <option value="TRIBER/LIFE">TRIBER/LIFE</option>
                                        <option value="TIIDA 1.6 VIS">TIIDA 1.6 VIS</option>
                                        <option value="A1 SPORTBACK 1.">A1 SPORTBACK 1.</option>
                                        <option value="HR-V 1.8 ELEGANCE">HR-V 1.8 ELEGANCE</option>
                                        <option value="CORSA LITE 1.4i">CORSA LITE 1.4i</option>
                                        <option value="A4 2.0T AMBITION (B8)">A4 2.0T AMBITION (B8)</option>
                                        <option value="NX 250 EX">NX 250 EX</option>
                                        <option value="PEGAS 1.4 LX">PEGAS 1.4 LX</option>
                                        <option value="FIGO 1.4 TDCi AMBIENTE(7/2010 - 11/2018)">FIGO 1.4 TDCi AMBIENTE(7/2010 - 11/2018)</option>
                                        <option value="I20">I20</option>
                                        <option value="VW 27X - POLO">VW 27X - POLO</option>
                                        <option value="VW  27X -  POLO">VW  27X -  POLO</option>
                                </select>
                            </td>
                            <th>
                                Location
                            </th>
                            <td>
                                <select class="filter-option" name="location">
                                    <option>Select</option>
                                        <option value="Auction Nation Centurion">Auction Nation Centurion</option>
                                        <option value="Auction Nation Cape Town">Auction Nation Cape Town</option>
                                        <option value="Auction Nation Durban Cornubia">Auction Nation Durban Cornubia</option>
                                        <option value="Auction Nation JHB R21">Auction Nation JHB R21</option>
                                        <option value="AN Polokwane">AN Polokwane</option>
                                        <option value="Auction Nation PE">Auction Nation PE</option>
                                        <option value="Auction Nation BFN">Auction Nation BFN</option>
                                        <option value="Auction Nation Middelburg">Auction Nation Middelburg</option>
                                        <option value="Auction Nation East London">Auction Nation East London</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Has&nbsp;Keys
                            </th>
                            <td>
                                <select class="filter-option" name="keys">
                                    <option value="">Yes/No</option>
                                    <option value="true">Yes</option>
                                    <option value="false">No</option>
                                </select>
                            </td>
                            <th>
                                Vehicle&nbsp;Starts
                            </th>
                            <td>
                                <select class="filter-option" name="starts">
                                    <option value="">Yes/No</option>
                                    <option value="true">Yes</option>
                                    <option value="false">No</option>
                                </select>
                            </td>
                            <th>
                                Vehicle Code
                            </th>
                            <td>
                                <select class="filter-option" name="code">
                                    <option value="">All</option>
                                    <option value="2">Code 2</option>
                                    <option value="3">Code 3</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="button" class="btn-sm btn-primary" value="Clear" onclick="ClearSearch()" />
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" value="true" name="ajax" />
                </form>




            <div class="list-of-vehicles" style="border-bottom: 1px solid #b5b5b5">
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218955">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007NeQ3C2AV/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VW24X-POLO
                                                </span>
                                            </div>
                                            <div class="stc-block fade">STC STATUS - NO</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>702634</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2004</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>351&#xA0;708 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>1</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218955"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218955"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218956">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007RI37r2AD/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>YARIS
                                                </span>
                                            </div>
                                            <div class="stc-block fade">STC STATUS - NO</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>834194</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2006</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>2</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218956"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218956"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218957">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007LOqce2AD/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>YARIS T3 A/C 5DR (INTRO 2005-10)
                                                </span>
                                            </div>
                                            <div class="stc-block fade">STC STATUS - NO</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>837371</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2008</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>270&#xA0;187 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>3</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218957"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218957"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/214995">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000074ehoo2AA/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GRAND I10
                                                </span>
                                            </div>
                                            <div class="stc-block fade">STC STATUS - NO</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>826200</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2024</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>18&#xA0;608 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>4</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/214995"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/214995"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218958">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007iRVaI2AW/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FIAT
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>500 1.2
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>839545</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FIAT</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>135&#xA0;666 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>5</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218958"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218958"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218959">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007dO9qP2AS/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>IKON 1.6 AMBIENTE (INTRO 2009-02)
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838963</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2015</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>197&#xA0;034 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>6</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218959"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218959"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218960">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007a0lLB2AY/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FIAT
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>UNO 1.2 VAN F/C P/V
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838119</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2008</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FIAT</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>175&#xA0;343 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>7</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Stolen/Recovered</th>
                                                        <td style="padding-left: 10px"><img src="/Content/Images/tick.png" alt="no" /></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218960"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218960"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218961">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007e63kB2AQ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>CHEVROLET
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>AVEO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838849</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2010</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>CHEVROLET</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>8</td>
                                            </tr>


                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218961"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218961"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218962">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007meli72AA/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>POLO 1.0 TSI COMFORTLINE
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>841454</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2018</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>166&#xA0;203 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>9</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218962"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218962"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218963">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000079jC3S2AU/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SUZUKI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>S-PRESSO 1.0 GL&#x2B;
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>828191</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2020</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SUZUKI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>81&#xA0;604 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>10</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218963"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218963"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218964">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000056kU0Q2AU/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>STARLET  A/T
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>787132</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2022</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>37&#xA0;132 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>11</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218964"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218964"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218965">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007c7JwC2AU/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>BANTAM 1.3I XL A/C P/U S/C (INTRO 2006-05)
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838618</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2008</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>368&#xA0;503 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>12</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218965"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218965"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218966">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007j9tcX2AQ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>POLO 1.6
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840068</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2004</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>313&#xA0;547 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>13</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218966"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218966"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218967">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006hwOTg2AM/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>CHEVROLET
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>AVEO 1.5 5DR
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>818218</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2007</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>CHEVROLET</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>61&#xA0;457 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>14</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218967"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218967"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218968">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Vqfmi2AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>KIA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>PICANTO 1.2 EX A/T
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>836330</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2012</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>KIA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>54&#xA0;362 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>15</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218968"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218968"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218969">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Csoj52AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GETZ
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>699138</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2008</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>196&#xA0;561 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>16</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218969"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218969"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218970">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007mbpJ22AI/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ELANTRA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>841009</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>1995</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>2&#xA0;621&#xA0;669 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>17</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218970"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218970"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218971">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007jkT1W2AU/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GOLF
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840377</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2014</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>107&#xA0;712 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>18</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218971"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218971"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218972">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007N3RSk2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>FIESTA 1.6 TDCi AMBIENTE 5Dr
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>832386</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2007</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>229&#xA0;302 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>19</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218972"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218972"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218973">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007cFZya2AG/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>I20 1.6 (INTRO 2009-06)
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>837534</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation PE</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>172&#xA0;356 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>20</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Service Book</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218973"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218973"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218974">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006XJ8Zs2AL/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VW24X-POLO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>813880</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2005</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>274&#xA0;833 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>21</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218974"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218974"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218975">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007VJAyB2AX/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GRAND I10 BA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>836118</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2015</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>25&#xA0;389 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>22</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218975"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218975"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218571">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007NbmrY2AR/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SUZUKI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GRAND VITARA V6
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>832765</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2010</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SUZUKI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>218&#xA0;614 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>23</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218571"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218571"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218976">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007VFFqF2AX/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GOLF VII
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>705970</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>117&#xA0;920 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>24</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218976"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218976"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218977">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007jpBEx2AM/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>IKON
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840467</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>232&#xA0;885 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>25</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218977"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218977"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218978">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007JsYKj2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>BMW
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>3 SERIES SEDAN
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>701177</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2005</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>BMW</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>270&#xA0;671 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>26</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218978"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218978"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218979">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007LKoF32AL/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>COROLLA [09/1
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>701566</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2000</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>378&#xA0;620 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>27</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218979"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218979"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/203746">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006Cm0h02AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>FIGO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>808006</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>301&#xA0;329 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>28</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/203746"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/203746"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218980">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007FKh8R2AT/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>ISUZU
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>KB 250Dc LE LWB P/U S/C
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829982</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2004</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>ISUZU</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>331&#xA0;342 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>29</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218980"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218980"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/216339">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007JwPHp2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MERCEDES-BENZ
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>C230
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>831428</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2002</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MERCEDES-BENZ</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>160&#xA0;829 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>30</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/216339"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/216339"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218981">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007S5HJo2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VW24X-POLO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>704597</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2006</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>151&#xA0;901 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>31</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218981"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218981"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218982">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007b7IYp2AM/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>YARIS T3 SPIRIT 5DR
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>837666</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2007</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>132&#xA0;393 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>32</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218982"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218982"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/217061">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007KWVxu2AH/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MERCEDES-BENZ
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ML 320 CDI
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>831516</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2007</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MERCEDES-BENZ</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation BFN</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>290&#xA0;906 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>33</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/217061"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/217061"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218983">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007cyT2e2AE/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>OPEL
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ZAFIRA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838209</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2006</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>OPEL</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>244&#xA0;007 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>34</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218983"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218983"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/216348">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007J1HdP2AV/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>BMW
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>6 SERIES
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>830964</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>BMW</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation BFN</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>424&#xA0;606 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>35</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/216348"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/216348"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218984">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007TFRv92AH/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>FOCUS
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>835346</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2017</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>180&#xA0;539 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>36</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218984"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218984"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218985">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007S1r0o2AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>OPEL
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>CORSA CLASSIC 1.7 DTI ELEGANCE
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>704476</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2004</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>OPEL</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation PE</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>37</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218985"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218985"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/202707">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006HZEA42AP/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>BMW
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>5 SERIES SEDAN
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>809507</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2009</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>BMW</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>38</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/202707"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/202707"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218986">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000076LbC32AK/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ALMERA 1.5 AC
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>826993</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>39</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218986"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218986"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/216346">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007ShB0W2AV/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>KIA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>CERATO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>835076</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2015</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>KIA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>257&#xA0;403 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>40</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/216346"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/216346"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218987">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007QDOGU2A5/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>AUDI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>A4 1.8T AMBITION MULTITRONIC (B8) (52008  12013)
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>833676</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2012</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>AUDI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>218&#xA0;731 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>41</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218987"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218987"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218988">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007ILeB52AL/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>HILUX
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>830412</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>312&#xA0;396 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>42</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218988"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218988"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/215247">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006BzZsX2AV/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HONDA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>BALLADE
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>807551</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2020</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HONDA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>53&#xA0;033 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>43</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/215247"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/215247"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218989">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007VKiIo2AL/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>KIA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>RIO 1.4 4DR (INTRO 2005-10)
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>836209</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2005</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>KIA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>265&#xA0;173 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>44</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218989"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218989"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218990">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Zwj6g2AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>FIESTA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>837396</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>147&#xA0;853 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>45</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218990"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218990"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218991">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006PWrAG2A1/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>IX35
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>811692</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2010</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>175&#xA0;497 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>46</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218991"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218991"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218992">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007ej93g2AA/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>I10
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838708</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2018</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>139&#xA0;757 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>47</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218992"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218992"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/206580">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006V9GcH2AV/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>RENAULT
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>Scenic Ii Expression 1.9 DCI
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>813097</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2005</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>RENAULT</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>39&#xA0;158 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>48</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/206580"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/206580"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218993">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007ShX3g2AF/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>POLO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>835077</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2018</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>104&#xA0;930 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>49</td>
                                            </tr>


                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218993"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218993"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/216371">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007CtEJK2A3/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>NP 200
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829316</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation BFN</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>222&#xA0;623 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>50</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/216371"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/216371"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218994">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007l3nfS2AQ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SUZUKI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>SX4 2.0
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840589</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2012</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SUZUKI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>241&#xA0;580 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>51</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218994"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218994"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218995">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Jrye02AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ECOSPORT
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>831360</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2017</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation BFN</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>162&#xA0;684 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>52</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218995"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218995"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/217607">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007OAbXG2A1/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>FIGO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>832983</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2020</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation PE</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>54&#xA0;364 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>53</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/217607"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/217607"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218996">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007G7HJs2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>FORTUNER
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>830110</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>77&#xA0;790 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>54</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218996"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218996"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/217565">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007VMuQD2A1/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VW 357-CADDY DEL
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>836172</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>366&#xA0;627 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>55</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/217565"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/217565"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218997">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Ncfnj2AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>COROLLA QUEST PLUS 1.8 CVT
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829949</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2023</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>56</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Stolen/Recovered</th>
                                                        <td style="padding-left: 10px"><img src="/Content/Images/tick.png" alt="no" /></td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218997"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218997"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218998">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007QueYm2AJ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>FIESTA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>834114</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2005</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>216&#xA0;967 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>57</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218998"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218998"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/208601">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006eSGRt2AO/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MERCEDES-BENZ
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>W221
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>816999</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2009</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MERCEDES-BENZ</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>308&#xA0;077 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>58</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/208601"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/208601"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218999">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007DXZFN2A5/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>BMW
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>[3 SERIES] (G20)
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829458</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2019</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>BMW</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Middelburg</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>116&#xA0;584 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>59</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218999"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218999"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/217062">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Kc7Ra2AJ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>NP200
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>831681</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation East London</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>203&#xA0;627 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>60</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/217062"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/217062"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219000">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Vvyyt2AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MERCEDES-BENZ
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>W204
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>836473</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2012</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MERCEDES-BENZ</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>194&#xA0;069 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>61</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219000"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219000"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219001">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007RH0Lm2AL/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>NP300 HARDBODY
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>834153</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>219&#xA0;389 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>62</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219001"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219001"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/215268">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006uvHws2AE/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>DATSUN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GO 1.2 LUX
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>822589</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2017</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>DATSUN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation PE</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>330&#xA0;907 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>63</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/215268"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/215268"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219002">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000072sbVo2AI/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GRAND i10
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>825361</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2025</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>567 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>64</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219002"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219002"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/217103">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007TrmrI2AR/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VW 25X - POLO VIVO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>835500</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2019</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>144&#xA0;973 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>65</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/217103"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/217103"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219003">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007FIgMh2AL/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MG
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>MG ZS 1.5 COM A/T
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829673</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2025</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MG</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>2&#xA0;074 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>66</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219003"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219003"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219004">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007RNaVv2AL/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>PEUGEOT
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>PARTNER 1.6 FC PV
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>834369</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2015</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>PEUGEOT</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>266&#xA0;025 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>67</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219004"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219004"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/216770">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007NZ10a2AD/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLVO
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>s40
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>832609</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2001</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLVO</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation BFN</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>261&#xA0;492 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>68</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/216770"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/216770"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219005">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000071aE8i2AE/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ALMERA 1.5 ACENTA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>825172</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2014</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>232&#xA0;294 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>69</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219005"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219005"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/217013">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Mz8fu2AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ECOSPORT
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>832321</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2015</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation East London</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>70</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/217013"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/217013"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219006">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007QBYla2AH/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ACCENT
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>833663</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Middelburg</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>228&#xA0;226 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>71</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219006"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219006"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219007">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000074hM7V2AU/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>COROLLA CROSS 1.8 XS HYBRID (INTRO 2021-09)
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>826299</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2023</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>37&#xA0;827 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>72</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219007"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219007"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/215193">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006tpE742AE/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MERCEDES-BENZ
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>E200
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>822065</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2014</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MERCEDES-BENZ</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>218&#xA0;962 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>73</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/215193"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/215193"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219008">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007KaGwB2AV/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>Figo/AMBIENTE
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>831634</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2014</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>99&#xA0;185 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>74</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219008"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219008"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219009">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007ExkUR2AZ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SUZUKI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>SWIFT
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829884</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2023</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SUZUKI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>11&#xA0;705 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>75</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219009"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219009"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219010">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007WROrW2AX/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>LAND ROVER
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>FREELANDER II 2.2 TD4 HSE A/T
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>836608</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2009</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>LAND ROVER</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>238&#xA0;502 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>76</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Service Book</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219010"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219010"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219011">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Ud63P2AR/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VN AMAROK
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>835608</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2022</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>59&#xA0;073 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>77</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219011"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219011"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/208457">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000064xpE52AI/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>MURANO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>805544</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2007</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>78</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/208457"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/208457"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219012">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000073xipl2AA/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HONDA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>HONDA JAZZ 1.3 LX M/T
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>825742</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2009</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HONDA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>178&#xA0;819 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>79</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219012"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219012"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/213512">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006uqvWN2AY/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MAHINDRA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>XUV
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>822480</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2025</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MAHINDRA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>2&#xA0;159 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>80</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/213512"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/213512"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219013">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007SfORM2A3/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>RANGER 2.2TDCi XL PU DC
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>835074</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2017</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>186&#xA0;565 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>81</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219013"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219013"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219014">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007BkaZe2AJ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SUZUKI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>BALENO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>832941</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2024</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SUZUKI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>82</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219014"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219014"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/215988">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006HaEIv2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>MAGNITE ACENTA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>790475</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2024</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>2&#xA0;831 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>83</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/215988"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/215988"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219015">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006zahoE2AQ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>HILUX 2.4 GD PU SC
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>824230</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>84</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219015"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219015"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219016">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007iWBkL2AW/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VW 250 - POLO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>839688</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>185&#xA0;124 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>85</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219016"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219016"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219017">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006sgYlj2AE/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>JEEP
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GRAND CHEROKEE 5.7 V8
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>821867</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>JEEP</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>210&#xA0;979 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>86</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219017"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219017"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219018">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007AU49N2AT/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>COROLLA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>828379</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2014</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>202&#xA0;404 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>87</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219018"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219018"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/216113">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006ZOrcM2AT/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>KIA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>RIO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>814809</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2022</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>KIA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>42&#xA0;660 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>88</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/216113"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/216113"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219019">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006hHhCy2AK/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>QASHQAI 1.2T MIDNIGHT CVT
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>818037</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>50&#xA0;372 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>89</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219019"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219019"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219020">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007iaCAg2AM/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ALMERA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>839724</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2019</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>150&#xA0;720 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>90</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219020"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219020"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219021">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000078EC2J2AW/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SUZUKI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>FRONX 1.5 GL
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>827695</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2024</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SUZUKI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>5&#xA0;982 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>91</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219021"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219021"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219022">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007ClDri2AF/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>OPEL
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>CORSA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829165</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2022</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>OPEL</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>45&#xA0;619 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>92</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219022"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219022"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/216968">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007JqUYG2A3/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLVO
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>C30
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>831304</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLVO</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>208&#xA0;176 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>93</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/216968"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/216968"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219023">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006ZO53R2AT/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SUZUKI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>JIMNY
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>814801</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SUZUKI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>44&#xA0;049 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>94</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219023"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219023"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219024">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007izuS32AI/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>TUCSON
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>839904</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2019</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>112&#xA0;341 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>95</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219024"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219024"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219025">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007HAOJS2A5/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>BMW
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>5 SERIES SEDAN
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>830188</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>BMW</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>214&#xA0;525 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>96</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219025"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219025"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219026">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006PScG12AL/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GRAND CRETA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>811561</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2022</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>61&#xA0;567 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>97</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219026"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219026"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/213053">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006qowhL2AQ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SSANG YONG
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>KORANDO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>821075</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2012</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SSANG YONG</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>292&#xA0;258 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>98</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/213053"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/213053"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219027">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006XynWO2AZ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>T-ROC 1.4 TSI
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>684094</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2023</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>66&#xA0;665 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>99</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219027"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219027"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219028">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007j5G6k2AE/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SUZUKI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>CELERIO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>839985</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2019</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SUZUKI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>162&#xA0;710 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>100</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219028"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219028"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219029">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006cxWmL2AU/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FIAT
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>DOBLO CARGO 1.3 MJT FC PV
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>816246</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FIAT</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>139&#xA0;692 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>101</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219029"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219029"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219030">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007E6qFE2AZ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GETZ
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829124</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2010</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>242&#xA0;884 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>102</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Service Book</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219030"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219030"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/217065">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000070ls9Z2AQ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MERCEDES-BENZ
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VITO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>824741</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MERCEDES-BENZ</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>67&#xA0;663 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>103</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/217065"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/217065"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219031">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007NipgN2AR/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ECOSPORT
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>832914</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2020</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>76&#xA0;196 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>104</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219031"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219031"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219032">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007ZxYuR2AV/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>NP300 HARDBODY
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>837430</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2019</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation East London</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>155&#xA0;075 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>105</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219032"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219032"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219033">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007eX9Mr2AK/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>KIA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>SORENTO  XM F/L
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838416</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>KIA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation BFN</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>214&#xA0;285 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>106</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219033"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219033"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219034">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007fNLom2AG/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>ISUZU
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>KB
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838840</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2018</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>ISUZU</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>247&#xA0;624 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>107</td>
                                            </tr>


                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219034"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219034"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/214296">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006siMnJ2AU/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>PEUGEOT
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>EXPERT 2.0 HDI L1H1 F/C P/V (INTRO 2008-09)
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>823716</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>PEUGEOT</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>168&#xA0;623 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>108</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/214296"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/214296"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/212468">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006mpluj2AA/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MINI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>MINI COUNTRYMAN
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>819783</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MINI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>109</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/212468"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/212468"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219035">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007fKVnE2AW/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MERCEDES-BENZ
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>KOMPRESSOR
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838796</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2010</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MERCEDES-BENZ</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation East London</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>287&#xA0;257 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>110</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219035"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219035"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219036">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006ftBVF2A2/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>AUDI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>A4
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>817306</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>AUDI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>141&#xA0;778 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>111</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219036"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219036"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219037">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007bOvyb2AC/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>JETTA VI 1.4 TSI COMFORTLINE
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>837844</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>137&#xA0;985 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>112</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Stolen/Recovered</th>
                                                        <td style="padding-left: 10px"><img src="/Content/Images/tick.png" alt="no" /></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219037"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219037"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219038">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000078H2IP2A0/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>CHEVROLET
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>UTILITY
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>827690</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>CHEVROLET</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>165&#xA0;939 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>113</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Service Book</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219038"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219038"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/216209">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007MBVyC2AX/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>RANGER
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>831969</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>70&#xA0;127 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>114</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/216209"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/216209"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219039">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007iffvR2AQ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ETIOS
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>839844</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2014</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>138&#xA0;675 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>115</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219039"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219039"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219040">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007WTjbx2AD/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VW24X-POLO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>706498</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2005</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>450&#xA0;827 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>116</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219040"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219040"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/213386">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000070rwg72AA/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>AUDI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>AU 48X-A5 S/BACK
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>824863</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2012</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>AUDI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation PE</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>117</td>
                                            </tr>


                                                    <tr>
                                                        <th>Stolen/Recovered</th>
                                                        <td style="padding-left: 10px"><img src="/Content/Images/tick.png" alt="no" /></td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/213386"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/213386"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/214308">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006lpblw2AA/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>STARLET
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>819346</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2024</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>118</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/214308"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/214308"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219041">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Cmd4c2AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ECOSPORT 1.5TiVCT TITANIUM A/T
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829178</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2015</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>128&#xA0;389 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>119</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219041"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219041"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219042">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007j8QBW2A2/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ACCENT
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840041</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2010</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>280&#xA0;334 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>120</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219042"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219042"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219043">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007N5VxR2AV/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>NP300
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>702252</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>281&#xA0;557 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>121</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219043"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219043"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219044">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007ejFoK2AU/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>COROLLA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838710</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>122</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Service Book</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219044"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219044"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/217572">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000058f3o12AA/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>BMW
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>530
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>787980</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2002</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>BMW</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>123</td>
                                            </tr>



                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/217572"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/217572"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219045">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007HXFzE2AX/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>HILUX
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>830232</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2019</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Middelburg</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>124</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219045"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219045"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219046">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007j8tEj2AI/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>KIA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>K2700
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840035</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>KIA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>220&#xA0;828 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>125</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219046"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219046"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219047">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Qjf002AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>HARDBODY NP300
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>833864</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2012</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>368&#xA0;185 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>126</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219047"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219047"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219048">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006XwWWm2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>CADDY MAXI CREWBUS 2.0 TDi
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>816885</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2017</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>281&#xA0;295 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>127</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219048"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219048"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/216870">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007MIFrQ2AX/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>KONA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>832156</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2020</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>42&#xA0;655 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>128</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/216870"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/216870"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219049">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007M4yXP2AZ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>Ranger/XLS
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>831930</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2015</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>159&#xA0;280 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>129</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219049"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219049"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219050">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007jRPkQ2AW/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>TERRITORY
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840171</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2006</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>221&#xA0;454 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>130</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219050"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219050"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219051">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006d0ILF2A2/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>COROLLA [2014] 1.8 QUEST PLUS
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>816368</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2020</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>77&#xA0;589 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>131</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219051"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219051"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219052">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007OujpE2AR/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SUZUKI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>SUPER CARRY
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>833316</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2020</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SUZUKI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>74&#xA0;365 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>132</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219052"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219052"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/217455">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007DbPh72AF/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>BMW
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>320i (E90)
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829549</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2006</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>BMW</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>158&#xA0;822 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>133</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/217455"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/217455"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219053">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007F0wt32AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>RANGER
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829872</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Middelburg</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>177&#xA0;216 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>134</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219053"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219053"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219054">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007jRP7E2AW/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>PEUGEOT
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>PARTNER
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840168</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2014</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>PEUGEOT</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>173&#xA0;910 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>135</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219054"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219054"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219055">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007aymOQ2AY/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MERCEDES-BENZ
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>X164
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>707438</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2007</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MERCEDES-BENZ</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>136</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219055"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219055"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219056">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007AYvG62AL/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>CHERY
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>QQ 0,8 I
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>828551</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2010</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>CHERY</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>172&#xA0;160 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>137</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219056"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219056"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/218382">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007M4bwN2AR/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>OPEL
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>KADETT
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>831915</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>1999</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>OPEL</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Middelburg</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>341&#xA0;718 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>138</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218382"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218382"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219057">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000078pQiA2AU/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>CADDY4 CREWBUS 1.6i  (7 SEAT)
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>827930</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>92&#xA0;499 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>139</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219057"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219057"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219058">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007jSBuc2AG/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GETZ
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840167</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2004</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>372&#xA0;236 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>140</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219058"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219058"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219059">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007RJ3fA2AT/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>TAZZ
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>834211</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2005</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>332&#xA0;150 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>141</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219059"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219059"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219060">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000079qB7p2AE/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>NP200 1.6 A/C P/U S/C
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>828293</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2018</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>227&#xA0;615 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>142</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219060"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219060"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/218565">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007MyEpd2AF/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SUZUKI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>SUPERCARRY
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>832260</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SUZUKI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Middelburg</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>243&#xA0;895 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>143</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/218565"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/218565"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219061">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007NauMR2AZ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>RANGER
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>832691</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>103&#xA0;199 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>144</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219061"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219061"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219062">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007jTRRc2AO/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>BMW
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>3 SERIES
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840173</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2004</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>BMW</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>293&#xA0;629 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>145</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219062"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219062"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219063">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Ud7oK2AR/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>DATSUN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>835603</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>DATSUN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>119&#xA0;813 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>146</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219063"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219063"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219064">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007S8Ksl2AF/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>CHEVROLET
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>UTILITY 1.4 SPORT PU SC
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>834805</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2012</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>CHEVROLET</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>192&#xA0;807 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>147</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Broken Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219064"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219064"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/217560">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007IK8wR2AT/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MERCEDES-BENZ
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>W176 - A250
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>830739</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MERCEDES-BENZ</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>234&#xA0;178 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>148</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/217560"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/217560"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/216856">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007QhMRw2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>LEXUS
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>RX 350 EX
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>833824</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2022</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>LEXUS</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>42&#xA0;197 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>149</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/216856"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/216856"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219065">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007jUYf52AG/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>FIESTA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840172</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2009</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>163&#xA0;258 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>150</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219065"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219065"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219066">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007bUiCy2AK/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>BMW
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>750il
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>707689</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2002</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>BMW</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>151</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219066"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219066"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219067">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00005YwA7O2AV/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>ALFA ROMEO
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GT
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>795567</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2005</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>ALFA ROMEO</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>209&#xA0;545 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>152</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219067"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219067"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/215335">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006wm7nE2AQ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MERCEDES-BENZ
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>W211
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>823358</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2007</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MERCEDES-BENZ</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation East London</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>605&#xA0;415 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>153</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/215335"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/215335"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219068">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007F0iia2AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GOLF
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829853</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>1996</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>896&#xA0;892 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>154</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219068"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219068"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219069">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007eiMX22AM/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VN AMAROK
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838689</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2012</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation BFN</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>396&#xA0;574 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>155</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219069"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219069"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219070">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007ScAPH2A3/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>CADDY F/C P/V
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>834979</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2018</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation East London</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>307&#xA0;825 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>156</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219070"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219070"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219071">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007jrsKM2AY/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>Volvo
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>S60 2.0T A/T
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>839546</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2005</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>Volvo</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>231&#xA0;574 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>157</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219071"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219071"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/214523">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006pQWib2AG/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MERCEDES-BENZ
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>A209
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>820432</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2007</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MERCEDES-BENZ</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>218&#xA0;959 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>158</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/214523"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/214523"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219072">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV000079o6QU2AY/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>HILUX
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>828237</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2022</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Unfit for Use/Build Up">CODE 3</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>159</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219072"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219072"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219073">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007l1Qv12AE/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FIAT
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>PUNTO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840894</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2011</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FIAT</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>203&#xA0;532 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>160</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219073"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219073"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219074">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007fW04v2AC/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>DATSUN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GO 1.2 LUX
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838951</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2018</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>DATSUN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>157&#xA0;210 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>161</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219074"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219074"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219075">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007cCwMv2AK/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>RENAULT
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>CLIO IV 900T EXPRESSION 5Dr
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838019</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2014</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>RENAULT</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>140&#xA0;400 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>162</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219075"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219075"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219076">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Er6i72AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>HARDBODY NP300
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829802</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>163</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219076"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219076"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219077">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007RJkkN2AT/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>HILUX
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>834272</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2018</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>322&#xA0;417 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>164</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Service Book</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219077"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219077"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219078">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007l2LRl2AM/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ELANTRA AD
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840905</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2018</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>82&#xA0;303 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>165</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219078"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219078"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219079">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007VLeFh2AL/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ALMERA 1.5 ACENTA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>836164</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2022</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>69&#xA0;061 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>166</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219079"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219079"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219080">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007S3Rg62AF/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>COROLLA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>834718</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>187&#xA0;716 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>167</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219080"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219080"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219081">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007eVOHt2AO/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>RENAULT
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>CLIO IV 1.2T
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838413</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2017</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>RENAULT</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>50&#xA0;507 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>168</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219081"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219081"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219082">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007RuWLS2A3/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>ISUZU
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>ISUZU KB250D FLEETSIDE P/U S/C
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>833345</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2008</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>ISUZU</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>526&#xA0;406 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>169</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219082"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219082"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219083">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007iUTPo2AO/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>AVANZA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>839668</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation PE</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>170</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219083"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219083"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219084">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007gzDH52AM/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>KIA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>SORENTO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>839094</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2010</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>KIA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>291&#xA0;391 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>171</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219084"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219084"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219085">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007ShSBf2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MAHINDRA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>BOLERO 2.5
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>835075</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MAHINDRA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>172&#xA0;572 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>172</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219085"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219085"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/217579">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007SixDb2AJ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>BMW
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>3 SERIES SEDAN
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>835098</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2007</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>BMW</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>232&#xA0;487 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>173</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/217579"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/217579"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219086">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007l446l2AA/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>PEUGEOT
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>306 2.0 CABRIOLET
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840969</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2001</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>PEUGEOT</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>168&#xA0;014 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>174</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219086"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219086"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219087">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007KaJUu2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>BMW
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>3 SERIES
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>701435</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>BMW</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>169&#xA0;299 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>175</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219087"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219087"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219088">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006czkhv2AA/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>AUDI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>AU   48X - A5
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>816347</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2010</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>AUDI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Middelburg</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>176</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Broken Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219088"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219088"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219089">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007UkFNl2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>KA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>705624</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2007</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>205&#xA0;873 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>177</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219089"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219089"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/217590">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007AZ7IN2A1/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VW 276 - T-ROC
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>828531</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>87&#xA0;636 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>178</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/217590"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/217590"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219090">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007iUAFJ2A4/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>PROTON
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>SAVVY 1.2
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>838954</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2006</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>PROTON</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>156&#xA0;230 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>179</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219090"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219090"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219091">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007UiPXq2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>DATSUN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>GO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>705566</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2019</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>DATSUN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>204&#xA0;968 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>180</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219091"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219091"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219092">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007S1f0d2AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MERCEDES-BENZ
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>W204
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>834655</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2007</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MERCEDES-BENZ</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Middelburg</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>219&#xA0;716 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>181</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219092"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219092"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219093">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007ZqQcI2AV/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MINI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>COOPER
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>837271</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2008</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MINI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation PE</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>182</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219093"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219093"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219094">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007QH5FJ2A1/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>POLO VIVO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>833705</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2018</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>AN Polokwane</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>151&#xA0;031 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>183</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219094"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219094"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="False" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219095">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007TAI0h2AH/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SUBARU
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>IMPREZA
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>704991</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2001</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SUBARU</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>unknown</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>184</td>
                                            </tr>


                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219095"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219095"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219096">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007F5yvM2AR/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>RENAULT
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>TRIBER/LIFE
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>829895</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2023</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>RENAULT</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>139&#xA0;797 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>185</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219096"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219096"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219097">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Muuya2AB/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>NISSAN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>TIIDA 1.6 VIS
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>832195</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2013</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>NISSAN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>202&#xA0;769 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>186</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Service Book</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219097"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219097"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219098">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007RuAEs2AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>AUDI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>A1 SPORTBACK 1.
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>834528</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2014</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>AUDI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>260&#xA0;178 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>187</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219098"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219098"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219099">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007Ugl7Q2AR/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HONDA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>HR-V 1.8 ELEGANCE
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>835700</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HONDA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>154&#xA0;233 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>188</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219099"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219099"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219100">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007a0n4v2AA/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>OPEL
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>CORSA LITE 1.4i
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>837524</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2005</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>OPEL</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation PE</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>207&#xA0;073 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>189</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219100"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219100"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219101">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00006sjTv12AE/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>MINI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>COOPER
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>821932</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2008</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>MINI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Cape Town</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>172&#xA0;136 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>190</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219101"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219101"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219102">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007kMeil2AC/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>AUDI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>A4 2.0T AMBITION (B8)
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>840701</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2008</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>AUDI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>281&#xA0;498 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>191</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219102"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219102"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219103">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007SdPcA2AV/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>LEXUS
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>NX 250 EX
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>832140</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2022</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>LEXUS</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>56&#xA0;434 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>192</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219103"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219103"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219104">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007CEc792AD/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>KIA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>PEGAS 1.4 LX
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>828545</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2022</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>KIA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>123&#xA0;823 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>193</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Key</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219104"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219104"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219105">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007RyFO82AN/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>SUZUKI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>BALENO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>834615</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2023</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>SUZUKI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>40&#xA0;444 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>194</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219105"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219105"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219106">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007JhvEg2AJ/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>FORD
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>FIGO 1.4 TDCi AMBIENTE(7/2010 - 11/2018)
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>831178</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2016</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>FORD</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Centurion</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>165&#xA0;935 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>195</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219106"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219106"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219107">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007hgXJX2A2/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>POLO VIVO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>709251</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2024</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Durban Cornubia</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>18&#xA0;635 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>196</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219107"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219107"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219108">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007KQM882AH/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>HYUNDAI
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>I20
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>831483</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2017</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>HYUNDAI</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation JHB R21</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>90&#xA0;885 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>197</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219108"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219108"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219109">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007VHBtc2AH/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>TOYOTA
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>FORTUNER
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>836061</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2010</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>TOYOTA</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Middelburg</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>543&#xA0;461 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>198</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219109"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219109"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="False" data-code="">
                                    <a href="/Listings/Vehicles/219110">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007TI8pl2AD/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VW 27X - POLO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>835417</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2021</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation BFN</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>63&#xA0;816 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>199</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219110"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219110"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="vehicle-item" data-keys="True" data-starts="True" data-code="">
                                    <a href="/Listings/Vehicles/219111">
                                        <div class="vehicle-image" style="background-image: url('https://d2wxnkq3f3e5mq.cloudfront.net/prod/vehicles/a0CIV00007AbYqV2AV/Photos/360/Front.jpg')">
                                        </div>
                                    </a>
                                    <div class="vehicle-tables">
                                        <div class="vehicel-title">
                                            <div class="hover-effect">
                                                <span class="hover-label">
                                                    <span class="label">Make</span>VOLKSWAGEN
                                                </span>

                                                <span class="hover-label">
                                                    <span class="label">Model</span>VW  27X -  POLO
                                                </span>
                                            </div>
                                            <div class="stc-block ">STC STATUS - YES</div>
                                        </div>
                                        <table class="vehicle overview">
                                            <tr>
                                                <th>Stock No</th>
                                                <td>828592</td>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <td>2023</td>
                                            </tr>
                                            <tr>
                                                <th>Make</th>
                                                <td>VOLKSWAGEN</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td><span title=" Used Motor Vehicle">CODE 2</span></td>
                                            </tr>
                                            <tr>
                                                <th>Location</th>
                                                <td>Auction Nation Middelburg</td>
                                            </tr>
                                            <tr>
                                                <th>Odometer</th>
                                                <td>23&#xA0;660 Km</td>
                                            </tr>
                                        </table>

                                        <table class="vehicle details-list">

                                            <tr>
                                                <th>Lot No</th>
                                                <td>200</td>
                                            </tr>


                                                    <tr>
                                                        <th>Has Keys</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Has Battery</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Starts</th>
                                                        <td>YES</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Spare Wheel</th>
                                                        <td>YES</td>
                                                    </tr>

                                        </table>
                                    </div>
                                    <div class="vehicle-buttons row">

                                            <a href="/Listings/Vehicles/219111"><div class="green lite-btn">Details</div></a>
                                        <a href="/Listings/Vehicles/219111"><div class="view-btn">View <img src="/Content/Images/blue_arrow.png" /></div></a>

                                    </div>
                                </div>
                            </div>
            </div>


        </div>
    </div>
<script>

    //Filter code
    $("#filterRegion").change(function () {
        var value = $(this).val();
        $("#valueRegion option").prop("selected", false);
        $("#valueRegion option[value='" + value + "']").prop("selected", true);
    });


    $("#filterShowNumber").change(function () {
        var value = $(this).val();
        var newUrl = window.location.href.split('?')[0] + "?page=1" + value;
        window.location.href = newUrl;
    });

    var keys = '';
    var starts = '';
    var code = '';
    var lastData;


    $("#filterKeys").change(function () {
        var value = $(this).val();
        keys = value;
        filter();

        $("#valueKeys").val(value);
    });

    $("#filterStarts").change(function () {
        var value = $(this).val();
        starts = value;
        filter();

        $("#valueStarts").val(value);
    });

    $("#filterCode").change(function () {
        var value = $(this).val();
        code = value;
        filter();

        $("#valueStarts").val(value);
    });

    $("#filter-bar .filter-option").change(getVehicles);

    function getVehicles(page) {

        let filters = $("#filter-bar").serialize();

        Cookies.set('filters', filters, { expires: 365 });

        window.location.href = "https://www.auctionnation.co.za/Listings/Auction?id=" + 430969 + "&" + filters;

    }


    function ClearSearch() {
        window.location.href = "https://www.auctionnation.co.za/Listings/Auction?id=" + 430969;
    }

         //Prebid confirmation start
        //$(".prebid-cancel").click(function (e) {
        //    e.preventDefault();
        //    $(".prebid-confirm-modal").removeClass("show");
        //    return false;
        //});

        //$("#prebid-submit").click(function (e) {

        //    //data-detail-id data-reg-id
        //    var detailId = $(this).attr("data-detail-id");
        //    var registrationId = $(this).attr("data-reg-id");

        //    console.log('prebid accepted', detailId, registrationId);

        //    return false;
        //});


        //Prebid confirmation end

        // function PlacePreBid(detailId, registrationId) {
        //    $.ajax({
        //        type: "POST",
        //        data: {
        //            "detail": detailId,
        //            "registration": registrationId,
        //            "amount": $("#prebid-amount-" + detailId).val()
        //        },
        //        url: baseUrl + "Json/PreBid",
        //        success: function (result) {
        //            if (result.Success === false) {
        //                msg.error("Bid Error", result.Message);
        //            } else {
        //                msg.alert("Prebid", "Pre Bid placed successfully. Please join the auction to see the results of this lot.");
        //            }
        //        }
        //    });
        //}

</script>
    </div>


    <div id="cookieNotice" class="light display-right" style="display: none;">
        <div id="closeIcon" style="display: none;">
        </div>
        <div class="title-wrap">
            <h4>Cookie Consent</h4>
        </div>
        <div class="content-wrap">
            <div class="msg-wrap">
                <p>This website uses cookies or similar technologies, to enhance your browsing experience. By continuing to use our website, you agree to our  Terms and Conditions <a href="/Listings/Privacy">Learn More</a></p>
                <div class="btn-wrap">
                    <button class="btn-primary" onclick="acceptCookieConsent();">Accept</button>
                </div>
            </div>
        </div>
    </div>


    
<div class="footer">
    <div class="brands-section">
        <div class="container">
            <h2>Backed by South Africa's leading insurance companies</h2>
            <div id="logoSlider">
                <div><img src="/insurers/absa.webp" /></div>
                <div><img src="/insurers/alexander forbes.webp" /></div>
                <div>
                    <a href="https://prime.co.za/car-insurance/?ref=AuctionNation">
                        <img src="/insurers/PrimeLogo.webp" width="226px" height="143px" />
                    </a>
                </div>
                <div>
                    <a href="https://www.naked.insure/car-insurance">
                        <img src="/insurers/naked_partnership_logo_tag_left_white.png" width="226px" height="143px" />
                    </a>
                </div>
                <div><img src="/insurers/brolink.webp" /></div>
                <div><img src="/insurers/bryte.webp" /></div>
                <div><img src="/insurers/compendium.webp" /></div>
                <div><img src="/insurers/discovery.webp" /></div>
                <div><img src="/insurers/fnb.webp" /></div>
                <div><img src="/insurers/hollard.webp" /></div>
                <div><img src="/insurers/iemas.webp" /></div>
                <div><img src="/insurers/integrisure.webp" /></div>
                <div><img src="/insurers/integritas.webp" /></div>
                <div><img src="/insurers/iwyze.webp" /></div>
                <div><img src="/insurers/king price.webp" /></div>
                <div><img src="/insurers/legacy.webp" /></div>
                <div><img src="/insurers/liib.webp" /></div>
                <div><img src="/insurers/lion of afric.webp" /></div>
                <div><img src="/insurers/mercury.webp" /></div>
                <div><img src="/insurers/miway.webp" /></div>
                <div><img src="/insurers/momentum.webp" /></div>
                <div><img src="/insurers/mua.webp" /></div>

                <div><img src="/insurers/old mutual.webp" /></div>
                <div><img src="/insurers/outsurance.webp" /></div>

                <div><img src="/insurers/renasa.webp" /></div>
                <div><img src="/insurers/santam.webp" /></div>
                <div><img src="/insurers/standard bank.webp" /></div>
                <div><img src="/insurers/telesure.webp" /></div>
                <div><img src="/insurers/vapsure.webp" /></div>
            </div>
        </div>
    </div>
    <div class="footer-nav">
        <div class="container">
            <div class="row">
                <div class="seven columns">
                    <div class="row">
                        <div class="four columns">
                            <ul class="footer-menu">
                                <li><a href="/">Home</a></li>
                                <li><a href="/Auctions">Live Auctions</a></li>
                                <li><a href="/Listings/Timed">Timed Auctions</a></li>
                            </ul>
                        </div>
                        <div class="four columns">
                            <ul class="footer-menu">
                                <li><a href="/home">Upcoming</a></li>
                                <li><a href="/Page/Sell">Sell</a></li>
                                <li><a href="/Page/Contact">Contact</a></li>
                            </ul>
                        </div>
                        <div class="four columns">
                            <ul class="footer-menu">
                                <li><a href="/Page/About">About Us</a></li>
                                <li><a href="/Page/FAQ">FAQs</a></li>
                                <li><a href="/Page/FAQ">How it works</a></li>
                                <li><a href="/Page/RIQ">Request for information</a></li>


                            </ul>
                        </div>
                    </div>
                </div>
                <div class="five columns">
                    <div class="call-us">
                        <h2>Call us on</h2>
                        <h1><a class="hover-change" href="tel:0861028948">08610 <span class="hover-slide"><span>BUYIT</span><span>28948</span></span></a></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div>
            &copy; 2025 Copyright Auction Nation
        </div>
        <div id="version-info" style="display: inline-block;">
            <small>
                Version 3.0.0&#x2B;aa9c1430faf2800f1d462c7510fcc1f5377fe563 2000/01/11
            </small>
        </div>
        <div>
            <a target="_blank" href="/Content/Auction Nation Terms and Conditions.pdf">Auction Nation Terms and Conditions</a> |
            <a target="_blank" href="/content/Privacy Policy.pdf">Auction Nation Privacy Policy</a> |
            <a target="_blank" href="/content/PAIA MANUAL.pdf">PAIA Manual</a>
        </div>
        <script type="text/javascript">
            window.debugVersionInfo = window.debugVersionInfo || {};
            window.debugVersionInfo.displayVersionInfo = function displayVersionInfo() {
                document.getElementById("version-info").style.display = "block";
            }
        </script>
    </div>
</div>

    
<div id="alert-modal" class="warning hide">
    <div class="m-ico"></div>
    <div class="m-title">Oh no</div>
    <div class="m-message">This lot has passed, please wait for the next lot to load.</div>
    <div class="m-btns">
        <button class="m-close">Ok</button>
    </div>
</div>


    <div class="pay-modal">
    <h1>Auction Registration</h1>
    <p>Registration for <span class="id-regfor">12 July</span></p>
    <p>A deposit of R5000 is required</p>
    <form id="aucreg-form">
        <div class="checkbox-line">
            <span class="checkbox"><input required type="checkbox" id="accept-anrules"><label for="accept-anrules"><span></span></label></span>
            I agree to the <a target="_blank" href="/Content/Auction Nation Terms and Conditions.pdf">Rules of Auction</a>
        </div>

        <div class="checkbox-line">
            <span class="checkbox"><input required type="checkbox" id="accept-tarules"><label for="accept-tarules"><span></span></label></span>
            I accept the <a target="_blank" href="/Content/A227-Timed Auctions.pdf">Online Timed Auctions</a> terms
        </div>

        <div class="checkbox-line">
            <span class="checkbox"><input required type="checkbox" id="accept-prirules"><label for="accept-prirules"><span></span></label></span>
            I have read and accepted the <a target="_blank" href="/Content/Privacy Policy.pdf">Privacy Policy</a>
        </div>

        <input type="hidden" name="auctionId" id="reg-aucId" />
        <div class="center-align">
            <input id="register-submit" type="submit" value="Submit" />
            <button class="reg-cancel reg-btn">Cancel</button>
        </div>

    </form>
    <div class="reg-loading">
        <div class="an-loading"></div>
    </div>
    <div class="reg-done">
        <h3>Registered</h3>
        <p>You need to make a deposit to activate your registration.</p>
        <div class="center-align">
            <a href="/" class="reg-btn refresh-back">Pay Deposit</a>
            <button class="reg-cancel reg-btn">Close</button>
        </div>
    </div>
</div>

    <div class="prebid-confirm-modal">
    <h1>Prebid Confirmation</h1>
    <div class="checkbox-line">
        <p style="padding-top: 30px;">&nbsp;</p>
        <p style="padding-bottom: 25px;">Are you sure you want to place this Prebid?</p>
        <p>&nbsp;</p>
    </div>
    <div class="center-align">
        <input id="prebid-submit" type="submit" value="Place Prebid" />
        <button class="prebid-cancel reg-btn">Cancel</button>
    </div>
</div>



    
<div id="live-modal" class="hidden">
    <div class="stock-list" id="live-modal-slider">

    </div>
    <a href="/Auctions/Live/">Go to Auction</a>
    <span class="close-auc">x</span>
</div>



    <script src="/_framework/blazor.server.js"></script>

    <script src="_content/BlazorInputFile/inputfile.js"></script>
    <script src="_content/CurrieTechnologies.Razor.SweetAlert2/sweetAlert2.min.js"></script>
    <link rel="stylesheet" href="_content/Radzen.Blazor/css/default-base.css">
    <script src="_content/Radzen.Blazor/Radzen.Blazor.js"></script>
    <link href="_content/Blazored.Modal/blazored-modal.css" rel="stylesheet" />
    <script src="_content/Blazored.Modal/blazored.modal.js"></script>

    <script type="text/javascript" src="/Content/slick/slick.min.js"></script>
    
    <script type="text/javascript" src="/Scripts/AN_2018.js?v=LIvmGK_CZpY-PLDBZHS3uQWqgmPyLTyincTUIKnLwh0"></script>
    <script type="text/javascript" src="/Scripts/moment.min.js"></script>

    <script type="text/javascript">
        /* Start of LiveChat (www.livechatinc.com) code */
        window.__lc = window.__lc || {};
        window.__lc.license = 4355231;
        (function () {
            var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
            lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
        })();


        // Create cookie
        function setCookie(cname, cvalue, exdays) {
            const d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        // Delete cookie
        function deleteCookie(cname) {
            const d = new Date();
            d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=;" + expires + ";path=/";
        }

        // Read cookie
        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        // Set cookie consent
        function acceptCookieConsent() {
            deleteCookie('user_cookie_consent');
            setCookie('user_cookie_consent', 1, 30);
            document.getElementById("cookieNotice").style.display = "none";
        }

        $(document).ready(function () {
            let cookie_consent = getCookie("user_cookie_consent");
            if (cookie_consent != "") {
                document.getElementById("cookieNotice").style.display = "none";
            } else {
                document.getElementById("cookieNotice").style.display = "block";
            }
        });
    </script>

    <!-- Hotjar Tracking Code for Site 5121138 (name missing) -->
    <script>
        (function (h, o, t, j, a, r) {
            h.hj = h.hj || function () { (h.hj.q = h.hj.q || []).push(arguments) };
            h._hjSettings = { hjid: 5121138, hjsv: 6 };
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script'); r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0GDPWGTSCM"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-0GDPWGTSCM');
    </script>

    

    <iframe id="Defib" src="/Home/KeepAlive" frameborder="0" width="0" height="0" runat="server"></iframe>

</body>
</html>
