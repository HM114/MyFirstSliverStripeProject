<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
    <article>
        <h1>$Title</h1>
        <div class="content">
            $Content
            <h2>Students</h2>
            <% if $Students %>
                <ul>
                    <% loop $Students %>
                        <li>$Name ($University)</li>
                    <% end_loop %>
                </ul>
            <% else %>
                <p>No students found</p>
            <% end_if %>
            <h2>Mentors</h2>
            <% if $Mentors %>
                <ul>
                    <% loop $Mentors %>
                        <li>$Name</li>
                    <% end_loop %>
                </ul>
            <% else %>
                <p>No mentors found</p>
            <% end_if %>
        </div>
    </article>
</div>
