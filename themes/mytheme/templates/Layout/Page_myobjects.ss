<% with $MyObject %>
    <h1>$Title</h1>
    <a href="$Project.Link">
        $Project.Title
    </a>
    <div>
    <% loop $Project.Students %>
       <h3>$Name ($University)</h3>
    <% end_loop %>
    </div>

<%--    <% include $Project.Students %>--%>
    etc....
<% end_with %>
