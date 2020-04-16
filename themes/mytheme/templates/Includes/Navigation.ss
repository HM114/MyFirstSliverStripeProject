<nav class="primary">
	<span class="nav-open-button">²</span>
	<ul>
		<% loop $Menu(1) %>

				<li class="<% if $isCurrent %>current<% else_if $isSection %>section<% end_if %>">
            				<a href="$Link" title="$Title.XML">$MenuTitle.XML</a>
            			</li>
		<% end_loop %>
	</ul>
</nav>
