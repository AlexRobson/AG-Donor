
    <link rel="stylesheet" href="/resources/blvdstatus/css/dashboard.css" />
    
    <link rel="stylesheet" href="/resources/blvdstatus/css/boxReferers.css" />    
    <link rel="stylesheet" href="/resources/blvdstatus/css/boxSearchKeywords.css" />
    <link rel="stylesheet" href="/resources/blvdstatus/css/boxSitePages.css" />    
    <link rel="stylesheet" href="/resources/blvdstatus/css/boxFootTraffic.css" />    
    <link rel="stylesheet" href="/resources/blvdstatus/css/boxOutgoingLinks.css" />    
    <link rel="stylesheet" href="/resources/blvdstatus/css/boxConversions.css" />

    <link rel="stylesheet" href="/resources/blvdstatus/css/shadowbox/shadowbox.css" />
    
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/textSupport.js"></script>
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/timeSupport.js"></script>

    <!-- Librerias de Spry framework de adobe  -->
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/spry/SpryData.js"></script>
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/spry/SpryJSONDataSet.js"></script>
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/spry/SpryDOMUtils.js"></script>
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/spry/SpryEffects.js"></script>
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/spry/SpryTabbedPanels.js"></script>
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/spry/SpryTooltip.js"></script>
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/browserSupport.js"></script>
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/debugSupport.js.php"></script>

    <!-- Libraries of DHTML -->
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/prototype/prototype.js"></script>
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/scriptaculous/scriptaculous.js"></script>
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/shadowbox/adapter/shadowbox-prototype.js"></script>
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/shadowbox/shadowbox.js"></script>
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/controls/boxGrid.js"></script>

    <!-- Widgets -->    
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/boxes/referrers.js"></script>   
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/boxes/keywords.js"></script>    
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/boxes/siteURLs.js"></script>    
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/boxes/traffic.js"></script>    
    <script language="javascript" type="text/javascript" src="/resources/blvdstatus/js/boxes/outgoingLinks.js"></script>    

<link href="http://dev.seoq.com/quotient/css/seoqreporting.css" rel="stylesheet" type="text/css" />
                                  
  <!-- Domain list -->
   <span id="blvdDomainSelectorRegion" spry:region="userDomainData">               
     Domain: <select id="blvdDomainSelector" onchange="changeSelectedDomain(this);" spry:repeatchildren="userDomainData">
          <option
              spry:if="'{userDomainData::DomainName}' != ''"
              value="{userDomainData::ds_RowNumber}|{userDomainData::DomainName}"
              class="{userDomainData::DomainOptionClass}"
          >
              {userDomainData::Title}
          </option>

          <option
              spry:if="'{userDomainData::DomainName}' == '<?php echo $domainName ?>'"
              value="{userDomainData::ds_RowNumber}|{userDomainData::DomainName}"
              class="{userDomainData::DomainOptionClass}"
              selected="selected"
          >
              {userDomainData::Title}
          </option>
      </select>
   </span>
  <!-- End to domain list -->  

    <script language="javascript" type="text/javascript">
    <!--
        var currentDomainId = 0;
        
         function select_domain(objSelect){
            window.location="<?php //echo $html->url('/admin/pages/home/', true); ?>"+objSelect.value;
         }
        
        function print(obj, maxDepth, prefix){
           var result = '';
           if (!prefix) prefix='';
           for(var key in obj){
               if (typeof obj[key] == 'object'){
                   if (maxDepth !== undefined && maxDepth <= 1){
                       result += (prefix + key + '=object [max depth reached]\n');
                   } else {
                       result += print(obj[key], (maxDepth) ? maxDepth - 1: maxDepth, prefix + key + '.');
                   }
               } else {
                   result += (prefix + key + '=' + obj[key] + '\n');
               }
           }
           return result;
        }
                
        
        function adjustUserDomainData(dataSet, row, rowNumber) {
            if (row.Owned == 0) {
                row.DomainOptionClass = 'UnownedDomain';
            } else {
                row.DomainOptionClass = 'OwnedDomain';
            }
            
            return row;
        }
        
        function changeSelectedDomain(node) {
            var option = node.options[node.selectedIndex];
            var value = option.value;
            
            var rowId = value.substr(0, value.indexOf('|'));
            var domainName = value.substr(value.indexOf('|') + 1);
            currentDomainId = rowId;
          
          /** 
           * Comment by John, because not is needly set Timezone....  I think so....
           **/
            Spry.Utils.loadURL(
                "GET",
                "/admin/blvdstatus/setTimezoneByDomain/" ,
                true,
                function(request) {
                    userDomainData.setCurrentRow(rowId);
                }           
            );/* */
        }
        
        function retrieveCurrentDomainId(region, lookup) {
            return currentDomainId;
        }
        
        var userDomainData = new Spry.Data.JSONDataSet(
            '/admin/blvdstatus/domain_names', 
            { path: "data", filterDataFunc: adjustUserDomainData }
        );
        //Document.write(print(userDomainData));
        // Object as region observer
        Spry.Data.Region.addObserver(
            'blvdDomainSelectorRegion',
            {
                // onPostUpdate, The region has regenerated its code and inserted it into the document.  
                onPostUpdate: function(notifier, data) { 
                    changeSelectedDomain(Spry.$('blvdDomainSelector'));
                }
            }
        );
        -->
    </script>


<script>
function tab_changeSelectedTab(className, newTabNode) {
  var currentLink = Spry.$$(className + " .TabArea .CurrentTab");
  if (currentLink.length > 0) {
    Spry.Utils.removeClassName(currentLink[0], "CurrentTab");
  }
  
  Spry.Utils.addClassName(newTabNode, "CurrentTab");
}
</script>

