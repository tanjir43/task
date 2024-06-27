<header role="banner">
    <div class="csh-wrapper">
      <div class="csh-header-main">
        <a href="index.html" role="none" class="csh-header-main-logo"
          ><img
            src="../../storage.crisp.chat/users/helpdesk/website/60c4bca58bb99c00/teleportlogo-v24_1tjg8fo.svg"
            alt="TeleportHQ Help Center"
        /></a>
        <div role="none" class="csh-header-main-actions">
          <a
            href="https://teleporthq.io/"
            target="_blank"
            rel="noopener noreferrer"
            role="none"
            class="csh-header-main-actions-website"
            ><span
              class="csh-header-main-actions-website-itself csh-font-sans-regular"
              >Go to website</span
            ></a
          >
        </div>
        <span class="csh-clear"></span>
      </div>
      <div class="csh-header-title csh-text-wrap csh-font-sans-medium">
        How can we help you?
      </div>
      <form
        action="https://help.teleporthq.io/en/includes/search/"
        role="search"
        onsubmit="return false"
        data-target-suggest="/en/includes/suggest/"
        data-target-report="/en/includes/report/"
        data-has-emphasis="true"
        data-has-focus="false"
        data-expanded="false"
        data-pending="false"
        class="csh-header-search"
      >
        <span class="csh-header-search-field"
          ><input
            type="search"
            name="search_query"
            autocomplete="off"
            autocorrect="off"
            autocapitalize="off"
            maxlength="100"
            placeholder="Search our help center..."
            aria-label="Search our help center..."
            role="searchbox"
            onfocus="CrispHelpdeskCommon.toggle_search_focus(true)"
            onblur="CrispHelpdeskCommon.toggle_search_focus(false)"
            onkeydown="CrispHelpdeskCommon.key_search_field(event)"
            onkeyup="CrispHelpdeskCommon.type_search_field(this)"
            onsearch="CrispHelpdeskCommon.search_search_field(this)"
            class="csh-font-sans-regular" /><span
            class="csh-header-search-field-autocomplete csh-font-sans-regular"
          ></span
          ><span class="csh-header-search-field-ruler"
            ><span
              class="csh-header-search-field-ruler-text csh-font-sans-semibold"
            ></span></span
        ></span>
        <div class="csh-header-search-results"></div>
      </form>
    </div>
    <div
      data-tile="squares-in-squares"
      data-has-banner="true"
      class="csh-header-background csh-theme-background-color-default"
    >
      <span
        style="
          background-image: url('{{asset('ad_banner.png')}}');
        "
        class="csh-header-background-banner"
      ></span>
    </div>
  </header>