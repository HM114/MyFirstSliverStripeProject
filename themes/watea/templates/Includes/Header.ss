<div class="container site-header clearfix">
    <% include SkipLinks %>
    <div class="site-header-brand">
        <a title="<%t CWP_Header.Title "Go to Home Page" %>" class="site-header-brand-link-default" href="$BaseHref">
           <img src="$resourceURL('themes/simple/images/cmd-icon@4x-8.png')" max-height="5"/>
            <span<% if $SiteConfig.Logo %> class="sr-only"<% end_if %>>$SiteConfig.Title</span>
        </a>
        <% if $SiteConfig.Tagline %>
            <span class="site-header-brand-tagline small">$SiteConfig.Tagline</span>
        <% end_if %>
    </div>
    <div class="navbar-expand-md navbar-dark">
        <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
            <span class="sr-only"><%t CWP_Header.Toggle "Toggle navigation" %></span>
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <% include HeaderSearch %>
    <% include LanguageSelector %>
</div>