<div
  id="MessageContainer"
  class="">
</div>

<div id="TooltipHolder"></div>

<div class="BoxGrid" id="boxGridTest">
  <div class="BoxGridIconBar"></div>
            
    
    <!-- REFERRERS WIDGET -->
    
 <div class="BoxGridBox ReferersBox" id="ReferersBox" boxSymbol="Re">
    <div class="TabArea">
      <div class="Tab CurrentTab" onclick="tab_referrersRecent(this);">Recent</div>
      <div class="Tab" onclick="tab_referrersAllTime(this);">All Time</div>
      <div class="Tab" onclick="tab_referrersDomains(this);">Domains</div>
    </div>
    
    <div class="LeftEdge"></div>
    <div class="RightEdge"></div>

    <div class="TopEdge"></div>
    
    <div class="LeftShadow"></div>
    <div class="RightShadow"></div>
    
    <div class="BoxTitleBar">
      <div class="BoxGridRefreshControl">
        Refresh:
        <select class="RefreshControlSelect" id="ReferersBox_refreshSelect" onchange="refreshChange_referrers(this);">
          <option value="0">Never</option>
          <option value="0.5">30 sec</option>

          <option value="1">1 min</option>
          <option value="3">3 min</option>
          <option value="10">10 min</option>
          <option value="15" selected="selected">15 min</option>
        </select>
        <script>
          var selectNode = Spry.$('ReferersBox_refreshSelect');
          
          selectNode.onclick = function(e) {
            if (!e) var e = window.event
            e.cancelBubble = true;
            if (e.stopPropagation) e.stopPropagation();
          }
        </script>
      </div>
      <span class="BoxGridBoxIcon"> Referrers</span>

    </div>
    <div class="BoxBackground">
      <div class="BoxContent">        <script>
  var referrerData = new Spry.Data.JSONDataSet(
    "/admin/blvdstatus/referrers/{userDomainData::DomainName}/recent",
    { path: "data", filterDataFunc: adjustReferrerData }
  );
</script>

<div class="DataDisplayRegion" id="referrerDataDisplay" spry:region="referrerData">
  <div spry:state="loading" class="LoadingPlaceholder">
    <div style="padding-top: 70%"><img src="http://dev.seoq.com/quotient/img/box_parts/loading_referrers.gif" style="margin-top: -100px;" alt="Loading referre" /></div>
  </div>
  
  <table border="0" cellspacing="0" cellpadding="0" spry:state="ready">

    <thead>
      <tr>
        <th
          class="NumericColumn"
          spry:if="referrers_activeTab == 'all' || referrers_activeTab == 'domains'"
        >
          Hits
        </th>
        <th
          class="NumericColumn"
          spry:if="referrers_activeTab == 'recent'"
        >
          Time
        </th>
        
        <th
          class="NumericColumn"
          spry:if="referrers_activeTab == 'domains'"
        >
          Domain
        </th>

        <th
          class="NumericColumn"
          spry:if="referrers_activeTab != 'domains'"
        >
          Referrer
        </th>
        
        <th
          spry:if="referrers_activeTab == 'recent'"
        >
          Conv
        </th>
      </tr>
    </thead>
    
    <tbody>
      <tr
        spry:repeat="referrerData"
        spry:test="{ds_RowNumber} &gt;= (referrers_startAt - 1) &amp;&amp; {ds_RowNumber} &lt; referrers_endAt"
      >

        <td
          class="NumericColumn"
          spry:if="referrers_activeTab == 'all' || referrers_activeTab == 'domains'"
        >
          {referrerData::Hits}<br/>
        </td>
        <td
          class="NumericColumn"
          spry:if="referrers_activeTab == 'recent'"
        >
          {referrerData::TimeAgo} ago
        </td>
        
        <td
          spry:if="referrers_activeTab != 'domains'"
        >
          <big spry:if="referrers_activeTab != 'recent'">
            <a
              id="tooltipTrigger_referrersURL_alltime_{referrerData::ds_RowID}_{function::retrieveCurrentDomainId}"
              href="{referrerData::OriginalReferringURL}"
              target="_blank"
            >

              <span spry:if="'{referrerData::Keyword}' != ''">
                <img
                  src="https://dev.blvdstatus.com/img/searchEngines/{referrerData::SearchEngineIconURL}"
                  spry:if="'{referrerData::SearchEngineIconURL}' != ''"
                  style="float: right; magin: 2px;"
                />
                <img
                  src="https://dev.blvdstatus.com/img/searchEngines/generic.png"
                  spry:if="'{referrerData::SearchEngineIconURL}' == ''"
                  style="float: right; magin: 2px;"
                />
                {referrerData::Keyword}
              </span>
              <span spry:if="'{referrerData::Keyword}' == ''">
                {referrerData::ReferringURL}
              </span>
            </a><br/>
          </big>

          <span spry:if="referrers_activeTab == 'recent'">
            <a
              id="tooltipTrigger_referrersURL_{referrerData::ds_RowID}_{function::retrieveCurrentDomainId}"
              href="{referrerData::OriginalReferringURL}"
              target="_blank"
            >
              <span spry:if="'{referrerData::Keyword}' != ''">
                <img
                  src="http://dev.seoq.com/quotient/img/searchEngines/{referrerData::SearchEngineIconURL}"
                  spry:if="'{referrerData::SearchEngineIconURL}' != ''"
                  style="float: right; magin: 2px;"
                />
                <img
                  src="http://dev.seoq.com/quotient/img/searchEngines/generic.png"
                  spry:if="'{referrerData::SearchEngineIconURL}' == ''"
                  style="float: right; magin: 2px;"
                />
                {referrerData::Keyword}
              </span>
              <span spry:if="'{referrerData::Keyword}' == ''">
                {referrerData::ReferringURL}
              </span>

            </a><br/>
          </span>
          
          <small spry:if="referrers_activeTab == 'recent'">
            Page:
            <a
              id="tooltipTrigger_referrers_{referrerData::ds_RowID}_{function::retrieveCurrentDomainId}"
              href="{referrerData::OriginalCurrentPageURL}"
              target="_blank"
            >
              {referrerData::CurrentPage}
            </a>
          </small>
          
                    <div spry:if="referrers_activeTab == 'recent'">
            <div
              class="Tooltip"
              id="tooltipContentProxy_referrersURL_{referrerData::ds_RowID}_{function::retrieveCurrentDomainId}"
              spry:if="'{referrerData::OriginalReferringURL}' != '{referrerData::ReferringURL}'"
            >

              {referrerData::OriginalReferringURL}
            </div>
            
            <script
              spry:if="'{referrerData::OriginalReferringURL}' != '{referrerData::ReferringURL}'"
            >
              createTooltipFromProxy(
                'tooltipContentProxy_referrersURL_{referrerData::ds_RowID}_{function::retrieveCurrentDomainId}',
                '#tooltipTrigger_referrersURL_{referrerData::ds_RowID}_{function::retrieveCurrentDomainId}'
              );
            </script>
          </div>
          
          <div spry:if="referrers_activeTab == 'all'">
            <div
              class="Tooltip"
              id="tooltipContentProxy_referrersURL_alltime_{referrerData::ds_RowID}_{function::retrieveCurrentDomainId}"
              spry:if="'{referrerData::OriginalReferringURL}' != '{referrerData::ReferringURL}'"
            >
              {referrerData::OriginalReferringURL}
            </div>
            
            <script
              spry:if="'{referrerData::OriginalReferringURL}' != '{referrerData::ReferringURL}'"
            >
              createTooltipFromProxy(
                'tooltipContentProxy_referrersURL_alltime_{referrerData::ds_RowID}_{function::retrieveCurrentDomainId}',
                '#tooltipTrigger_referrersURL_alltime_{referrerData::ds_RowID}_{function::retrieveCurrentDomainId}'
              );
            </script>

          </div>
          
                    <div
            spry:if="referrers_activeTab == 'recent'"
            class="Tooltip"
            id="tooltipContentProxy_referrers_{referrerData::ds_RowID}_{function::retrieveCurrentDomainId}"
          >
            {referrerData::OriginalCurrentPage}<br/>
            <small
              spry:if="'{referrerData::OriginalCurrentPage}' != '{referrerData::OriginalCurrentPageURL}'"
            >
              {referrerData::OriginalCurrentPageURL}
            </small>
          </div>
          
          <script spry:if="referrers_activeTab == 'recent';">
            createTooltipFromProxy(
              'tooltipContentProxy_referrers_{referrerData::ds_RowID}_{function::retrieveCurrentDomainId}',
              '#tooltipTrigger_referrers_{referrerData::ds_RowID}_{function::retrieveCurrentDomainId}'
            );
          </script>

        </td>
        
        
        <td
          spry:if="referrers_activeTab == 'domains'"
        >
          <big><a href="http://{referrerData::ReferrerDomain}" target="_blank">{referrerData::ReferrerDomain}</a></big>
        </td>
        
        <td
          spry:if="referrers_activeTab == 'recent'"
          class="ReferrerConversionTarget"
          rowId="{referrerData::ds_RowID}"
        >&nbsp;</td>
      </tr>
    </tbody>
  </table>

  
  <script>displayConversionData();</script>
  
</div>
      </div><div class="PagerBar"><span class="PagerHeader">Show: </span><span class="PageLink CurrentPageLink" onclick="pageReferrers('1', '10', this);">1 - 10</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageReferrers('11', '20', this);">11 - 20</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageReferrers('21', '30', this);">21 - 30</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageReferrers('31', '40', this);">31 - 40</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageReferrers('41', '50', this);">41 - 50</span></div></div><div class="Bottom"><div class="BottomLeftCorner"></div><div class="BottomRightCorner"></div><div class="BottomCenter"></div><div class="BottomShadow"></div></div></div><script>disableSelectionById('ReferersBox');</script>   
    <!-- END REFERRERS WIDGET -->
                          
        
    <!-- SEARCH KEYWORDS WIDGET -->   

                <div class="BoxGridBox SearchKeywordsBox" id="SearchKeywordsBox" boxSymbol="KW">
    <div class="TabArea">
    <!--  <div class="FilterControls">
  Filter:
  <select name="SearchEngineFilter" onchange="keywords_changeFilter(this);" >
    <option value="0">(All)</option>
          <option value="10">Alexa</option>
          <option value="8">Ask.com</option>

          <option value="11">Bing</option>
          <option value="28">Bing BE</option>
          <option value="29">Bing IE</option>
          <option value="30">Bing PT</option>
          <option value="9">Comcast</option>
          <option value="1">Google</option>

          <option value="2">Google (Advanced)</option>
          <option value="12">Google BE</option>
          <option value="7">Google Blog Search</option>
          <option value="16">Google CA</option>
          <option value="18">Google DE</option>
          <option value="14">Google FR</option>

          <option value="26">Google IE</option>
          <option value="17">Google IT</option>
          <option value="13">Google NL</option>
          <option value="19">Google PT</option>
          <option value="15">Google UK</option>
          <option value="5">MSN</option>

          <option value="6">Reddit</option>
          <option value="4">Windows Live</option>
          <option value="3">Yahoo</option>
          <option value="22">Yahoo CA</option>
          <option value="20">Yahoo DE</option>
          <option value="27">Yahoo ES</option>

          <option value="24">Yahoo FR</option>
          <option value="21">Yahoo IT</option>
          <option value="25">Yahoo NL</option>
          <option value="23">Yahoo UK</option>
      </select>
</div>-->

<div class="Tab CurrentTab" onclick="tab_keywordsRecent(this);">Recent</div>

<div class="Tab" onclick="tab_keywordsAllTime(this);">All Time</div>
    </div>
    
    <div class="LeftEdge"></div>
    <div class="RightEdge"></div>
    <div class="TopEdge"></div>
    
    <div class="LeftShadow"></div>
    <div class="RightShadow"></div>
    
    <div class="BoxTitleBar">
      <div class="BoxGridRefreshControl">

        Refresh:
        <select class="RefreshControlSelect" id="SearchKeywordsBox_refreshSelect" onchange="refreshChange_keywords(this);">
          <option value="0">Never</option>
          <option value="0.5">30 sec</option>
          <option value="1">1 min</option>
          <option value="3">3 min</option>
          <option value="10">10 min</option>
          <option value="15" selected="selected">15 min</option>

        </select>
        <script>
          var selectNode = Spry.$('SearchKeywordsBox_refreshSelect');
          
          selectNode.onclick = function(e) {
            if (!e) var e = window.event
            e.cancelBubble = true;
            if (e.stopPropagation) e.stopPropagation();
          }
        </script>
      </div>
      <span class="BoxGridBoxIcon"> Search Keywords</span>
    </div>
    <div class="BoxBackground">
      <div class="BoxContent">        <script>
  var keywordsData = new Spry.Data.JSONDataSet(
    "/admin/blvdstatus/keywords/{userDomainData::DomainName}/recent",
    { path: "data", filterDataFunc: adjustData_keywords }
  );

</script>

<div class="DataDisplayRegion" id="keywordsDataDisplay" spry:region="keywordsData userDomainData">
  <div spry:state="loading" class="LoadingPlaceholder">
    <div style="padding-top: 70%"><img src="/resources/blvdstatus/img/box_parts/loading_keywords.gif" style="margin-top: -100px;"/></div>
  </div>
  
  <div spry:state="ready">
    <table border="0" cellspacing="0" cellpadding="0" >
      <thead>
        <tr>

          <th class="NumericColumn" spry:if="keywords_activeTab != 'recent'">Hits</th>
          <th class="NumericColumn" spry:if="keywords_activeTab == 'recent'">Time</th>
          <th>Keyword</th>
          <th class="NumericColumn" spry:if="keywords_activeTab == 'recent'">Rank</th>
          <th class="NumericColumn" spry:if="keywords_activeTab != 'recent'">
            <nobr>
              <span class="Control Selected" onclick="keywords_displayAverageRanks();" id="keywords_averageRankHeader">Avg</span>

              /
              <span class="Control" onclick="keywords_displayCurrentRanks();" id="keywords_currentRankHeader">Cur</span>
            </nobr>
          </th>
        </tr>
      </thead>
      
      <tbody>
        <tr
          spry:repeat="keywordsData"
          spry:test="{ds_RowNumber} &gt;= (keywords_startAt - 1) &amp;&amp; {ds_RowNumber} &lt; keywords_endAt"
        >
          <td spry:if="keywords_activeTab == 'all'" class="NumericColumn">

            {keywordsData::Hits}
          </td>
          <td spry:if="keywords_activeTab == 'recent'" class="NumericColumn">
            {keywordsData::TimeAgo} ago
          </td>
          
          <td spry:if="keywords_activeTab != 'recent'">
              <img
    src="http://dev.seoq.com/quotient/img/searchEngines/{keywordsData::SearchEngineIconURL}"
    spry:if="'{keywordsData::SearchEngineIconURL}' != ''"
    class="RightFloatIcon"
  />
  <img
    src="http://dev.seoq.com/quotient/img/searchEngines/generic.png"
    spry:if="'{keywordsData::SearchEngineIconURL}' == ''"
    class="RightFloatIcon"
  />
            <big spry:if="'{keywordsData::SearchURL}' != ''">
              <a
                href="{keywordsData::SearchURL}" target="_blank"
                id="tooltipTrigger_keywordsKW_alltime_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}"
              >

                {keywordsData::SearchEngineKeyword}
              </a>
            </big>
            <big
              spry:if="'{keywordsData::SearchURL}' == ''"
              id="tooltipTrigger_keywordsKW_alltime_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}"
            >
              {keywordsData::SearchEngineKeyword}
            </big>
            
                        <div
              class="Tooltip"
              id="tooltipContentProxy_keywordsKW_alltime_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}"
              spry:if="'{keywordsData::OriginalSearchEngineKeyword}' != '{keywordsData::SearchEngineKeyword}'"
            >
              {keywordsData::OriginalSearchEngineKeyword}<br/>
            </div>

            
            <script
              spry:if="'{keywordsData::OriginalSearchEngineKeyword}' != '{keywordsData::SearchEngineKeyword}'"
            >
              createTooltipFromProxy(
                'tooltipContentProxy_keywordsKW_alltime_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}',
                '#tooltipTrigger_keywordsKW_alltime_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}'
              );
            </script>
          </td>
          <td spry:if="keywords_activeTab == 'recent'">
              <img
    src="http://dev.seoq.com/quotient/img/searchEngines/{keywordsData::SearchEngineIconURL}"
    spry:if="'{keywordsData::SearchEngineIconURL}' != ''"
    class="RightFloatIcon"
  />
  <img
    src="http://dev.seoq.com/quotient/img/searchEngines/generic.png"
    spry:if="'{keywordsData::SearchEngineIconURL}' == ''"
    class="RightFloatIcon"
  />
            <a
              spry:if="'{keywordsData::SearchURL}' != ''"
              href="{keywordsData::SearchURL}"
              target="_blank"
              id="tooltipTrigger_keywordsKW_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}"
            >
              {keywordsData::SearchEngineKeyword}
            </a>
            <span
              spry:if="'{keywordsData::SearchURL}' == ''"
              id="tooltipTrigger_keywordsKW_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}"
            >

              {keywordsData::SearchEngineKeyword}
            </span>
            
            <br/>
            
            <small>
              Page:
              <a
                href="{keywordsData::CurrentPage}"
                target="_blank"
                id="tooltipTrigger_keywords_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}"
              >
                {keywordsData::CurrentPageTitle}
              </a>
            </small>
            
                        <div
              class="Tooltip"
              id="tooltipContentProxy_keywordsKW_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}"
              spry:if="'{keywordsData::OriginalSearchEngineKeyword}' != '{keywordsData::SearchEngineKeyword}'"
            >

              {keywordsData::OriginalSearchEngineKeyword}<br/>
            </div>
            
            <script
              spry:if="'{keywordsData::OriginalSearchEngineKeyword}' != '{keywordsData::SearchEngineKeyword}'"
            >
              createTooltipFromProxy(
                'tooltipContentProxy_keywordsKW_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}',
                '#tooltipTrigger_keywordsKW_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}'
              );
            </script>
            
                        <div
              class="Tooltip"
              id="tooltipContentProxy_keywords_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}"
            >
              {keywordsData::OriginalCurrentPageTitle}<br/>
              <small>{keywordsData::CurrentPage}</small>
            </div>

            
            <script>
              createTooltipFromProxy(
                'tooltipContentProxy_keywords_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}',
                '#tooltipTrigger_keywords_{keywordsData::ds_RowID}_{function::retrieveCurrentDomainId}'
              );
            </script>
          </td>
          
          <td class="NumericColumn" spry:if="keywords_activeTab == 'recent'">
            <span spry:if="'{keywordsData::KeywordRank}' != '0'">
              {keywordsData::KeywordRank}
            </span>
            
            <span
              spry:if="'{keywordsData::KeywordRank}' == '0'"
              blvdKeyword="{keywordsData::SearchEngineKeyword}"
              id="realtimeKeywordRank_{keywordsData::ds_RowID}"
            >
              N/A
              <script>
                keywords_loadRealtimeRank(
                  "realtimeKeywordRank_{keywordsData::ds_RowID}",
                  "{keywordsData::CurrentPage}",
                  "{keywordsData::ds_RowID}",
                  "{keywordsData::SearchEngineID}"
                );
              </script>

            </span>
          </td>
          
          <td class="NumericColumn" spry:if="keywords_activeTab != 'recent'">
                        <span id="keywords_allTimeRanking_averageRankColumn" class="keywords_AverageRankDisplay" style="display: none;">
              <span spry:if="'{keywordsData::AverageRank}' != '0'">
                {keywordsData::AverageRank}
              </span>
              <span spry:if="'{keywordsData::AverageRank}' == '0'">
                N/A
              </span>

            </span>
            
                        <span id="keywords_allTimeRanking_currentRankColumn" class="keywords_CurrentRankDisplay" style="display: none;">
              <span spry:if="'{keywordsData::KeywordRank}' != '0'">
                {keywordsData::KeywordRank}
              </span>
              
              <span
                spry:if="'{keywordsData::KeywordRank}' == '0'"
                blvdKeyword="{keywordsData::SearchEngineKeyword}"
                id="realtimeKeywordRank_allTime_{keywordsData::ds_RowID}"
              >
                N/A
                <script>
                  keywords_loadRealtimeRank(
                    "realtimeKeywordRank_allTime_{keywordsData::ds_RowID}",
                    "{userDomainData::DomainName}",
                    "{keywordsData::ds_RowID}",
                    "{keywordsData::SearchEngine}"
                  );
                </script>
              </span>

            </span>
          </td>
        </tr>
      </tbody>
    </table>
    
    <script>
      if (keywords_activeTab == 'all') {
        if (keywords_allTimeRanking_activeRanking == 'Avg') {
          keywords_displayRankNodes('keywords_AverageRankDisplay', 'inline');
          keywords_displayRankNodes('keywords_CurrentRankDisplay', 'none');
        } else {
          keywords_displayRankNodes('keywords_AverageRankDisplay', 'none');
          keywords_displayRankNodes('keywords_CurrentRankDisplay', 'inline');
        }
      }
    </script>
  </div>
</div>
      </div><div class="PagerBar"><span class="PagerHeader">Show: </span><span class="PageLink CurrentPageLink" onclick="pageKeywords('1', '10', this);">1 - 10</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageKeywords('11', '20', this);">11 - 20</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageKeywords('21', '30', this);">21 - 30</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageKeywords('31', '40', this);">31 - 40</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageKeywords('41', '50', this);">41 - 50</span></div></div><div class="Bottom"><div class="BottomLeftCorner"></div><div class="BottomRightCorner"></div><div class="BottomCenter"></div><div class="BottomShadow"></div></div></div><script>disableSelectionById('SearchKeywordsBox');</script>    
    <!-- END TO SEARCH KEYWORDS WIDGET -->
  
    <!-- SITE URLS WIDGET -->

  <div class="BoxGridBox SitePagesBox" id="SitePagesBox" boxSymbol="SU">
    <div class="TabArea">
      <div class="Tab CurrentTab" onclick="tab_siteUrlsRecent(this);">Recent</div>
<div class="Tab" onclick="tab_siteUrlsLive(this);">Live</div>
<div class="Tab" onclick="tab_siteUrlsAllTime(this);">All Time</div>

    </div>
    
    <div class="LeftEdge"></div>
    <div class="RightEdge"></div>
    <div class="TopEdge"></div>
    
    <div class="LeftShadow"></div>
    <div class="RightShadow"></div>
    
    <div class="BoxTitleBar">
      <div class="BoxGridRefreshControl">

        Refresh:
        <select class="RefreshControlSelect" id="SitePagesBox_refreshSelect" onchange="refreshChange_siteUrls(this);">
          <option value="0">Never</option>
          <option value="0.5">30 sec</option>
          <option value="1">1 min</option>
          <option value="3">3 min</option>
          <option value="10">10 min</option>
          <option value="15" selected="selected">15 min</option>

        </select>
        <script>
          var selectNode = Spry.$('SitePagesBox_refreshSelect');
          
          selectNode.onclick = function(e) {
            if (!e) var e = window.event
            e.cancelBubble = true;
            if (e.stopPropagation) e.stopPropagation();
          }
        </script>
      </div>
      <span class="BoxGridBoxIcon"> Site URLs</span>
    </div>
    <div class="BoxBackground">
      <div class="BoxContent">        <script>
  var urlData = new Spry.Data.JSONDataSet(
    "/admin/blvdstatus/hitsPerPage/{userDomainData::DomainName}/recent",
    { path: "data", filterDataFunc: adjustUrlData }
  );

</script>

<div class="DataDisplayRegion" id="urlDataDisplay" spry:region="urlData">
  <div spry:state="loading" class="LoadingPlaceholder">
    <div style="padding-top: 70%;"><img src="/resources/blvdstatus/img/box_parts/loading_siteURLs.gif"  style="margin-top: -100px;"/></div>
  </div>
  
  <table border="0" cellspacing="0" cellpadding="0" spry:state="ready">
    <thead>
      <tr>
        <th class="NumericColumn">

          <span spry:if="siteUrls_activeTab == 'live'">Users</span>
          <span spry:if="siteUrls_activeTab == 'all'">Hits</span>
          <span spry:if="siteUrls_activeTab == 'recent'">Time</span>
        </th>
        <th>Page</th>
      </tr>
    </thead>

    
    <tbody>
        <tr
          spry:repeat="urlData"
          spry:test="{ds_RowNumber} &gt;= (siteUrls_startAt - 1) &amp;&amp; {ds_RowNumber} &lt; siteUrls_endAt"
        >
          <td spry:if="siteUrls_activeTab == 'all'" class="NumericColumn">
            {urlData::Hits}
          </td>
          <td spry:if="siteUrls_activeTab == 'live'" class="NumericColumn">
            {urlData::Visitors}
          </td>
          <td spry:if="siteUrls_activeTab == 'recent'" class="NumericColumn">
            <nobr>{urlData::TimeAgo} ago</nobr>

          </td>
          
          <td spry:if="'{urlData::Title}' == ''">
            <big><a href="{urlData::OriginalURL}" target="_blank" id="tooltipTrigger_urls_{urlData::ds_RowID}_{function::retrieveCurrentDomainId}_{function::retrieveSiteUrlsActiveTab}">{urlData::URL}</a></big>
            
                        <div
              class="Tooltip"
              id="tooltipContentProxy_urls_{urlData::ds_RowID}_{function::retrieveCurrentDomainId}_{function::retrieveSiteUrlsActiveTab}"
            >
              {urlData::OriginalURL}<br/>
            </div>
            
            <script>
              createTooltipFromProxy(
                'tooltipContentProxy_urls_{urlData::ds_RowID}_{function::retrieveCurrentDomainId}_{function::retrieveSiteUrlsActiveTab}',
                '#tooltipTrigger_urls_{urlData::ds_RowID}_{function::retrieveCurrentDomainId}_{function::retrieveSiteUrlsActiveTab}'
              );
            </script>

          </td>
          <td spry:if="'{urlData::Title}' != ''">
            <big><a href="{urlData::OriginalURL}" target="_blank" id="tooltipTrigger_urls_{urlData::ds_RowID}_{function::retrieveCurrentDomainId}_{function::retrieveSiteUrlsActiveTab}">{urlData::Title}</a></big>
            
                        <div
              class="Tooltip"
              style="display: none;"
              id="tooltipContentProxy_urls_{urlData::ds_RowID}_{function::retrieveCurrentDomainId}_{function::retrieveSiteUrlsActiveTab}"
            >
              {urlData::OriginalTitle}<br/>
              <small>{urlData::OriginalURL}</small>
            </div>

            
            <script>
              createTooltipFromProxy(
                'tooltipContentProxy_urls_{urlData::ds_RowID}_{function::retrieveCurrentDomainId}_{function::retrieveSiteUrlsActiveTab}',
                '#tooltipTrigger_urls_{urlData::ds_RowID}_{function::retrieveCurrentDomainId}_{function::retrieveSiteUrlsActiveTab}'
              );
            </script>
          </td>
        </tr>
    </tbody>
  </table>
</div>
      </div><div class="PagerBar"><span class="PagerHeader">Show: </span><span class="PageLink CurrentPageLink" onclick="pageSiteUrls('1', '10', this);">1 - 10</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageSiteUrls('11', '20', this);">11 - 20</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageSiteUrls('21', '30', this);">21 - 30</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageSiteUrls('31', '40', this);">31 - 40</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageSiteUrls('41', '50', this);">41 - 50</span></div></div><div class="Bottom"><div class="BottomLeftCorner"></div><div class="BottomRightCorner"></div><div class="BottomCenter"></div><div class="BottomShadow"></div></div></div><script>disableSelectionById('SitePagesBox');</script>   
    <!-- END SITE URLS WIDGET -->
    
    
      <!-- FOOT TRAFIC WIDGET -->
    
                <div class="BoxGridBox FootTrafficBox" id="FootTrafficBox" boxSymbol="FT">
    <div class="TabArea">
      <div class="Tab CurrentTab" onclick="tab_traffic(this, 0);">Hourly</div>
<!--<div class="Tab" onclick="tab_trafficWeekly(this);">Daily</div>
<div class="Tab" onclick="tab_trafficMonthly(this);">Weekly</div>
<div class="Tab" onclick="tab_trafficYearly(this);">Monthly</div> -->

    </div>
    
    <div class="LeftEdge"></div>
    <div class="RightEdge"></div>
    <div class="TopEdge"></div>
    
    <div class="LeftShadow"></div>
    <div class="RightShadow"></div>
    
    <div class="BoxTitleBar">
      <div class="BoxGridRefreshControl">
        Refresh:
        <select class="RefreshControlSelect" id="FootTrafficBox_refreshSelect" onchange="refreshChange_traffic(this);">

          <option value="0">Never</option>
          <option value="0.5">30 sec</option>
          <option value="1">1 min</option>
          <option value="3">3 min</option>
          <option value="10">10 min</option>
          <option value="15" selected="selected">15 min</option>
        </select>

        <script>
          var selectNode = Spry.$('FootTrafficBox_refreshSelect');
          
          selectNode.onclick = function(e) {
            if (!e) var e = window.event
            e.cancelBubble = true;
            if (e.stopPropagation) e.stopPropagation();
          }
        </script>
      </div>
      <span class="BoxGridBoxIcon"> Foot Traffic</span>
    </div>
    <div class="BoxBackground">
      <div class="BoxContent">        <script>
  var hourlyTrafficData = new Spry.Data.JSONDataSet(
      "/admin/blvdstatus/hourlyTraffic/{userDomainData::DomainName}" +
      "/" + traffic_year +
      "/" + traffic_day +
      "/" + traffic_month + 
      "/0/24" //      /StartHour/EndHour
    , { path: "data", filterDataFunc: adjustTrafficData }
  );
  
  var rssTrafficData = new Spry.Data.JSONDataSet(
    "/admin/blvdstatus/feedburnerSubscriptions/{userDomainData::DomainName}"
    ,  { path: "data" }
  );
  
  var currentVisitorTrafficData = new Spry.Data.JSONDataSet(
    "/admin/blvdstatus/currentVisitorData/{userDomainData::DomainName}/total"
    ,  { path: "data" }
  );
</script>

<div class="DataDisplayRegion" id="hourlyTrafficDataDisplay" spry:region="hourlyTrafficData rssTrafficData currentVisitorTrafficData">
  <div spry:state="loading" class="LoadingPlaceholder">
    <div style="padding-top: 70%"><img src="/resources/blvdstatus/img/box_parts/loading_traffic.gif" style="margin-top: -100px;"/></div>
  </div>
  
  <div spry:state="ready">
    <table border="0" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th>Time</th>

          <th class="NumericColumn">Hits</th>
          <th class="NumericColumn">Unique</th>
          <th class="NumericColumn">Conv</th>
        </tr>
      </thead>
      
      <tbody>
        
        <tr spry:repeat="hourlyTrafficData" spry:test="{hourlyTrafficData::ds_RowNumber} >= traffic_startHour && {hourlyTrafficData::ds_RowNumber} <= traffic_endHour">

          <td
            
          >
            {hourlyTrafficData::Display}
          </td>
          <td
            class="NumericColumn"
            
          >
            {hourlyTrafficData::TotalHits}
          </td>
          <td
            class="NumericColumn"
            
          >
            {hourlyTrafficData::UniqueHits}
          </td>
          <td
            class="NumericColumn"
            
          >

            {hourlyTrafficData::Conversions}
          </td>
        </tr>
        
      </tbody>
    </table>
    
    <h1>
      <img src="http://dev.seoq.com/quotient/img/icon_feedburner.png" />
      RSS Statistics
    </h1>
    
    <div>

      <div class="ShortSummary" spry:repeat="rssTrafficData">
        <h1>
          {rssTrafficData::Title}
        </h1>
        <div>
          Subscribers: {rssTrafficData::Circulation}
        </div>
      </div>
    </div>
    
    <div>

      <a href="manageFeeds.php" rel="shadowbox" target="_blank">Manage your feedburner account</a>
    </div>
    
    <div class="ShortSummary">
      There
      <span spry:if="'{currentVisitorTrafficData::Visitors}' != '1'">are</span>
      <span spry:if="'{currentVisitorTrafficData::Visitors}' == '1'">is</span>
      currently about {currentVisitorTrafficData::Visitors}
      visitor<span spry:if="'{currentVisitorTrafficData::Visitors}' != '1'">s</span>

      on your site.
    </div>
  </div>
</div>
    
      </div><div class="PagerBar"><span class="PagerHeader">Show: </span><span class="PageLink " onclick="pageTraffic('0', '5', this);">Early</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageTraffic('6', '11', this);">Morning</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageTraffic('12', '17', this);">Afternoon</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageTraffic('18', '23', this);">Evening</span></div></div><div class="Bottom"><div class="BottomLeftCorner"></div><div class="BottomRightCorner"></div><div class="BottomCenter"></div><div class="BottomShadow"></div></div></div><script>disableSelectionById('FootTrafficBox');</script>   
    <!-- END FOOT TRAFIC WIDGET -->


<!-- OUTGOING LINKS WIDGET -->

                <div class="BoxGridBox OutgoingLinksBox" id="OutgoingLinksBox" boxSymbol="OL">
    <div class="TabArea">
      <div class="Tab CurrentTab" onclick="tab_outgoingLinksRecent(this);">Recent</div>
<div class="Tab" onclick="tab_outgoingLinksAllTime(this);">All Time</div>

    </div>
    
    <div class="LeftEdge"></div>
    <div class="RightEdge"></div>
    <div class="TopEdge"></div>
    
    <div class="LeftShadow"></div>
    <div class="RightShadow"></div>
    
    <div class="BoxTitleBar">
      <div class="BoxGridRefreshControl">
        Refresh:
        <select class="RefreshControlSelect" id="OutgoingLinksBox_refreshSelect" onchange="refreshChange_outgoingLinks(this);">

          <option value="0">Never</option>
          <option value="0.5">30 sec</option>
          <option value="1">1 min</option>
          <option value="3">3 min</option>
          <option value="10">10 min</option>
          <option value="15" selected="selected">15 min</option>
        </select>

        <script>
          var selectNode = Spry.$('OutgoingLinksBox_refreshSelect');
          
          selectNode.onclick = function(e) {
            if (!e) var e = window.event
            e.cancelBubble = true;
            if (e.stopPropagation) e.stopPropagation();
          }
        </script>
      </div>
      <span class="BoxGridBoxIcon"> Outgoing Links</span>
    </div>
    <div class="BoxBackground">
      <div class="BoxContent">        <script>
  var outgoingLinkData = new Spry.Data.JSONDataSet(
    "/admin/blvdstatus/outgoingLinks/{userDomainData::DomainName}/recent",
    { path: "data", filterDataFunc: adjustOutgoingLinksData }
  );
</script>

<div class="DataDisplayRegion" id="outgoingLinkDataDisplay" spry:region="outgoingLinkData">
  <div spry:state="loading" class="LoadingPlaceholder">
    <div style="padding-top: 70%"><img src="/resources/blvdstatus/img/box_parts/loading_outgoingLinks.gif" style="margin-top: -100px;"/></div>
  </div>
  
  <table border="0" cellspacing="0" cellpadding="0" spry:state="ready">
    <thead>
      <tr>
        <th
          class="NumericColumn"
          spry:if="outgoingLinks_activeTab == 'all'"
        >
          Hits
        </th>

        <th
          class="NumericColumn"
          spry:if="outgoingLinks_activeTab == 'recent'"
        >
          Time
        </th>
        
        <th>Link</th>
      </tr>
    </thead>
    
    <tbody>
      <tr
        spry:repeat="outgoingLinkData"
        spry:test="{ds_RowNumber} &gt;= (outgoingLinks_startAt - 1) &amp;&amp; {ds_RowNumber} &lt; outgoingLinks_endAt"
      >
        <td
          class="NumericColumn"
          spry:if="outgoingLinks_activeTab == 'all'"
        >

          {outgoingLinkData::Hits}
        </td>
        <td
          class="NumericColumn"
          spry:if="outgoingLinks_activeTab == 'recent'"
        >
          {outgoingLinkData::TimeAgo} ago
        </td>
        
        <td>
          <big>
            <a
              href="{outgoingLinkData::OriginalURL}"
              target="_blank"
              id="tooltipTrigger_outgoing_{outgoingLinkData::ds_RowID}_{function::retrieveCurrentDomainId}_{function::retrieveOutgoingLinksActiveTab}"
            >
              {outgoingLinkData::URL}
            </a>

          </big>
          
                    <div
            class="Tooltip"
            id="tooltipContentProxy_outgoing_{outgoingLinkData::ds_RowID}_{function::retrieveCurrentDomainId}_{function::retrieveOutgoingLinksActiveTab}"
          >
            {outgoingLinkData::OriginalURL}<br/>
          </div>
          
          <script>
            createTooltipFromProxy(
              'tooltipContentProxy_outgoing_{outgoingLinkData::ds_RowID}_{function::retrieveCurrentDomainId}_{function::retrieveOutgoingLinksActiveTab}',
              '#tooltipTrigger_outgoing_{outgoingLinkData::ds_RowID}_{function::retrieveCurrentDomainId}_{function::retrieveOutgoingLinksActiveTab}'
            );
          </script>
        </td>
      </tr>
    </tbody>

  </table>
</div>
      </div><div class="PagerBar"><span class="PagerHeader">Show: </span><span class="PageLink CurrentPageLink" onclick="pageOutgoingLinks('1', '10', this);">1 - 10</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageOutgoingLinks('11', '20', this);">11 - 20</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageOutgoingLinks('21', '30', this);">21 - 30</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageOutgoingLinks('31', '40', this);">31 - 40</span><span class="PageDivider"> | </span><span class="PageLink " onclick="pageOutgoingLinks('41', '50', this);">41 - 50</span></div></div><div class="Bottom"><div class="BottomLeftCorner"></div><div class="BottomRightCorner"></div><div class="BottomCenter"></div><div class="BottomShadow"></div></div></div><script>disableSelectionById('OutgoingLinksBox');</script>        
    <!-- END TO OUTGOING LINKS WIDGET -->

  


            
</div>     
            

<script>
var boxGrid1 = new Blvd.Widget.BoxGrid("boxGridTest", { boxHeight: 300 } );

Spry.Utils.addLoadListener(Shadowbox.init);
</script>

<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>